<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookOne = Book::factory()->create([
            "condition_id" => "1",
            "format_id" => "2",
            "publisher_id" => "1",
            "language_id" => "1",
            "title" => "Harry Potter og De Vises Sten",
            "summary" => "Harry fylder 11 år og får en nyhed, som han ikke lige havde forventet. Han er forældreløs, bor hos sin onkel og tante og lever i det hele taget et surt og trist liv - men det er kun lige indtil der begynder at dukke breve op. Så ændrer alting sig.",
            "isbn" => "9788702173222",
            "publish_date" => "2015-10-09",
            "page_count" => "360",
            "stock" => "400",
            "price" => "249",
            "image" => "test/test-bog-1.png"
        ]);

        $bookOne->genres()->attach(1);
        $bookOne->authors()->attach(1);

        $bookTwo = Book::factory()->create([
            "condition_id" => "1",
            "format_id" => "2",
            "publisher_id" => "1",
            "language_id" => "1",
            "title" => "Harry Potter og Hemmelighedernes Kammer",
            "summary" => "Det er endelig ved at være tid til endnu et år på den magiske troldmandsskole Hogwarts, og Harry glæder sig. Han har nemlig brugt sommeren hos familien Dursley. Men året skal byde på mange flere og større udfordringer end forventet, og det bliver ikke helt ufarligt.",
            "isbn" => "9788702173239",
            "publish_date" => "2015-10-09",
            "page_count" => "400",
            "stock" => "380",
            "price" => "249",
            "image" => "test/test-bog-2.png"
        ]);

        $bookTwo->genres()->attach(1);
        $bookTwo->authors()->attach(1);

        $bookThree = Book::factory()->create([
            "condition_id" => "1",
            "format_id" => "2",
            "publisher_id" => "1",
            "language_id" => "1",
            "title" => "Harry Potter og fangen fra Azkaban",
            "summary" => "Harry Potter illustreret 3 - Harry Potter og fangen fra Azkaban - er en fuldstændigt fortryllende udgave af den 3. bog i serien om vores alle sammens favorittroldmand og hans venner.",
            "isbn" => "9788702227888",
            "publish_date" => "2017-10-03",
            "page_count" => "336",
            "stock" => "420",
            "price" => "349",
            "image" => "test/test-bog-3.png"
        ]);

        $bookThree->genres()->attach(1);
        $bookThree->authors()->attach(1);

        $bookFour = Book::factory()->create([
            "condition_id" => "1",
            "format_id" => "2",
            "publisher_id" => "1",
            "language_id" => "1",
            "title" => "Harry Potter og Flammernes Pokal",
            "summary" => "Harry Potter og Flammernes Pokal - er en hæsblæsende og actionfyldt roman i serien om Harry Potter, der atter engang må se store udfordringer i øjnene. Her får du romanen som lydbog og historien er oplæst af vores alle sammens Jesper Christensen.",
            "isbn" => "9788702075410",
            "publish_date" => "2009-02-20",
            "page_count" => "336",
            "stock" => "315",
            "price" => "199",
            "image" => "test/test-bog-4.png"
        ]);

        $bookFour->genres()->attach(1);
        $bookFour->authors()->attach(1);

        $bookFive = Book::factory()->create([
            "condition_id" => "1",
            "format_id" => "2",
            "publisher_id" => "1",
            "language_id" => "1",
            "title" => "Harry Potter og Fønixordenen",
            "summary" => "I den femte bog i J.K. Rowlings fantastiske Harry Potter-serie, begynder livet for alvor at blive besværligt for den 15-årige Harry.",
            "isbn" => "9788702075427",
            "publish_date" => "2009-02-20",
            "page_count" => "415",
            "stock" => "315",
            "price" => "199",
            "image" => "test/test-bog-5.png"
        ]);

        $bookFive->genres()->attach(1);
        $bookFive->authors()->attach(1);

        $bookSix = Book::factory()->create([
            "condition_id" => "1",
            "format_id" => "2",
            "publisher_id" => "1",
            "language_id" => "1",
            "title" => "Harry Potter og halvblodsprinsen",
            "summary" => "Harry har tilbragt de første uger af sommerferien hos familien Dursley med at ligge på sin seng og stirre op i loftet. Han sørger over sin dræbte gudfar Sirius, mens han genoplever det grufulde opgør med Dødsgardisterne i Ministeriet for Magi og den sindsoprivende duel mellem Dumbledore og Lord Voldemort. Nu sidder han ved vinduet og venter på Dumbledore, der har meldt sin ankomst pr. uglepost. Harry glæder sig til at slippe væk fra Ligustervænget. Han ved heller ikke, hvad der venter ham",
            "isbn" => "9788702075434",
            "publish_date" => "2009-02-20",
            "page_count" => "415",
            "stock" => "315",
            "price" => "199",
            "image" => "test/test-bog-6.png"
        ]);

        $bookSix->genres()->attach(1);
        $bookSix->authors()->attach(1);

        $bookSeven = Book::factory()->create([
            "condition_id" => "1",
            "format_id" => "2",
            "publisher_id" => "1",
            "language_id" => "1",
            "title" => "Harry Potter og dødsregalierne",
            "summary" => "Den forrige slap med Harry, der nu skal finde resten af horcruxerne. Det virker som en umuligt opgave, men det er deres eneste chance.",
            "isbn" => "9788702075441",
            "publish_date" => "2009-02-20",
            "page_count" => "399",
            "stock" => "216",
            "price" => "299",
            "image" => "test/test-bog-7.png"
        ]);

        $bookSeven->genres()->attach(1);
        $bookSeven->authors()->attach(1);
    }
}
