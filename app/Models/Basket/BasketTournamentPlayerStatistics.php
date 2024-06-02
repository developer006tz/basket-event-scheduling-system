<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketTournamentPlayerStatistics extends Model
{
    use HasFactory;
    protected $table = 'BasketTournamentPlayerStatistics';
    protected $fillable = ['tournament_id','player_id','goals','assist','yellow_card','red_card'];
}
