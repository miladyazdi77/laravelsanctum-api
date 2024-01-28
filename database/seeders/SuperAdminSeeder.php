<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Ehsan Ur Raofi',
            'email' => 'EhsanRaofi@gmail.com',
            'password' => Hash::make('EhsanRaofi1234')
        ]);
        $superAdmin->assignRole('Super Admin');

        $admin = User::create([
            'name' => 'milad',
            'email' => 'miladman77@gmail.com',
            'password' => Hash::make('milad1377')
        ]);
        $admin->assignRole('Admin');

        $productManager = User::create([
            'name' => 'mahmoud maleklo',
            'email' => 'mahmoudmaleklo@gmail.com',
            'password' => Hash::make('mahmoud1234')
        ]);
        $productManager->assignRole('Product Manager');
    }
}
