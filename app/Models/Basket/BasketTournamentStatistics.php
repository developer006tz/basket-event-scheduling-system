<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketTournamentStatistics extends Model
{
    use HasFactory;
    protected $table = 'BasketTournamentStatistics';
    protected $fillable = ['tournament_id','team_id','game_id','goals_scored','goals_conceded','game_status'];

    public function tournament()
    {
        return $this->belongsTo(BasketTournament::class, 'tournament_id');
    }

    public function team()
    {
        return $this->belongsTo(BasketTeam::class, 'team_id');
    }

    public function game()
    {
        return $this->belongsTo(BasketGames::class, 'game_id');
    }

}
