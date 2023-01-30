@extends('layout')
@section('content')
@if ($user === 'none')
    <input type="button" class="btn btn-primary" value="관리자 로그인" onclick="location.href = '{{ route('login')}}'">
    <input type="button" class="btn btn-primary" value="회원가입" onclick="location.href = '{{ route('signup_create')}}'">
@else
    <h4>관리자 {{ $user->name }}님 환영합니다.</h4>
    <input type="button" class="btn btn-primary" value="로그아웃" onclick="location.href = '{{ route('logout')}}'">
    <input type="button" class="btn btn-primary" value="책 생성하기" onclick="location.href = '{{ route('create')}}'">
@endif
    <br/><br/>

    <form method="GET" action="{{ route('search') }}">
        <select class="sss" name="category_name">
            <option value='default'>분류</option>
            @foreach($categories as $category)
                <option value='{{$category->name}}' {{ request()->get('category_name') === $category->name ? 'selected' : null}}>{{$category->name}}</option>
            @endforeach
        </select>
        <select class="sss" name="brand_id">
            <option value='default'>출판사</option>
            @foreach($brands as $brand)
                <option value='{{$brand->id}}' {{ request()->get('brand_id') == $brand->id ? 'selected' : null}}>{{$brand->name}}</option>
            @endforeach
        </select>
        <input type="submit" class="btn btn-primary" value="검색하기"><br/>
    </form>

    <div class="book_container"> 
    @foreach($books as $book)
        <div class="abc">
            <h3>{{$book -> title}}</h3><br/>
            <span>페이지 수 : {{$book -> page}}</span><br/>
            <span>저자 : {{$book -> author}}</span><br/>
            <span>가격 : {{$book -> price}}원</span><br/>
            <span>분류 : {{$book -> category -> name}}</span><br/>
            <span>출판사 : {{$book -> category -> brand -> name}}</span><br/>
            @if($user !== 'none')
            <div class="text-center">
                <input type="button" class="btn btn-outline-primary" value="수정하기" onclick="location.href = '{{ route('edit', ['id' => $book->id]) }}'">
                <form method="POST" action = "{{ route('delete', ['id' => $book->id]) }}">
                @csrf
                @method('delete')
                    <button class="btn btn-outline-danger">삭제하기</button>
                </form>
                <input type="button" class="btn btn-outline-success" value="로그확인" onclick="location.href = '{{ route('profile', ['id' => $book->id])}}'">
            </div>  
            @endif
        </div>
    @endforeach
    </div>
@endsection