<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Players extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'team_id',
        'jersey_number',
        'height',
        'weight',
        'age',
    ];

    protected $searchableFields = ['*'];

    public function teams()
    {
        return $this->belongsTo(Teams::class);
    }

    public function allEventStatistics()
    {
        return $this->hasMany(EventStatistics::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
