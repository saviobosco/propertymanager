@extends('user::layouts.master')

@section('page_title')
    Add Recurring
    @switch(request()->get('taskTypeId'))
        @case(1)
        Resident Request
        @break
        @case(2)
        Rental owner request
        @break
        @case(3)
        To Do
        @break
        @case(4)
        Contact request
        @break
    @endswitch
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h2>
                        Add Recurring
                        @switch(request()->get('taskTypeId'))
                            @case(1)
                            Resident Request
                            @break
                            @case(2)
                            Rental owner request
                            @break
                            @case(3)
                            To Do
                            @break
                            @case(4)
                            Contact request
                            @break
                        @endswitch

                    </h2>
                    {!! Form::open(['route' =>'user.tasks.store' ]) !!}
                    {!! Form::hidden('type', $taskTypeId) !!}
                    <div class="row">
                        <div class="col-sm-7">

                            @if ((int) request()->get('taskTypeId') === 1)
                                <div class="form-group">
                                    <label for="requested_by">Request By</label>
                                    {!! Form::select('tenant_id', ['' => 'select a resident...'] + $tenants, null, ['class' => 'form-control']) !!}
                                </div>

                            @elseif ((int) request()->get('taskTypeId') === 2)
                                <div class="form-group">
                                    <label for="requested_by">Requested By</label>
                                    {!! Form::select('rental_owner_id', ['' => 'select a rental owner...'] + $rentalOwners, null, [
                                        'class' => 'form-control', 'id' => 'rental-owner-id']) !!}
                                </div>

                                <div class="row form-group">
                                    <div class="col-sm-7">
                                        <label for="property_id">Property</label>
                                        <select name="property_id" id="property_id" class="form-control">
                                        </select>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="unit_id">Unit (Optional)</label>
                                        <select name="unit_id" id="unit_id" class="form-control">
                                        </select>
                                    </div>
                                </div>

                            @elseif ((int) request()->get('taskTypeId') === 4)
                                <div class="row form-group">
                                    <div class="col-sm-6">
                                        <label for="first_name">First Name(Required)</label>
                                        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="last_name">Last Name(Required)</label>
                                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-9">
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
                                            <span class="small-caps">email address</span>
                                            {!! Form::email('primary_email_address', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="subject">Subject (Required)</label>
                                {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
                            </div>

                            <div class="form-group">
                                <a href=""><i class="fa fa-plus fa-sm"></i> Add attachments...</a>
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                {!! Form::select('task_category_id', $taskCategories, null, ['class' => 'form-control']) !!}
                            </div>

                            @if ((int)$taskTypeId === 3 || (int) $taskTypeId === 4)
                                <div class="form-group">
                                    <label for="property">Property</label>
                                    {!! Form::select('property_id', $properties, null, ['class' => 'form-control']) !!}
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="assigned_to">Assigned To</label>
                                {!! Form::select('assigned_to', ['' => 'select a staff member'], null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-5">
                                    <label for="status">Status</label>
                                    {!! Form::select('status', [
                                        '1' => 'New',
                                        '2' => 'In Progress',
                                        '3' => 'Completed',
                                        '4' => 'Deferred',
                                        '5' => 'Closed',
                                    ], null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-4">
                                    <label for="due_date">Due</label>
                                    {!! Form::date('due_date', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="col-sm-3">
                                    <label for="priority">Priority</label>
                                    {!! Form::select('priority', [
                                        'low' => 'Low',
                                        'normal' => 'Normal',
                                        'high' => 'High'
                                        ], 'normal', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    <label for="frequency">Repeat</label>
                                    {!! Form::select('repeat_frequency', [], null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-sm-4">
                                    <label for="start_date">Start Date(Required)</label>
                                    {{ Form::date('start_date', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="col-sm-4">
                                    <label for="end">End</label>
                                    {!! Form::select('end_type', [
                                        'never' => 'Never',
                                        'after' => 'After',
                                        'on_date' => 'On Date'
                                    ], null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Add task', ['class' => 'btn btn-primary']) !!}
                        <a class="text-bold ml-4" href="{{ route('user.task_categories.index') }}">Cancel</a>
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
            $('#rental-owner-id').on('change', function(event){
                var rental_owner_id = (event.target.value !== undefined && event.target.value !== "") ? event.target.value : false;
                if (rental_owner_id) {
                    // load the properties
                    $.get(window.origin + '/manager/rental/rental-owners/'+ rental_owner_id  +'/properties', null, function(response, statusText, Xhr) {
                        let options = document.querySelectorAll("#property_id option");
                        options = Array.prototype.slice.call(options);
                        options.forEach(function(option){
                            option.remove();
                        });

                        // put default empty option
                        let option = document.createElement("OPTION");
                        option.setAttribute("value", "");
                        let option_name = document.createTextNode('select property...');
                        option.appendChild(option_name);
                        document.getElementById("property_id").appendChild(option);

                        // loop through the returned data
                        for ( const [index, value] of Object.entries(response)) {
                            let option = document.createElement("OPTION");
                            option.setAttribute("value", index);
                            let option_name = document.createTextNode(value);
                            option.appendChild(option_name);
                            document.getElementById("property_id").appendChild(option);
                        }
                    });
                } else {
                    let options = document.querySelectorAll("#property_id option");
                    options = Array.prototype.slice.call(options);
                    options.forEach(function(option){
                        option.remove();
                    });
                }
            });

            $("#property_id").on("change", function(event){
                let property_id = (event.target.value !== undefined && event.target.value !== "") ? event.target.value : false;
                if (property_id) {
                    $.get(window.origin + '/manager/properties/get-units/'+ property_id, null, function(response, statusText, Xhr) {
                        let options = document.querySelectorAll("#unit_id option");
                        options = Array.prototype.slice.call(options);
                        options.forEach(function(option){
                            option.remove();
                        });

                        let option = document.createElement("OPTION");
                        option.setAttribute("value", "");
                        let option_name = document.createTextNode('select unit...');
                        option.appendChild(option_name);
                        document.getElementById("unit_id").appendChild(option);

                        // load the data to options
                        for ( const [index, value] of Object.entries(response)) {
                            let option = document.createElement("OPTION");
                            option.setAttribute("value", index);
                            let option_name = document.createTextNode(value);
                            option.appendChild(option_name);
                            document.getElementById("unit_id").appendChild(option);
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
        })();
    </script>
@endsection
