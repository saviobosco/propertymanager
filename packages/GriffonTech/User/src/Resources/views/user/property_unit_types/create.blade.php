@extends('user::layouts.master')

@section('title') Add Property Unit Type @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Add New Property Unit Type</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => ['user.property_unit_types.create', $property_id] ]) !!}

                    <div class="form-group">
                        {!! Form::label('unit_type_id', 'Unit Type') !!}
                        {!! Form::select('unit_type_id', $unitTypes, null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('amount', 'Rent Amount') !!}
                        {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                    </div>

                    <div>
                        <h5> Amenities </h5>
                        @if (count($amenities))
                            @foreach($amenities as $id => $amenity)
                                <div>
                                    <label for="{{ $id }}">
                                        <input id="{{ $id }}" type="checkbox" name="amenities[]" value="{{ $id }}"> {{ $amenity }}
                                    </label>
                                </div>
                            @endforeach
                        @endif
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
