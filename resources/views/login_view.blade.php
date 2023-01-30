@extends('layout')
@section('content')
<div class="special_container">
    <form class="was-validated" method="POST" action="{{ route('login_auth') }}" novalidate>
        @csrf

        <div class="mb-1">
            <label for="email" class="form-label">아이디</label><br/>
            <input type="text" class="form-control" name="email" required><br/>
        </div>
        @error('email')
        <div>{{$message}}</div>
        @enderror

        <div class="mb-1">
            <label for="password" class="form-label">비밀번호</label><br/>
            <input type="password" class="form-control" name="password" required><br/>
        </div>
        @error('password')
        <div>{{$message}}</div>
        @enderror
        
        <input type="submit" class="btn btn-primary" value="로그인">
    </form>

    @if(session('error'))
        <div>{{session('error')}}</div>
    @endif
</div>
@endsection