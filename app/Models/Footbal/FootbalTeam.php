<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalTeam extends Model
{
    use HasFactory;
    protected $table = 'FootbalTeam';
    protected $fillable = ['name','short_name', 'coach_id', 'badge', 'venue_id'];


    public function coach(){
        return $this->belongsTo(FootbalCoach::class);
    }

    public function gamesAsHomeTeam()
    {
        return $this->hasMany(FootbalGames::class, 'home_team_id');
    }

    public function gamesAsAwayTeam()
    {
        return $this->hasMany(FootbalGames::class, 'away_team_id');
    }

    public function statistics()
    {
        return $this->hasMany(FootbalTournamentStatistics::class, 'team_id');
    }
}
