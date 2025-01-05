<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'updated_at', 'created_at'];


    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function imageGallery()
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subCategory_id');
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class, 'childCategory_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productImagegallery()
    {
        return $this->belongsTo(ProductImageGallery::class);
    }

    public function productVariants()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
