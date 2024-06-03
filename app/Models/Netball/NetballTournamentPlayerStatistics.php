<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballTournamentPlayerStatistics extends Model
{
    use HasFactory;
    protected $table = 'NetballTournamentPlayerStatistics';
    protected $fillable = ['tournament_id','player_id','game_id','goals','assist','yellow_card','red_card'];

    public function tournament()
    {
        return $this->belongsTo(NetballTournament::class, 'tournament_id');
    }

    public function player()
    {
        return $this->belongsTo(NetballPlayer::class, 'player_id');
    }

    public function game()
    {
        return $this->belongsTo(NetballGames::class, 'game_id');
    }
}
