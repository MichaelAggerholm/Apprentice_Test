<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publisher::factory()->create([
            'name' => 'Gyldendal',
            'address' => 'Klareboderne 3',
            'city' => 'København K',
            'zip' => '1115',
            'country' => 'Danmark',
            'contact_name' => 'Ivan Elverlund',
            'contact_email' => 'gyldendal@gyldendal.dk',
            'contact_phone' => '33755555',
        ]);
    }
}
