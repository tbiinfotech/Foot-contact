<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->integer('club_info_id');
            $table->integer('club_admin_id')->nullable();
            $table->string('category',255); 
            $table->string('team_rank',255)->nullable();
            $table->string('year_limit',255)->nullable();
            $table->string('team_name',255);
            $table->string('image',255);
            $table->string('season',255);
            $table->string('teamcode',255);
            $table->string('championship',255);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('teams');
    }
}
