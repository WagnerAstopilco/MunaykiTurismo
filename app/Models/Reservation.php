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
        'reservation_date',
        'number_of_people',
        'status',
        'total_price',
        'start_date',
        'end_date',
        'payment_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_reservation');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
