<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    // ...

    public function getCompletedTasks()
    {
        $completedTasks = Task::where('status', 'completed')->get();

        return response()->json(['data' => $completedTasks]);
    }

    public function getIncompleteTasks()
    {
        $incompleteTasks = Task::where('status', 'incomplete')->get();

        return response()->json(['data' => $incompleteTasks]);
    }

    public function updateTaskStatus($id, Request $request)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $status = $request->input('status');

        if ($status !== 'completed' && $status !== 'incomplete') {
            return response()->json(['message' => 'Invalid status'], 400);
        }

        $task->status = $status;
        $task->save();

        return response()->json(['message' => 'Task status updated successfully', 'data' => $task]);
    }

    // ...
}


