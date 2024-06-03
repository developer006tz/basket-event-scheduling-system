<?php

namespace App\Models\Netball;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballPlayer extends Model
{
    use HasFactory;
    protected $table = 'NetballPlayer';

    protected $fillable = ['team_id','course_id','photo','name','phone','age','email','password'];

    public function playerStatistics()
    {
        return $this->hasMany(NetballTournamentPlayerStatistics::class, 'player_id');
    }

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }

    public function team(){
        return $this->belongsTo(NetballTeam::class,'team_id');
    }
}
