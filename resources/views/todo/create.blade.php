@extends('layouts.app')
@section('content')
    <div class="container ">
        <h1 class="mt-3 mb-4">Create todo</h1>
        <form action="{{ route('todo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <input type="text" placeholder="todo Name" name="name" class="form-control border border-2 border-success">
                <input type="file" placeholder="todo image" name="image" class="form-control border border-2 border-success">
                <textarea name="description" id="" cols="6" rows="3"
                    class="form-control border border-2 border-success"></textarea>
                <input type="datetime-local" name="start_time" class="form-control border border-2 border-success">
                <input type="datetime-local" name="end_time" class="form-control border border-2 border-success ">
                <select name="status" id="status">
                    <option value="Ongoing">Ongoing</option>
                    <option value="Pending">Pending</option>
                    <option value="Done">Done</option>
                  </select>
                <button class="btn btn-success w-100" type="submit">Addtodo</button>
            </div>
        </form>

    </div>
@endsection
