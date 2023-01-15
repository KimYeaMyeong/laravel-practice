@extends('layout')
@section('content')
    <form method="POST" action="{{ route('store')}}">    
        @csrf
        <input type="text" name="title" placeholder='책 제목' class="input_text"><br/>
        <input type="text" name="page" placeholder='페이지 수' class="input_text"><br/>
        <input type="text" name="author" placeholder='저자' class="input_text"><br/>
        <input type="text" name="price" placeholder='가격' class="input_text"><br/>
        
        <input type="submit" value="생성하기">
    </form>
@endsection