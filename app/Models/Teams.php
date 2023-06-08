<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teams extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'coaches_id', 'image', 'location'];

    protected $searchableFields = ['*'];

    public function coaches()
    {
        return $this->belongsTo(Coaches::class);
    }

    public function allPlayers()
    {
        return $this->hasMany(Players::class);
    }

    public function allPractices()
    {
        return $this->hasMany(Practices::class);
    }

    public function homeGames()
    {
        return $this->hasMany(Games::class, 'home_team_id');
    }

    public function awayGames()
    {
        return $this->hasMany(Games::class, 'away_team_id');
    }
}
