@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div>
                        <h3 class="m-subheader__title ">
                            Personal development
                        </h3>
                    </div>
                    <div class="m-subheader__action">
                        <a href="" class="btn btn-success m-btn m-btn--icon m-btn--pill">
                            <span>
                                <i class="la la-plus"></i>
                                <span>New</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                <span class="m-subheader__daterange-label">
                    <span class="m-subheader__daterange-title"></span>
                    <span class="m-subheader__daterange-date m--font-brand"></span>
                </span>
                <a href="" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                    <i class="la la-angle-down"></i>
                </a>
            </span>
        </div>
        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    {{csrf_field()}}

    <div id="app">
        <user-career></user-career>
    </div>


@endsection