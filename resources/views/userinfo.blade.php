@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                   <div class="card-body">
                      <h1>Kasutaja andmed</h1>
                       <ul>
                             <li>Nimi: {{$user->name}}</li>
                             <li>Email: {{$user->email}}</li>
                       </ul>
                   </div>
            </div>
        </div>
    </div>
</div>
@endsection