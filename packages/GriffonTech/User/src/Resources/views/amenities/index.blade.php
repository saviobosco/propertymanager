@extends('user::layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Amenities </h4>
                    <a class="btn btn-primary btn-sm" href="{{ route('amenities.create') }}"> New Amenity</a>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>
                                #
                            </td>
                            <td> Amenity </td>
                            <td> Actions</td>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($amenities as $amenity)
                            <tr>
                                <td> {{ $amenity->id }} </td>
                                <td> {{ $amenity->type }} </td>
                                <td class="with-btn" nowrap>
                                    <a class="btn btn-primary btn-sm" href="{{ route('amenities.edit', $amenity->id) }}"> edit </a>
                                    <a class="btn btn-danger btn-sm" href="javascript:;"
                                       data-id="{{ $amenity->id }}"
                                       data-link="{{ route('amenities.delete', $amenity->id) }}"
                                       data-click="delete"> delete </a>
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
