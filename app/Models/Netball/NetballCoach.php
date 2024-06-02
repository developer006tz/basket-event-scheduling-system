<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballCoach extends Model
{
    use HasFactory;
    protected $table = 'NetballCoach';
    protected $fillable = ['name', 'email', 'image', 'phone','course_id','password','team_id'];
}
