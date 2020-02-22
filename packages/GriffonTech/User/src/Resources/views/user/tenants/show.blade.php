@extends('user::layouts.master')

@section('title') View Tenant @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">View Tenant</h4>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="img-thumbnail" style="width: 150px; height: 150px;">

                            </div>
                        </div>
                        <div class="col-sm-10">
                            <table class="table">
                                <tr>
                                    <td> Property Name :</td>
                                    <td>{{ $tenant->property->name }}</td>
                                </tr>
                                <tr>
                                    <td>Unit Identifier</td>
                                    <td> {{ $tenant->unit->identifier }}</td>
                                </tr>
                                <tr>
                                    <td>Full Name</td>
                                    <td> {{ $tenant->first_name.' '.$tenant->middle_name.' '.$tenant->last_name }} </td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td>{{ $tenant->occupation }}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>{{ $tenant->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Email Address </td>
                                    <td> {{ $tenant->email_address }}</td>
                                </tr>
                                <tr>
                                    <td>State of Origin</td>
                                    <td>{{ $tenant->state_of_origin }}</td>
                                </tr>
                                <tr>
                                    <td>L.G.A</td>
                                    <td>{{ $tenant->l_g_a }}</td>
                                </tr>
                                <tr>
                                    <td>Note</td>
                                    <td>{{ $tenant->note }}</td>
                                </tr>
                                <tr>
                                    <td> Was Evicted </td>
                                    <td>{{($tenant->was_evicted) ? 'Yes' : ''}}</td>
                                </tr>
                                <tr>
                                    <td> Active </td>
                                    <td>{{ ($tenant->active) ? 'Yes' : 'No' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
