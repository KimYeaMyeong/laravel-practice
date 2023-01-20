@extends('layout')
@section('content')
    <form method="POST" action="{{ route('update', ['id' => $edit_book->id])}}">    
        @csrf
        <input type="text" name="title" value='{{$edit_book->title}}' class="input_text"><br/>
        <input type="text" name="page" value='{{$edit_book->page}}' class="input_text"><br/>
        <input type="text" name="author" value='{{$edit_book->author}}' class="input_text"><br/>
        <input type="text" name="price" value='{{$edit_book->price}}' class="input_text"><br/>
        <select name="category_id">
            @foreach($category as $cat)
                @if($edit_book->category->id == $cat->id)
                <option value='{{$cat->id}}' selected>{{$cat->name}}</option>
                @else
                <option value='{{$cat->id}}'>{{$cat->name}}</option>
                @endif
            @endforeach
        </select>
        
        <input type="submit" value="수정하기">
    </form>
@endsection