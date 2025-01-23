<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingRules extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];


    // To Show Only Active Shipping rules
    public function scopeStatus($query, $status = true)
    {
        return $query->where('status', $status);
    }
}
