@extends('layout')
@section('content')
    <form method="POST" action="{{ route('signup') }}">
        @csrf
        <input type="text" name="name" placeholder='이름' class="input_text"><br/>
        <input type="text" name="email" placeholder='아이디' class="input_text"><br/>
        <input type="password" name="password" placeholder='비밀번호' class="input_text"><br/>
        
        <input type="submit" value="회원가입">
    </form>

    @if(session('error'))
        <div>{{session('error')}}</div>
    @endif
@endsection