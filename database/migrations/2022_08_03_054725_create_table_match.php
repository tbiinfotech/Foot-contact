<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->id();
            $table->integer('event_type_id');
            $table->integer('match_type_id');
            $table->string('club_name');
            $table->integer('sport_category_id');
            $table->integer('team'); 
            $table->integer('opponent_team');
            $table->integer('is_home');
            $table->date('date');
            $table->timestamp('appointment_time')->nullable();
            $table->timestamp('fixture_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('address');
            $table->string('additional_info');
            $table->string('score');
            $table->string('scores');
            $table->string('assists');
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
        Schema::dropIfExists('match');
    }
}
