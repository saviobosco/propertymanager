@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-bottom: 20px;">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                   <h4> Total Properties </h4>
                    <h5> {{ ($totalProperties) ? $totalProperties : 0 }} </h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4> Total Tenants </h4>
                    <h5> {{ ($totalTenants) ? $totalTenants : 0 }} </h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h4> Total Tenants </h4>
                    <h5> 5 </h5>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Lease to Expire in a Month </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th> Property </th>
                            <th> Ends </th>
                            <th> Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($leaseExpiresInAMonth as $tenant)
                            <tr>
                                <td>
                                    {{ $tenant->first_name }} {{ $tenant->last_name }}
                                </td>
                                <td> {{ $tenant->property->name }} </td>
                                <td> {{ $tenant->lease_ends }} </td>
                                <td>
                                    <a href="#" class="btn btn-primary"
                                       onclick="event.preventDefault();
                                           var response = confirm('Are you sure you want to notify this tenant?');
                                           if (response) {
                                           document.getElementById('{{ $tenant->id }}').submit(); }"
                                    > Notify Tenant </a>
                                    <form id="{{ $tenant['id'] }}" action="{{ route('tenants.notify', $tenant['id']) }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <ul>

                    </ul>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"> Activities </div>

                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
