<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'updated_at', 'created_at'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class);
    }

    public function vendor()
    {
        return $this->hasMany(Vendor::class);
    }

    public function brand()
    {
        return $this->hasMany(Brand::class);
    }

    public function productImagegallery()
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
