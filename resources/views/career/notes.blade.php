@extends('layouts.master')

@section('content-header')
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Notes
            </h3>
        </div>
    </div>
@endsection

@section('content-body')

    <div id="app">
        <career-note :notes='@json($notes)'></career-note>
    </div>

@endsection
