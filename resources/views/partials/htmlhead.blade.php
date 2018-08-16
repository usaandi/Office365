<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>{{ config('app.name', 'Laravel') }}</title>

<!--begin::Base Styles -->
<!--begin::Page Vendors -->
<link href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors -->
<link href="{{asset('assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/demo/demo8/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
<!--end::Base Styles -->
<link rel="shortcut icon" href="{{asset('assets/demo8/demo/media/img/logo/favicon.ico')}}" />

<!--begin::App Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!--end::App Styles -->

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<base href="/">