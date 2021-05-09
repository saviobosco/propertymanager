@extends('user::layouts.master')

@section('page_title')
    Tasks
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <h2> Tasks </h2>
            <div class="clearfix mb-3">
                <div class="float-right">


                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        Add recurring Tasks
                    </a>
                    <div class="dropdown-menu" style="">
                        <a class="dropdown-item" tabindex="-1" href="{{ route('user.recurring_tasks.create',['taskTypeId' => 3]) }}">To do</a>
                        <a class="dropdown-item" tabindex="-1" href="{{ route('user.recurring_tasks.create',['taskTypeId' => 1]) }}">Resident request</a>
                        <a class="dropdown-item" tabindex="-1" href="{{ route('user.recurring_tasks.create',['taskTypeId' => 2]) }}">Rental owner request</a>
                    </div>
                </div>
            </div>



            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Task</th>
                    <th>Unit</th>
                    <th>Updated</th>
                    <th>Age</th>
                    <th>Status</th>
                    <th>Due</th>
                    <th>Priority</th>
                    <th>Category</th>
                    <th>Work order</th>
                    <th>Assigned To</th>
                </tr>
                </thead>
                <tbody>
                @if ($tasks->isNotEmpty())
                    @foreach($tasks as $task)
                        <tr>
                            <td colspan="2">
                                @if ((int)$task->type === 3 || (int)$task->type === 4)
                                    <p class="text-bold">
                                        {{$task->subject}}
                                    </p>
                                @elseif((int)$task->type === 1)
                                    <p class="text-bold">
                                        {{$task->subject}} at {{ $task->tenant->lease->property->address }} - {{ $task->tenant->lease->unit->identifier }}
                                    </p>
                                @elseif((int)$task->type === 2)
                                    <p class="text-bold">
                                        {{$task->subject}} at {{ $task->property->address }} - {{ ($task->unit) ? $task->unit->identifier : '' }}
                                    </p>
                                @endif

                                <span> {{ $taskTypes[$task->type] }} | {{ $task->id }} </span>
                            </td>
                            <td colspan="2">
                                {{ $task->updated_at }} <br>
                                --
                            </td>
                            <td colspan="2">
                                <p> {{ $taskStatuses[$task->status] }} </p>
                                <span> -- </span>
                            </td>
                            <td colspan="2">
                                <p>{{ $taskPriorities[$task->priority] }}</p>
                                <span>{{ $task->category->name }}</span>
                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="float-right">
                                    <div class="quick-menu">
                                        <div class="quick-menu-icon"></div>
                                        <div class="quick-menu-popover">
                                            <ul class="quick-menu-list">
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="{{ route('user.tasks.edit', ['task' => $task->id, 'taskTypeId' => $task->type]) }}">Edit task</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">View task</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link" href="">Print task</a>
                                                </li>
                                                <li class="quick-menu-item">
                                                    <a class="quick-menu-link text-danger"
                                                       href="javascript:;"
                                                       onclick="event.preventDefault(); if (confirm('Are you sure?')){
                                                           document.getElementById('delete-task-{{$task->id}}').submit();
                                                           }"
                                                    >Delete task</a>
                                                    <form id="delete-task-{{$task->id}}" action="{{ route('user.tasks.delete', $task->id) }}" method="POST">
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
                </tbody>
            </table>

        </div>
    </div>
@endsection
