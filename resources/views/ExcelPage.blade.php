@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Excel
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')


    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Import Export to Excel</h1>
            </div>
            <div class="panel-body">

                <a href="{{ url('adm/downloadExcel') }}">
                    <button class="btn btn-success">Download</button>
                </a>


                <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;"
                      action="{{ url('adm/importExcel') }}" class="form-horizontal" method="post"
                      enctype="multipart/form-data">
                    @csrf


                    <input type="file" name="import_file"/>
                    <button class="btn btn-brand m--margin-top-5">Import File</button>
                </form>

            </div>
        </div>
    </div>

@endsection