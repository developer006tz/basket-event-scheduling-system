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
        Schema::create('FootbalTeam', function (Blueprint $table) {
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FootbalTeam');
    }
};
