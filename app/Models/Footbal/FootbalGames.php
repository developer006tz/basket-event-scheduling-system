<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalGames extends Model
{
    use HasFactory;
    protected $table = 'FootbalGames';

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
        return $this->belongsTo(FootbalTeam::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(FootbalTeam::class, 'away_team_id');
    }
}
