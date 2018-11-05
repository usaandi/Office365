
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
 <style>
     input, select, textarea{
         width:200px;
         border:1px solid #babacc;
         box-sizing:border-box;

     }
     .form-group{

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
        <label for="ADMsince"><b>ADM since</b></label>
        <input type="date" placeholder="ADM Join Date" name="ADMsince" value="" required>
        <br>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</div>
    </form>

@endsection