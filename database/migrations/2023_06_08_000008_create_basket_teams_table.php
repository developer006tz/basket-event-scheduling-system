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
        Schema::create('BasketTeam', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->unsignedBigInteger('coach_id');
            $table->string('badge')->nullable();
            $table->string('venue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('BasketTeam');
    }
};
