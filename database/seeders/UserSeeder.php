<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test bruger 1',
            'email' => 'admin@test.dk',
            'password' => Hash::make('12345'),
            'is_admin' => 1,
        ]);

        User::factory()->create([
            'name' => 'Test bruger 2',
            'email' => 'guest@test.dk',
            'password' => Hash::make('12345'),
            'is_admin' => 0,
        ]);
    }
}
