<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            body {

            padding-top:60px;
            padding-bottom:10px;


            }
            #connect-button{
                text-align: left;


            }
        </style>
    </head>
    <body>
    @extends('layout')

    @section('content')

        <div class="jumbotron">
            <p>
                <a class="btn btn-lg btn-primary" href="/signin" role="button" id="connect-button">Connect to Outlook</a>
            </p>
        </div>

    @endsection
    </body>
</html>
