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
            $table->increments('id');
            $table->string('name');
            $table->date('birth_day');
            $table->integer('gender')->unsigned();
            $table->integer('residence')->unsigned();
            $table->string('image_file_name', 100)->default('default.png');
            $table->text('self_introduction', 10000)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('part1')->nullable();
            $table->integer('part2')->nullable();
            $table->integer('part3')->nullable();
            $table->integer('part_of_years1')->nullable();
            $table->integer('part_of_years2')->nullable();
            $table->integer('part_of_years3')->nullable();
            $table->rememberToken();
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
