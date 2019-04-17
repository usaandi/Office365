@extends('layouts.master')

@section('content-header')
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Projects
            </h3>
        </div>
    </div>
@endsection

@section('content-body')

    <div id="app">
        <project-view></project-view>
    </div>

@endsection