<?php

namespace Database\Seeders;

use App\Models\DebugEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DebugEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate random 100 debug events
        foreach (range(1, 1000) as $i) {
            $debugEvent = new DebugEvent();
            $debugEvent->investigation_app_id = 1;
            $debugEvent->file_path = 'src/' . strtolower(Str::random(6)) . '/' . strtolower(Str::random(10)) . '.js';
            $debugEvent->line_number = rand(1, 1000);
            $debugEvent->function = Str::random(8);
            $debugEvent->stage = rand(1, 3);
            $debugEvent->save();
        }
    }
}
