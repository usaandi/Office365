@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                Create Team
            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')

    {{csrf_field()}}


    <div id="app">
        <div class="admin__form admin__form--clear"><h4>Add Team</h4>
            <form name="form" class="m-form" action="{{route('createTeam')}}" method="post">
                @csrf
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row"><label for="example-text-input"
                                                                     class="col-sm-3 col-xs-12  col-form-label">Team Name</label>
                        <div class="col-sm-9 col-xs-12 "><input required type="text" placeholder="Enter Team name"
                                                                name="teamName" class="form-control m-input"></div>
                    </div>

                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-sm-3 col-xs-12"></div>
                            <div class="col-sm-9 col-xs-12">
                                <div class="profile-timeline__action">
                                    <button type="submit" class="btn btn-success m-btn m-btn--pill">
                                        <span><span>Submit</span></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection