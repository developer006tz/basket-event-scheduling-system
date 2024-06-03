<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalTournamentPlayerStatistics extends Model
{
    use HasFactory;
    protected $table = 'FootbalTournamentPlayerStatistics';
    protected $fillable = ['tournament_id','game_id','player_id','goals','assist','yellow_card','red_card'];

    public function tournament()
    {
        return $this->belongsTo(FootbalTournament::class, 'tournament_id');
    }

    public function player()
    {
        return $this->belongsTo(FootbalPlayer::class, 'player_id');
    }

    public function game()
    {
        return $this->belongsTo(FootbalGames::class, 'game_id');
    }
}
