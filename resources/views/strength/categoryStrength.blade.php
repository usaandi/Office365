@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Category and Strength
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    <div class="m-content">
        {{csrf_field()}}
        <div id="app">
            <admin-view-strength-category></admin-view-strength-category>
        </div>
    </div>

@endsection