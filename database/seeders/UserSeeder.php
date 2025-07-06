<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Juan Pérez',
                'email' => 'lider@gmail.com',
                'rol' => 'lider_unidad',
                
                'cedula' => '1'
            ],
            [
                'name' => 'Ana Gómez',
                'email' => 'ana.produccion@gmail.com',
                'rol' => 'gestor_area_produccion',
                
                'cedula' => '2'
            ],
            [
                'name' => 'Carlos Ruiz',
                'email' => 'carlos.gerente@gmail.com',
                'rol' => 'gerente',
                
                'cedula' => '3'
            ],
            [
                'name' => 'Lucía Torres',
                'email' => 'lucia.contable@gmail.com',
                'rol' => 'gestor_contable',
                
                'cedula' => '4'
            ],
            [
                'name' => 'Miguel Díaz',
                'email' => 'miguel.mercadeo@gmail.com',
                'rol' => 'gestor_mercadeo',
                
                'cedula' => '5'
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'rol' => $user['rol'],
                'cedula' => $user['cedula'],
                "password" => "password",
                'email_verified_at' => now(),
            ]);
        }
    }
}
