<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::factory()->create([
            "first_name" => "Joanne",
            "middle_name" => "Kathleen",
            "last_name" => "Rowling",
            "author_name" => "J. K. Rowling",
            "language_id" => "1",
            "birth_date" => "1965-07-31",
            "biography" => "Joanne Rowling was born on 31st July 1965 at Yate General Hospital near Bristol, and grew up in Gloucestershire in England and in Chepstow, Gwent, in south-east Wales.",
            "website_url" => "https://www.jkrowling.com/",
        ]);
    }
}
