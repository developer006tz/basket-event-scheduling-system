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
        Schema::table('event_statistics', function (Blueprint $table) {
            $table
                ->foreign('games_id')
                ->references('id')
                ->on('games')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('players_id')
                ->references('id')
                ->on('players')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_statistics', function (Blueprint $table) {
            $table->dropForeign(['games_id']);
            $table->dropForeign(['players_id']);
        });
    }
};
