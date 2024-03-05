@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mt-3 mb-4">Edit todo</h1>
        <form action="{{ route('todo.update',$todo->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="form-group d-flex">
                <input type="" placeholder="todo Name" name="name" class="form-control border border-2 border-info" value="{{ $todo->name }}">
                <input type="file" placeholder="todo image" name="image" class="form-control border border-2 border-success"  value="{{ $todo->image }}">

                <textarea name="description" id="" cols="6" rows="3"
                    class="form-control border border-2 border-info" value="{{ $todo->description }}"></textarea>
                <input type="datetime-local" name="start_time" class="form-control border border-2 border-info mb-4" value="{{ $todo->start_time }}" >
                <input type="datetime-local" name="end_time" class="form-control border border-2 border-info mb-4" value="{{ $todo->end_time }}">
                <select name="status" id="status" value="{{ $todo->status }}">
                    <option value="Ongoing">Ongoing</option>
                    <option value="Pending">Pending</option>
                    <option value="Done">Done</option>
                  </select>
                <button class="btn btn-info w-100" type="submit">Addtodo</button>
            </div>
        </form>

    </div>
@endsection
