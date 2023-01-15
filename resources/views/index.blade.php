@extends('layout')
@section('content')
    <input type="button" value="책 생성하기" onclick="location.href = '{{ route('create')}}'">
    <div class="book_container">
    @foreach($books as $book)
        <div class="abc">
            <span>제목 : {{$book -> title}}</span><br/>
            <span>페이지 수 : {{$book -> page}}</span><br/>
            <span>저자 : {{$book -> author}}</span><br/>
            <span>가격 : {{$book -> price}}</span><br/>
            
            <input type="button" value="수정하기" onclick="location.href = '{{ route('edit', ['id' => $book->id]) }}'">  
            <input type="button" value="삭제하기" onclick="location.href = '{{ route('delete', ['id' => $book->id]) }}'">      
        </div>
    @endforeach
    </div>
@endsection