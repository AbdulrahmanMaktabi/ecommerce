<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\CouponUsage;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    // Add a method to validate the coupon
    public static function validateCoupon(string $code, int $userId)
    {
        $coupon = self::where('code', $code)->first();

        if (!$coupon) {
            return [
                'status' => false,
                'message' => 'Invalid coupon code.',
            ];
        }

        // Check if the coupon is active
        if (!$coupon->status) {
            return [
                'status' => false,
                'message' => 'This coupon is not active.',
            ];
        }

        // Check expiration date
        if ($coupon->expiry_date && Carbon::now()->gt($coupon->expiry_date)) {
            return [
                'status' => false,
                'message' => 'This coupon has expired.',
            ];
        }

        User::findOrFail($userId);

        // Check max uses for the user
        $userUsage = CouponUsage::where('coupon_id', $coupon->id)
            ->where('user_id', $userId)
            ->sum('uses');

        if ($userUsage > $coupon->max_use) {
            return [
                'status' => false,
                'message' => 'You have reached the maximum usage limit for this coupon.',
            ];
        }

        return [
            'status' => true,
            'message' => 'Coupon is valid.',
            'coupon' => $coupon,
        ];
    }
}
