<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballTeam extends Model
{
    use HasFactory;
    protected $table = 'NetballTeam';
    protected $fillable = ['name','short_name', 'coach_id', 'badge', 'venue_id'];

    public function coach(){
        return $this->belongsTo(NetballCoach::class);
    }

    public function gamesAsHomeTeam()
    {
        return $this->hasMany(NetballGames::class, 'home_team_id');
    }

    public function gamesAsAwayTeam()
    {
        return $this->hasMany(NetballGames::class, 'away_team_id');
    }

    public function statistics()
    {
        return $this->hasMany(NetballTournamentStatistics::class, 'team_id');
    }
}
