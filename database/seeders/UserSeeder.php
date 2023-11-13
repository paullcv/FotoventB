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
        User::Create([
            'name' => 'Paul Cruz',
            'email' => 'Paul@gmail.com',
            'telephone' => '78565231',
            'password' => bcrypt('password'),
        ]);
    }
}
