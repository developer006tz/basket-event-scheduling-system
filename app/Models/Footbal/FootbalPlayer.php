<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalPlayer extends Model
{
    use HasFactory;
    protected $table = 'FootbalPlayer';

    protected $fillable = ['team_id','course_id','photo','name','phone','age','email','password'];

    public function playerStatistics()
    {
        return $this->hasMany(FootbalTournamentPlayerStatistics::class, 'player_id');
    }
}
