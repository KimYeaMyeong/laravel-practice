@extends('layout')
@section('content')
@if ($user === 'none')
    <input type="button" value="관리자 로그인" onclick="location.href = '{{ route('login')}}'">
    <input type="button" value="회원가입" onclick="location.href = '{{ route('signup_create')}}'">
@else
    <div id="admin_title">관리자 {{ $user->name }}님 환영합니다.</div>
    <input type="button" value="로그아웃" onclick="location.href = '{{ route('logout')}}'">
    <input type="button" value="책 생성하기" onclick="location.href = '{{ route('create')}}'">
@endif

    <div class="book_container"> 
    @foreach($books as $book)
        <div class="abc">
            <span>제목 : {{$book -> title}}</span><br/>
            <span>페이지 수 : {{$book -> page}}</span><br/>
            <span>저자 : {{$book -> author}}</span><br/>
            <span>가격 : {{$book -> price}}원</span><br/>
            <span>종류 : {{$book -> category -> name}}</span><br/>
            <span>출판사 : {{$book -> category -> brand -> name}}</span><br/>
            @if($user !== 'none')
            <div id="update_delete">
                <input type="button" value="수정하기" onclick="location.href = '{{ route('edit', ['id' => $book->id]) }}'">
                <form method="POST" action = "{{ route('delete', ['id' => $book->id]) }}">
                @csrf
                @method('delete')
                    <button>삭제하기</button>
                </form>
                <input type="button" value="로그확인" onclick="location.href = '{{ route('profile', ['id' => $book->id])}}'">
            </div>  
            @endif
        </div>
    @endforeach
    </div>
@endsection