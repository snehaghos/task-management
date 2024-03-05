<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        //dd($todos);
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $todo = new Todo();
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->start_time = date('Y-m-d H:i:s');
        $todo->end_time = date('Y-m-d H:i:s');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('todo_images', 'public');
            $todo->image = $imagePath;
        }
        $todo->status = $request->status;
        $todo->save();
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $todo = Todo::find($id);

        return view('todo.edit', compact('todo'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $todo->name = $request->name;

        $todo->description = $request->description;
        $todo->description = $request->description;
        $todo->start_time = date('Y-m-d');
        $todo->end_time = date('Y-m-d');
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($todo->image) {
                Storage::disk('public')->delete($todo->image);
            }

            $imagePath = $request->file('image')->store('todo_images', 'public');
            $todo->image = $imagePath;
        }
        $todo->status = $request->status;

        $todo->save();
        return redirect()->route('todo.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo=Todo::find($id);
        $todo->delete();
        return redirect()->route('todo.index');
    }
}
