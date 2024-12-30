<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@site.com')->first();

        $data =
            [
                'store_name' => 'best shop',
                'description' => 'the main store of our store',
                'user_id' => $user->id,
                'x_link' => 'x.com/vender',
                'insta_link' => 'instagram.com/vender',
                'fb_link' => 'facebook.com/vender',
                'email' => 'vendor@site.com',
                'phone' => '9066283692',
                'banner' => '/uploads/123.png',
            ];

        Vendor::create($data);
    }
}
