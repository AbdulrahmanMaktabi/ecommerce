<?php

namespace App\Models;

use App\Models\Scopes\activeVariantItemsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantIem extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'updated_at', 'creatd_at'];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new activeVariantItemsScope);
    }
}
