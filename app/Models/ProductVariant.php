<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariantIem;

class ProductVariant extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariantItems()
    {
        return $this->hasMany(ProductVariantIem::class);
    }
}
