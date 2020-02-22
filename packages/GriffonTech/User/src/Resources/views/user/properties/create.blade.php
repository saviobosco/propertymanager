@extends('user::layouts.master')

@section('title') Add New Property @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Add New Property</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'user.properties.create']) !!}

                    <div class="form-group">
                        {!! Form::label('property_type', 'Property Type') !!}
                        {!! Form::select('property_type', $propertyTypes, null,[ 'class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Property Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', 'Address') !!}
                        {!! Form::textarea('address', null, ['rows' => 4,  'class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('city', 'City') !!}
                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('state', 'State') !!}
                        {!! Form::text('state', null, [ 'class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('country', 'Country') !!}
                        {!! Form::text('country', null, [ 'class' => 'form-control']) !!}
                    </div>

                    <h4> LandLord Information </h4>
                    <div class="form-group">
                        {!! Form::label('landlord_name', 'LandLord Name') !!}
                        {!! Form::text('landlord_name', null, [ 'class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('landlord_address', 'landlord Address') !!}
                        {!! Form::text('landlord_address', null, [ 'class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('landlord_bank_details', 'LandLord bank Details') !!}
                        {!! Form::textarea('landlord_bank_details', null, ['rows' => 4, 'class' => 'form-control']) !!}
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
