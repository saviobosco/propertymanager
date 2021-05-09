@extends('user::layouts.master')

@section('page_title') Edit {{ $unit->identifier }} @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="panel-title">Edit Unit "{{ $unit->identifier }} "</h4>
                </div>
                <div class="card-body">
                    {!! Form::model($unit, ['route' => ['manager.properties.units.update',$unit->id]]) !!}

                    <p>What's the unit information ?</p>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {!! Form::label('identifier', 'Unit Number (Required)') !!}
                                {!! Form::text('identifier', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label for="market_rent">Market rent(Optional)</label>
                                    {!! Form::text('market_rent', null, ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                                </div>

                                <div class="col-sm-6 form-group">
                                    <label for="market_rent">size (Optional)</label>
                                    {!! Form::text('size', null, ['class' => 'form-control', 'placeholder' => 'sq. ft.']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p>What is the street address ?</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="street_address">Street Address</label>
                                <div class="mb-1">
                                    <input type="text" name="address_line1" value="{{ $unit->address_line1 }}" class="form-control">
                                </div>
                                <div class="mb-1">
                                    <input type="text" name="address_line2" value="{{ $unit->address_line2 }}" class="form-control">
                                </div>
                                <div class="mb-1">
                                    <input type="text" name="address_line3" value="{{ $unit->address_line3 }}" class="form-control">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <label for="city">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ $unit->city }}">
                                </div>
                                <div class="col-sm-4">
                                    <label for="state_code">State</label>
                                    <select name="state" id="state_code" class="form-control" data-default="{{ $unit->state }}">
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="zip_code">Postal Code</label>
                                    <input type="text" name="zip_code" id="zip_code" value="{{ $unit->zip_code }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                {!! Form::select('country', $countries, $unit->country, ['class' => 'form-control','id' => 'country_code']) !!}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3 class="mb-3">What is the listing information ?</h3>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label for="rooms">Rooms</label>
                                    {!! Form::select('room', $rooms, $unit->room, ['class' => 'form-control']) !!}
                                </div>

                                <div class="col-sm-6">
                                    <label for="baths">Baths</label>
                                    {!! Form::select('bath_room', $bath_rooms, $unit->bath_room, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                {!! Form::textarea('description', $unit->description, ['class' => 'form-control','cols'=>30,'rows'=>4]) !!}
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label for="features">features (Optional)</label>
                                    {!! Form::text('features', $unit->features, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>
                    </div>





                    <div class="form-group">
                        {!! Form::submit('Create unit', ['class' => 'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        var states = {!! $states !!};

        window.onload = function (event) {
            var default_country_code = document.getElementById('country_code').value;

            var country_states = states[default_country_code];
            let default_state_code = document.getElementById('state_code').dataset.default;
            if (default_state_code !== undefined) {
                loadStates(country_states, default_state_code);
            } else {
                loadStates(country_states);
            }
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

        function loadStates(states, default_state)
        {
            let option = document.createElement("OPTION");
            option.setAttribute("value", "");
            let option_name = document.createTextNode("");
            option.appendChild(option_name);
            document.getElementById("state_code").appendChild(option);

            for ( const state_code in states) {
                if (states.hasOwnProperty(state_code)) {
                    let option = document.createElement("OPTION");
                    option.setAttribute("value", state_code);
                    if (default_state !== undefined) {
                        if (state_code === default_state) {
                            option.setAttribute("selected", "selected");
                        }
                    }
                    let option_name = document.createTextNode(states[state_code]);
                    option.appendChild(option_name);
                    document.getElementById("state_code").appendChild(option);
                }
            }
        }

        clearStatesOption()
    </script>

@endsection
