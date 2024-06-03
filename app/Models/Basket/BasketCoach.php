<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketCoach extends Model
{
    use HasFactory;
    protected $table = 'BasketCoach';
    protected $fillable = ['name', 'email', 'image', 'phone','course_id','password','team_id'];
    public function team(){
        return $this->belongsTo(BasketTeam::class);
    }
}
