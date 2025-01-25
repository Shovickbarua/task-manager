<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return $this->sendResponse(['data' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $input = $request->all();
        $task = Task::create($input);
        return $this->sendResponse(['data' => $task, 'message'=> 'Task created sucessfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->sendError(['message' => 'Task not found']);
        }

        return $this->sendResponse(['data' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->sendError(['message' => 'Task not found']);
        }

        $task->status = 'completed';
        $task->save();
        return $this->sendResponse(['data' => $task]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->sendError(['message' => 'Task not found']);
        }
        
        $task->delete();
        return $this->sendResponse(['message' => 'Task deleted successfully']);
    }
}
