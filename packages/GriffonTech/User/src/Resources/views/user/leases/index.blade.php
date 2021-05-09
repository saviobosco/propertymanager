@extends('user::layouts.master')

@section('page_title')
    Leasing
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="clearfix mb-5">
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('manager.properties.leases.create') }}">Add Lease draft</a>
                </div>
                <h2> Leasing</h2>
            </div>


            <div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Lease</th>
                        <th>Status</th>
                        <th>Agent</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Rent</th>
                        <th class="no-left-border"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($leases))
                        @foreach($leases as $lease)
                            <tr>
                                <td>
                                    <a href="">{{ $lease->property->address }} ({{ $lease->property->type_name }}) - {{ $lease->unit->identifier }}
                                        |
                                        @if ($lease->tenants->isNotEmpty())
                                            @foreach($lease->tenants as $lease_tenant)
                                                {{ $lease_tenant->tenant->full_name }},
                                            @endforeach
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <p> DRAFT</p>
                                </td>
                                <td></td>
                                <td> <p> {{ $lease->start_date }} </p> </td>
                                <td> <p> {{ $lease->end_date }} </p> </td>
                                <td>
                                    &#8358;{{ number_format($lease->rents->sum('amount'), 2) }}
                                </td>
                                <td class="with-btn no-left-border" nowrap>
                                    <div class="quick-menu">
                                        <div class="quick-menu-icon"></div>
                                        <div class="quick-menu-popover">
                                            <ul class="quick-menu-list">
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="{{ route('manager.properties.leases.edit', $lease->id) }}">Edit lease</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="{{ route('manager.properties.leases.tenants', $lease->id) }}">Tenants</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">Lease Summary</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link text-danger"
                                                       {!! ((int)$lease->signature_status === 1) ? 'style="cursor: not-allowed; opacity: .5;"' : '' !!}
                                                       href="#" onclick="event.preventDefault(); if (confirm('Are you sure?')){ document.getElementById('delete-lease-{{$lease->id}}').submit(); }" >Delete lease</a>
                                                    <form action="{{ route('manager.properties.leases.delete', $lease->id) }}" method="POST" id="delete-lease-{{$lease->id}}">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>
                                                </li>
                                            </ul>
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
