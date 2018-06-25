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
    <style>
        input, select, textarea{
            width:200px;
            border:1px solid #babacc;
            box-sizing:border-box;

        }
        label {
            width: 100px;
        }
    </style>

    <form name="form" action="{{route('update',$user)}}" method="post">
        @csrf

    <div class="card-body">
        <h1>Muuda Kasutaja andmeid</h1>
        <label><b>Fullname</b></label>
        <input type="text" name="name"  value="{{ $user->name }}"/>
        <br>
        <label><b>Email</b></label>
        <input type="email" name="email"  value="{{ $user->email }}"/>
        <br>
        <label><b>Phone Number</b></label>
        <input type="number" name="phone" value="{{$user->phoneN}}"/>
        <br>
        <label><b>Birthday</b></label>
        <input type="date"name="birthday" value="{{$user->birthday}}"/>
        <br>
        <label><b>Skype</b></label>
        <input type="text"name="skype" value="{{$user->skype}}"/>
        <br>
        <label for="team"><b>Your team</b></label>
        <select name="team" placeholder="{{$user->team}}">
            <option value="team1">team1</option>
            <option value="team2">team2</option>
            <option value="team3">team3</option>
            <option value="team4">team4</option>
        </select>
        <br>
        <label><b>ADM since</b></label>
        <input type="date" name="ADMsince" value="{{$user->ADMsince}}">
        <br>
        <button type="submit">Save</button>
    </div>
    </form>
@endsection