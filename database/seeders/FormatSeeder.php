<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(["Paperback", "Hardback", "Hæftet", "Indbundet"] as $name) {
            Format::factory()->create(['name' => $name]);
        }
    }
}
