<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketTeam extends Model
{
    use HasFactory;
    protected $table = 'BasketTeam';
    protected $fillable = ['name','short_name', 'coach_id', 'badge', 'venue'];
}
