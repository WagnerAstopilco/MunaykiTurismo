<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'visible_in_main_web',
    ];
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function categoryParent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
