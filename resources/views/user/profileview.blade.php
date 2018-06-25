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
    {{csrf_field()}}

    <div class="card-body">
        @role('admin')
        I AM ADMIN
        @else
            I AM NOT ADMIN
        @endrole
        <h1>Kasutaja andmed</h1>
        <input type="hidden" name="id" value="{{{ $user->id }}}">

        <ul>
            <li>Email: {{$user->email}}</li>
            <li>Fullname: {{$user->name}}</li>
            <li>Phone Number: {{$user->phoneN}}</li>
            <li>Team: {{$user->team}}</li>
            <li>Skype: {{$user->skype}}</li>
            <li>Sünnipäev: {{$user->birthday}}</li>
            <li>Joined ADM: {{$user->ADMsince}}</li>
        </ul>


    </div>
@endsection