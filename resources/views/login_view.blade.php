@extends('layout')
@section('content')

    <form method="POST" action="{{ route('login_auth') }}">
        @csrf
        <input type="text" name="email" placeholder='아이디' class="input_text"><br/>
        @error('email')
        <div>{{$message}}</div>
        @enderror
        <input type="password" name="password" placeholder='비밀번호' class="input_text"><br/>
        @error('password')
        <div>{{$message}}</div>
        @enderror
        
        <input type="submit" value="로그인">
    </form>

    @if(session('error'))
        <div>{{session('error')}}</div>
    @endif

@endsection