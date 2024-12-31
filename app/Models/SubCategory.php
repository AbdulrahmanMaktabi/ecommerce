<?php

namespace App\Models;

use App\Models\Scopes\ActiveCategoriesScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class); // Optional if products are tied to SubCategory directly
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // public static function booted()
    // {
    //     static::addGlobalScope(new ActiveCategoriesScope());
    // }
}
