<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coaches extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id'];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allTeams()
    {
        return $this->hasMany(Teams::class);
    }
}
