@extends('user::layouts.master')

@section('title') Edit Amenity @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Edit Amenity</h4>
                </div>
                <div class="panel-body">
                    {!! Form::model( $amenity, ['route' => ['amenities.edit', $amenity->id] ]) !!}

                    <div class="form-group">
                        {!! Form::label('type', 'Amenity Type') !!}
                        {!! Form::text('type', null, ['class' => 'form-control']) !!}
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
