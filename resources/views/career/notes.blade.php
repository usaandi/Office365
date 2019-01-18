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
        <career-notes :notes='@json($notes)' :career-id={{json_encode((int)$careerId)}}></career-notes>
    </div>

@endsection
