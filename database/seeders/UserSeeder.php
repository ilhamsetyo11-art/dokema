<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin/HR Users
        User::create([
            'name' => 'Admin HR',
            'email' => 'hrd@telkomakses.co.id',
            'password' => Hash::make('password'),
            'role' => 'hr',
            'email_verified_at' => now(),
        ]);

        // Pembimbing Users
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@telkomakses.co.id',
            'password' => Hash::make('password'),
            'role' => 'pembimbing',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Sari Wulandari',
            'email' => 'sari.wulandari@telkomakses.co.id',
            'password' => Hash::make('password'),
            'role' => 'pembimbing',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad.rizki@telkomakses.co.id',
            'password' => Hash::make('password'),
            'role' => 'pembimbing',
            'email_verified_at' => now(),
        ]);
    }
}
