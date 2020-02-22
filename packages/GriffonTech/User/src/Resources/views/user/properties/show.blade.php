@extends('user::layouts.master')

@section('title')Edit Property @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">View Property</h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Property Name</td>
                            <td>{{ $property->name }}</td>
                        </tr>
                        <tr>
                            <td>Property Type</td>
                            <td>{{ $property->property_type }}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td> {{ $property->address }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ $property->city }}</td>
                        </tr>
                        <tr>
                            <td>State</td>
                            <td>{{ $property->state }}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>{{ $property->country }}</td>
                        </tr>
                    </table>

                    <h4> LandLord Details</h4>
                    <table class="table">
                        <tr>
                            <td>LandLord Name</td>
                            <td>{{ $property->landlord_name }}</td>
                        </tr>
                        <tr>
                            <td>LandLord Address</td>
                            <td>{{ $property->landlord_address }}</td>
                        </tr>
                        <tr>
                            <td>LandLord Bank Details</td>
                            <td>{{ $property->landlord_bank_account_details }}</td>
                        </tr>
                    </table>

                    <h4> Units</h4>
                    @if($property->units)

                        <table class="table">
                            <thead>
                            <tr>
                                <td>
                                    #
                                </td>
                                <td> Identifier </td>
                                <td> Lease Starts </td>
                                <td> Lease Ends </td>
                                <td> Is Occupied </td>
                                <td> Tenants </td>
                                <td> last Updated</td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($property->units as $unit)
                                <tr>
                                    <td> {{ $unit->id }} </td>
                                    <td> {{ $unit->identifier }} </td>
                                    <td> {{ $unit->lease_starts }} </td>
                                    <td> {{ $unit->lease_ends }} </td>
                                    <td> {{ ($unit->is_occupied) ? 'Yes' : 'No' }} </td>
                                    <td>
                                        @if ($unit->tenants->count())
                                            @foreach ($unit->tenants as $tenant)
                                                <a href="{{ route('user.tenants.show', $tenant->id) }}"> {{ $tenant->first_name }} </a>,
                                            @endforeach

                                        @endif
                                    </td>
                                    <td> {{ $unit->updated_at }} </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>


                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
