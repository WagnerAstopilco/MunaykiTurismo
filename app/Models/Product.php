<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'price_PEN',
        'price_USD',
        'stock',
        'number_of_days',
        'number_of_nights',
        'number_of_people',
        'file',
        'itinerary',
        'reservation_requirements',
        'reservation_included',
        'destino_id',
        'visible_in_main_web',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_product');
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_product');
    }
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'product_reservation');
    }
    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'product_promotion');
    }
    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_product');
    }

}
