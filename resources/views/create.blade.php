@extends('layout')
@section('content')
    <form method="POST" action="{{ route('store')}}">    
        @csrf
        <input type="text" name="title" placeholder='책 제목' class="input_text"><br/>
        @error('title')
        <div>{{$message}}</div>
        @enderror
        <input type="text" name="page" placeholder='페이지 수' class="input_text"><br/>
        @error('page')
        <div>{{$message}}</div>
        @enderror
        <input type="text" name="author" placeholder='저자' class="input_text"><br/>
        @error('author')
        <div>{{$message}}</div>
        @enderror
        <input type="text" name="price" placeholder='가격' class="input_text"><br/>
        @error('price')
        <div>{{$message}}</div>
        @enderror

        <select name="category_name">
            @foreach($categories as $category)
                <option value='{{$category->name}}'>{{$category->name}}</option>
            @endforeach
        </select>

        <select name="brand_id">
            @foreach($brands as $brand)
                <option value='{{$brand->id}}'>{{$brand->name}}</option>
            @endforeach
        </select><br/>

        <input type="submit" value="생성하기">
    </form>
@endsection