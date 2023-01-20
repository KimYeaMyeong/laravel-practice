@extends('layout')
@section('content')
    @foreach($logs as $log)
        <div>{{$log->name}} : {{$log->log}}</div>
    @endforeach
@endsection