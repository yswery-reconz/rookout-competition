<?php

use App\Models\InvestigationApp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestigationAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigation_apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('language');
            $table->string('endpoint');
            $table->timestamps();
        });

        // Populate our first Application
        $app = new InvestigationApp();
        $app->name = 'TodoList NodeJS App';
        $app->language = 'nodejs';
        $app->endpoint = 'http://172.20.10.5:4000/exec';
        $app->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('investigation_apps');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
