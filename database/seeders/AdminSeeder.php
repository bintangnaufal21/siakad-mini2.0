<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // cek jika sudah ada
            [
                'name' => 'Administrator',
                'npm' => '0000000000',
                'no_telepon' => '08123456789',
                'password' => Hash::make('admi123'), // password default
                'role' => 'admin',
            ]
        );

        // Mahasiswa
        User::updateOrCreate(
            ['email' => 'mahasiswa@gmail.com'],
            [
                'name' => 'Mahasiswa Contoh',
                'npm' => '2301001001',
                'no_telepon' => '081312345678',
                'password' => Hash::make('mahasiswa123'),
                'role' => 'mahasiswa',
            ]
        );

        // Dosen
        User::updateOrCreate(
            ['email' => 'dosen@gmail.com'],
            [
                'name' => 'Dosen Contoh',
                'npm' => '1980001001',
                'no_telepon' => '082198765432',
                'password' => Hash::make('dosen123'),
                'role' => 'dosen',
            ]
        );
    }
}