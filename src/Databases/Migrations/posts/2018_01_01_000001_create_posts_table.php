<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->boolean('status');
            $table->timestamps();
        });
        
        Schema::create('page_post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->foreign('page_id')
              ->references('id')->on('pages')
              ->onDelete('cascade');
            $table->foreign('post_id')
              ->references('id')->on('posts')
              ->onDelete('cascade');
        });

        */

    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        Schema::dropIfExists('page_post');
        Schema::dropIfExists('posts');
        */
    }
}
