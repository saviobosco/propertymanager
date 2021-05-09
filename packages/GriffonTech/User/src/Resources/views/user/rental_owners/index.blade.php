@extends('user::layouts.master')

@section('page_title')
    Rental owners
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <h2>Rental owners </h2>
            <div class="clearfix mb-3">
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('manager.rental_owners.create') }}">Add owner</a>

                    <a class="btn btn-default" href="">Management fee</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-2">
                            <label for="property_id">Rentals(Property)</label>
                            <select name="" id="property_id" class="form-control"></select>
                        </div>
                        <div class="col-sm-3">
                            <label for="status">Status</label>
                            <select name="" id="status" class="form-control">
                                <option value="">future</option>
                                <option value="">active</option>
                                <option value="">former</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <p> 2 matches</p>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Agreement ends on</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($propertyOwners->isNotEmpty())
                            @foreach($propertyOwners as $propertyOwner)
                                <tr>
                                    <td class="border-right-0">
                                        <a href="">
                                            {{ (!empty($propertyOwner->company_name)) ? $propertyOwner->company_name : $propertyOwner->full_name }}
                                        </a>
                                    </td>
                                    <td class="border-left-0"></td>
                                    <td>
                                        {{ (isset($propertyOwner->agreement_end_date)) ? $propertyOwner->agreement_end_date->format('d/m/Y') : 'N/A' }}

                                        @if(isset($propertyOwner->agreement_end_date))
                                            <span class="badge barge-outline badge-warning">
                                            {{ (isset($propertyOwner->agreement_end_date)) ? now()->diffInDays($propertyOwner->agreement_end_date).' Days' : '' }}
                                        </span>
                                        @endif
                                    </td>

                                    <td> {{ $propertyOwner->address }} </td>
                                    <td>
                                        <div class="form-element form-element--icon icon-tel icon-tel--home">{{ $propertyOwner->home_phone_number }} </div>
                                        <div class="form-element form-element--icon icon-tel icon-tel--work">{{ $propertyOwner->work_phone_number }}</div>
                                        <div class="form-element form-element--icon icon-tel icon-tel--mobile">{{ $propertyOwner->mobile_phone_number }}</div>
                                        <div class="form-element form-element--icon icon-tel icon-tel--fax">{{ $propertyOwner->fax_phone_number }}</div>
                                    </td>
                                    <td>
                                        <span><a href="">{{ $propertyOwner->primary_email_address }}</a></span> <br>
                                        <span><a href="">{{ $propertyOwner->alternate_email_address }}</a></span>

                                        <div class="float-right">
                                            <div class="quick-menu">
                                                <div class="quick-menu-icon"></div>
                                                <div class="quick-menu-popover">
                                                    <ul class="quick-menu-list">
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="">Properties</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="">Financials</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="#">Record contribution</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="#">Rental owner summary</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
