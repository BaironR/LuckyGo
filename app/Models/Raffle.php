<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'date_raffle';
    public $incrementing = false;
    protected $keyType = 'string'; // Cambiar a 'string' porque 'date' no es un tipo de clave válido en Laravel

    protected $fillable = [
        'date_raffle',
        'number_of_tickets',
        'total',
        'total_luck',
        'subtotal_of_tickets',
        'status_raffle',
        'luck_raffle',
        'entered_date',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function winnerNumbers()
    {
        return $this->hasMany(WinnerNumbers::class, 'date_raffle', 'date_raffle');
    }

    public function luckWinnerNumbers()
    {
        return $this->hasMany(LuckWinnerNumbers::class, 'date_raffle', 'date_raffle');
    }
}
