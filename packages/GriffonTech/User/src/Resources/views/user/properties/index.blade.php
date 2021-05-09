@extends('user::layouts.master')

@section('page_title') Properties @stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Properties</h3>
                        <div class="float-right">
                            <a class="btn btn-success btn-sm" href="{{ route('user.properties.create') }}">Add Property</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="property-table" class="table table-bordered">
                            <thead>
                            <tr>
                                <td> Property </td>
                                <td> Location </td>
                                <td> Rental Owner </td>
                                <td> Manager </td>
                                <td colspan="2"> Type </td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($properties as $property)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.properties.show', $property->id) }}">
                                            {{ $property->address }}
                                        </a>
                                    </td>
                                    <td> {{ $property->city }}, {{ $property->state_name }} - {{ $property->country_name }} </td>
                                    <td>
                                        @if($property->rental_owners->isNotEmpty())
                                            @foreach($property->rental_owners as $rental_owner)
                                                {{ ($rental_owner->owner->company_name) ? $rental_owner->owner->company_name : $rental_owner->owner->first_name.' '.$rental_owner->owner->last_name  }},
                                            @endforeach
                                        @endif
                                    </td>
                                    <td></td>
                                    <td class="no-right-border">
                                        {{ $property->property_type_detail }}
                                    </td>
                                    <td class="with-btn no-left-border" nowrap>
                                        <div class="quick-menu">
                                            <div class="quick-menu-icon"></div>
                                            <div class="quick-menu-popover">
                                                <ul class="quick-menu-list">
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link" href="">Financials</a>
                                                    </li>
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link" href="{{ route('manager.properties.units.index', ['property' => $property->id]) }}">Units</a>
                                                    </li>
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link" href="{{ route('user.property_owners.index', ['property_id' => $property->id]) }}">Rental owners</a>
                                                    </li>
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link" href="">Event history</a>
                                                    </li>
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link" href="{{ route('user.properties.show', $property->id) }}">Property Summary</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
