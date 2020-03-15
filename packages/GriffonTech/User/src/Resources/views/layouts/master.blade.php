<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <title>{{ config('app.name', 'Property Manager') }}</title>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="property manager" />
    <meta content="" name="saviobosco" />

    <!-- Styles -->
{{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
--}}
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="{{ asset('user/assets/css/material/app.min.css') }}" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('user/assets/plugins/jvectormap-next/jquery-jvectormap.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('user/assets/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <!-- Scripts -->
    <style>
        .fa-naira-sign::before{
            content: "\20A6";
        }
    </style>
</head>

<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade show">
    <div class="material-loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
        <div class="message">Loading...</div>
    </div>
</div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar">
    <!-- begin #header -->
    @include('user::layouts.header.index')
    <!-- end #header -->

    <!-- begin #sidebar -->
    @include('user::layouts.sidebar.index')
    <!-- end #sidebar -->

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        @include('user::layouts.header.breadcrumb.index')
        <!-- end breadcrumb -->


        <!-- begin page-header -->
        <h1 class="page-header">Hi,{{ auth()->user()->name }}
        </h1>
        <!-- end page-header -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
        @endif

        @if(Session::has('warning'))
            <p class="alert alert-warning">{{ Session::get('warning') }}</p>
        @endif

        @if(Session::has('info'))
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        @endif
        @if(Session::has('error'))
            <p class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif

        @yield('content')
    </div>
    <!-- end #content -->



    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('user/assets/js/app.min.js') }}"></script>
<script src="{{ asset('user/assets/js/theme/material.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('user/assets/plugins/gritter/js/jquery.gritter.js') }}"></script>
<script src="{{ asset('user/assets/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('user/assets/plugins/flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('user/assets/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('user/assets/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('user/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('user/assets/plugins/jvectormap-next/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('user/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{ asset('user/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('user/assets/js/demo/dashboard.js') }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    var handleRecordDeletion = function()
    {
        $('[data-click="delete"]').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this record!',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then(function(result) {
                if (result.value) {
                    // submit the deletion request
                    if (e.target.dataset.hasOwnProperty('link'))
                        var link = e.target.dataset.link;
                        $.ajax({
                            url: link,
                            type: 'post',
                            data: {
                                '_token': "{{ csrf_token() }}",
                                '_method': 'DELETE'
                            },
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            success: function(data, statusText) {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            }
                        });
                }
            });
        });
    };
    handleRecordDeletion();
</script>
@yield('footer-scripts')
</body>

</html>
