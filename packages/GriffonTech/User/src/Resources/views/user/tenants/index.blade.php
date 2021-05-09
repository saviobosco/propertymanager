@extends('user::layouts.master')

@section('page_title')
    Tenants
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <h2>Tenants</h2>
            <div class="clearfix mb-3">
                <div class="float-right">
                    <a class="btn btn-success" href="">Add Lease</a>
                    <a class="btn btn-success" href="{{ route('manager.tenants.create') }}">Add Tenant</a>

                    <a class="btn btn-default" href=""> Receive payment</a>
                    <a class="btn btn-default" href=""> Compose email</a>
                    <a class="btn btn-default" href=""> Resident users</a>
                    <a class="btn btn-default" href=""> Text message accounts</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-2">
                            <label for="property_id">Property</label>
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
                            <th>Unit Number</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <!--                        <th>Resident center status</th>
                                                    <th>Text message status</th>-->
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($tenants->isNotEmpty())
                            @foreach($tenants as $tenant)
                                <tr>
                                    <td class="border-right-0">
                                        <a href=""> {{ $tenant->full_name }} </a> <br>
                                        <span>Tenant</span>
                                    </td>
                                    <td class="border-left-0"></td>
                                    <td>
                                        <?php $lease_tenant = $tenant->leases()->first();  ?>
                                        @if ($lease_tenant)
                                                {{ $lease_tenant->lease->property->address }} - {{ $lease_tenant->lease->unit->identifier }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-element form-element--icon icon-tel icon-tel--home"> {{ $tenant->home_phone_number }} </div>
                                        <div class="form-element form-element--icon icon-tel icon-tel--work"> {{ $tenant->work_phone_number }}</div>
                                        <div class="form-element form-element--icon icon-tel icon-tel--mobile"> {{ $tenant->mobile_phone_number }}</div>
                                        <div class="form-element form-element--icon icon-tel icon-tel--fax"> {{ $tenant->fax_phone_number }} </div>
                                    </td>
                                    <td>
                                        <span><a href="">{{ $tenant->primary_email_address }} </a></span> <br>
                                        <span><a href="">{{ $tenant->alternate_email_address }}</a></span>
                                    </td>
                                    <td>
                                        Active
                                        <div class="float-right">
                                            <div class="quick-menu">
                                                <div class="quick-menu-icon"></div>
                                                <div class="quick-menu-popover">
                                                    <ul class="quick-menu-list">
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="{{ route('manager.tenants.edit', $tenant->id) }}">Edit Tenant</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="">Receive Payment</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="">Lease ledger</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="quick-menu-link" href="#">Tenant summary</a>
                                                        </li>
                                                        <li class="quick-menu-item">
                                                            <a class="text-danger quick-menu-link"
                                                               href="javascript:;"
                                                               onclick="event.preventDefault(); if (confirm('Are you sure?')){ document.getElementById('delete-tenant-{{$tenant->id}}').submit(); }"
                                                            >Delete tenant</a>
                                                            <form action="{{ route('manager.tenants.delete', $tenant->id) }}" method="POST" id="delete-tenant-{{$tenant->id}}">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>


                            @endforeach
                        @endif

<!--                        <tr>
                            <td class="border-right-0">
                                <a href="">Omebe Johnbosco</a> <br>
                                <span>Tenant</span>
                            </td>
                            <td class="border-left-0"></td>
                            <td>10 Oharugo(flats)- Room 1</td>
                            <td>
                                <div class="form-element form-element&#45;&#45;icon icon-tel icon-tel&#45;&#45;home">(080)-688-65957</div>
                                <div class="form-element form-element&#45;&#45;icon icon-tel icon-tel&#45;&#45;work">(080)-688-65957</div>
                                <div class="form-element form-element&#45;&#45;icon icon-tel icon-tel&#45;&#45;mobile">(080)-688-65957</div>
                                <div class="form-element form-element&#45;&#45;icon icon-tel icon-tel&#45;&#45;fax">(080)-688-65957</div>
                            </td>
                            <td>
                                <span><a href="">Johnboscoomebe@yahoo.com</a></span> <br>
                                <span><a href="">saviobosco4real@gmail.com</a></span>
                            </td>
                            <td>
                                Active
                                <div class="float-right">
                                    <div class="quick-menu">
                                        <div class="quick-menu-icon"></div>
                                        <div class="quick-menu-popover">
                                            <ul class="quick-menu-list">
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">Receive Payment</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">Lease ledger</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="#">Tenant summary</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-right-0">
                                <a href="">Goodness Anih</a> <br>
                                <span>Tenant</span>
                            </td>
                            <td class="border-left-0"></td>
                            <td>Off Ezra Rd.(flats)- Room 1</td>
                            <td>
                                <div class="form-element form-element&#45;&#45;icon icon-tel icon-tel&#45;&#45;home">(081)-311-83737</div>
                                <div class="form-element form-element&#45;&#45;icon icon-tel icon-tel&#45;&#45;work">(081)-311-83737</div>
                                <div class="form-element form-element&#45;&#45;icon icon-tel icon-tel&#45;&#45;mobile">(081)-311-83737</div>
                            </td>
                            <td>
                                <span><a href="">Johnboscoomebe@yahoo.com</a></span> <br>
                                <span><a href="">saviobosco4real@gmail.com</a></span>
                            </td>
                            <td>
                                Active
                                <div class="float-right">
                                    <div class="quick-menu">
                                        <div class="quick-menu-icon"></div>
                                        <div class="quick-menu-popover">
                                            <ul class="quick-menu-list">
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">Receive Payment</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">Lease ledger</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="#">Tenant summary</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>-->
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
