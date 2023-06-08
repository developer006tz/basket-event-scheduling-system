<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventTypes extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['type', 'name'];

    protected $searchableFields = ['*'];

    protected $table = 'event_types';

    public function allNotifications()
    {
        return $this->hasMany(Notifications::class);
    }
}
