@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Strength View
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
    <div class="m-content">
        <div id="app">
            <div class="admin__form admin__form--clear"><h4>Department</h4>
                <form class="m-form">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row"><label for="example-text-input"
                                                                         class="col-sm-3 col-xs-12  col-form-label">Strength</label>
                            <div class="col-sm-9 col-xs-12 "><input type="text" placeholder="Strength name"
                                                                    class="form-control m-input"></div>
                        </div>
                        <div class="form-group m-form__group row"><label for="exampleTextarea"
                                                                         class="col-sm-3 col-xs-12 col-form-label">Description</label>
                            <div class="col-sm-9 col-xs-12"><textarea id="exampleTextarea" rows="3"
                                                                      class="form-control m-input"></textarea></div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12"></div>
                                <div class="col-sm-9 col-xs-12">
                                    <div class="profile-timeline__action">
                                        <button href="" class="btn btn-success m-btn m-btn--pill">
                                            <span><span>Submit</span></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection