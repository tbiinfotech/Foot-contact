<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCoachEventPlayer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_event_player', function (Blueprint $table) {
            $table->id();
            $table->integer('coach_id');
            $table->integer('event_id');
            $table->integer('player_id');
            $table->integer('is_accept')->default(0);
            $table->integer('is_present')->default(0);
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('coach_event_player');
    }
}
