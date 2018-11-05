@extends('layouts.master')

@section('content-header')
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Users
            </h3>
        </div>
    </div>
@endsection

@section('content-body')

    <div id="app">
        <user-list :users='@json($users)'></user-list>
    </div>

@endsection
