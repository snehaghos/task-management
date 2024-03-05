<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Todo\TodoResource;
use App\Http\Resources\Todo\TodoCollection;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TodoCollection(Todo::all());
    }

    public function store(StoreTodoRequest $request)
    {

        $data=$request->validated();
        // dd($data);
         if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('todo_images','public');
        $data['image'] = $imagePath;
    }
        $data['start_time'] = date('Y-m-d H:i:s');
        $data['end_time']= date('Y-m-d H:i:s');
        $todo=Todo::create($data);
        return new TodoResource($todo);
    }

    public function show(Todo $todo)
    {
        return new TodoResource($todo);

    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $data=$request->validated();
        // dd( $todo->start_time==null?date('Y-m-d H:i:s'):$todo->start_time);
        if ($request->hasFile('image')) {
            if ($todo->image) {
                Storage::disk('public')->delete($todo->image);
            }

            $imagePath = $request->file('image')->store('todo_images', 'public');
            $data['image'] = $imagePath;
        }
        $data['start_time'] = $todo->start_time==null?date('Y-m-d H:i:s'):$todo->start_time;
        $data['end_time']= date('Y-m-d H:i:s');

        $todo->update($data);
        return new TodoResource($todo);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return  response(null, 204);
    }
}
