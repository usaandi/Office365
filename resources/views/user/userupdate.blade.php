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
        input, select, textarea {
            width: 200px;
            border: 1px solid #babacc;
            box-sizing: border-box;
            margin-top: 5px;

        }

        label {
            width: 150px;
        }
    </style>

    <form name="form" action="{{route('update',$user)}}" method="post">
        @csrf

        <div class="card-body">
            <h1>Muuda Kasutaja andmeid</h1>
            <label><b>Fullname</b></label>
            <input type="text" name="name" value="{{ $user->name }}"/>
            <br>
            <label><b>Phone Number</b></label>
            <input type="number" name="phone" value="{{$user->phone}}"/>
            <br>
            <label><b>Birthday</b></label>
            <input type="date" name="birthday" value="{{$user->birthday}}"/>
            <br>
            <label><b>Skype</b></label>
            <input type="text" name="skype" value="{{$user->skype}}"/>
            <br>
            <label for="department"><b>Your Department: {{$currentDepartment[0]->department_name}} </b></label>
            <select name="department">
                <option></option>

                @foreach($departments as $department)
                    <option value="{{$department->id}}"
                            @if($department->id === $currentDepartment[0]->id)
                            selected="selected"
                            @endif
                    >{{$department->department_name}}</option>
                @endforeach

            </select>
            <br>
            @hasanyrole('Admin')
            <label for="role"><b>Your Current role: </b></label>
            <select name="role">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}"
                            @if ($user->roles()->first()->id === $role->id)
                            selected="selected"
                            @endif

                    >
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <br>
            @endhasanyrole
            <label><b>ADM since</b></label>
            <input type="date" name="ADMsince" value="{{$user->ADMsince}}">
            <br>
            <button type="submit">Save</button>
        </div>
    </form>

    <div id="app">
        <admin-view-user-strength :user-id='@json($user['id'])'>
        </admin-view-user-strength>
    </div>

@endsection