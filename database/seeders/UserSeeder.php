<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userdata = [
            [
                'name' => 'beni',
                'email' => 'benedictusradyan@gmail.com',
                'role' => 'admin',
                'password' => bcrypt(123456),
            ],

            [
                'name' => 'ravi',
                'email' => 'ravin@gmail.com',
                'role' => 'client',
                'password' => bcrypt(123456),
            ],
        ];

        foreach ($userdata as $key => $value) {
            User::create($value);
        }
    }
}
