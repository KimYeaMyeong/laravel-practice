<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller {
    // 웹 최초 진입 시 처리.
    public function index() {
        $books = Book::get();

        return view('index', ['books' => $books]);
    }

    public function create(){
        return view('create');
    }
    
    public function store(){
        $check_book = request()->validate([
            ['title' => 'required'],
            ['page' => 'required'],
            ['author' => 'required'],
            ['price' => 'required']
        ]);

        Book::create([
            "title" => $check_book->post('title'),
            "page" => $check_book->post('page'),
            "author" => $check_book->post('author'),
            "price" => $check_book->post('price')
        ]);

        return redirect('/');
    }

    public function edit(){
        $edit_book = Book::find(request()->get('id'));

        return view('edit', ['edit_book' => $edit_book]);
    }

    public function update() {
        $book_id = request()->get('id');

        $update_book = Book::find($book_id);

        $update_book->title = request()->post('title');
        $update_book->page = request()->post('page');
        $update_book->author = request()->post('author');
        $update_book->price = request()->post('price');

        $update_book->save();

        return redirect('/');
    }

    public function delete() {
        $delete_book = Book::find(request()->get('id'));
        $delete_book->delete();
        
        // // $last_book = Book::where("id", count($books)) -> first();
        // $last_book = Book::orderBy('id') -> first();
        // $last_book -> delete();

        return redirect('/');
    }
}

// $books = Book::get();

//         foreach ($books as $book) {
//             echo $book->id . "<br>";
//             echo $book->title . "<br>";
//             echo "쪽수 :" . $book->page . "<br>";
//             echo "저자 :" . $book->author . "<br>";
//             echo "가격 :" . $book->price . "<br>";

//             echo "<br><br>";
//         }

        // $first_book = Book::where("id", 1)->first();

        // $first_book->title = "제목3";
        // $first_book->price = 500000000;

        // $first_book->save();

        // $first_book->delete();

        // echo $first_book->id . "<br>";
        // echo $first_book->title . "<br>";
        // echo $first_book->page . "<br>";

        // echo "<br><br>";

        // return view("welcome");