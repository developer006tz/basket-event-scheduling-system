<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalTournamentStatistics extends Model
{
    use HasFactory;
    protected $table = 'FootbalTournamentStatistics';
    protected $fillable = ['tournament_id','team_id','game_id','goals_scored','goals_concerded','game_status'];
}
