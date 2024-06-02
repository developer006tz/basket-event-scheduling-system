<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalTeam extends Model
{
    use HasFactory;
    protected $table = 'FootbalTeam';
    protected $fillable = ['name','short_name', 'coach_id', 'badge', 'venue'];
}
