<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- begin::Head -->
<head>
    @include('partials.htmlhead')
</head>
<!-- end::Head -->
<!-- start::Body -->
<body class="m-page--fluid m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin::Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

        @include('partials.header')

        <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader ">
                        @yield('content-header')
                    </div>
                    <!-- END: Subheader -->

                    <!-- begin::Body Content -->
                    <div class="m-content">
                        @yield('content-body')
                    </div>
                    <!-- end::Body Content -->

            </div>
        </div>

    </div>
    @include('partials.footerscripts')
    <!-- end::Page -->
</body>
<!-- end::Body -->
</html>