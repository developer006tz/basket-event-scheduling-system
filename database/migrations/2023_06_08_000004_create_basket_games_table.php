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
            $table->bigIncrements('id');
            $table->foreignId('home_team_id');
            $table->foreignId('away_team_id');
            $table->string('location');
            $table->date('date');
            $table->time('start_time');
            $table->string('result')->nullable();
            $table->enum('result_status', ['1', '3', '2'])->nullable();

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
