@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Departments strengths
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    {{csrf_field()}}

    <div id="app">
        <department-user-strength-category></department-user-strength-category>
    </div>


@endsection