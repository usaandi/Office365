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
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible text-center">
            <a href="" class="close " data-dismiss="alert" aria-label="close"></a>
            <strong>User updated</strong>
        </div>
    @endif
    <div class="admin__form admin__form--clear"><h4>Update user: {{$user->name}}</h4>
        <form name="form" class="m-form" action="{{route('update',$user)}}" method="post">
            @csrf


            <div class="m-portlet__body">
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Username</label>
                    <div class="col-sm-9 col-xs-12 "><input value="{{$user->name}}" required type="text"
                                                            placeholder="Enter Username"
                                                            name="name" class="form-control m-input"></div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">phone</label>
                    <div class="col-sm-9 col-xs-12 "><input value="{{$user->phone}}" type="text"
                                                            placeholder="Enter Phone"
                                                            name="phone" class="form-control m-input"></div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Birthday</label>
                    <div class="col-sm-9 col-xs-12 "><input value="{{$user->birthday}}" type="date"
                                                            placeholder="Enter Birthday"
                                                            name="birthday" class="form-control m-input"></div>
                </div>
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Skype</label>
                    <div class="col-sm-9 col-xs-12 "><input value="{{$user->skype}}" type="text"
                                                            placeholder="Enter Skype"
                                                            name="skype" class="form-control m-input"></div>
                </div>


                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">
                        Department: @isset($currentDepartment)
                            {{$currentDepartment[0]->department_name}} @endisset</label>

                    <div class="col-sm-9 col-xs-12 "><select required name="department" class="form-control m-input">
                            <option></option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}"
                                        @isset($currentDepartment)
                                        @if($department->id === $currentDepartment[0]->id)
                                        selected="selected"
                                        @endif
                                        @endisset
                                >{{$department->department_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @hasrole('Admin')
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Current
                        Roles: @if($user->hasRole('Moderator'))
                            Moderator
                        @endif
                        @if($user->hasRole('User'))
                            User
                        @endif
                        @if($user->hasRole('Admin'))
                            Admin
                        @endif

                    </label>
                    <div class="col-sm-9 col-xs-12 "><select name="role" class="form-control m-input">
                            <option></option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"
                                        @if(isset($user->roles()->first()->id))
                                        @if ($user->roles()->first()->id === $role->id)
                                        selected="selected"
                                        @endif
                                        @endif
                                >
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endhasrole
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">ADM
                        since</label>
                    <div class="col-sm-9 col-xs-12 "><input value="{{$user->ADMsince}}" type="date"
                                                            placeholder="Enter Join date"
                                                            name="ADMsince" class="form-control m-input"></div>
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

    @hasanyrole('Admin|Moderator')
    <div id="app">
        <form class="m-form">
            <div class="admin__form admin__form--clear">
                <admin-view-user-strength :user-id='@json($user['id'])'>
                </admin-view-user-strength>
            </div>
        </form>
    </div>
    @endhasanyrole

@endsection