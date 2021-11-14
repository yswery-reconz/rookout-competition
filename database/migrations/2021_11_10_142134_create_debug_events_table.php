<?php

use App\Models\DebugEvent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateDebugEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debug_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investigation_app_id');
            $table->foreign('investigation_app_id')
                ->references('id')
                ->on('investigation_apps')
                ->onDelete('cascade');
            $table->integer('stage');
            $table->string('file_path');
            $table->integer('line_number')->unsigned();
            $table->string('function');
            $table->timestamps();
        });


        // Populate our first debug events
        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/utils.js ';
        $debugEvent->line_number = 8;
        $debugEvent->function = 'cleanString';
        $debugEvent->stage = 1;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/todos.js';
        $debugEvent->line_number = 34;
        $debugEvent->function = 'addNewTodo';
        $debugEvent->stage = 1;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/todos.js';
        $debugEvent->line_number = 48;
        $debugEvent->function = 'getAll';
        $debugEvent->stage = 1;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/todos.js';
        $debugEvent->line_number = 65;
        $debugEvent->function = 'add';
        $debugEvent->stage = 1;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/todos.js';
        $debugEvent->line_number = 87;
        $debugEvent->function = 'update';
        $debugEvent->stage = 1;
        $debugEvent->save();

        // ========================================

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/utils/store.js';
        $debugEvent->line_number = 116;
        $debugEvent->function = 'remove';
        $debugEvent->stage = 2;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/utils/store.js';
        $debugEvent->line_number = 135;
        $debugEvent->function = 'ClearCompleted';
        $debugEvent->stage = 2;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/utils/store.js';
        $debugEvent->line_number = 154;
        $debugEvent->function = 'ToggleAll';
        $debugEvent->stage = 2;
        $debugEvent->save();


        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/utils/store.js';
        $debugEvent->line_number = 175;
        $debugEvent->function = 'drop';
        $debugEvent->stage = 2;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/handlers/homePage.js';
        $debugEvent->line_number = 6;
        $debugEvent->function = 'homePage';
        $debugEvent->stage = 2;
        $debugEvent->save();

        // ========================================

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/getTodosByFilter.js';
        $debugEvent->line_number = 13;
        $debugEvent->function = 'getCompleted';
        $debugEvent->stage = 3;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/getTodosByFilter.js';
        $debugEvent->line_number = 27;
        $debugEvent->function = 'getAllFilter';
        $debugEvent->stage = 3;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/getTodosByFilter.js';
        $debugEvent->line_number = 37;
        $debugEvent->function = 'getActive';
        $debugEvent->stage = 3;
        $debugEvent->save();

        $debugEvent = new DebugEvent();
        $debugEvent->investigation_app_id = 1;
        $debugEvent->file_path = 'src/services/getTodosByFilter.js';
        $debugEvent->line_number = 58;
        $debugEvent->function = 'getTodosByFilter';
        $debugEvent->stage = 3;
        $debugEvent->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('debug_events');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
