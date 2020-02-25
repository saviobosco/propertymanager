@extends('user::layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Tenants </h4>
                    @if(request()->route('id'))
                        <a class="btn btn-primary btn-sm" href="{{ route('user.tenants.create') }}"> New Tenant</a>
                    @else
                        <a class="btn btn-primary btn-sm" href="{{ route('user.tenants.create', request()->route('id')) }}"> New Tenant</a>
                    @endif
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>
                                #
                            </td>
                            <td> Property Name </td>
                            <td> Unit </td>
                            <td> First Name </td>
                            <td> Last Name </td>
                            <td> Phone Number </td>
                            <td> Lease Duration</td>
                            <td> Created </td>
                            <td> last Updated</td>
                            <td> Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($tenants))
                            <?php $num = 1; ?>
                            @foreach($tenants as $tenant)
                                <tr>
                                    <td> {{ $num }}</td>
                                    <td> {{ $tenant->property->name }} </td>
                                    <td> {{ $tenant->unit->identifier }} </td>
                                    <td> {{ $tenant->first_name }} </td>
                                    <td> {{ $tenant->last_name }} </td>
                                    <td> {{ $tenant->phone_number }} </td>
                                    <td>
                                        <?php
                                        if ($tenant->unit->is_occupied) {
                                            $lease_ends_date = (new \Carbon\Carbon())->diffInDays(new \Carbon\Carbon($tenant->unit->lease_ends), false);
                                            if ($lease_ends_date < 0) {
                                                echo '<span class="label label-danger">expired</span>';
                                            } elseif ($lease_ends_date == 0) {
                                                echo '<span class="label label-info">expires shortly</span>';
                                            } else {
                                                echo $lease_ends_date . ' Day(s)';
                                            }
                                        }

                                        ?>
                                    </td>
                                    <td> {{ $tenant->created_at }} </td>
                                    <td> {{ $tenant->updated_at }} </td>
                                    <td class="with-btn" nowrap>
                                        <a class="btn btn-info btn-sm width-60 m-r-2" href="{{ route('user.tenants.show', $tenant->id) }}">view</a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('user.tenants.edit', $tenant->id) }}"> edit </a>
                                        <a class="btn btn-danger btn-sm" href="javascript:;"
                                           data-id="{{ $tenant->id }}"
                                           data-link="{{ route('user.tenants.delete', $tenant->id) }}"
                                           data-click="delete"> delete </a>
                                    </td>
                                </tr>
                                <?php $num++ ?>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
