<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> @yield('page_title') | {{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <style>
        .card {
            border-radius: 0;
        }
        div.form-group label {
            font-weight: 500 !important;
        }


        .tooltip-inner {
            background-color: rgba( 0, 0, 0, 0.8);
            font-size: .9em;
            padding: 4px;
        }

        .required > label::after {
            content: " * ";
            color: red;
        }






        td.no-right-border {
            border-right: none;
        }
        td.no-left-border {
            border-left: none;
        }
        .quick-menu {
            position: relative;
        }
        .quick-menu-icon {
            width: 26px;
            height: 26px;
            position: relative;
            text-decoration: none;
            cursor: pointer;
        }
        .quick-menu-icon:hover:before {
            background-image: url(/assets/dist/img/quick-menu-green.svg);
        }
        .quick-menu-icon:before {
            display: block;
            width: 25px;
            height: 25px;
            content: " ";
            position: relative;
            background: url(/assets/dist/img/quick-menu-grey.svg) center center no-repeat;
            background-size: 24px;
        }

        .quick-menu-popover {
            margin-top: 4px;
            display: none;
            box-shadow: 0 2px 10px 0 rgba(0, 0, 0, .25);
            border: 1px solid #cfcfcf;
            border-radius: 5px;
            width: 200px;
            background-color: #fff;
            position: absolute;
            right: 60%;
            z-index: 10;
        }
        .quick-menu-popover.show {
            display: block;
        }

        .quick-menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .quick-menu-link {
            display: block;
            height: 37px;
            padding: 3px 20px;
            cursor: pointer;
            border-color: transparent;
            border-style: solid;
            border-width: 1px 0;
            box-sizing: border-box;
            white-space: nowrap;
            font-weight: 600;
            letter-spacing: .5px;
            line-height: 29px;
            font-size: 14px;
            text-decoration: none;
            color: #4f4f52;
        }
        .quick-menu-link:hover {
            background-color: rgba(0, 0, 0, 0.1);
            color: #4f4f52;
        }
        .form__column {
            float: left;
        }

        .quick__nav__tab {
            list-style: none;
            padding: 0;
            border-bottom: 1px solid gray;
        }
        .quick__nav__tab .quick__nav__item {
            display: inline-block;
        }
        .quick__nav__tab .quick__nav__link {
            display: inline-block;
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px 5px 0 0;
            color: #212529;
            font-weight: 600;
        }
        .quick__nav__tab .quick__nav__link.active {
            background-color: rgba(0, 0, 0, 0.3);
        }
        .small-caps {
            font-variant: small-caps;
        }

        .card-detail {
            border-radius: 5px;
            border-left: 5px solid #1e7e34;
        }
        .form--element {
            display: block;
        }
        .form-element--icon {
            padding-left: 20px;
        }
        .icon-tel {
            background-size: 14px;
            background-repeat: no-repeat;
            background-position: left center;
            padding-left: 20px;
        }
        .icon-tel--home, .icon-tel--home-std {
            background-image: url(/css/icons/tel-home-grey.svg);
        }
        .icon-tel--work, .icon-tel--work-std {
            background-image: url(/css/icons/tel-work-grey.svg);
        }
        .icon-tel--mobile, .icon-tel--mobile-std {
            background-image: url(/css/icons/tel-mobile-grey.svg);
        }
        .icon-tel--fax, .icon-tel--fax-std {
            background-image: url(/css/icons/tel-fax-grey.svg);
        }
        .border-radius-5 {
            border-radius: 5px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('user::layouts.header.index')

@include('user::layouts.sidebar.index')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Main content -->
        <section class="content">
            @include('user::layouts.flash_messages')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 mt-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@include('user::layouts.footer.index')

<!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
{{--
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
--}}
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--
<script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
--}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        },
    });
    $(document).ajaxError(function(event, jqXHR){
        // if use is not logged in redirect.
        if (jqXHR.status === 403) {
            window.location = window.location.origin + '/admin/login';
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });


    $('.quick-menu-icon').on("click",function(event) {
        if ($(this).next().hasClass("show")) {
            $(this).next().removeClass("show");
        } else {
            var quick_menu_popovers = document.getElementsByClassName('quick-menu-popover');
            var i;
            for (i = 0; i < quick_menu_popovers.length; i++) {
                var popover = quick_menu_popovers[i];
                if (popover.classList.contains('show')) {
                    popover.classList.remove('show');
                }
            }
            $(this).next().addClass("show");
        }
    });

    window.onclick = function(event) {
        // hide all popovers
        var element = event.target;
        //console.log(element.matches('.quick-menu-popover'));
        if (!element.matches('.quick-menu-popover') && !element.matches('.quick-menu-icon') ) {
            var quick_menu_popovers = document.getElementsByClassName('quick-menu-popover');
            var i;
            for (i = 0; i < quick_menu_popovers.length; i++) {
                var popover = quick_menu_popovers[i];
                if (popover.classList.contains('show')) {
                    popover.classList.remove('show');
                }
            }
        }

    }

</script>
@yield('footer-script')
</body>
</html>
