@extends('layout')
@section('content')
    <form method="POST" action="{{ route('update', ['id' => $edit_book->id])}}">    
        @csrf
        <input type="text" name="title" value='{{$edit_book->title}}' class="input_text"><br/>
        <input type="text" name="page" value='{{$edit_book->page}}' class="input_text"><br/>
        <input type="text" name="author" value='{{$edit_book->author}}' class="input_text"><br/>
        <input type="text" name="price" value='{{$edit_book->price}}' class="input_text"><br/>
        
        <input type="submit" value="수정하기">
    </form>
@endsection