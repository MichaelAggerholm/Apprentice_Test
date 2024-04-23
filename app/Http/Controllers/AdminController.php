<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Condition;
use App\Models\Format;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        $authorCount = Author::count();
        $bookCount = Book::count();
        $userCount = User::count();
        $conditionCount = Condition::count();
        $formatCount = Format::count();
        $genreCount = Genre::count();
        $languageCount = Language::count();
        $publisherCount = Publisher::count();

        return view('admin.pages.dashboard', [
            'authorCount' => $authorCount,
            'bookCount' => $bookCount,
            'userCount' => $userCount,
            'conditionCount' => $conditionCount,
            'formatCount' => $formatCount,
            'genreCount' => $genreCount,
            'languageCount' => $languageCount,
            'publisherCount' => $publisherCount,
        ]);
    }
}
