<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballTournament extends Model
{
    use HasFactory;
    protected $table = 'NetballTournament';
    protected $fillable = ['name','year','start_date','end_date','first_winner_award','second_winner_award','third_winner_award'];

    public function games()
    {
        return $this->hasMany(NetballGames::class, 'tournament_id');
    }


    public function playerStatistics()
    {
        return $this->hasMany(NetballTournamentPlayerStatistics::class, 'tournament_id');
    }
}
