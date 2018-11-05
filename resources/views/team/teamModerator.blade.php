
@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Hello
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')
    <style>
         select {
            width:200px;
            border:1px solid #babacc;
            box-sizing:border-box;

        }

        label {
            width: 100px;
        }
    </style>
    <div id="app">
        <user-team-moderator :users='@json($users)' :teams='@json($teams)' ></user-team-moderator>
    </div>

@endsection