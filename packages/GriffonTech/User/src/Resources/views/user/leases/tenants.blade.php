@extends('user::layouts.master')

@section('page_title')
    Lease tenants - {{ $lease->property->address }} ({{ $lease->property->type_name }}) - {{ $lease->unit->identifier }}
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="clearfix mb-5">
                <div class="float-right">
                    <a class="btn btn-success" href="javascript:;" data-toggle="modal" data-target="#modal-sm">Attach Tenant</a>
                </div>
                <h5> Lease Tenants - {{ $lease->property->address }} ({{ $lease->property->type_name }}) - {{ $lease->unit->identifier }}</h5>
                <a href="{{ route('manager.properties.leases.index') }}">All leases</a>
            </div>

            <div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Email</th>
<!--                    <th>Resident center status</th>
                        <th>Text message status</th>-->

                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($lease->tenants) && $lease->tenants->isNotEmpty())
                        @foreach($lease->tenants as $lease_tenant)
                            <tr>
                                <td class="border-right-0">
                                    <a href=""> {{ $lease_tenant->tenant->full_name }} </a> <br>
                                    <span>Tenant</span>
                                </td>
                                <td class="border-left-0"></td>
                                <td>
                                    <div class="form-element form-element--icon icon-tel icon-tel--home"> {{ $lease_tenant->tenant->home_phone_number }} </div>
                                    <div class="form-element form-element--icon icon-tel icon-tel--work"> {{ $lease_tenant->tenant->work_phone_number }}</div>
                                    <div class="form-element form-element--icon icon-tel icon-tel--mobile"> {{ $lease_tenant->tenant->mobile_phone_number }}</div>
                                    <div class="form-element form-element--icon icon-tel icon-tel--fax"> {{ $lease_tenant->tenant->fax_phone_number }} </div>
                                </td>
                                <td>
                                    <span><a href="">{{ $lease_tenant->tenant->primary_email_address }}</a></span> <br>
                                    <span><a href="">{{ $lease_tenant->tenant->alternate_email_address }}</a></span>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm" href="#"
                                       onclick="event.preventDefault();
                                        if (confirm('Are you sure you want to detach tenant: {{ $lease_tenant->tenant->full_name }} ?')) { document.getElementById('detach-tenant-{{$lease_tenant->id}}').submit()}">Detach</a>

                                    <form action="{{ route('manager.properties.leases.tenants.detach', $lease_tenant->id) }}"
                                          method="POST"
                                          id="detach-tenant-{{ $lease_tenant->id }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Tenant </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['manager.properties.leases.tenants.add', $lease->id] ]) !!}
                        <div class="form-group">
                            <label for="tenant">Tenants (You can select multiple tenants)</label>
                            {!! Form::select('tenants_id[]', $tenants, null, ['class' => 'form-control', 'multiple' => true]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Attach Tenant',['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
