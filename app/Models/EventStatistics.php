<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventStatistics extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'games_id',
        'players_id',
        'points',
        'rebounds',
        'assists',
        'blocks',
        'steals',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'event_statistics';

    public function games()
    {
        return $this->belongsTo(Games::class);
    }

    public function players()
    {
        return $this->belongsTo(Players::class);
    }
}
