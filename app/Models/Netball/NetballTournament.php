<?php

namespace App\Models\Netball;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetballTournament extends Model
{
    use HasFactory;
    protected $table = 'NetballTournament';
    protected $fillable = ['name','year','start_date','end_date','fist_winner_award','second_winner_award','third_winner_award'];
}
