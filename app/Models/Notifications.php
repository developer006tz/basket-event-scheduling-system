<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifications extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'games_id',
        'practices_id',
        'event_types_id',
        'title',
        'message',
        'sent_at',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function games()
    {
        return $this->belongsTo(Games::class);
    }

    public function practices()
    {
        return $this->belongsTo(Practices::class);
    }

    public function eventTypes()
    {
        return $this->belongsTo(EventTypes::class);
    }
}
