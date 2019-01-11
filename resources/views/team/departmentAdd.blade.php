@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                @isset($error)
                    @if($error)
                      This department: {{$error}} already exists!
                    @endif
                @endisset

                @isset($success)
                    @if($success)
                        Added: {{$success}} successfully
                    @endif
                @endisset
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    <div class="admin__form admin__form--clear">
        <form class="m-form" name="form" action="{{route('store')}}" method="post">
            @csrf
            <div class="m-portlet__body">
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Fullname</label>
                    <div class="col-sm-9 col-xs-12 "><input   required name="departmentName" type="text"
                                                            placeholder="Department Fullname"
                                                            class="form-control m-input"></div>
                </div>
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Abbreviation</label>
                    <div class="col-sm-9 col-xs-12 "><input  required name="departmentAbbr" type="text"
                                                            placeholder="Department abbreviation"
                                                            class="form-control m-input"></div>
                </div>
                <div class="form-group m-form__group row"><label for="exampleTextarea"
                                                                 class="col-sm-3 col-xs-12 col-form-label">Description</label>
                    <div class="col-sm-9 col-xs-12"><textarea required maxlength="2000" id="exampleTextarea" rows="3"
                                                              class="form-control m-input"
                                                              name="description"></textarea></div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <div class="row">
                        <div class="col-sm-3 col-xs-12"></div>
                        <div class="col-sm-9 col-xs-12">
                            <div class="profile-timeline__action">
                                <button type="submit" class="btn btn-success m-btn m-btn--pill">
                                    <span><span>Submit</span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection