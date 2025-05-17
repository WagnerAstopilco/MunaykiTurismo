<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'reservation_id',
        'payment_method',
        'transaction_id',
        'status',
        'date',
        'voucher', 
        'amount',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }   

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
