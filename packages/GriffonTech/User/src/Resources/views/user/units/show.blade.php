@extends('user::layouts.master')

@section('page_title') {{ $property->address_line1 }}({{ $property->type->name }}) - {{ $unit->identifier }} @stop

@section('content')

    <div class="card">
        <div class="card-body">

            @include('user::user.properties.includes.top_header')

            <div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="img-responsive">
                                    <img src="{{ asset('assets/dist/img/photo4.jpg') }}" alt="{{ $unit->identifier }}" class="img-thumbnail">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <section class="col-xs-12">
                                        <span> Occupied</span>
                                        <h2>
                                            {{ $property->address_line1 }}({{ $property->type->name }}) - {{ $unit->identifier }}
                                            <a href="{{ route('manager.properties.units.edit', $unit->id) }}">edit</a>
                                        </h2>
                                        <div>
                                            <p>Address</p>
                                            <address>
                                                {{ $unit->address_line1. ' '. $unit->address_line2.' '. $unit->address_line3 }} <br>
                                                {{ $unit->city }}  {{ $unit->state }} {{ $unit->zip_code }}<br>
                                            </address>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <section class="mt-3">
                            <h2>Listing Information </h2>
                            <hr>
                            <div class="row">
                                <div class="col-sm-2">
                                    <p>Market Rent</p>
                                    <span>{{ $unit->market_rent }}</span>
                                </div>
                                <div class="col-sm-2">
                                    <p>Size</p>
                                    <span>{{ $unit->size }}</span>
                                </div>
                                <div class="col-sm-2">
                                    <p>Bedrooms</p>
                                    <span>{{ $rooms[$unit->room] }}</span>
                                </div>
                                <div class="col-sm-2">
                                    <p>Bathrooms</p>
                                    <span>{{ $bath_rooms[$unit->bath_room] }}</span>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <p class="text-bold">Description</p>
                                    {!! nl2br($unit->description) !!}
                                </div>
                            </div>
                        </section>

                        <div class="mt-3">
                            <h2>Leases </h2>
                            @if ($unit->leases)
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Start-End</th>
                                        <th>Tenant</th>
                                        <th>Type</th>
                                        <th>Rent</th>
                                    </tr>
                                    </thead>
                                </table>
                            @else
                                <a href="">Add Lease</a>
                            @endif

                        </div>

                        <div class="mt-5">
                            <h2>Appliances </h2>
                            <hr>

                        </div>

                        <div class="mt-5">
                            <h2>Notes</h2>
                            <hr>

                        </div>

                        <div class="mt-5">
                            <h2>Files</h2>
                            <hr>

                        </div>

                    </div>
                    <div class="col-sm-4">

                        <div class="card">
                            <div class="card-body">
                                <ul>
                                    <li>
                                        <a href=""> Balance: <span class="float-right">0.00</span> </a>
                                    </li>
                                    <li>
                                        <a href=""> Repayments: <span class="float-right">0.00</span> </a>
                                    </li>
                                    <li>
                                        <a href=""> Deposits Held: <span class="float-right">0.00</span> </a>
                                    </li>
                                    <li>
                                        <a href=""> Rent <span class="float-right">0.00</span> </a>
                                    </li>
                                </ul>

                                <a href="">
                                    Payment is due on the 1st of the month. If payment isn't received, a one-time fee of $50.00 will be charged on the 2nd of each month. An additional daily fee of $10.00 will be charged starting on the 3rd and continue until the month ends. Late fees will never exceed $100.00 per month.
                                </a>

                                <div class="mt-4">
                                    <button class="btn btn-success btn-sm">Receive payment</button>
                                    <a href="#" class="ml-4">Lease ledger</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

