@extends('user::layouts.master')

@section('title') Edit Tenant @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Edit Tenant</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model($tenant, ['route' => ['user.tenants.edit', $tenant->id] ]) !!}

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="img-thumbnail" style="width: 150px; height: 150px;">

                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="form-group">
                                {!! Form::label('unit_id', 'Unit') !!}
                                <select name="unit_id" id="unit_id" class="form-control" disabled>
                                    <option value="{{ $tenant->unit->id }}">{{ $tenant->unit->identifier }}</option>
                                </select>
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

                    <div class="form-group">
                        {!! Form::label('note', 'Note About Tenant') !!}
                        {!! Form::textarea('note', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="row m-t-20">
                        <div class="col-sm-4">
                            {!! Form::label('was_evicted', 'Was Evicted') !!}
                            {!! Form::checkbox('was_evicted', null, false) !!}
                        </div>
                        <div class="col-sm-8">
                            {!! Form::label('reason_for_eviction', 'Reason For Eviction') !!}
                            {!! Form::textarea('reason_for_eviction', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('active', 'Tenant Active') !!}
                        <input type="hidden" name="active" value="0">
                        <input type="checkbox" name="active" value="1" {{ ($tenant->active) ? 'checked' : '' }}>
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
