<!-- begin::Quick Nav -->
<!--begin::Base Scripts -->
<script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/demo/demo8/base/scripts.bundle.js')}}" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Vendors -->
<script src="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
<!--end::Page Vendors -->
<!--begin::Page Snippets -->
<script src="{{asset('assets/app/js/dashboard.js')}}" type="text/javascript"></script>
<!--end::Page Snippets -->
<script>
    var authUser = {!! auth()->user() !!};
    var authUserRole = {!! auth()->user()->roles()->first() !!};
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://unpkg.com/vue@latest"></script>
<script src="https://unpkg.com/vue-select@latest"></script>

<script>
    $(function() {
        $.fn.select2.defaults.set("theme", "bootstrap");
    });
</script>