<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketTournamentStatistics extends Model
{
    use HasFactory;
    protected $table = 'BasketTournamentStatistics';
    protected $fillable = ['tournament_id','team_id','game_id','goals_scored','goals_conceded','game_status'];

}
