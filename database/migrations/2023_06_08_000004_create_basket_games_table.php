<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('basket_games', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('home_team_id');
            $table->foreignId('away_team_id');
            $table->integer('venue');
            $table->date('date');
            $table->time('start_time');
            $table->int('home_score')->nullable();
            $table->int('away_score')->nullable();
            $table->foreign('tournament_id')->references('id')->on('BasketTournament');
            $table->foreign('win_team_id')->references('id')->on('BasketTeam');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
