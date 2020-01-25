@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Add Tenant
                    </div>

                    <div class="card-body">

                        {!! Form::open(['route' => 'tenants.create']) !!}

                        <div class="form-group">
                            {!! Form::label('property_id', 'Property Name') !!}
                            {!! Form::select('property_id', $properties, null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('first_name', 'First Name') !!}
                            {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('last_name', 'Last Name') !!}
                            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('phone_number', 'Phone Number') !!}
                            {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('lease_starts', 'Lease Start') !!}
                            {!! Form::date('lease_starts', null, ['class' => 'form-control' ]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('lease_ends', 'Lease End') !!}
                            {!! Form::date('lease_ends', null, ['class' => 'form-control' ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('submit', ['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
