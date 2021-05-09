@extends('user::layouts.master')

@section('page_title') Add New Task Category @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h2>Add new task category </h2>
                    {!! Form::open(['route' =>'user.task_categories.store' ]) !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Add task category', ['class' => 'btn btn-primary']) !!}
                        <a class="text-bold ml-4" href="{{ route('user.task_categories.index') }}">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
