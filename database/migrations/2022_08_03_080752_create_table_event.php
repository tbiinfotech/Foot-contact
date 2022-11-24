<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->integer('event_type_id');
            $table->integer('match_type_id');
            $table->string('club_name')->nullable();
            $table->integer('sport_category_id');
            $table->integer('team')->nullable();
            $table->integer('opponent_team');
            $table->integer('is_home');
            $table->date('date');
            $table->time('appointment_time')->nullable();
            $table->time('fixture_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('title');
            $table->integer('is_recurrent');
            $table->string('additional_info')->nullable();
            $table->string('score')->nullable();
            $table->string('scores')->nullable();
            $table->string('assists')->nullable();
            $table->string('type');
            $table->integer('user_id');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('event');
    }
}
