<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Console\Command;

class SendDebugEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rookout:send-debug-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Go through and send out all active debug events';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Run the process every 3 seconds twenty times in a min
        // We have to do this since we cant set crontab to be every second :(
        foreach (range(1, 500) as $i) {
            $this->process();
            sleep(3);
        }

        return Command::SUCCESS;
    }

    private function process()
    {
        $this->info('Removing all debug events and user session that are older than 1 hour');
        User::where( 'updated_at', '<=', Carbon::now()->subMinutes( 60 ) )->delete();
        $this->info('Executing all active debug events');

        $users = User::with('debug_events')->whereHas('debug_events')->get();
        foreach ($users as $user) {

            $this->warn('======================================');
            $this->info('');

            $investigationApp = $user->debug_events->first()->investigation_app;
            $this->info('Investigation App: ' . $investigationApp->name . ' (' . $investigationApp->language . ')');
            $this->info('Investigation App Endpoint: ' . $investigationApp->endpoint);
            $this->info('');
            $this->info('User ID: ' . $user->id);
            $this->info('');
            foreach ($user->debug_events as $debugEvent) {
                $this->info('Debug Event ID: ' . $debugEvent->id);
                $this->info('Stage: ' . $debugEvent->stage);
                $this->info('File Path: ' . $debugEvent->file_path);
                $this->info('Line Number: ' . $debugEvent->line_number);
                $this->info('Function: ' . $debugEvent->function);
                $this->info('Function Data: ' . $debugEvent->pivot->function_data);
                $this->info('');

                $cookieJar = CookieJar::fromArray([
                    'identity' => $user->cookie,
                ], config('session.domain'));

                $client = new Client(['cookies' => true]);

                $client->request('POST', $debugEvent->investigation_app->endpoint, [
                    'cookies' => $cookieJar,
                    'json' => [
                        'function' => $debugEvent->function,
                        'function_data' => json_decode($debugEvent->pivot->function_data, true),
                    ],
                    'headers' => [
                        'Accept' => 'application/json',
                    ]
                ]);
            }

        }
    }
}
