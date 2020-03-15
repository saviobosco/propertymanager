@extends('user::layouts.master')

@section('title') View Unit @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> {{ $unit->identifier }} </h4>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Property </td>
                            <td>{{ $unit->property->name }}</td>
                        </tr>
                        <tr>
                            <td> Unit # </td>
                            <td> {{ $unit->identifier }}</td>
                        </tr>
                        <tr>
                            <td>Lease Starts</td>
                            <td>{{ $unit->lease_starts->format('M d, Y') }}</td>
                        </tr>
                        <tr>
                            <td>Lease Expires</td>
                            <td>{{ $unit->lease_ends->format('M d, Y') }}</td>
                        </tr>
                        <tr>
                            <td> Duration </td>
                            <td> {{ $unit->lease_ends->diffInDays($unit->lease_starts) }} Days </td>
                        </tr>
                        <tr>
                            <td>Is Occupied</td>
                            <td>{!! ($unit->is_occupied) ? ' <span class="label label-success"> Yes </span>' : ' <span class="label label-danger">No</span> ' !!}</td>
                        </tr>
                    </table>

                    <h4> Tenants</h4>

                    @if ($unit->tenants)
                    <div class="row">
                        @foreach($unit->tenants as $tenant)
                        <div class="col-xs-3">
                            <div class="card border-0">
                                <img class="card-img-top" src="" alt="">
                                <div class="card-body">
                                    <h4 class="card-title m-t-0 m-b-10"> {{ $tenant->first_name.' '. $tenant->last_name }} </h4>
                                    <p class="card-text">
                                        {{ $tenant->occupation }}
                                    </p>
                                    <p> Account Status : <small> {{ ($tenant->active) ? 'Active' : 'Unactive' }} </small></p>
                                    <div class="text-center">
                                        <a href="javascript:;" class="btn btn-sm btn-info">view</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <hr>

                    <div class="m-t-25">
                        <h4> Unit Rent Payments </h4>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">

                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"> Unit Rent Payment </h4>
                                    </div>
                                    <div class="panel-body">
                                        {!! Form::open(['route' => 'user.unit_rent_payments.create']) !!}

                                        {!! Form::hidden('unit_id' , $unit->id) !!}
                                        <div class="form-group">
                                            <input type="text" value="{{ $unit->identifier }}" disabled class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="amount_paid"> Amount Paid </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">&#8358; </span>
                                                </div>
                                                {!! Form::text('amount', null, ['class' => 'form-control']) !!}
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
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
                                            <div class="col-sm-6">
                                                {!! Form::label('lease_ends', 'Lease Ends') !!}
                                                <div class="input-group m-b-10">
                                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar-alt"></i>
                                        </span>
                                                    </div>
                                                    {!! Form::text('lease_ends', null, [
                                                        'class' => 'form-control datepicker-default',
                                                         'placeholder' => 'Lease Ends Date']) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="note"> Comment </label>
                                            {!! Form::textarea('note', null, [ 'rows' => 5, 'class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="generate_receipts">
                                                <input type="checkbox" name="generate_receipt" value="yes" checked> Generate Payment Receipt
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary"> Update Rent </button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>Amount Paid </td>
                                            <td>Comment </td>
                                            <td>Lease Starts </td>
                                            <td>Lease Expires </td>
                                            <td>Created On </td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($unit->rent_payments ) && !$unit->rent_payments->isEmpty())
                                            @foreach($unit->rent_payments as $payment)
                                            <tr>
                                                <td>&#8358;{{ number_format($payment->amount, 2) }}</td>
                                                <td>{{ $payment->note }}</td>
                                                <td>{{ $payment->lease_starts->format('M d, Y') }}</td>
                                                <td>{{ $payment->lease_ends->format('M d, Y') }}</td>
                                                <td>{{ $payment->created_at }}</td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center"> No Records </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

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
    </script>
@stop
