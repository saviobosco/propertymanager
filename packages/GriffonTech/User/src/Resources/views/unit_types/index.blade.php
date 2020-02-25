@extends('user::layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title"> Unit Types </h4>
                    <a class="btn btn-primary btn-sm" href="{{ route('unit_types.create') }}"> New Unit Type</a>
                </div>
                <div class="panel-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <td>
                                #
                            </td>
                            <td> Type </td>
                            <td> Actions</td>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($unit_types as $unit_type)
                            <tr>
                                <td> {{ $unit_type->id }} </td>
                                <td> {{ $unit_type->type }} </td>
                                <td class="with-btn" nowrap>
                                    <a class="btn btn-primary btn-sm" href="{{ route('unit_types.edit', $unit_type->id) }}"> edit </a>
                                    <a class="btn btn-danger btn-sm" href="javascript:;"
                                       data-id="{{ $unit_type->id }}"
                                       data-link="{{ route('unit_types.delete',$unit_type->id) }}"
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
