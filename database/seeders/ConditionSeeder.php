<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(["Ny", "Brugt"] as $name) {
            Condition::factory()->create(['name' => $name]);
        }
    }
}
