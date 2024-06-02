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
        Schema::create('BasketTournament', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('year');
            $table->date('start_date');
            $table->date('end_date');
            $table->float('first_winner_award');
            $table->float('second_winner_award')->nullable();
            $table->float('third_winner_award')->nullable();
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
        Schema::dropIfExists('BasketTournament');
    }
};
