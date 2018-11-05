@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Department
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    {{csrf_field()}}

    <div id="app">
        <department-user-list-draggable></department-user-list-draggable>
    </div>


@endsection