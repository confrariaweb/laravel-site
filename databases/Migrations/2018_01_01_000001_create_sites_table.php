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
            $table->foreignId('template_id')
                ->constrained('templates')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title');
            $table->boolean('status')->default(true);
            $table->json('options')->nullable();
            $table->timestamps();
        });

        Schema::create('domain_site', function (Blueprint $table) {
            $table->foreignId('domain_id')->constrained('domains')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('site_id')->constrained('sites')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('site_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('site_id')->constrained('sites')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('menu');
            $table->string('title');
            $table->string('route');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_menus');
        Schema::dropIfExists('domain_site');
        Schema::dropIfExists('sites');
    }
}
