@extends('user::layouts.master')

@section('page_title') Add New Property @stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Property</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'user.properties.create']) !!}

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group required">
                                    <h4>What is the property type?</h4>
                                    <label for="property_type">Property type</label>
                                    <select name="property_type" id="property_type" class="form-control">
                                        <option value=""> </option>
                                        @if (isset($property_types) && !empty($property_types))
                                            @foreach($property_types as $category => $types)
                                                <optgroup label="{{$category}}">
                                                    @foreach($types as $type)
                                                        <option value="{{ $type['id'] }}"> {{ $type['name'] }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <h4>What is the street address?</h4>
                                <div class="form-group required">
                                    {!! Form::label('address', 'street address') !!}
                                    {!! Form::text('address_line1', null, ['class' => 'form-control mb-1']) !!}
                                    {!! Form::text('address_line2', null, ['class' => 'form-control mb-1']) !!}
                                    {!! Form::text('address_line3', null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4 required">
                                        {!! Form::label('city', 'City') !!}
                                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="col-sm-4 required">
                                        {!! Form::label('state', 'State') !!}
                                        <select name="state" id="state_code" class="form-control">
                                        </select>
{{--
                                        {!! Form::text('state', null, ['class' => 'form-control']) !!}
--}}
                                    </div>

                                    <div class="col-sm-4 required">
                                        {!! Form::label('zip_code', 'Postal Code') !!}
                                        {!! Form::text('zip_code', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group required">
                                    {!! Form::label('country', 'Country') !!}
                                    {!! Form::select('country', $countries , "NGA", [ 'id' => 'country_code', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="property-owners mb-3">
                            <h4> Who is the property owner?</h4>
                            <p> This information will be used to prepare owner draws and 1099s</p>
                            <a href=""> <i class="fa fa-plus"></i> Add rental owner </a>
                        </div>

                        <hr>

                        <div class="property-other-details">
                            <h4> What is the property primary bank account? </h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <div class="col-sm-6 required">
                                            <label for="">Operating Account</label>
                                            <select class="form-control" name="operating_account" id="">
                                                <option value="">Rent Account</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 required">
                                            <label for="property_reserve">Property Reserve</label>
                                            <input id="property_reserve" type="text" name="property_reserve" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>Who will be the primary manager of this property?</h4>

                            <p>If the staff member has not yet been added as a user in your account, they can be added to the account, then as the manager later through the property's summary details.</p>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <select class="form-control" name="primary_manager" id="">
                                        <option value=""></option>
                                    </select>
                                </div>

                            </div>
                        </div>



                        <div class="form-group">
                            {!! Form::submit('Create property', ['class' => 'btn btn-primary']) !!}

                            <button class="btn btn-link"> Cancel </button>
                        </div>

                        {!! Form::close() !!}

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->


    <script>
        var states = {!! $states !!};

        window.onload = function (event) {
            var default_country_code = document.getElementById('country_code').value;

            var country_states = states[default_country_code];
            loadStates(country_states);
        }

        document.getElementById("country_code").addEventListener("change", function(event) {
            let value = event.target.value;
            if (value) {
                clearStatesOption();
                loadStates(states[value]);
            } else {
                clearStatesOption();
            }
        });

        function clearStatesOption()
        {
            let options = document.querySelectorAll("#state_code option");
            options = Array.prototype.slice.call(options);
            options.forEach(function(option){
                option.remove();
            });
        }

        function loadStates(states)
        {
            // create an empty option
            let option = document.createElement("OPTION");
            option.setAttribute("value", "");
            let option_name = document.createTextNode("");
            option.appendChild(option_name);
            document.getElementById("state_code").appendChild(option);

            for ( const state_code in states) {
                if (states.hasOwnProperty(state_code)) {
                    let option = document.createElement("OPTION");
                    option.setAttribute("value", state_code);
                    let option_name = document.createTextNode(states[state_code]);
                    option.appendChild(option_name);
                    document.getElementById("state_code").appendChild(option);
                }
            }
        }

        clearStatesOption()
    </script>
@endsection
