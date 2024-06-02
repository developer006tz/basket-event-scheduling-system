<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballPlayer extends Model
{
    use HasFactory;
    protected $table = 'NetballPlayer';

    protected $fillable = ['team_id','course_id','photo','name','phone','age','email','password'];
}
