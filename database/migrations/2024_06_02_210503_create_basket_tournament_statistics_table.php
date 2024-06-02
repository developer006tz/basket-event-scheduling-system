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
        Schema::create('BasketTournamentStatistics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('game_id');
            $table->integer('goals_scored')->nullable();
            $table->integer('goals_conceded')->nullable();
            $table->enum('game_status', ['scheduled', 'ongoing', 'completed', 'canceled'])->nullable();
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
        Schema::dropIfExists('BasketTournamentStatistics');
    }
};
