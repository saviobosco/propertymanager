@extends('user::layouts.master')

@section('page_title') {{ $property->address }}  @stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <!-- /.card-header -->
                    <div class="card-body">

                        @include('user::user.properties.includes.top_header')

                        <div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="img-responsive">
                                                <img src="{{ asset('assets/dist/img/photo4.jpg') }}" alt="{{ $property->address }}" class="img-thumbnail">
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <address>
                                                {{ $property->address }}, <br>
                                                {{ $property->state_name}}({{ $property->state }}) ,{{ $property->zip_code }}<br>
                                                {{ $property->country_name }} ({{ $property->country}})
                                            </address>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <h2>Units ({{$property->units()->count()}}) </h2>
                                        <a href="{{ route('manager.properties.units.create', ['property_id' => $property->id]) }}">add</a>
                                        <hr>

                                    </div>

                                    <div class="mt-3">
                                        <h2>Property Owners</h2>
                                        <a href="{{ route('user.property_owners.create', ['property_id' => $property->id]) }}">Add</a>
                                        <hr>
                                        @if (isset($property_owners))
                                            @foreach($property_owners as $property_owner)
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <p> {{ $property_owner->company_name }} </p>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p> {{ $property_owner->mobile_phone_number }} </p>
                                                                <p> {{ $property_owner->home_phone_number }} </p>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <p> Ownership percentage : {{ $rental_owner_percentages[$property_owner->id] }}%</p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>

                                    <div class="mt-3">
                                        <h2>Leases</h2>
                                        <hr>
                                    </div>

                                    <div class="mt-3">
                                        <h2>Events </h2>
                                        <hr>
                                    </div>

                                    <div class="mt-3">
                                        <h2>Files </h2>
                                        <hr>

                                    </div>

                                </div>
                                <div class="col-sm-3">

                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
