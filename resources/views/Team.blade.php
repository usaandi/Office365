@extends('layouts.master')

@section('content-header')
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Teams
            </h3>
        </div>
    </div>
@endsection

@section('content-body')

    <div id="app">
        <admin-view-team
                :teams='@json($teams)'
        ></admin-view-team>
    </div>

@endsection
