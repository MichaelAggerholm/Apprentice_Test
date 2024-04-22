<?php
namespace App\Imports;

use App\Models\Author;
use App\Models\Book;
use App\Models\Condition;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\Language;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BooksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // TODO: Tilføj mere validering
        Validator::make($row, [
            'isbn' => 'required|unique:books,isbn', // check for unikt ISBN
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ])->validate();

        // Tjek om en bog med samme ISBN allerede eksisterer.
        if(Book::where('isbn', $row['isbn'])->exists()) {
            return null; // Skip hvis der gør.
        }

        $bookDetails = $this->getBookDetails($row);

        $book = Book::create($bookDetails);

        $this->attachGenresToBook($book, $row);
        $this->attachAuthorsToBook($book, $row);

        return $book;
    }

    protected function getBookDetails(array $row)
    {
        $condition = Condition::where('name', $row['condition'])->first();
        $format = Format::where('name', $row['format'])->first();
        $publisher = Publisher::where('name', $row['publisher'])->first();
        $language = Language::where('name', $row['language'])->first();

        return [
            'condition_id'  => $condition->id,
            'format_id'     => $format->id,
            'publisher_id'  => $publisher->id,
            'language_id'   => $language->id,
            'title'         => $row['title'],
            'summary'       => $row['summary'],
            'isbn'          => $row['isbn'],
            'publish_date'  => Carbon::instance(Date::excelToDateTimeObject($row['published']))->format('Y-m-d'),
            'page_count'    => $row['pages'],
            'stock'         => $row['stock'],
            'price'         => $row['price'],
            'image'         => $row['image'],
        ];
    }

    protected function attachGenresToBook(Book $book, array $row)
    {
        $genre = Genre::where('name', $row['genre'])->first();
        if ($genre) {
            $book->genres()->attach($genre->id);
        }
    }

    protected function attachAuthorsToBook(Book $book, array $row)
    {
        $author = Author::where('author_name', $row['author'])->first();
        if ($author) {
            $book->authors()->attach($author->id);
        }
    }
}
