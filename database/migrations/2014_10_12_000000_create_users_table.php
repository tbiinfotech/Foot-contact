<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->string('email',100)->nullable()->unique();
            $table->string('phone',15)->nullable()->unique();
            $table->string('password',255)->nullable();
            $table->string('image',100)->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->integer('parent_user_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('sport_category_id')->nullable(); 
            $table->integer('club_info_id')->nullable(); 
            $table->integer('is_archive')->nullable(); 
            $table->integer('created_by_id')->nullable(); 
            $table->boolean('has_parent')->default(0);
            $table->boolean('status')->default(1);
            $table->enum('verified',['0','1','2','3'])->default(0);
            $table->string('token',128)->nullable();
            $table->timestamp('token_expires_at')->nullable();
            $table->string('reset_token',255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
