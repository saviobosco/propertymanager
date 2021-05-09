@extends('user::layouts.master')

@section('page_title') Add draft lease @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add draft lease </h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'manager.properties.leases.store']) !!}

                    <div class="row">
                        <div class="col-sm-4">
                            <h3>Signature Status </h3>
                            <div class="form-group row mt-4">
                                <div class="col-sm-6">
                                    <label for="signature_signed">
                                        <input type="checkbox" id="signature_signed" name="signature_status" value="1"> Signed
                                    </label>
                                </div>
                               <div class="col-sm-6">
                                   <label for="signature_unsigned">
                                       <input type="checkbox" id="signature_unsigned" name="signature_status" value="0" checked> Unsigned
                                   </label>
                               </div>
                            </div>
                        </div>
                    </div>


                    <h3>Lease Details</h3>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="property">Property (Required)</label>
                                    {!! Form::select('property_id', $properties, null, ['class' => 'form-control', 'id' => 'property_id']) !!}
                                </div>
                                <div class="col-sm-6">
                                    <label for="property"> Unit </label>
                                    {!! Form::select('unit_id', [], null, ['class' => 'form-control', 'id' => 'unit_id']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="lease_type">Lease Type*</label>
                            {!! Form::select('lease_type', [
                                '1' => 'Fixed',
                                '2' => 'Fixed w/rollover',
                                '3' => 'At-will (month-to-month)'
                            ], null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-2">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" class="form-control" id="start_date">
                        </div>
                        <div class="col-sm-2">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" class="form-control" id="end_date">
                        </div>
                        <div class="col-sm-3">
                            <label for="leasing_agent_id">Leasing Agent</label>
                            <select name="leasing_agent" id="leasing_agent_id" class="form-control">
                            </select>
                        </div>
                    </div>
                    <hr>

                    <div class="mt-5 mb-5">
                        <div class="form-group">
                            <h5> Tenants and cosigners</h5>
                            <a class="mt-4" href="#" data-toggle="modal" data-target="#modal-sm"> <i class="fa fa-plus"></i> Add tenants or cosigners</a>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-5 mb-5">
                        <h3>Resident center welcome email</h3>
                        <input type="hidden" name="send_resident_welcome_email" value="0">
                        <label for="send_resident_welcome_email">
                            <input type="checkbox" name="send_resident_welcome_email" id="send_resident_welcome_email" value="1">
                        </label>
                        <div>
                            We'll send a welcome email to anyone without Resident Center access. Once they sign in, they can make online payments, view important documents, submit requests, and more
                        </div>
                    </div>
                    <hr>
                    <div class="mt-5 mb-5">
                        <h3 class="mb-4">Rent <small>(optional)</small></h3>
                        <div class="row">
                            <div class="col-sm-3">
                                <label class="text-capitalize" for="rent_cycle">Rent cycle</label>
                                <select name="rent_cycle" id="rent_cycle" class="form-control">
                                    <option value="1">Daily</option>
                                    <option value="2">Weekly</option>
                                    <option value="3">Every two weeks</option>
                                    <option value="4">Monthly</option>
                                    <option value="5">Every two months</option>
                                    <option value="6">Quarterly</option>
                                    <option value="7">Every six months</option>
                                    <option value="8" selected="selected">Yearly</option>
                                </select>
                            </div>
                        </div>

                        <div id="rent-charges-container">
                            <div class="card form-group mt-3 card-detail rent-charge">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="rent_amount">Amount</label>
                                            <input type="text" name="rent[0][amount]" class="form-control" id="rent_amount" placeholder="&#8358;0.00">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="rent_account_id">Account*</label>
                                            <select name="rent_account_id" id="rent[0][account_id]" class="form-control"></select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="next_due_date">Next due date*</label>
                                            <input type="date" class="form-control" name="rent[0][next_due_date]" id="next_due_date">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 clearfix">
                                            <label for="memo">Memo</label>
                                            <input id="memo" type="text" name="rent[0][memo]" class="form-control" placeholder="If blank, it will show 'Rent'">
                                            <small class="float-right">100</small>
                                        </div>
                                    </div>
                                    <a class="delete-rent-charge" style="position: absolute; right: 2%; top: 50%; display: none"> <i class="fa fa-times"></i></a>
                                </div>
                            </div>

                            <a class="mt-3" href="#" id="split-rent-charges"><i class="fa fa-plus"></i> Split rent charge</a>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-5 mb-5">
                        <h3>Security deposit <small>(optional)</small></h3>
                        <div class="card">
                            <div class="card-body card-detail">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="security_deposit_due_date">Due Date*</label>
                                        <input type="date" id="security_deposit_due_date" class="form-control">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="security_deposit_amount">Amount</label>
                                        <input type="text" id="security_deposit_amount" class="form-control" placeholder="&#8358;0.00">
                                    </div>
                                    <div class="col-sm-6 mt-4">
                                        <p>
                                            Don't forget to record the payment once you have collected the deposit.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="mt-5 mb-5">
                        <h3 class="mt-3 mb-4">Charges</h3>
                        <div id="lease-charges-container">
                            <div class="card card-detail form-group lease-charge">
                                <div class="card-body">
                                    <h4>Recurring</h4>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="account_id">Account*</label>
                                            <select name="charges[0][account_id]" id="account_id" class="form-control">
                                            </select>
                                        </div>

                                        <div class="col-sm-2">
                                            <label for="charge_next_due_date">Next due date*</label>
                                            <input type="date" name="charges[0][next_due_date]" class="form-control" id="charge_next_due_date">
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="charge_amount">Amount*</label>
                                            <input type="text" name="charges[0][amount]" class="form-control" id="charge_amount" placeholder="&#8358;0.00">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="charge_memo">MEMO</label>
                                            <input type="text" name="charges[0][memo]" class="form-control" id="charge_memo">
                                            <small class="float-right">100</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="frequency">Frequency*</label>
                                            <select name="charges[0][charge_frequency]" id="frequency" class="form-control">
                                                <option value="monthly">Daily</option>
                                                <option value="monthly">Weekly</option>
                                                <option value="monthly">Every two weeks</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="monthly">Every two months</option>
                                                <option value="monthly">Quarterly</option>
                                                <option value="monthly">Every six months</option>
                                                <option value="monthly">Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                    <a class="delete-lease-charge" style="position: absolute; right: 2%; top: 15%; display: none;"> <i class="fa fa-times"></i></a>
                                </div>
                            </div>
                        </div>

                        <a href="javascript:;" id="add-recurring-charge"><i class="fa fa-plus"></i>Add recurring charge</a> |
                        <a href="javascript:;" id="add-one-time-charge"><i class="fa fa-plus"></i>Add one-time charge</a>
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Save draft lease', ['class' => 'btn btn-success']) !!}
                        <a class="ml-3 text-bold text-black" href="">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Tenant </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['manager.tenants.store'] ]) !!}
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
                                    {!! Form::text('primary_email_address', null, ['class' => 'form-control']) !!}
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

{{--                            <div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="street_address">Street address</label>--}}
{{--                                    <div class="mb-1">--}}
{{--                                        <input type="text" name="address_line1" class="form-control">--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-1">--}}
{{--                                        <input type="text" name="address_line2" class="form-control">--}}
{{--                                    </div>--}}
{{--                                    <div class="mb-1">--}}
{{--                                        <input type="text" name="address_line3" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row form-group">--}}
{{--                                    <div class="col-sm-4">--}}
{{--                                        <label for="city">City</label>--}}
{{--                                        <input type="text" name="city" class="form-control">--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-4">--}}
{{--                                        <label for="state">State</label>--}}
{{--                                        {!! Form::select('state_code', [], null, ['class' => 'form-control', 'id' => 'state_code']) !!}--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-4">--}}
{{--                                        <label for="zip_code">Zip code</label>--}}
{{--                                        <input type="text" name="zip_code" id="zip_code" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group">--}}
{{--                                    <label for="country_code">Country</label>--}}
{{--                                    {!! Form::select('country', [], 'NGA', ['class' => 'form-control', 'id' => 'country_code']) !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <a href=""> <i class="fa fa-plus"></i> Add alternate address</a>--}}
{{--                            </div>--}}
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
                                            <input id="date_of_birth" type="date" name="date_of_birth" class="form-control">
                                        </div>

                                        <div class="col-sm-7">
                                            <label for="nimc_number">Nimc number</label>
                                            <input type="text" class="form-control" name="nimc_number" id="nimc_number">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label for="comment">Comments</label>
                                            <textarea id="comment" name="comment" cols="30" rows="4" class="form-control"></textarea>
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
                        {!! Form::submit('Add tenant', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        (function() {
            $('#property_id').on('change', function(event) {
                var property_id = (event.target.value !== undefined && event.target.value !== "") ? event.target.value : false;
                if (property_id) {
                    // load the units for the properties
                    $.get(window.origin + '/manager/properties/'+ property_id +'/units/index', null, function(response_data) {

                        let options = document.querySelectorAll("#unit_id option");
                        options = Array.prototype.slice.call(options);
                        options.forEach(function(option){
                            option.remove();
                        });

                        // load the data to options
                        for ( const unit in response_data) {
                            if (response_data.hasOwnProperty(unit)) {
                                let option = document.createElement("OPTION");
                                option.setAttribute("value", response_data[unit]['id']);
                                let option_name = document.createTextNode(response_data[unit]['identifier']);
                                option.appendChild(option_name);
                                document.getElementById("unit_id").appendChild(option);
                            }
                        }
                    });
                } else {
                    let options = document.querySelectorAll("#unit_id option");
                    options = Array.prototype.slice.call(options);
                    options.forEach(function(option){
                        option.remove();
                    });
                }
            });
            // on property change select the units for the lease.




            var rent_charge_count = 1;
            $('#split-rent-charges').click(function (event){
                event.preventDefault();
                var rent_charge_template = `<div class="card form-group mt-3 card-detail rent-charge">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="rent_amount">Amount</label>
                                        <input type="text" name="rent[%index%][amount]" class="form-control" id="rent_amount" placeholder="&#8358;0.00">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="rent_account_id">Account*</label>
                                        <select name="rent_account_id" id="rent[%index%][account_id]" class="form-control"></select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="next_due_date">Next due date*</label>
                                        <input type="date" class="form-control" name="rent[%index%][next_due_date]" id="next_due_date">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 clearfix">
                                        <label for="memo">Memo</label>
                                        <input id="memo" type="text" name="rent[%index%][memo]" class="form-control" placeholder="If blank, it will show 'Rent'">
                                        <small class="float-right">100</small>
                                    </div>
                                </div>
                                <a class="delete-rent-charge" style="position: absolute; right: 2%; top: 50%; display: none"> <i class="fa fa-times"></i></a>
                            </div>
                        </div>`;

                rent_charge_template = rent_charge_template.replace("%index%", rent_charge_count);
                rent_charge_template = rent_charge_template.replace("%index%", rent_charge_count);
                rent_charge_template = rent_charge_template.replace("%index%", rent_charge_count);
                rent_charge_template = rent_charge_template.replace("%index%", rent_charge_count);

                event.target.insertAdjacentHTML("beforebegin", rent_charge_template);

                // increment the count
                rent_charge_count++;

                // count all rent charges displayed
                // if more than 1 display the delete sign beside them
                checkIfRentChargesGreaterThanOne();
            });

            // on click to delete rent charges.
            $("#rent-charges-container").on("click", ".delete-rent-charge", function(event) {
                event.currentTarget.parentElement.parentElement.remove();
                checkIfRentChargesGreaterThanOne();
            });


            function checkIfRentChargesGreaterThanOne() {
                if (document.getElementsByClassName("rent-charge").length > 1) {
                    $(".rent-charge").each(function(index){
                        $(this).find(".delete-rent-charge").css("display", "block")
                    });
                } else {
                    $(".rent-charge").each(function(index){
                        $(this).find(".delete-rent-charge").css("display", "none");
                    });
                }
            }

            function checkIfLeaseChargesGreaterThanOne() {
                if (document.getElementsByClassName("lease-charge").length > 1) {
                    $(".lease-charge").each(function(index){
                        $(this).find(".delete-lease-charge").css("display", "block")
                    });
                } else {
                    $(".lease-charge").each(function(index){
                        $(this).find(".delete-lease-charge").css("display", "none");
                    });
                }
            }


            // charges section
            var lease_charge_count = 1;
            $('#add-recurring-charge').click(function (event){
                event.preventDefault();
                var recurring_charge_template = `
                        <div class="card card-detail form-group lease-charge">
                            <div class="card-body">
                                <h4>Recurring</h4>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="account_id">Account*</label>
                                        <select name="charges[%index%][account_id]" id="account_id" class="form-control">
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="charge_next_due_date">Next due date*</label>
                                        <input type="date" name="charges[%index%][next_due_date]" class="form-control" id="charge_next_due_date">
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="charge_amount">Amount*</label>
                                        <input type="text" name="charges[%index%][amount]" class="form-control" id="charge_amount" placeholder="&#8358;0.00">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="charge_memo">MEMO</label>
                                        <input type="text" name="charges[%index%][memo]" class="form-control" id="charge_memo">
                                        <small class="float-right">100</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="frequency">Frequency*</label>
                                        <select name="charges[%index%][frequency]" id="frequency" class="form-control">
                                            <option value="1">Daily</option>
                                            <option value="2">Weekly</option>
                                            <option value="3">Every two weeks</option>
                                            <option value="4">Monthly</option>
                                            <option value="5">Every two months</option>
                                            <option value="6">Quarterly</option>
                                            <option value="7">Every six months</option>
                                            <option value="8">Yearly</option>
                                        </select>
                                    </div>
                                </div>
                                <a class="delete-lease-charge" style="position: absolute; right: 2%; top: 15%; display: none;"> <i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        `;

                recurring_charge_template = recurring_charge_template.replace("%index%", lease_charge_count);
                recurring_charge_template = recurring_charge_template.replace("%index%", lease_charge_count);
                recurring_charge_template = recurring_charge_template.replace("%index%", lease_charge_count);
                recurring_charge_template = recurring_charge_template.replace("%index%", lease_charge_count);
                recurring_charge_template = recurring_charge_template.replace("%index%", lease_charge_count);
                // increment the count
                lease_charge_count++;
                document.getElementById("lease-charges-container")
                    .insertAdjacentHTML("beforeend", recurring_charge_template);
                // count all rent charges displayed
                // if more than 1 display the delete sign beside them
                checkIfLeaseChargesGreaterThanOne();
            });


            $('#add-one-time-charge').click(function (event){
                event.preventDefault();
                var one_time_charge_template = `
                        <div class="card card-detail form-group lease-charge">
                            <div class="card-body">
                                <h4>One time charge</h4>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="account_id">Account*</label>
                                        <select name="charges[%index%][account_id]" id="account_id" class="form-control">
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="charge_next_due_date">Next due date*</label>
                                        <input type="date" name="charges[%index%][next_due_date]" class="form-control" id="charge_next_due_date">
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="charge_amount">Amount*</label>
                                        <input type="text" name="charges[%index%][amount]" class="form-control" id="charge_amount" placeholder="&#8358;0.00">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="charge_memo">MEMO</label>
                                        <input type="text" name="charges[%index%][memo]" class="form-control" id="charge_memo">
                                        <small class="float-right">100</small>
                                    </div>
                                </div>
                                <a class="delete-lease-charge" style="position: absolute; right: 2%; top: 15%; display: none;"> <i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        `;

                one_time_charge_template = one_time_charge_template.replace("%index%", lease_charge_count);
                one_time_charge_template = one_time_charge_template.replace("%index%", lease_charge_count);
                one_time_charge_template = one_time_charge_template.replace("%index%", lease_charge_count);
                one_time_charge_template = one_time_charge_template.replace("%index%", lease_charge_count);
                // increment the count
                lease_charge_count++;
                document.getElementById("lease-charges-container")
                    .insertAdjacentHTML("beforeend", one_time_charge_template);
                checkIfLeaseChargesGreaterThanOne();
            });

            // on click to delete lease charges.
            $("#lease-charges-container").on("click", ".delete-lease-charge", function(event) {
                event.currentTarget.parentElement.parentElement.remove();
                checkIfLeaseChargesGreaterThanOne();
            });
        })();
    </script>
@endsection


