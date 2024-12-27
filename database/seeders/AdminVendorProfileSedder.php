<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminVendorProfileSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@site.com')->first();

        $data = [
            'store_name' => 'admin vendor',
            'description' => 'The Best Store Ever',
            'user_id' => $user->id,
            'x_link' => 'x.com/x',
            'email' => 'adminvendor@site.com',
            'phone' => '9634335353',
            'banner' => '/uploads/123.png',
        ];
        $vendor = Vendor::create($data);
    }
}
