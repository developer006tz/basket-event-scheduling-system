<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Practices extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'teams_id',
        'location',
        'date',
        'start_time',
        'end_time',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function teams()
    {
        return $this->belongsTo(Teams::class);
    }

    public function allNotifications()
    {
        return $this->hasMany(Notifications::class);
    }
}
