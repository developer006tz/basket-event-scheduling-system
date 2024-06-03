<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballTournamentPlayerStatistics extends Model
{
    use HasFactory;
    protected $table = 'NetballTournamentPlayerStatistics';
    protected $fillable = ['tournament_id','player_id','game_id','goals','assist','yellow_card','red_card'];
}
