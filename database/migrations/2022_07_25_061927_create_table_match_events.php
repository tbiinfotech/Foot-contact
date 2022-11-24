<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMatchEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_events', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('match_type_id');
            $table->integer('team_id');
            $table->integer('opponent_team');
            $table->boolean('is_home');
            $table->date('date');
            $table->time('appointment_time');
            $table->time('fixture_time');
            $table->time('end_time');
            $table->string('address');
            $table->string('additional_info');
            $table->float('score')->nullable();
            $table->string('scorers')->nullable();
            $table->string('assists');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_events');
    }
}
