<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'juan',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user1->assignRole('admin');

        $user2 = User::create([
            'name' => 'samuel',
            'email' => 'samuel@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user2->assignRole('doctor');

        $user4 = User::create([
            'name' => 'sam',
            'email' => 'sam@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user4->assignRole('doctor');

        $user5 = User::create([
            'name' => 'caro',
            'email' => 'caro@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user5->assignRole('doctor');

        $user3= User::create([
            'name' => 'santiago',
            'email' => 'santiago@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user3->assignRole('patient');


    }
}
