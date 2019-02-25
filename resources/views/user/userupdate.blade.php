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
        <form id="form" name="form" class="m-form" action="{{route('update',$user)}}" method="post">
            @csrf


            <div class="m-portlet__body">
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Username</label>
                    <div class="col-sm-9 col-xs-12 "><input value="{{$user->name}}" required type="text"
                                                            placeholder="Enter Username"
                                                            name="name" class="form-control m-input"></div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Phone</label>
                    <div class="col-sm-9 col-xs-12 "><input id="phoneNumber" value="{{$user->phone}}" type="text"
                                                            maxlength="12"
                                                            placeholder="Enter Phone"


                                                            name="phone" class="form-control m-input"></div>
                </div>

                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Birthday</label>
                    <div class="col-sm-9 col-xs-12 "><input id="birthday" type="text"
                                                            placeholder="Enter Birthday" readonly
                                                            value="{{$user->birthday}}"
                                                            name="birthday" class="form-control m-input"></div>
                </div>
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Skype</label>
                    <div class="col-sm-9 col-xs-12 "><input value="{{$user->skype}}" type="text"
                                                            placeholder="Enter Skype"
                                                            name="skype" class="form-control m-input"></div>
                </div>


                <div class="form-group m-form__group row"><label for="departmentInput"
                                                                 class="col-sm-3 col-xs-12  col-form-label">
                        Department: </label>

                    <div class="col-sm-9 col-xs-12 "><select required name="department" id="departmentInput"
                                                             class="form-control m-input">
                            @foreach($departments as $department)
                                <option value="{{$department->id}}"
                                        @isset($userDepartment)
                                        @if($department->id === $userDepartment->id)
                                        selected="selected"
                                        @endif
                                        @endisset
                                >{{$department->department_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group m-form__group row"><label for="teamInput"
                                                                 class="col-sm-3 col-xs-12  col-form-label">
                        Team: </label>
                    <div class="col-sm-9 col-xs-12 "><select required name="team" id="teamInput" class="form-control m-input">
                            <option></option>
                            @foreach($teams as $team)
                                <option value="{{$team->team_id}}"
                                        @isset($userTeam)
                                        @if($team->team_id === $userTeam->id)
                                        selected="selected"
                                        @endif
                                        @endisset
                                >{{$team->team_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @hasrole('Admin')
                <div class="form-group m-form__group row"><label for="example-text-input"
                                                                 class="col-sm-3 col-xs-12  col-form-label">Current
                        Role: @if($user->hasRole('Moderator'))
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
                <div class="form-group m-form__group row"><label for="ADMsince"
                                                                 class="col-sm-3 col-xs-12  col-form-label">ADM
                        since</label>
                    <div class="col-sm-9 col-xs-12 "><input value="{{$user->ADMsince}}" type="text" readonly
                                                            placeholder="Joined ADM"
                                                            id="ADMsince"
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

    <script>

        $('#birthday').datepicker({
            format: 'yyyy-mm-dd',
            orientation: "top auto",
            autoclose: true,
        }).on('changeDate', event => {

        });
        $('#ADMsince').datepicker({
            format: 'yyyy-mm-dd',
            orientation: "top auto",
            autoclose: true,
        }).on('changeDate', event => {

        });

        $('#form').submit(e => {
            let phone = $('#phoneNumber');
            if (phone.val().length > 15) {
                phone.addClass('border border-danger');
                return false;
            } else {
                phone.removeClass('border border-danger')
                return true;
            }
        })
    </script>
@endsection
