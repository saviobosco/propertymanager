@extends('user::layouts.master')

@section('page_title')
    Rent roll
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <h2>Rent roll </h2>
            <div class="clearfix mb-3">
                <div class="float-right">
                    <a class="btn btn-success" href="">Add lease</a>

                    <a class="btn btn-default" href="">Renew lease</a>
                    <a class="btn btn-default" href="">Receive payment</a>
                    <a class="btn btn-default" href="">Update recurring charges</a>
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
                                <option value="">past</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <p> 2 matches</p>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-capitalize">Lease</th>
                            <th class="text-capitalize">status</th>
                            <th class="text-capitalize">Type</th>
                            <th class="text-capitalize">Days left</th>
                            <th class="text-capitalize">Rent</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="border-right-0">
                                <a href="">10 Oharugo Presco - Room 1 | Ego Ibe, Ifeanyi </a>
                            </td>
                            <td>Active</td>
                            <td> fixed w/rollover </td>
                            <td> <span class="badge badge-success">538 days</span> </td>

                            <td>
                                <a href="">$500.00</a>

                                <div class="float-right">
                                    <div class="quick-menu">
                                        <div class="quick-menu-icon"></div>
                                        <div class="quick-menu-popover">
                                            <ul class="quick-menu-list">
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">Receive payment</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">Event history</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="#">Tenants</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="#">Financials</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="#">Lease summary</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </td>

                        </tr>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
