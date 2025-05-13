<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';

    protected $fillable = [
        'name',
        'code',
        'description',
        'discount_percentage',
        'max_uses',
        'uses_count',
        'valid_from',
        'valid_to',
    ];

    public function payments()
    {
        return $this->belongsToMany(Payment::class,'coupon_payment');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'coupon_product');
    }
}
