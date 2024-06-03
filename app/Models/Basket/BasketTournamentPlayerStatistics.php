<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketTournamentPlayerStatistics extends Model
{
    use HasFactory;
    protected $table = 'BasketTournamentPlayerStatistics';
    protected $fillable = ['tournament_id','player_id','game_id','goals','assist','yellow_card','red_card'];

    public function tournament()
    {
        return $this->belongsTo(BasketTournament::class, 'tournament_id');
    }

    public function player()
    {
        return $this->belongsTo(BasketPlayer::class, 'player_id');
    }

    public function game()
    {
        return $this->belongsTo(BasketGames::class, 'game_id');
    }
}
