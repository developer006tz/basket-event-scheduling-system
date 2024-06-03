<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalCoach extends Model
{
    use HasFactory;
    protected $table = 'FootbalCoach';
    protected $fillable = ['name', 'email', 'image', 'phone','course_id','password','team_id'];

    public function team(){
        return $this->belongsTo(FootbalTeam::class);
    }
}
