<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!--begin::Web font -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {"families":["Montserrat:300,400,500,600,700","Roboto:300,400,500,600,700"]},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<!--end::Web font -->
<!--begin::Base Styles -->
<!--begin::Page Vendors -->
<link href="{{ asset('metronic_assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors -->
<link href="metronic_assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
<link href="metronic_assets/demo/demo4/base/style.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Base Styles -->
<link rel="shortcut icon" href="metronic_assets/demo/demo4/media/img/logo/favicon.ico" />