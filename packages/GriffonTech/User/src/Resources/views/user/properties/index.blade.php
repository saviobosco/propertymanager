@extends('user::layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Properties</h4>
                    <a class="btn btn-primary btn-sm" href="{{ route('user.properties.create') }}"> New Property</a>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <td>
                                #
                            </td>
                            <td> Property Name </td>
                            <td> Address </td>
                            <td> City </td>
                            <td> State</td>
                            <td> Country</td>
                            <td> No of Unit(s)</td>
                            <td> Created</td>
                            <td> last Updated</td>
                            <td> Actions</td>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($properties as $property)
                            <tr>
                                <td> {{ $property->id }} </td>
                                <td> {{ $property->name }} </td>
                                <td> {{ $property->address }} </td>
                                <td> {{ $property->city }} </td>
                                <td> {{ $property->state }} </td>
                                <td> {{ $property->country }} </td>
                                <td> {{ ($property->units) ? number_format($property->units->count()) : 0 }} </td>
                                <td> {{ $property->created_at }} </td>
                                <td> {{ $property->updated_at }} </td>
                                <td class="with-btn" nowrap>
                                    <a class="btn btn-info btn-sm width-60 m-r-2" href="{{ route('user.properties.show', $property->id) }}">view</a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('user.properties.edit', $property->id) }}"> edit </a>
                                    <a class="btn btn-danger btn-sm" href="javascript:;"
                                       data-id="{{ $property->id }}"
                                       data-link="{{ route('user.properties.delete', $property->id) }}"
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
