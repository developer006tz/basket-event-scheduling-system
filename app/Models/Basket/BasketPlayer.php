<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketPlayer extends Model
{
    use HasFactory;
    protected $table = 'BasketPlayer';

    protected $fillable = ['team_id','course_id','photo','name','phone','age','email','password'];
}
