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
        Schema::create('NetballTeam', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->unsignedBigInteger('coach_id')->nullable();
            $table->string('badge')->nullable();
            $table->unsignedBigInteger('venue_id');
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
        Schema::dropIfExists('NetballTeam');
    }
};
