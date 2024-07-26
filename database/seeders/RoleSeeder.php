<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'admin',
            'label' => 'Administrateur',
            'description' => 'Administrateur de Système'
        ]);
        $candidat = Role::create([
            'name' => 'candidat',
            'label' => 'Candidat',
            'description' => 'Candidats du bacc 2024'
        ]);

        $admin->givePermissionTo([
            'superadmin',
        ]);

        $candidat->givePermissionTo([
            'candidat',
        ]);
    }
}
