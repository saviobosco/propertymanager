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
                        <select name="property_type" id="property_type" class="form-control">

                            <option value=""></option>
                            @foreach($property_types as $key => $property_type)
                                <option value="{{ $key }}"> {{ $property_type['name'] }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Property Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('address', 'Address') !!}
                        {!! Form::text('address', null, ['rows' => 4,  'class' => 'form-control']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('country', 'Country') !!}
                        {!! Form::text('country', null, [ 'class' => 'form-control']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA74luMgs-grl9Ve0gU8sJS8PS_y3Ggeqc&libraries=places"></script>

    <script>
        var geocoder = new google.maps.Geocoder();
        var address = "new york";

        geocoder.geocode( { 'address': address}, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.latitude;
                var longitude = results[0].geometry.location.longitude;
                alert(latitude);
            }
        });
    </script>


@endsection
