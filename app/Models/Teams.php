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
}
