<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketTournament extends Model
{
    use HasFactory;
    protected $table = 'BasketTournament';
    protected $fillable = ['name','year','start_date','end_date','first_winner_award','second_winner_award','third_winner_award'];

    public function games()
    {
        return $this->hasMany(BasketGames::class, 'tournament_id');
    }


    public function playerStatistics()
    {
        return $this->hasMany(BasketTournamentPlayerStatistics::class, 'tournament_id');
    }
}
