@extends('user::layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Property Unit Types </h4>
                    <a class="btn btn-primary btn-sm" href="{{ route('user.property_unit_types.create', $property_id) }}"> New Unit Type</a>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>
                                #
                            </td>
                            <td> Type </td>
                            <td> Amount  </td>
                            <td> Photos  </td>
                            <td> Actions </td>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($propertyUnitTypes as $unitType)
                            <tr>
                                <td> {{ $unitType->id }} </td>
                                <td> {{ $unitType->unit_type->type }} </td>
                                <td> {{ $unitType->amount }} </td>
                                <td>  </td>
                                <td class="with-btn" nowrap>
                                    <a class="btn btn-info btn-sm" href="{{ route('user.property_unit_types.show', $unitType->id) }}"> view </a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('user.property_unit_types.edit', $unitType->id) }}"> edit </a>
                                    <a class="btn btn-danger btn-sm" href="javascript:;"
                                       data-id="{{ $unitType->id }}"
                                       data-link="{{ route('user.property_unit_types.delete', $unitType->id) }}"
                                       data-click="delete"> delete </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
