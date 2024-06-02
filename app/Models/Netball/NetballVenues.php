<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballVenues extends Model
{
    use HasFactory;

    protected $table = 'NetballVenues';
    protected $fillable = ['name','capacity','status'] ;
}
