<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title', 40);
            $table->text('body');
            $table->integer('post_type')->unsigned();
            $table->integer('stance')->unsigned();
            $table->integer('part_1')->unsigned()->nullable();
            $table->integer('part_2')->unsigned()->nullable();
            $table->integer('part_3')->unsigned()->nullable();
            $table->integer('part_4')->unsigned()->nullable();
            $table->integer('part_5')->unsigned()->nullable();
            $table->integer('part_6')->unsigned()->nullable();
            $table->integer('part_7')->unsigned()->nullable();
            $table->integer('part_8')->unsigned()->nullable();
            $table->integer('area_1')->unsigned()->nullable();
            $table->integer('area_2')->unsigned()->nullable();
            $table->integer('area_3')->unsigned()->nullable();
            $table->integer('area_4')->unsigned()->nullable();
            $table->integer('area_5')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
