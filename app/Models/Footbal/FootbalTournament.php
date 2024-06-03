<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalTournament extends Model
{
    use HasFactory;
    protected $table = 'FootbalTournament';
    protected $fillable = ['name','year','start_date','end_date','first_winner_award','second_winner_award','third_winner_award'];

    public function games()
    {
        return $this->hasMany(FootbalGames::class, 'tournament_id');
    }
}
