@extends('user::layouts.master')

@section('page_title') Edit rental owner @stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit rental owner</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::model($propertyOwner, ['route' => ['user.property_owners.update', $propertyOwner->id]]) !!}

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name">Name</label>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
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
                                                <input type="checkbox" id="company" {{ ($propertyOwner->company_name) ? 'checked' : '' }}>
                                                Company
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <label for="date_of_birth">Date of birth</label>
                                        {!! Form::date('date_of_birth', null, ['class' => 'form-control']) !!}
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
                                        {!! Form::date('agreement_start_date', $propertyOwner->agreement_start_date->format('Y-m-d'), ['class' => 'form-control', 'id' => 'agreement_start_date']) !!}
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="agreement_end_date">End Date</label>
                                        {!! Form::date('agreement_end_date',($propertyOwner->agreement_end_date) ? $propertyOwner->agreement_end_date->format('Y-m-d') : '', ['class' => 'form-control', 'id' => 'agreement_end_date']) !!}
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
                                        {!! Form::text('address_line1', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="mb-1">
                                        {!! Form::text('address_line2', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="mb-1">
                                        {!! Form::text('address_line3', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-sm-4">
                                        <label for="city">City</label>
                                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="state">State</label>
                                        <select name="state" id="state_code" class="form-control">
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="zip_code">Zip code</label>
                                        {!! Form::text('zip_code', null, ['class' => 'form-control', 'id' => 'zip_code']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="country_code">Country</label>
                                    {!! Form::select('country', $countries, $propertyOwner->country, ['class' => 'form-control', 'id' => 'country_code']) !!}
                                </div>

                                <div class="form-group">
                                    <label for="comments">Comment</label>
                                    {!! Form::textarea('comment', null, ['id' => 'comment', 'rows' => 4, 'cols' => 30, 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <h2>Rental property owned</h2>
                        <table class="table" id="rental-property-table">
                            <tr>
                                <th>Property Name</th>
                                <th>Percentage Owned(%)</th>
                                <th>
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-sm">
                                        Add Property
                                    </button>
                                </th>
                            </tr>
                            @if ($owned_properties->isNotEmpty())
                                @foreach($owned_properties as $owned_property)
                                    <tr>
                                        <td>{{ $owned_property->property->address }}</td>
                                        <td>
                                            <div class="form-group">
                                                {!! Form::hidden('owned_property['.$owned_property->id.'][id]', $owned_property->id) !!}
                                                {!! Form::text('owned_property['.$owned_property->id.'][ownership_percentage]',
                                                $owned_property->ownership_percentage,
                                                 ['class' => 'form-control', 'style' => 'width: 40%;']) !!}
                                            </div>
                                        </td>
                                        <td>

<!--                                            <a onclick="event.preventDefault(); deleteOwnedProperty(event.target.dataset.id)" href="#" class="btn btn-danger btn-sm" data-id="{{ $owned_property->id }}">Delete</a>
                                            -->
                                            <a href="#" class="btn btn-danger btn-sm" data-id="{{ $owned_property->id }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
<!--                            <tr>
                                <td>%property_address%</td>
                                <td>
                                    <div class="form-group">
                                        <input type="hidden" name="new_property[%property_id%][id]" value="%property_id%">
                                        <input type="text" class="form-control" name="new_property[%property_id%][ownership_percentage]" style="width:40%;">
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm" data-id="%property_id%" href="#">delete</a>
                                </td>
                            </tr>-->
                        </table>

                        <div class="form-group">
                            {!! Form::submit('Update owner', ['class' => 'btn btn-success']) !!}

                            <button class="btn btn-link btn-sm"> Cancel </button>
                        </div>

                        {!! Form::close() !!}

                        <form id="deleteOwnedProperty" action="" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Property to {{ $propertyOwner->full_name }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="property_id">Properties</label>
                        <select name="property_id" id="attach-property-property-id" class="form-control">
                            <option value=""></option>
                            @if ($properties->isNotEmpty())
                                @foreach($properties as $property_id => $property_name)
                                    <option value="{{ $property_id }}">{{ $property_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="attach-property-to-owner">Add Property</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection



@section('footer-script')
    <script>
        var states = {!! $states !!};

        var selected_state = "{!! $propertyOwner->state !!}"

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
                    if (state_code === selected_state) {
                        option.setAttribute("selected", "");
                    }
                    let option_name = document.createTextNode(states[state_code]);
                    option.appendChild(option_name);
                    document.getElementById("state_code").appendChild(option);
                }
            }
        }

        function deleteOwnedProperty(id) {
            if (confirm('Are you sure you want to delete this rental property?')) {
                alert('Logic under implementation.');
                /*var delete_owned_property_form = document.getElementById("deleteOwnedProperty");
                delete_owned_property_form.action = window.origin + "/" + "/property-owners/rental-property/delete/" + id;
                delete_owned_property_form.submit();*/
            }
        }

        (function(){
            var html, property_id, property_text, properties_select_el, newHtml;
            document.getElementById("attach-property-to-owner").addEventListener("click", function(){
                properties_select_el = document.getElementById("attach-property-property-id");
                property_text = properties_select_el.options[properties_select_el.selectedIndex].text;

                var property_id = document.getElementById("attach-property-property-id").value;
                if (property_id !== undefined && property_id !== "") {
                    html = '<tr>'+
                        '<td> %property_address% </td>'+
                        '<td>'+
                        '<div class="form-group">' +
                        '<input type="hidden" name="new_property[%property_id%][id]" value="%property_id%">' +
                        '<input type="text" class="form-control" name="new_property[%property_id%][ownership_percentage]" style="width:40%;">' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<a class="btn btn-danger btn-sm" href="#">delete</a>' +
                        '</td>' +
                        '</tr>';

                    newHtml = html.replace('%property_address%', property_text);
                    newHtml = newHtml.replace('%property_id%', property_id);
                    newHtml = newHtml.replace('%property_id%', property_id);
                    newHtml = newHtml.replace('%property_id%', property_id);

                    document.getElementById('rental-property-table')
                        .insertAdjacentHTML("beforeend", newHtml);

                    $('#modal-sm').modal('hide');
                } else {
                    alert("No property selected!");
                }
            });

            // deleting the a property
            $('#rental-property-table').on("click", ".btn-danger", function(event){
                event.preventDefault();
                if (confirm('Are you sure?')) {
                    var id = event.currentTarget.dataset.id;
                    if (id !== undefined) {
                        // make a post request to delete.
                        $.post(window.location.origin + '/manager/property-owners-properties/delete/' + id,
                            {'_method':'DELETE'},
                            function (response) {
                            // give feedback after deletion.
                        });
                    }
                    event.currentTarget.parentElement.parentElement.remove();
                }
            });

        })();

        clearStatesOption();
    </script>

@endsection
