
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
        .form-group{

        }
        label {
            width: 100px;
        }
    </style>
    <form name="form" action="{{route('store')}}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <h1>Department</h1>

                <label for="Department name"><b>Department Fullname</b></label>
                <input type="text" placeholder="Department Fullname" name="departmentName"  required>
                <br>
                <label for="Department abbr"><b>Abbreviation</b></label>
                <input type="text" placeholder="Department abbreviation"  name="departmentAbbr"  required>
                <br>
                <br><label for="description"><b>Description</b></label>
                <textarea  rows="5" cols="3" name="description"></textarea>
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
        </div>
    </form>


@endsection