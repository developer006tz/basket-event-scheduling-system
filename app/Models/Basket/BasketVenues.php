<?php

namespace App\Models\Basket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketVenues extends Model
{
    use HasFactory;
    protected $table = 'BasketVenues';
    protected $fillable = ['name','capacity','status'] ;

    public function games()
    {
        return $this->hasMany(BasketGames::class, 'venue_id');
    }
}
