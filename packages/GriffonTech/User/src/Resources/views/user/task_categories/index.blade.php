@extends('user::layouts.master')

@section('page_title')
    Task Categories
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <h2>Task Categories </h2>
            <div class="clearfix mb-3">
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('user.task_categories.create') }}">Add Task Category</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Detail</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($taskCategories->isNotEmpty())
                    @foreach($taskCategories as $taskCategory)
                        <tr>
                            <td class="">
                                {{ $taskCategory->name }}
                            </td>
                            <td class="">{{ $taskCategory->type }}</td>
                            <td>
                                You have {{ $taskCategory->tasks()->count() }} task(s) under this category.
                            </td>
                            <td>
                                @if ($taskCategory->type === 'user_defined')
                                <a class="btn btn-primary btn-sm" href="{{ route('user.task_categories.edit', $taskCategory->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm" href="javascript:;"
                                   onclick="event.preventDefault(); if (confirm('Are you sure? If you delete this category, all tasks under it will be move to uncategorized')) {
                                       document.getElementById('task-category-{{$taskCategory->id}}').submit();
                                   }">Delete</a>

                                <form id="task-category-{{$taskCategory->id}}" action="{{ route('user.task_categories.delete', $taskCategory->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                                @endif
                            </td>
                        </tr>


                    @endforeach
                @endif
                </tbody>
            </table>

        </div>
    </div>
@endsection
