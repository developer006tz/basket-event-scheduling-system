<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballTournamentStatistics extends Model
{
    use HasFactory;
    protected $table = 'NetballTournamentStatistics';
    protected $fillable = ['tournament_id','team_id','game_id','goals_scored','goals_concerded','game_status'];
}
