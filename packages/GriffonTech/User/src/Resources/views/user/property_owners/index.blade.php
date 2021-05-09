@extends('user::layouts.master')

@section('page_title') Property owners @stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Property Owners</h3>
                        <div class="float-right">
                            <a class="btn btn-success btn-sm" href="{{ route('user.property_owners.create', ['property_id' => $property_id]) }}">Add Property Owner</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="property-table" class="table table-bordered">
                            <thead>
                            <tr>
                                <td> First Name </td>
                                <td> Last Name </td>
                                <td> Agreement Ends On </td>
                                <td> Address </td>
                                <td> Phone </td>
                                <td colspan="2"> Email </td>
                            </tr>
                            </thead>
                            <tbody>

                            @if (isset($property_owners))
                                @foreach($property_owners as $property_owner)
                                    <tr>
                                        @if ($property_owner->company_name)
                                            <td colspan="2">
                                                {{ $property_owner->company_name }}
                                            </td>
                                        @else
                                            <td>
                                                {{ $property_owner->first_name  }}
                                            </td>
                                            <td>
                                                {{ $property_owner->last_name }}
                                            </td>
                                        @endif
                                        <td>

                                            {{ $property_owner->agreement_start_date->format('d/m/Y') }} -
                                            {{ ($property_owner->agreement_end_date) ? $property_owner->agreement_end_date->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td>
                                            {{ $property_owner->address }} <br>
                                            {{ $property_owner->city }},
                                            {{ $property_owner->state }}  {{ $property_owner->zip_code }} <br>
                                            {{ $property_owner->country }}

                                        </td>
                                        <td class="no-right-border">
                                            <p> {{ $property_owner->mobile_phone_number }} </p>
                                            <p> {{ $property_owner->home_phone_number }} </p>
                                        </td>
                                        <td>
                                            <p class="mb-0 small-caps"> {{ $property_owner->primary_email_address }}</p>
                                            <p class="mb-0 small-caps"> {{ $property_owner->alternate_email_address }}</p>
                                        </td>
                                        <td class="with-btn no-left-border" nowrap>
                                            <div class="quick-menu">
                                                <div class="quick-menu-icon"></div>
                                                <div class="quick-menu-popover">
                                                    <ul class="quick-menu-list">
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link"
                                                               href="{{ route('user.property_owners.edit',['propertyOwner' => $property_owner->id]) }}">
                                                                Edit Owner
                                                            </a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="">Properties</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="#">Owner Summary</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a
                                                                onclick="event.preventDefault();
                                                                if (confirm('Are you sure you want to delete this property owner?')) {
                                                                    document.getElementById('property-owner-{{$property_owner->id}}').submit();
                                                                }"
                                                                class="quick-menu-link text-danger" href="#">Delete</a>
                                                            <form method="POST" id="property-owner-{{$property_owner->id}}" action="{{ route('user.property_owners.delete', $property_owner->id) }}">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            @endif
                            </tbody>

                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
@endsection
