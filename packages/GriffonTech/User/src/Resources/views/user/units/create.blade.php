@extends('user::layouts.master')

@section('title') Add New Property @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Add New Unit</h4>
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'user.units.create']) !!}


                    <div class="form-group">
                        {!! Form::label('property_id', 'Property') !!}
                        {!! Form::select('property_id', $propertySelectValues , null, ['class' => 'form-control', 'id' => 'property_id']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('property_unit_type_id', 'Property Unit Types') !!}
                        {!! Form::select('property_unit_type_id', [] , null, ['class' => 'form-control', 'id' => 'property_unit_type_id']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('identifier', 'Identifier') !!}
                        {!! Form::text('identifier', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('lease_starts', 'Lease Starts') !!}
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    {!! Form::text('lease_starts', null, [
                                        'class' => 'form-control datepicker-default',
                                         'placeholder' => 'Lease Start Date']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::label('lease_ends', 'Lease Ends') !!}
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    {!! Form::text('lease_ends', null, [
                                    'class' => 'form-control datepicker-default',
                                    'placeholder' => 'Lease End Date']) !!}
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="form-group">
                        {!! Form::label('is_occupied', 'Is Occupied') !!}
                        <input type="hidden" name="is_occupied" value="0">
                        <input type="checkbox" id="switcher_checkbox_1" name="is_occupied" value="1">
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
        $('.datepicker-default').datepicker({
            todayHighlight: true,
            format: "yyyy-mm-dd"
        });

        $('#property_id').change(function(event) {
            var property_id = event.target.value;
            if (property_id) {
                $('#property_unit_type_id').load(document.location.origin + "/user/properties/get_property_unit_types/"+property_id);
            }
        });
    </script>
@stop
