<?php

namespace App\Models\Footbal;

use App\Models\Course;
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

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }

    public function team(){
        return $this->belongsTo(FootbalTeam::class,'team_id');
    }
}
