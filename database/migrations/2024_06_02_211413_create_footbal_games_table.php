<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FootbalGames', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->unsignedBigInteger('venue_id');
            $table->date('date');
            $table->time('start_time');
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->unsignedBigInteger('win_team_id')->nullable();
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
        Schema::dropIfExists('FootbalGames');
    }
};
