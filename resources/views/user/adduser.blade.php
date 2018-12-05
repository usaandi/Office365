@extends('layouts.master')

@section('content-header')

    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">


            </h3>
        </div>

        @include('partials.footerscripts')
    </div>
@endsection

@section('content-body')



    <div class="admin__form admin__form--clear"><h4>Create account</h4>
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                <strong>User Created!</strong>
            </div>
        @endif
        <form name="form" class="m-form" action="{{route('userAdd')}}" method="post">
            @csrf
            <div class="m-portlet__body">

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Username</label>
                    <div class="col-sm-9 col-xs-12 "><input required type="text" placeholder="Enter Username"
                                                            name="name" class="form-control m-input"></div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">E-mail</label>
                    <div class="col-sm-9 col-xs-12 "><input required type="email" placeholder="Enter E-mail"
                                                            name="email" class="form-control m-input"></div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Phone</label>
                    <div class="col-sm-9 col-xs-12 "><input required type="text" placeholder="Enter Phone"
                                                            name="phone" class="form-control m-input"></div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Birthday</label>
                    <div class="col-sm-9 col-xs-12 "><input required type="date" placeholder="Enter Skype"
                                                            name="birthday" class="form-control m-input"></div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">User
                        Role</label>
                    <div class="col-sm-9 col-xs-12 "><select required name="role" class="form-control m-input">
                            <option></option>
                            @foreach($roles as $role)

                                <option value="{{ $role->role_id }}">

                                    {{ $role->role_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">User
                        Department</label>
                    <div class="col-sm-9 col-xs-12 "><select required name="department" class="form-control m-input">
                            <option></option>
                            @foreach($departments as $department)

                                <option value="{{ $department->department_id }}">

                                    {{ $department->department_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Skype</label>
                    <div class="col-sm-9 col-xs-12 "><input required name="skype" type="text" placeholder="Enter Skype"
                                                            class="form-control m-input"></div>
                </div>
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">ADM
                        Since</label>
                    <div class="col-sm-9 col-xs-12 "><input required name="ADMsince" type="date"
                                                            placeholder="Enter Skype"
                                                            class="form-control m-input"></div>
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

@endsection