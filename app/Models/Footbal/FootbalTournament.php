<?php

namespace App\Models\Footbal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootbalTournament extends Model
{
    use HasFactory;
    protected $table = 'FootbalTournament';
    protected $fillable = ['name','year','start_date','end_date','fist_winner_award','second_winner_award','third_winner_award'];
}
