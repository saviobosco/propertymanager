@extends('user::layouts.master')

@section('page_title')
    {{ $property->address }}
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('user::user.properties.includes.top_header')

            <div class="clearfix mb-3">
                <div class="float-right">

                    <a class="btn btn-success" href="{{ route('manager.properties.units.create', ['property_id' => $property->id]) }}">Add Unit</a>

                    <a class="btn btn-default" href=""> Enter bulk charges</a>
                    <a class="btn btn-default" href=""> Enter bulk credits</a>
                </div>
            </div>


            <div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Address</th>
                        <th>Tenants</th>
                        <th>Most Recent Event</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($units))
                        @foreach($units as $unit)
                            <tr>
                                <td>
                                    <a href="{{ route('manager.properties.units.show', ['property_id'=>$property->id,'id' => $unit->id]) }}"> {{ $unit->identifier }}</a>
                                </td>
                                <td> {{ $unit->property->address }} </td>
                                <td>
                                    <?php $activeLease = $unit->leases()->first(); ?>
                                    @if ($activeLease)
                                            @if ($activeLease->tenants->isNotEmpty())
                                                @foreach($activeLease->tenants as $lease_tenant)
                                                    <a href="">{{ $lease_tenant->tenant->full_name }}</a>,
                                                @endforeach
                                            @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="float-right">
                                        <div class="quick-menu">
                                            <div class="quick-menu-icon"></div>
                                            <div class="quick-menu-popover">
                                                <ul class="quick-menu-list">
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link" href="">Receive Payment</a>
                                                    </li>
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link" href="{{ route('manager.properties.units.edit', ['id' => $unit->id]) }}">Edit unit</a>
                                                    </li>
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link" href="{{ route('manager.properties.units.show', ['property_id'=>$property->id,'id' => $unit->id]) }}">View unit</a>
                                                    </li>
                                                    <li class="quick-menu-item">
                                                        <a class="quick-menu-link text-danger" href="{{ route('manager.properties.units.delete', ['id' => $unit->id]) }}">Delete unit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
