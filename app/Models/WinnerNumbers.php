<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WinnerNumbers extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'date_raffle',
        'winner_number'
    ];

    // Desactivar autoincremento y tipo de clave primaria
    public $incrementing = false;
    protected $keyType = 'string';

    // Relación con la tabla referenciada
    public function raffle()
    {
        return $this->belongsTo(Raffle::class, 'date_raffle', 'date_raffle');
    }

    // Método para encontrar un registro por clave primaria compuesta
    public static function findByPrimary($date_raffle, $winner_number)
    {
        return self::where('date_raffle', $date_raffle)
            ->where('winner_number', $winner_number)
            ->first();
    }
}
