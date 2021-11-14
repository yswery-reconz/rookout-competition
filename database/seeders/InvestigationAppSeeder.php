<?php

namespace Database\Seeders;

use App\Models\InvestigationApp;
use Illuminate\Database\Seeder;

class InvestigationAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app = new InvestigationApp();
        $app->name = 'Our NodeJS App';
        $app->language = 'nodejs';
        $app->endpoint = 'http://192.168.1.252:4000/exec';
        $app->save();
    }
}
