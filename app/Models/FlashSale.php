<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function items()
    {
        return $this->hasMany(FlashSaleItem::class);
    }

    public function scopeStatus($query, $status = 1)
    {
        return $query->where('status', $status);
    }

    public function scopeShowOnHome($query, $show = 1)
    {
        return $query->where('show_on_home', $show);
    }

    public function scopeNotEnded($query)
    {
        return $query->where('end_time', '>', now());
    }
}
