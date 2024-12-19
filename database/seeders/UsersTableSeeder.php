<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan pengguna admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminku1'),  // Pastikan password di-hash
            'role' => 'admin',  // Menambahkan role admin
        ]);

        // Anda bisa menambahkan pengguna lain di sini jika perlu
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('uuserku123'),
            'role' => 'user',  // Menambahkan role user
        ]);
    }
}

