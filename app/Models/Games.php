<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Games extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'location',
        'date',
        'start_time',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function allNotifications()
    {
        return $this->hasMany(Notifications::class);
    }

    public function allEventStatistics()
    {
        return $this->hasMany(EventStatistics::class);
    }

    public function homeTeam()
    {
        return $this->belongsTo(Teams::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Teams::class, 'away_team_id');
    }
}
