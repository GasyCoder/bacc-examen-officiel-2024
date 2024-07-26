<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@univ.com',
            'password' => bcrypt('admin@univ.com'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Creating candidat User
        $candidat = User::create([
            'name' => 'Candidat',
            'email' => 'candidat@mail.com',
            'password' => bcrypt('candidat@mail.com'),
            'email_verified_at' => now(),
        ]);
        $candidat->assignRole('candidat');

    }
}
