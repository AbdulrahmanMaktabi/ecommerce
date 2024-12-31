<?php

namespace App\Models;

use App\Models\Scopes\ActiveCategoriesScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
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
