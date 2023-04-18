<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ url('assets/js/libs/jquery.min.js') }}"></script>
<script src="{{ url('assets/js/libs/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/js/libs/flatpickr.min.js') }}"></script>
<script src="{{ url('assets/js/libs/flatpickr.vn.js') }}"></script>
<script src="{{ url('assets/js/libs/moment.min.js') }}"></script>
<script src="{{ url('assets/js/libs/moment.vi.min.js') }}"></script>
<script src="{{ url('assets/js/libs/daterangepicker.min.js') }}"></script>
<script src="{{ url('assets/js/libs/select2.full.min.js') }}"></script>

<script src="{{ url('assets/js/libs/loadingoverlay.min.js') }}"></script>
<script src="{{ url('assets/js/libs/luxon.min.js') }}"></script>
<script src="{{ url('assets/js/libs/lodash.js') }}"></script>
<script src="{{ url('assets/js/libs/jquery.form.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ url('assets/js/libs/Datatables/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/libs/datatables.bundle.js') }}"></script>
<script src="{{ url('assets/js/libs/Datatables/sum().js') }}"></script>
<!--end::Global Javascript Bundle-->
<script src="{{ url('assets/js/base.app.js') }}"></script>
<!--end::Javascript-->
<script>
    var DateTime = luxon.DateTime;
    $.app.init({
        url: '{{url('')}}',
        token: '{!! csrf_token() !!}',
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('pageJs')
