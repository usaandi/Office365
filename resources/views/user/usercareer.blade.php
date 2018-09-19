@extends('layouts.master')

@section('content-body')

    {{csrf_field()}}

    <div id="app">
        <user-career :current-user-id='@json($user)'></user-career>
    </div>


@endsection