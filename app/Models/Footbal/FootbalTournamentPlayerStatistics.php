<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalTournamentPlayerStatistics extends Model
{
    use HasFactory;
    protected $table = 'FootbalTournamentPlayerStatistics';
    protected $fillable = ['tournament_id','player_id','goals','assist','yellow_card','red_card'];
}
