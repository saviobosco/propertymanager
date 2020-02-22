@extends('user::layouts.master')

@section('title') Add New Tenant @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Add New Tenant</h4>
                </div>
                <div class="panel-body">
                    @if (request()->route('id'))
                    {!! Form::open(['route' => ['user.units.tenants.create', $unit->id] ]) !!}
                    @else
                        {!! Form::open(['route' => 'user.tenants.create']) !!}
                    @endif
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="img-thumbnail" style="width: 150px; height: 150px;">

                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="form-group">
                                @if(request()->route('id'))
                                {!! Form::label('unit_id', 'Unit') !!}
                                <select name="unit_id" id="unit_id" class="form-control">
                                    <option value="{{ $unit->id }}">{{ $unit->identifier }}</option>
                                </select>
                                @else
                                {!! Form::select('unit_id', $units, null, [ 'id' => 'change-unit', 'class' => 'form-control']) !!}
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('first_name', 'First Name') !!}
                                        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('middle_name', 'Middle Name') !!}
                                        {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('last_name', 'Last Name') !!}
                                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('occupation', 'Occupation') !!}
                                {!! Form::text('occupation', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('phone_number', 'Phone Number') !!}
                                {!! Form::text('phone_number', null, [ 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('email_address', 'Email Address') !!}
                                {!! Form::email('email_address', null, [ 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('state_of_origin', 'State of Origin') !!}
                                {!! Form::text('state_of_origin', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('l_g_a', 'L.G.A') !!}
                                {!! Form::text('l_g_a', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('hometown', 'HomeTown') !!}
                                {!! Form::text('hometown', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row m-b-20">
                        <div class="col-sm-6">
                            {!! Form::label('lease_starts', 'Lease Starts') !!}
                            {!! Form::text('lease_starts', @$unit->lease_starts, [ 'readonly' => true,'id' => 'lease_starts', 'class' => 'form-control']) !!}

                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('lease_ends', 'Lease Ends') !!}
                            {!! Form::text('lease_ends', @$unit->lease_ends, [ 'readonly' => true, 'id' => 'lease_ends', 'class' => 'form-control']) !!}

                        </div>
                    </div>


                    <div class="form-group">
                        {!! Form::label('note', 'Note About Tenant') !!}
                        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('add_another_tenant', 'Add another Tenant') !!}
                        {!! Form::checkbox('add_another_tenant', null, false) !!}

                    </div>

                    <div class="form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        $('#change-unit').change(function(event) {
            // get the unit lease details
            var value = event.target.value;
            if (value) {
                $.getJSON(document.location.origin + '/user/units/show/'+ value, {}, function (data, statusText, jqXHR) {
                    if (data.data !== undefined) {
                        $('#lease_starts').val(data.data.lease_starts);
                        $('#lease_ends').val(data.data.lease_ends);
                    }
                });
            } else {
                $('#lease_starts').val('');
                $('#lease_ends').val('');
            }
        });
    </script>
@stop
