

@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Dashboard
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    <form action="{{route('upload')}}" enctype="multipart/form-data" method="post">
            @csrf

        <div class="container">
            <div class="col-8">
                <input type="file" name="image">
                <input type="submit" class="btn btn-success" value="upload">
            </div>
        </div>

    </form>

@endsection