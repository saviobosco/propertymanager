@extends('user::layouts.master')

@section('page_title') Add new rental owner @stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add rental owner</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route' => 'user.property_owners.store']) !!}

                        {!! Form::hidden('property_id', $property_id) !!}
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name">Name</label>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="text" name="first_name" class="form-control" placeholder="First name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" class="form-control" placeholder="Last name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="company_name">Company Name</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="company">
                                                <input type="checkbox" id="company">
                                                Company
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <label for="date_of_birth">Date of birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2> Management agreement</h2>
                        <hr>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="row form-group">
                                    <div class="col-sm-6">
                                        <label for="agreement_start_date">Start Date</label>
                                        <input type="date" class="form-control" name="agreement_start_date" id="start_date">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="agreement_end_date">End Date</label>
                                        <input type="date" class="form-control" name="agreement_end_date" id="end_date">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2>Contact information</h2>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <div class="col-sm-6">
                                        <label for="primary_email_address">Primary email address</label>
                                        {!! Form::text('primary_email_address', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="alternate_email_address">Alternate email address</label>
                                        {!! Form::text('alternate_email_address', null, ['class' => 'form-control']) !!}
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
                                        <select name="state" id="state_code" class="form-control">
                                        </select>
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

                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    <textarea name="comments" id="comments" cols="30" rows="4" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <h2>Rental property owned</h2>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label for="percentage_ownership">Percentage Ownership (%)</label>
                                    <input type="text" class="form-control" name="ownership_percentage">
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            {!! Form::submit('Create owner', ['class' => 'btn btn-success']) !!}

                            <button class="btn btn-link btn-sm"> Cancel </button>
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

        clearStatesOption();
    </script>
@endsection
