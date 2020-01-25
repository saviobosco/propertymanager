@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Add New Tennat
                    </div>

                    <div class="card-body">

                        {!! Form::open(['route' => 'tenants.create']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Property Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('address', 'Property Address') !!}
                            {!! Form::textarea('address', null, ['rows' => 4,  'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('submit', ['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
