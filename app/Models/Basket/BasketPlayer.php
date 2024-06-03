<?php

namespace App\Models\Basket;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketPlayer extends Model
{
    use HasFactory;
    protected $table = 'BasketPlayer';

    protected $fillable = ['team_id','course_id','photo','name','phone','age','email','password'];

    public function playerStatistics()
    {
        return $this->hasMany(BasketTournamentPlayerStatistics::class, 'player_id');
    }

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }

    public function team(){
        return $this->belongsTo(BasketTeam::class,'team_id');
    }
}
