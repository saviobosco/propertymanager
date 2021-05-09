@extends('user::layouts.master')

@section('page_title') edit lease @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit lease </h4>
                </div>
                <div class="card-body">
                    {!! Form::model($lease, ['route' => ['manager.properties.leases.update', $lease->id]]) !!}

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
                                    {!! Form::select('unit_id', $units, null, ['class' => 'form-control', 'id' => 'unit_id']) !!}
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
                            {!! Form::date('start_date', null, ['class' => 'form-control', 'id' => 'start_date']) !!}
                        </div>
                        <div class="col-sm-2">
                            <label for="end_date">End Date</label>
                            {!! Form::date('end_date', null, ['class' => 'form-control', 'id' => 'end_date']) !!}
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
                            <a class="mt-4" href=""> <i class="fa fa-plus"></i> Add tenants or cosigners</a>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-5 mb-5">
                        <h3>Resident center welcome email</h3>
                        <input type="hidden" name="send_resident_welcome_email" value="0">
                        <label for="send_resident_welcome_email">
                            {!! Form::checkbox('send_resident_welcome_email', null, ['id' => 'send_resident_welcome_email', 'value'=>1]) !!}
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
                                {!! Form::select('rent_cycle',[
                                    '1' => 'Daily',
                                    '2' => 'Weekly',
                                    '3' => 'Every two weeks',
                                    '4' => 'Monthly',
                                    '5' => 'Every two months',
                                    '6' => 'Quarterly',
                                    '7' => 'Every six months',
                                    '8' => 'Yearly'
                                ], 8, ['class' => 'form-control', 'id' => 'rent_cycle']) !!}
                            </div>
                        </div>

                        <div class="card form-group mt-3 card-detail">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="rent_amount">Amount</label>
                                        <input type="text" name="rent[0][rent_amount]" class="form-control" id="rent_amount" placeholder="&#8358;0.00">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="rent_account_id">Account*</label>
                                        <select name="rent_account_id" id="rent[0][rent_account_id]" class="form-control"></select>
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
                            </div>
                        </div>

                        <a class="mt-3" href=""><i class="fa fa-plus"></i> Split rent charge</a>
                    </div>
                    <hr>
                    <div class="mt-5 mb-5">
                        <h3>Security deposit <small>(optional)</small></h3>
                        <div class="card">
                            <div class="card-body card-detail">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="security_deposit_due_date">Due Date*</label>
                                        {!! Form::date('security_deposit_due_date', null, ['class' => 'form-control', 'id'=>'security_deposit_due_date']) !!}
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="security_deposit_amount">Amount</label>
                                        {!! Form::text('security_deposit_amount', null, ['class' => 'form-control', 'id' => 'security_deposit_amount', 'placeholder' => '&#8358;0.00']) !!}
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

                        <div>
                            <div class="card card-detail form-group">
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
                                </div>
                            </div>
                        </div>

                        <a href=""><i class="fa fa-plus"></i>Add recurring charge</a> |
                        <a href=""><i class="fa fa-plus"></i>Add one-time charge</a>
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Update draft lease', ['class' => 'btn btn-success']) !!}
                        <a class="ml-3 text-bold text-black" href="">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

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
        })();
    </script>
@endsection
