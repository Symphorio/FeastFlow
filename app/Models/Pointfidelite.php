<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointDeFidelite extends Model
{
    use HasFactory;

    protected $table = 'point_fidelite';

    protected $fillable = [
        'user_id',
        'points',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
