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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('role')->default('user');
            $table->string('password');
            $table->string('image')->default('avatar');
            $table->date('date_of_birth');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('state')->default('active');
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
