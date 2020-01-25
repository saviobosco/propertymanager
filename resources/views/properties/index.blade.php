@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary float-right" href="{{ route('properties.create') }}"> Add Property </a>
                        Properties </div>

                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th> Name </th>
                                <th> Address </th>
                                <th> Created </th>
                                <th> Actions </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($properties as $property)
                                <tr>
                                    <td> {{ $property->id }}</td>
                                    <td> {{ $property->name }}</td>
                                    <td> {{ $property->address }}</td>
                                    <td> {{ $property->created_at }}</td>
                                    <td>
                                        <a href="{{ route('properties.edit', $property->id) }}">add tenants</a>
                                        <a href="{{ route('properties.edit', $property->id) }}">edit</a>
                                        <a href=""> view </a>
                                        <a class="text-danger" href="javascript:;"
                                           onclick="event.preventDefault();
                                               var response = confirm('Are you sure you want to delete this property?');
                                               if (response) {
                                               document.getElementById('{{ $property->id }}').submit(); }"
                                        >delete</a>
                                        <form id="{{ $property['id'] }}" action="{{ route('properties.delete', $property['id']) }}" method="POST" style="display: none;">
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
