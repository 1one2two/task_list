@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card card-new-task">
                <!-- Display Validation Errors -->
                @include('errors')
                <div class="card-header">
                    <b>New Task</b>
                </div>
                <!-- New Task Form -->
                <div class="card-body">
                    <form action="{{ url('task') }}" method="POST" class="form-horizontal">
                        {!! csrf_field() !!}
                        <!-- Task Name -->
                        <div class="form-group">
                        <label class="col-sm-offset-3 col-sm-6">Title</label>
                            <div class="col-sm-6">
                                <input type="text" name="name" id="task-name" class="form-control" maxlength="255" autocomplete="off">
                            </div>    
                        </div>
                        <div class="col-sm-offset-3 col-sm-6">
                            <!-- Add Task Button -->
                            <button type="submit" class="btn btn-primary"> 
                                Add Task
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TODO: Current Tasks -->
            @if (count($tasks) > 0)
            <div class="card">
                <div>
                    <table class="table table-striped">
                        <div class="card-header">
                            <tr>
                                <td> Task </td>
                                <td class="text-right"> Like </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </div>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td>
                                    @if ($task->is_complete)
                                        <s>{{ $task->name }}</s>
                                    @else
                                        {{ $task->name }}
                                    @endif
                                </td>
                                <td class="text-right">
                                    {{ $task->likes }}
                                </td>
																<td class="text-right">
                                    <!-- TODO: Delete Button -->
                                    <form action="{{ url('task/'.$task->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        @if ($task->is_complete)
                                            <button class="btn btn-primary"> Delete</button>
                                        @else
                                            <button class="btn btn-primary"> Finish</button>
                                        @endif
                                    </form>

                                </td>
                                <td class="text-right">
                                    <form action="{{ url('like/'.$task->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button type="submit" class="btn btn-primary"> 
                                            +1
                                        </button>
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
