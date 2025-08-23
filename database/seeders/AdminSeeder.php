<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator Utama',
                'password' => Hash::make('admin123'),
                'remember_token' => Str::random(10),
            ]
        );

    }
}
