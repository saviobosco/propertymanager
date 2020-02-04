@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary float-right" href="{{ route('tenants.create') }}"> Add Tenants </a>
                        Tenants </div>

                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Phone Number </th>
                                <th> Lease Start </th>
                                <th> Lease Ends </th>
                                <th> Property </th>
                                <th> Created </th>
                                <th> Actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tenants as $tenant)
                                <tr>
                                    <td> {{ $tenant->id }}</td>
                                    <td> {{ $tenant->first_name }}</td>
                                    <td> {{ $tenant->last_name }}</td>
                                    <td> {{ $tenant->phone_number }}</td>
                                    <td> {{ $tenant->lease_starts }}</td>
                                    <td> {{ $tenant->lease_ends }}</td>
                                    <td> {{ $tenant->property->name }}</td>
                                    <td> {{ $tenant->created_at }}</td>
                                    <td>
                                        <a href="{{ route('tenants.edit', $tenant->id) }}">edit</a>
                                        <a class="text-danger" href="javascript:;"
                                           onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this tenant?');
                                               if (response) {
                                               document.getElementById('{{ $tenant->id }}').submit(); }"
                                        >delete</a>
                                        <form id="{{ $tenant['id'] }}" action="{{ route('tenants.delete', $tenant['id']) }}" method="POST" style="display: none;">
                                            <input type="hidden" name="_method" value="delete">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
