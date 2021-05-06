<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function add(Request $req) {
        $book = new Book;
        $book->title = $req->title;
        $book->author = $req->author;
        $book->availability = 1;
        $book->save();
    }

    public function all() {
        $booksArr = Book::all();
        return $booksArr;
    }

    public function delete($id) {
        Book::destroy($id);
    }

    public function changeAvailabilty($id) {
        $book = Book::find($id);
        $book->availability = ($book->availability + 1) % 2;
        $book->save();
    }
}
