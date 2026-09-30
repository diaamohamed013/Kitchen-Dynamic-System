<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon', 'display_order', 'is_active'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class)->orderBy('display_order');
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, Subcategory::class);
    }
}
