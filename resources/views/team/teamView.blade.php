@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Osakond {{ $department->department_name }}
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    {{csrf_field()}}


    <div id="app">
        <team-list :departmentid='@json($department->id)' ></team-list>
    </div>


@endsection