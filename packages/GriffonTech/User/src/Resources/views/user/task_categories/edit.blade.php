@extends('user::layouts.master')

@section('page_title') Edit Task Category @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h2>Edit task category </h2>
                    {!! Form::model($taskCategory, ['route' => ['user.task_categories.update', $taskCategory->id] ]) !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Update task category', ['class' => 'btn btn-primary']) !!}
                        <a class="text-bold ml-4" href="{{ route('user.task_categories.index') }}">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
