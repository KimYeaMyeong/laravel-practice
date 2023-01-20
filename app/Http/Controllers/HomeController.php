<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Modifylog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookCreateRequest;
use Illuminate\Validation\Validator;

class HomeController extends Controller {
    public function index() {
        $books = Book::get();
        
        return view('index', ['books' => $books, 'user' => Auth::user() ?? 'none']);
    }

    public function create(){
        $category = Category::distinct()->get('name');
        $brand = Brand::get();

        return view('create', ['categories' => $category, 'brands' => $brand]);
    }
    
    public function store(BookCreateRequest $request) {
        $search = Category::where('name', request('category_name'))->where('brand_id', request('brand_id'))->get('id')->modelKeys();
        $flag = $search[0] ?? 'none';

        if($flag == 'none'){
            Category::create([
                'name' => request('category_name'),
                'brand_id' => request('brand_id')
            ]);
        }
        
        // $a = Category::where('name', request('category_name'))->where('brand_id', request('brand_id'))->first();
        $match = Category::isexist(request('category_name'), request('brand_id'))->first();

        $book_name = request('title');

        $book = Book::create([
            "title" => request('title'),
            "page" => request('page'),
            "author" => request('author'),
            "price" => request('price'),
            "category_id" => $match->id
        ]);
        
        $book->modifylogs()->create([
            "log" => "{$book_name} 책을 생성함.",
            "user_id" => Auth::id()
        ]);

        return redirect('/');
    }

    public function edit(){
        $id = request()->get('id');
        $edit_book = Book::find($id);
        $category = Category::get();
        
        return view('edit', ['edit_book' => $edit_book, 'category' => $category]);
    }

    public function update() {
        $book_id = request()->get('id');

        $update_book = Book::find($book_id);

        $update_book->title = request()->post('title');
        $update_book->page = request()->post('page');
        $update_book->author = request()->post('author');
        $update_book->price = request()->post('price');
        $update_book->category_id = request()->post('category_id');

        $update_book->save();

        $book_name = request()->post('title');
        
        Modifylog::create([
            'log' => "{$book_name} 정보를 수정함.",
            'user_id' => Auth::id(),
            'book_id' => $book_id
        ]);

        return redirect('/');
    }

    public function delete() {
        $delete_book = Book::find(request()->path());

        Modifylog::create([
            'log' => "{$delete_book->title}을 삭제했음.",
            'user_id' => Auth::id(),
            'book_id' => $delete_book->id,
        ]);

        $delete_book->delete();
        
        return redirect('/');
    }

    public function profile() {
        // $logs = Modifylog::where('book_id', request()->id)->join('users', 'user_id', '=', 'users.id')->get();
        $logs = Modifylog::selectlog(request()->id)->join('users', 'user_id', '=', 'users.id')->get();
        
        // Modifylog::join('books', 'book_id', '=', 'books.id')->select('modifylogs.user_id', 'modifylogs.log', 'title')->
        // where('user_id', Auth::user()->id)->get();

        return view('profile', ['user' => Auth::user(), 'logs' => $logs]);
    }
}