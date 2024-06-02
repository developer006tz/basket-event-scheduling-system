<?php

namespace App\Models;

use App\Models\Basket\BasketTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BasketGames extends Model
{
    use HasFactory;
    protected $table = 'BasketGames';

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'venue',
        'date',
        'start_time',
        'result',
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
}
