<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalTournamentStatistics extends Model
{
    use HasFactory;
    protected $table = 'FootbalTournamentStatistics';
    protected $fillable = ['tournament_id','team_id','game_id','goals_scored','goals_conceded','game_status'];

    public function tournament()
    {
        return $this->belongsTo(FootbalTournament::class, 'tournament_id');
    }

    public function team()
    {
        return $this->belongsTo(FootbalTeam::class, 'team_id');
    }

    public function game()
    {
        return $this->belongsTo(FootbalGames::class, 'game_id');
    }
}
