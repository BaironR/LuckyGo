<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckWinnerNumbers extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'date_raffle';

    protected $fillable = [
        'date_raffle',
        'luck_winner_number'
    ];
}
