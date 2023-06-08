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
        Schema::table('notifications', function (Blueprint $table) {
            $table
                ->foreign('games_id')
                ->references('id')
                ->on('games')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('practices_id')
                ->references('id')
                ->on('practices')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('event_types_id')
                ->references('id')
                ->on('event_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['games_id']);
            $table->dropForeign(['practices_id']);
            $table->dropForeign(['event_types_id']);
        });
    }
};
