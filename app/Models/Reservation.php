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
        'product_id',
        'reservation_date',
        'number_of_people',
        'status',
        'total_price',
        'start_date',
        'end_date',
        'confirmed',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function producto()
    {
        return $this->belongsTo(Product::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function companions()
    {
        return $this->hasMany(Companion::class);
    }
}
