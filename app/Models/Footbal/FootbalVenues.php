<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalVenues extends Model
{
    use HasFactory;
    protected $table = 'FootbalVenues';
    protected $fillable = ['name','capacity','status'] ;

    public function games()
    {
        return $this->hasMany(FootbalGames::class, 'venue_id');
    }
}
