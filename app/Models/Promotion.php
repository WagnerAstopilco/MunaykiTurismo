<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    protected $fillable = [
        'name',
        'description',
        'discount_percentage',
        'valid_from',
        'valid_to',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_promotion');
    }
}
