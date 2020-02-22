@extends('user::layouts.master')

@section('title') Dashboard @stop

@section('content')
    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-building"></i></div>
                <div class="stats-info">
                    <h4>TOTAL PROPERTIES</h4>
                    <p> {{ number_format($propertiesCount) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('user.properties.index')  }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-info">
                <div class="stats-icon"><i class="fa fa-home"></i></div>
                <div class="stats-info">
                    <h4>TOTAL UNITS</h4>
                    <p>{{ number_format($unitsCount) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('user.units.index')  }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-user"></i></div>
                <div class="stats-info">
                    <h4>TENANTS</h4>
                    <p>{{ number_format($tenantsCount) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('user.tenants.index')  }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-dollar-sign"></i></div>
                <div class="stats-info">
                    <h4>TOTAL INCOME</h4>
                    <p>100,000</p>
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
    <!-- end row -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-8 -->
        <div class="col-xl-8">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="index-1">
                <div class="panel-heading">
                    <h4 class="panel-title"> Units Less than 2 months to Expiration</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body pr-1">
                    @if($unitsToExpireSoon)
                        @foreach($unitsToExpireSoon as $property_name => $units)
                            <h4> {{ $property_name }} </h4>

                            @if($units)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>Unit Identifier</td>
                                        <td>Lease Starts</td>
                                        <td>Lease Ends</td>
                                        <td>Is Occupied</td>
                                    </tr>
                                    </thead>
                                    @foreach($units as $unit)
                                        <tr>
                                            <td>{{ $unit->identifier }}</td>
                                            <td>{{ $unit->lease_starts }}</td>
                                            <td>{{ $unit->lease_ends }}</td>
                                            <td>{{ ($unit->is_occupied) ? 'Yes' : 'No' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <!-- end panel -->


        </div>
        <!-- end col-8 -->
        <!-- begin col-4 -->
        <div class="col-xl-4">






            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="index-10">
                <div class="panel-heading">
                    <h4 class="panel-title">Calendar</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="datepicker-inline" class="datepicker-full-width overflow-y-scroll position-relative"><div></div></div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-4 -->
    </div>
    <!-- end row -->
@endsection
