<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketTeam extends Model
{
    use HasFactory;
    protected $table = 'BasketTeam';
    protected $fillable = ['name','short_name', 'coach_id', 'badge', 'venue_id'];

    public function coach(){
        return $this->belongsTo(BasketCoach::class);
    }

    public function gamesAsHomeTeam()
    {
        return $this->hasMany(BasketGames::class, 'home_team_id');
    }

    public function gamesAsAwayTeam()
    {
        return $this->hasMany(BasketGames::class, 'away_team_id');
    }

    public function statistics()
    {
        return $this->hasMany(BasketTournamentStatistics::class, 'team_id');
    }
}
