<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<!-- begin::Head -->
<head>
    @include('partials.htmlhead')
</head>
<!-- end::Head -->
<!-- start::Body -->
<body style="background-image: url(metronic_assets/app/media/img/bg/bg-1.jpg)" class="m-page--boxed m-body--fixed m-header--static m-aside--offcanvas-default">
    <!-- begin::Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

        @include('partials.header')

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid m-grid--hor m-container m-container--responsive m-container--xxl">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid m-grid--hor m-container m-container--responsive m-container--xxl">

                    <!-- begin::Body Header -->
                    <div class="m-grid__item m-body__nav">
                        <div class="m-stack m-stack--ver m-stack--desktop">
                            @yield('content-header')
                        </div>
                    </div>
                    <!-- end::Body Header -->

                    <!-- begin::Body Content -->
                    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--desktop m-grid--ver-desktop m-body__content">
                        <div class="m-grid__item m-grid__item--fluid m-wrapper">
                            @yield('content-body')
                        </div>
                    </div>
                    <!-- end::Body Content -->

                </div>
            </div>
        </div>

    </div>
    <!-- end::Page -->
</body>
<!-- end::Body -->
</html>