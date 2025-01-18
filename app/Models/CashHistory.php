<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashHistory extends Model
{
    protected $fillable = [
        'monto',
        'estado',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
