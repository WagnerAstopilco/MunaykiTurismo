<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';

    protected $fillable = [
        'user_id',
        'product_id',
        'value',
        'comment',
        'visible_in_main_web',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
