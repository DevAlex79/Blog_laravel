<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
class RoleSeeder extends Seeder
{
    public function run()
    {
        //Role::create(['name' => 'auteur']);
        //Role::create(['name' => 'lecteur']);

        // Vérifiez si le rôle existe avant de le créer
        // Role::updateOrCreate(['name' => 'auteur']);
        // Role::updateOrCreate(['name' => 'lecteur']);

        // Utilisation de updateOrCreate pour éviter les doublons
        $roles = [
            ['name' => 'auteur'],
            ['name' => 'lecteur'],
            ['name' => 'admin'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']]);
        }
    }
}

