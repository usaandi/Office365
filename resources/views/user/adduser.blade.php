
@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Dashboard
            </h3>
        </div>
        <div>
            <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                <span class="m-subheader__daterange-label">
                    <span class="m-subheader__daterange-title"></span>
                    <span class="m-subheader__daterange-date m--font-brand"></span>
                </span>
                <a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill">
                    <i class="la la-angle-down"></i>
                </a>
            </span>
        </div>
        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    <form name="form" action="{{route('store')}}" method="post">
        @csrf

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="name" value="" required>
        <label for="uemail"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" value="" required>

        <button type="submit">Submit</button>

    </form>

@endsection