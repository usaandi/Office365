
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
    <form name="form" action="{{route('store')}}" method="post">
        @csrf
<div class="card-body">
        <h1>Lisa kasutaja</h1>
        <label for="name"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="name" value="" required>
        <br>
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" value="" required>
        <br>
        <label for="phone"><b>Phone Number</b></label>
        <input type="number"placeholder="Enter Phone Number" name="phone" value="" required>
        <br>
        <label for="birthday"><b>Birthday</b></label>
        <input type="date" placeholder="Enter Birthday" name="birthday" value="" required>
        <br>
        <label for="skype"><b>Skype</b></label>
        <input type="text" placeholder="Enter Skype" name="skype" value="" required>
        <br>
        <label for="team"><b>Your team</b></label>
        <select name="team" placeholder="Your team" required>
            <option value="team1">team1</option>
            <option value="team2">team2</option>
            <option value="team3">team3</option>
            <option value="team4">team4</option>
        </select>
        <br>
        <label for="ADMsince"><b>ADM since</b></label>
        <input type="date" placeholder="ADM Join Date" name="ADMsince" value="" required>
        <br>

        <button type="submit">Submit</button>
</div>
    </form>

@endsection