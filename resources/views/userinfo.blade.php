@extends('layouts.app')

@section('content')

<div>

    @foreach($user as $users)
        <li>{{$users->email}}</li>
        <li>{{$users->name}}</li>
        @endforeach

</div>
@endsection