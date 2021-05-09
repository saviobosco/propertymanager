@extends('user::layouts.master')

@section('page_title') Edit Tenant @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h2>Edit tenant </h2>
                    {!! Form::model($tenant, ['route' => ['manager.tenants.update', $tenant->id] ]) !!}
                    <div class="row mt-5">
                        <div class="col-sm-8">
                            <p class="text-bold">Contact information</p>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('first_name', 'First Name') !!}
                                        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('last_name', 'Last Name') !!}
                                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-5">
                                    <label for="phone_numbers">Phone Numbers</label>
                                    <div class="form-group">
                                        <span class="small-caps"> mobile telephone </span>
                                        {!! Form::text('mobile_phone_number', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <span class="small-caps">home telephone</span>
                                        {!! Form::text('home_phone_number', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <span class="small-caps">work telephone</span>
                                        {!! Form::text('work_phone_number', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <span class="small-caps">fax telephone</span>
                                        {!! Form::text('fax_phone_number', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="primary_email_address">Primary email address</label>
                                    {!! Form::text('primary_email_address', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-6">
                                    <label for="alternate_email_address">Alternate email address</label>
                                    {!! Form::text('alternate_email_address', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6">
                            <p class="text-bold">Address *</p>

                            <div class="form-group">
                                <label for="same_as_unit_address">
                                    <input id="same_as_unit_address" type="checkbox" name="same_as_unit_address"> Same as unit address
                                </label>
                            </div>

                            <div>
                                <div class="form-group">
                                    <label for="street_address">Street address</label>
                                    <div class="mb-1">
                                        <input type="text" name="address_line1" class="form-control">
                                    </div>
                                    <div class="mb-1">
                                        <input type="text" name="address_line2" class="form-control">
                                    </div>
                                    <div class="mb-1">
                                        <input type="text" name="address_line3" class="form-control">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <label for="city">City</label>
                                        <input type="text" name="city" class="form-control">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="state">State</label>
                                        {!! Form::select('state_code', [], null, ['class' => 'form-control', 'id' => 'state_code']) !!}
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="zip_code">Zip code</label>
                                        <input type="text" name="zip_code" id="zip_code" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country_code">Country</label>
                                    {!! Form::select('country', $countries, 'NGA', ['class' => 'form-control', 'id' => 'country_code']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <a href=""> <i class="fa fa-plus"></i> Add alternate address</a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 mb-4">
                        <div class="col-sm-8">
                            <div class="card card-outline card-success border-radius-5">
                                <div class="card-header">
                                    <h4 class="card-title">Personal information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <label for="date_of_birth">Date of birth</label>
                                            {{ Form::date('date_of_birth', null, ['class' => 'form-control']) }}
                                        </div>

                                        <div class="col-sm-7">
                                            <label for="nimc_number">Nimc number</label>
                                            {{ Form::text('nin', null, ['class' => 'form-control', 'id' => 'nin']) }}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="comment">Comments</label>
                                            {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 4, 'cols' => 30]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-sm-8">
                            <div class="card card-outline card-success border-radius-5">
                                <div class="card-header">
                                    <h4 class="card-title">Emergency contact</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="text-capitalize" for="emergency_contact_name">Contact name</label>
                                            {!! Form::text('emergency_contact_name', null, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="text-capitalize" for="relationship_to_tenant">relationship to tenant</label>
                                            {!! Form::text('emergency_contact_relationship', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="emergency_contact_email_address">Email</label>
                                            {!! Form::text('emergency_contact_email_address', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="emergency_contact_phone_number">Phone</label>
                                            {!! Form::text('emergency_contact_phone_number', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Update tenant record', ['class' => 'btn btn-primary']) !!}
                        <a class="text-bold ml-4" href="">Cancel</a>
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
