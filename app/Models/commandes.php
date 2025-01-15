<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';

    protected $fillable = [
        'user_id',
        'status',
        'delivery_address',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
