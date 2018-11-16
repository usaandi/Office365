@extends('layouts.master')

@section('content-header')
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Departments
            </h3>
        </div>
    </div>
@endsection

@section('content-body')

    <div id="app">
        <admin-view-department :departments='@json($departments)'></admin-view-department>
    </div>

@endsection
