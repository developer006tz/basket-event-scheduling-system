<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballGames extends Model
{
    use HasFactory;
    protected $table = 'NetballGames';

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'venue_id',
        'date',
        'start_time',
        'home_score',
        'away_score',
        'win_team_id',
        'tournament_id'
    ];

    protected $casts = [
        'date' => 'date',
    ];

   
    public function homeTeam()
    {
        return $this->belongsTo(NetballTeam::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(NetballTeam::class, 'away_team_id');
    }



    public function tournament()
    {
        return $this->belongsTo(NetballTournament::class, 'tournament_id');
    }

    public function venue()
    {
        return $this->belongsTo(NetballVenues::class, 'venue_id');
    }
}
