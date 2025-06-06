<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'title',
        'url',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'image_product');
    }
    public function destino()
    {
        return $this->hasOne(Destino::class);
    }
}
