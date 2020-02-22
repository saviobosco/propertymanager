@extends('user::layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Units</h4>
                    <a class="btn btn-primary btn-sm" href="{{ route('user.units.create') }}"> New Unit</a>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>
                                #
                            </td>
                            <td> Property Name </td>
                            <td> Identifier </td>
                            <td> Is Occupied </td>
                            <td> Lease Ends </td>
                            <td> Status </td>
                            <td> Tenants </td>
                            <td> Actions </td>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($units as $unit)
                            <tr>
                                <td> {{ $unit->id }} </td>
                                <td> {{ $unit->property->name }} </td>
                                <td> {{ $unit->identifier }} </td>
                                <td> {!! ($unit->is_occupied) ? '<span class="text-success">YES</span>' : '<span class="text-danger">NO</span>' !!} </td>
                                <td> {{ ($unit->lease_ends) ? (new \Carbon\Carbon($unit->lease_ends))->format('M j, Y') : '' }} </td>
                                <td>
                                    <?php
                                        if ($unit->lease_ends && $unit->is_occupied) {
                                            $lease_ends_date = (new \Carbon\Carbon())->diffInDays(new \Carbon\Carbon($unit->lease_ends), false);
                                            if ($lease_ends_date < 0) {
                                                echo '<span class="label label-danger">expired</span>';
                                            } elseif ($lease_ends_date == 0) {
                                                echo '<span class="label label-info">expires shortly</span>';
                                            } else {
                                                echo $lease_ends_date . ' Day(s) Remaining';
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                     @if ($unit->tenants->count())
                                        @foreach ($unit->tenants as $tenant)
                                            <a href="{{ route('user.tenants.show', [$tenant->unit_id, $tenant->id]) }}"> {{ $tenant->first_name }} </a>,
                                        @endforeach

                                    @endif
                                </td>
                                <td class="with-btn" nowrap>
                                    <a class="btn btn-info btn-sm width-60 m-r-2" href="{{ route('user.units.show', $unit->id) }}">view</a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('user.units.edit', $unit->id) }}"> edit </a>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-white btn-sm width-90">Tenants</a>
                                        <a href="#" class="btn btn-white btn-sm dropdown-toggle width-30 no-caret" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('user.units.tenants.index', $unit->id) }}" class="dropdown-item">All Tenants</a>
                                            <a href="{{ route('user.units.tenants.create', $unit->id) }}" class="dropdown-item"> New Tenant</a>
                                            @if($unit->tenants->count() && $unit->is_occupied)
                                            <a href="#" class="dropdown-item text-info"> Notify Tenants</a>
                                            @endif
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item text-danger">Remove Tenants</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
