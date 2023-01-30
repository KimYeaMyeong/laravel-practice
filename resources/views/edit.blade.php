@extends('layout')
@section('content')
<div class="special_container">
    <form class="was-validated" method="POST" action="{{ route('update', ['id' => $edit_book->id])}}" novalidate>
        @csrf
        <div class="mb-1">
            <label for="title" class="form-label">책 제목</label><br/>
            <input type="text" class="form-control" name="title" value='{{$edit_book->title}}' required><br/>
        </div>
        @error('title')
        <div>{{$message}}</div>
        @enderror

        <div class="mb-1">
            <label for="page" class="form-label">페이지 수</label><br/>
            <input type="text" class="form-control" name="page" value='{{$edit_book->page}}' required><br/>
        </div>
        @error('page')
        <div>{{$message}}</div>
        @enderror

        <div class="mb-1">
            <label for="author" class="form-label">저자</label><br/>
            <input type="text" class="form-control" name="author" value='{{$edit_book->author}}' required><br/>
        </div>
        @error('author')
        <div>{{$message}}</div>
        @enderror

        <div class="mb-1">
            <label for="price" class="form-label">가격</label><br/>
            <input type="text" class="form-control" name="price" value='{{$edit_book->price}}' equired><br/>
        </div>
        @error('price')
        <div>{{$message}}</div>
        @enderror
        
        <select class="form-select-sm ms-2" name="category_name">
            @foreach($categories as $category)
                @if($default_category == $category->name)
                    <option value='{{$category->name}}' selected>{{$category->name}}</option>
                @else
                    <option value='{{$category->name}}'>{{$category->name}}</option>
                @endif
            @endforeach
        </select>

        <select class="form-select-sm ms-2" name="brand_id">
            @foreach($brands as $brand)
                @if($default_brand == $brand->name)
                    <option value='{{$brand->id}}' selected>{{$brand->name}}</option>
                @else
                    <option value='{{$brand->id}}'>{{$brand->name}}</option>
                @endif
            @endforeach
        </select><br/>
        
        <input type="submit" class="btn btn-primary mt-3 ms-2" value="수정하기">
    </form>
</div>
@endsection