<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordsSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua user yang belum memiliki temp_password
        $users = User::whereNull('temp_password')->get();

        foreach ($users as $user) {
            // Jika ingin mengisi dengan password default
            $user->update([
                'temp_password' => 'password123' 
            ]);
        }
    }
}
