<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->unsigned()->index();
            $table->string('name');
            $table->integer('game_type');
            $table->integer('device_type');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('game_providers')->onDelete('cascade');
        });

        Schema::create('game_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('game_id')->unsigned()->index();
            $table->integer('bet');
            $table->integer('win');
            $table->string('currency');
            $table->integer('balance_before');
            $table->integer('balance_after');
            $table->dateTime('date');
            $table->string('win_combination');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_stats');
        Schema::dropIfExists('games');
        Schema::dropIfExists('game_providers');
    }
}
