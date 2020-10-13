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
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('template_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->boolean('status')->default(true);
            $table->json('options')->nullable();
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

        Schema::create('domain_site', function (Blueprint $table) {
            $table->unsignedBigInteger('domain_id');
            $table->unsignedBigInteger('site_id');
            $table->foreign('domain_id')
                ->references('id')
                ->on('domains')
                ->onDelete('cascade');
            $table->foreign('site_id')
                ->references('id')
                ->on('sites')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domain_site');
        Schema::dropIfExists('sites');
    }
}
