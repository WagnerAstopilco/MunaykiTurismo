<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    use HasFactory;
    protected $table = 'companions';
    protected $fillable = [
        'reservation_id',
        'full_name',
        'document_number',
        'age',
        'gender',
        'is_adult',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
