<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //User::factory(10)->create();
        $rol_1=Role::create(['name' => 'Administrador']);
        $rol_2=Role::create(['name' => 'Escritor']);
        // creamos los permisos para cada rol
        Permission::create(['name' => 'show posts'])->syncRoles([Role::find(1),Role::find(2)]);
        Permission::create(['name' => 'create posts'])->syncRoles($rol_2);
        Permission::create(['name' => 'edit posts'])->syncRoles($rol_2);
        Permission::create(['name' => 'delete posts'])->syncRoles($rol_1);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@blog.com',
            'password' => Hash::make('12345678')
        ]);
        $user->assignRole($rol_1);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
