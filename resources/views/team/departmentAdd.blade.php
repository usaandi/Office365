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
        input, select, textarea {
            width: 200px;
            border: 1px solid #babacc;
            box-sizing: border-box;

        }

        .form-group {

        }

        label {
            width: 100px;
        }
    </style>
    <div class="admin__form admin__form--clear">
    <form class="m-form" name="form" action="{{route('store')}}" method="post">
        @csrf
        <div class="m-portlet__body">
            <div class="form-group m-form__group row"><label for="example-text-input"
                                                             class="col-sm-3 col-xs-12  col-form-label">Fullname</label>
                <div class="col-sm-9 col-xs-12 "><input name="departmentName" type="text" placeholder="Department Fullname"
                                                        class="form-control m-input"></div>
            </div>
            <div class="form-group m-form__group row"><label for="example-text-input"
                                                             class="col-sm-3 col-xs-12  col-form-label">Abbreviation</label>
                <div class="col-sm-9 col-xs-12 "><input name="departmentAbbr" type="text" placeholder="Department abbreviation"
                                                        class="form-control m-input"></div>
            </div>
            <div class="form-group m-form__group row"><label for="exampleTextarea"
                                                             class="col-sm-3 col-xs-12 col-form-label">Description</label>
                <div class="col-sm-9 col-xs-12"><textarea id="exampleTextarea" rows="3"
                                                          class="form-control m-input" name="description"></textarea></div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-sm-3 col-xs-12"></div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="profile-timeline__action">
                            <button type="submit" class="btn btn-success m-btn m-btn--pill"><span><span>Submit</span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

@endsection