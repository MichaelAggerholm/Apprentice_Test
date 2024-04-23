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

        Author::factory()->create([
            "first_name" => "Tonny",
            "middle_name" => "",
            "last_name" => "Gulløv",
            "author_name" => "Tonny Gulløv",
            "language_id" => "1",
            "birth_date" => "1982-09-11",
            "biography" => "",
            "website_url" => "",
        ]);

        Author::factory()->create([
            "first_name" => "Josefine",
            "middle_name" => "",
            "last_name" => "Ottesen",
            "author_name" => "Josefine Ottesen",
            "language_id" => "1",
            "birth_date" => "1956-02-04",
            "biography" => "Josefine Ottesen er en dansk børnebogsforfatter, skuespiller, teaterinstruktør mm.",
            "website_url" => "https://www.josefineottesen.dk/",
        ]);
    }
}
