<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('template_id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->boolean('status')->default(true);
            $table->json('options')->nullable();
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
            $table->foreign('template_id')
                ->references('id')
                ->on('templates')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('site_template', function (Blueprint $table) {
            $table->unsignedInteger('site_id');
            $table->unsignedInteger('template_id');
            $table->foreign('site_id')
                ->references('id')
                ->on('sites')
                ->onDelete('cascade');
            $table->foreign('template_id')
                ->references('id')
                ->on('templates')
                ->onDelete('cascade');
        });

        Schema::create('site_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('site_id');
            $table->json('file');
            $table->json('options')->nullable();
            $table->foreign('site_id')
                ->references('id')
                ->on('sites')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('site_banners');
        Schema::dropIfExists('site_template');
        Schema::dropIfExists('sites');

        Schema::enableForeignKeyConstraints();
    }
}
