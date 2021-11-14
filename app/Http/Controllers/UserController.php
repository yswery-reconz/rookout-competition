<?php

namespace App\Http\Controllers;

use App\Models\DebugEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Faker\Factory as Faker;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // check if the user already has a valid cookie on their system
        // If not, then lets create a new user
        if (!$user = User::where('cookie', $request->cookie('identity'))->first()) {
            $user = new User();
            $user->cookie = Str::random();
            $user->token = Str::random(48);
            $user->save();
        }

        // Check if the user has already submitted their token
        if ($user->email && $user->stop_time) {
            return redirect()->route('success');
        }

        return response()
            ->view('home', compact('user'))
            ->withCookie(cookie()->forever('identity', $user->cookie));
    }

    public function start(Request $request)
    {
        if (!$user = User::where('cookie', $request->cookie('identity'))->first()) {
            return abort('403', 'Please make sure your Browser cookies are enabled and start again');
        }

        // Start the timer
        $user->start_time = time();
        $user->save();

        // Set the token randomly in the next
        $faker = Faker::create();

        $debugEventStage3 = $debugEvent = DebugEvent::inRandomOrder()->where('stage', 3)->first();
        $user->debug_events()->attach([
            // Create the final nested object
            $debugEventStage3->id => [
                'function_data' => json_encode([
                    'cookie' => $user->cookie,
                    'hidden_token' => random2DArrayWithToken($user->token)
                ])
            ]
        ]);

        $debugEventStage2 = $debugEvent = DebugEvent::inRandomOrder()->where('stage', 2)->first();
        $stage2Token = Str::random(8);
        $user->debug_events()->attach([
            // Create the final nested object
            $debugEventStage2->id => [
                'function_data' => json_encode([
                    'cookie' => $user->cookie,
                    'token' => $stage2Token,
                    strtolower($faker->word) => $faker->word,
                    strtolower($faker->word) => $faker->word,
                    strtolower($faker->word) => $faker->word,
                    'competition_clue' => 'In file ' . $debugEventStage3->file_path . ' on line ' . $debugEventStage3->line_number . ' you will find a multi dimensional array where one of the object is going to be your secret token!',
                ])
            ]
        ]);

        // Add 9 extra fake events fore stage 2
        foreach (range(1, 9) as $index) {
            $randomDebugEvent = DebugEvent::inRandomOrder()->first();
            $user->debug_events()->attach([
                // Create the final nested object
                $debugEventStage2->id => [
                    'function_data' => json_encode([
                        'cookie' => $user->cookie,
                        'token' => Str::random(8),
                        strtolower($faker->word) => $faker->word,
                        strtolower($faker->word) => $faker->word,
                        strtolower($faker->word) => $faker->word,
                        'competition_clue' => 'In file ' . $randomDebugEvent->file_path . ' on line ' . $randomDebugEvent->line_number . ' you will find a multi dimensional array where one of the object is going to be your secret token!',
                    ])
                ]
            ]);
        }

        $debugEventStage1 = $debugEvent = DebugEvent::inRandomOrder()->where('stage', 1)->first();
        $user->debug_events()->attach([
            // Create the final nested object
            $debugEventStage1->id => [
                'function_data' => json_encode([
                    'cookie' => $user->cookie,
                    strtolower($faker->word) => $faker->word,
                    strtolower($faker->word) => $faker->word,
                    strtolower($faker->word) => $faker->word,
                    strtolower($faker->word) => $faker->word,
                    strtolower($faker->word) => $faker->word,
                    'competition_clue' => 'In file ' . $debugEventStage2->file_path . ' on line ' . $debugEventStage2->line_number . ' you will find a your next clue! You will need to use the following: ' . $stage2Token,
                ])
            ]
        ]);

        return redirect()->route('home');
    }

    public function stop(Request $request)
    {
        if (!$user = User::where('cookie', $request->cookie('identity'))->first()) {
            return abort('403', 'Please make sure your Browser cookies are enabled and start again');
        }

        $rules = [
            'token' => [
                'required',
                Rule::exists('users', 'token')
                    ->where('cookie', $user->cookie),
            ],
        ];

        $this->validate($request, $rules);

        $user->stop_time = time();
        $user->save();

        return redirect()->route('submit-info');
    }

    public function leaderboard()
    {
        $users = User::whereNotNull('start_time')
            ->whereNotNull('stop_time')
            ->whereNotNull('email')
            ->select('*', DB::raw(' `stop_time` - `start_time` AS  time_diff'))
            ->orderBy('time_diff', 'ASC')
            ->get();

        return view('leaderboard')->with(compact('users'));
    }

    public function submitInfo(Request $request)
    {
        if (!$user = User::where('cookie', $request->cookie('identity'))->first()) {
            return abort('403', 'Please make sure your Browser cookies are enabled and start again');
        }

        if (!$user->stop_time) {
            return abort('403', 'You have to make sure you submit the correct token first');
        }

        return view('submit-info');
    }

    public function doSubmitInfo(Request $request)
    {
        if (!$user = User::where('cookie', $request->cookie('identity'))->first()) {
            return abort('403', 'Please make sure your Browser cookies are enabled and start again');
        }

        if (!$user->stop_time) {
            return abort('403', 'You have to make sure you submit the correct token first');
        }

        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);

        $user->email = $request->input('email');
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->save();

        // Remove all related debug events
        $user->debug_events()->detach();

        return redirect()->route('success');
    }

    public function success(Request $request)
    {
        if (!$user = User::where('cookie', $request->cookie('identity'))->first()) {
            return abort('403', 'Please make sure your Browser cookies are enabled and start again');
        }

        if (!$user->stop_time || !$user->email) {
            return redirect()->route('home');
        }

        return view('success')->with(compact('user'));
    }
}
