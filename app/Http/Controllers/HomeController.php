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
        $category = Category::distinct()->get('name');
        $brand = Brand::get();
        
        return view('index', [
            'books' => $books, 
            'user' => Auth::user() ?? 'none', 
            'categories' => $category, 
            'brands' => $brand]);
    }

    public function search() {
        $category = Category::distinct()->get('name');
        $brand = Brand::get();
        $books = array();

        if(request()->category_name == 'default'){
            if(request()->brand_id == 'default'){
                return redirect('/');
            }
            else {
                $match = Category::findByBrandId(request('brand_id'))->get();
                foreach($match as $category_data){
                    $search_book = Book::findByCategoryId($category_data->id)->get()->all();
                    $books = array_merge($books, $search_book);
                }
            }
        }
        else{
            if(request()->brand_id == 'default'){
                $match = Category::findByCategoryName(request()->category_name)->get();
                foreach($match as $book_data){
                    $search_book = Book::findByCategoryId($book_data->id)->get()->all();
                    $books = array_merge($books, $search_book);
                }
            }
            else{
                $match_id = Category::findOne(request('category_name'),request('brand_id'))->get()->first()->id;
                $books = Book::findByCategoryId($match_id)->get();
            }
        }

        return view('index', [
            'books' => $books, 
            'user' => Auth::user() ?? 'none', 
            'categories' => $category, 
            'brands' => $brand]);
    }

    public function create(){
        $category = Category::distinct()->get('name');
        $brand = Brand::get();

        return view('create', ['categories' => $category, 'brands' => $brand]);
    }
    
    public function store(BookCreateRequest $request) {
        $search = Category::findOne(request('category_name'), request('brand_id'))->get('id')->modelKeys();
        $flag = $search[0] ?? 'none';

        if($flag == 'none'){
            Category::create([
                'name' => request('category_name'),
                'brand_id' => request('brand_id')
            ]);
        }
        
        $match = Category::findOne(request('category_name'), request('brand_id'))->first();

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
        $edit_book = Book::find(request('id'));
        $category = Category::distinct()->get('name');
        $brand = Brand::get();

        $default_category = $edit_book->category->name;
        $default_brand = $edit_book->category->brand->name;
        
        return view('edit', [
            'edit_book' => $edit_book,
            'categories' => $category, 
            'brands' => $brand,
            'default_category' => $default_category,
            'default_brand' => $default_brand
        ]);
    }

    public function update(BookCreateRequest $request) {
        $search = Category::findOne(request('category_name'), request('brand_id'))->get('id')->modelKeys();
        $flag = $search[0] ?? 'none';

        if($flag == 'none'){
            Category::create([
                'name' => request('category_name'),
                'brand_id' => request('brand_id')
            ]);
        }
        
        $match_id = Category::findOne(request('category_name'), request('brand_id'))->first()->id;

        $book_name = request('title');

        $update_book = Book::find(request('id'));

        $update_book->title = request('title');
        $update_book->page = request('page');
        $update_book->author = request('author');
        $update_book->price = request('price');
        $update_book->category_id = $match_id;

        $update_book->save();

        Modifylog::create([
            'log' => "{$book_name} 정보를 수정함.",
            'user_id' => Auth::id(),
            'book_id' => request('id')
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
        $logs = Modifylog::findByBookId(request()->id)->join('users', 'user_id', '=', 'users.id')->get();
        
        return view('profile', ['user' => Auth::user(), 'logs' => $logs]);
    }
}