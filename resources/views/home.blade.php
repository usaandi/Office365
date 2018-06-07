@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}

                        </div>
                    @endif
                        User list
<br>
                    @foreach ($user as $users)
                        <a href={{url('user/'.$users->id)}}><br> <li>{{$users->name}}</li></a>

                            <li>{{$users->id}}</li>

                            <li>{{$users->email}}</li>

                            {{url('user/'.$users->id)}}
                        <br>

                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
