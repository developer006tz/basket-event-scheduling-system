<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballTeam extends Model
{
    use HasFactory;
    protected $table = 'NetballTeam';
    protected $fillable = ['name','short_name', 'coach_id', 'badge', 'venue'];
}
