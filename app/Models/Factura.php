<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total',
        'tax',
        'subtotal',
        'user_id',
        'historial_id',
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function historial()
    {
        return $this->belongsTo(Historial::class);
    }
}
