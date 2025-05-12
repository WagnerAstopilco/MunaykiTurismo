<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    use HasFactory;

    protected $fillable = [
        'place', 
        'country',
        'description',
        'visible_in_main_web',
        'image_id',
    ];

    public function productos()
    {
        return $this->hasMany(Product::class);
    }
    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
