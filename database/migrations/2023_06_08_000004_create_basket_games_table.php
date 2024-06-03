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
        Schema::create('BasketGames', function (Blueprint $table) {
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
     */
    public function down(): void
    {
        Schema::dropIfExists('BasketGames');
    }
};
