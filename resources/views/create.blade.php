@extends('layout')
@section('content')
<div class="special_container">
    <form class="was-validated" method="POST" action="{{ route('store')}}" novalidate>    
        @csrf
        <div class="mb-1">
            <label for="title" class="form-label">책 제목</label><br/>
            <input type="text" class="form-control" name="title" required><br/>
        </div>
        @error('title')
        <div>{{$message}}</div>
        @enderror

        <div class="mb-1">
            <label for="page" class="form-label">페이지 수</label><br/>
            <input type="text" class="form-control" name="page" required><br/>
        </div>
        @error('page')
        <div>{{$message}}</div>
        @enderror

        <div class="mb-1">
            <label for="author" class="form-label">저자</label><br/>
            <input type="text" class="form-control" name="author" required><br/>
        </div>
        @error('author')
        <div>{{$message}}</div>
        @enderror

        <div class="mb-1">
            <label for="price" class="form-label">가격</label><br/>
            <input type="text" class="form-control" name="price" required><br/>
        </div>
        @error('price')
        <div>{{$message}}</div>
        @enderror

        <select class="form-select-sm ms-2" name="category_name">
            @foreach($categories as $category)
                <option value='{{$category->name}}'>{{$category->name}}</option>
            @endforeach
        </select>

        <select class="form-select-sm ms-2" name="brand_id">
            @foreach($brands as $brand)
                <option value='{{$brand->id}}'>{{$brand->name}}</option>
            @endforeach
        </select><br/>

        <input type="submit" class="btn btn-primary mt-3 ms-2" value="생성하기">
    </form>
</div>
@endsection