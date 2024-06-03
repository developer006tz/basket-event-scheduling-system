<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketGames extends Model
{
    use HasFactory;
    protected $table = 'BasketGames';

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
        return $this->belongsTo(BasketTeam::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(BasketTeam::class, 'away_team_id');
    }



    public function tournament()
    {
        return $this->belongsTo(BasketTournament::class, 'tournament_id');
    }

    public function venue()
    {
        return $this->belongsTo(BasketVenues::class, 'venue_id');
    }
}
