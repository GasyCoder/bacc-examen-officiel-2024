<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'superadmin',
            'candidat',
        ];

        $label_permissions = [
            'Super Admin',
            'Candidat',
        ];

        $descriptions_permissions = [
            'Plein administrateur controler tous',
            'Candidats du bacc 2024',
        ];

        // Loop through the permissions and create them using Spatie
        foreach ($permissions as $key => $permissionName) {
            Permission::create([
                'name' => $permissionName,
                'label' => $label_permissions[$key],
                'description' => $descriptions_permissions[$key],
            ]);
        }
    }
}
