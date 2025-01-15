<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'reservation_time',
        'number_of_people',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
