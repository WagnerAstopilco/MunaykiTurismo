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
    protected $casts = [
    'visible_in_main_web' => 'boolean',
];

    public function productos()
    {
        return $this->hasMany(Product::class);
    }
    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
