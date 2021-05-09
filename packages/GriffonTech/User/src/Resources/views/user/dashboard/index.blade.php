@extends('user::layouts.master')

@section('page_title')
    Dashboard
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header mb-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Good Morning, <span class="text-bold"> {{ auth()->user()->name }}</span></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="container-fluid dashboard-view">
        <!-- Main row -->
        <div class="row mb-4">
            <!-- Left col -->
            <section class="col-lg-4 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Outstanding Balances - Rentals
                        </h3>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <p>In progress...</p>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-4">

                <!-- solid sales graph -->
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">
                            Tasks
                        </h3>
                    </div>
                    <div class="card-body">
                        <p>In progress...</p>
                    </div>
                </div>
                <!-- /.card -->
            </section>

            <section class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Overdue Tasks</h3>
                    </div>
                    <div class="card-body">
                        <p>In progress...</p>
                    </div>
                </div>
            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <section class="col-lg-4">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Expiring Leases</h3>
                    </div>
                    <div class="card-body">
                        <p>In progress...</p>
                    </div>
                </div>
            </section>

            <section class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Rental Listings</h3>
                    </div>
                    <div class="card-body">
                        <p>In progress...</p>
                    </div>
                </div>
            </section>

            <section class="col-lg-4">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Rental Applications</h3>
                    </div>
                    <div class="card-body">
                        <p>In progress...</p>
                    </div>
                </div>
            </section>
        </div>
    </div><!-- /.container-fluid -->

@endsection
