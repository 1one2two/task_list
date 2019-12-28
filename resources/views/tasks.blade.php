@extends('app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Bootstrap Boilerplate... -->

            <div class="card card-new-task">
                <!-- Display Validation Errors -->
                @include('errors')
                <div class="card-header">New Task</div>
                <!-- New Task Form -->
                <div class="card-body">
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}
                        <!-- Task Name -->
                        <div class="form-group">
                            <label>Title</label>
                            <input type="hidden" name="is_complete" value="1">
                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control">
                            </div>
                            <!-- Add Task Button -->
                            <div class="col-sm-offset-3 col-sm-6">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Add Task
                            </button>
                    </form>
                </div>
            </div>

            <!-- TODO: Current Tasks -->
            @if (count($tasks) > 0)
            <div class="card1111">
                <div>
                    <table class="table table-striped task-table">
                        <!-- Table Headings -->
                        <thead class="card-body">
                            <th>Tasks</th>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    @if ($task->is_complete)
                                        <s>{{ $task->name }}</s>
                                    @else
                                        {{ $task->name }}
                                    @endif
                                </td>

                                <td class="text-right">
                                    <!-- TODO: Delete Button -->
                                    <form action="{{ url('task/'.$task->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        @if ($task->is_complete)
                                            <button class="btn btn-primary"> Delete Task</button>
                                        @else
                                            <button class="btn btn-primary"> Finish Task</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection