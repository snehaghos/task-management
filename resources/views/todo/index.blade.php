@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Todo Index</h1>
        <a href="{{ route('todo.create') }}">
            <div class="btn btn-info">
                Create todo
            </div>
        </a>
        <table class="table border-dark table-responsive">
            <tr>
                <th>Sl</th>
                <th>todo Name</th>
                <th>Description</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Image</th>
                <th>Action</th>

            </tr>
            @foreach ($todos as $key => $todo)
                <tr>
                    <td>{{ $todo->id }}</td>
                    <td>{{ $todo->name }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ $todo->start_time }}</td>
                    <td>{{ $todo->end_time }}</td>

                    <td>{{ $todo->status }}</td>
                    <td>
                        @if ($todo->image)
                            <img src="{{ asset('storage/' . $todo->image) }}" alt="Todo Image" style="max-width: 100px;">
                        @else
                            No Image found
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-success me-2">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('todo.delete', $todo->id) }}" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
