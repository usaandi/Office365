@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Create Career template
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    {{csrf_field()}}
<div class="m-content">
    <div id="app">
        <add-career></add-career>
    </div>
</div>


@endsection