@extends('user::layouts.master')

@section('title') View Unit @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">View Unit</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td> Unit # </td>
                            <td> {{ $unit->id }}</td>
                        </tr>
                        <tr>
                            <td>Lease Starts</td>
                            <td>{{ $unit->lease_starts }}</td>
                        </tr>
                        <tr>
                            <td>Lease Ends</td>
                            <td>{{ $unit->lease_ends }}</td>
                        </tr>
                        <tr>
                            <td>Is Occupied</td>
                            <td>{{ ($unit->is_occupied) ? 'Yes' : 'No' }}</td>
                        </tr>
                    </table>

                    <h4> Tenants</h4>

                    @if ($unit->tenants)
                    <div class="row">
                        @foreach($unit->tenants as $tenant)
                        <div class="col-xs-3">
                            <div class="card border-0">
                                <img class="card-img-top" src="" alt="">
                                <div class="card-body">
                                    <h4 class="card-title m-t-0 m-b-10"> {{ $tenant->first_name.' '. $tenant->last_name }} </h4>
                                    <p class="card-text">
                                        {{ $tenant->occupation }}
                                    </p>
                                    <a href="javascript:;" class="btn btn-sm btn-info">view profile</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
