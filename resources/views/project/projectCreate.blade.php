@extends('layouts.master')

@section('content-header')
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Projects Add
            </h3>
        </div>
    </div>
@endsection

@section('content-body')

    <div id="app">
        <project-create-view :clients="{{json_encode($clients)}}" :positions="{{json_encode($positions)}}"></project-create-view>
    </div>

@endsection