<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballTournamentStatistics extends Model
{
    use HasFactory;
    protected $table = 'NetballTournamentStatistics';
    protected $fillable = ['tournament_id','team_id','game_id','goals_scored','goals_conceded','game_status'];

    public function tournament()
    {
        return $this->belongsTo(NetballTournament::class, 'tournament_id');
    }

    public function team()
    {
        return $this->belongsTo(NetballTeam::class, 'team_id');
    }

    public function game()
    {
        return $this->belongsTo(NetballGames::class, 'game_id');
    }
}
