@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Dashboard
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    {{csrf_field()}}

    <div id="app">
        <profile-view :user='@json($user)'></profile-view>
    </div>


@endsection