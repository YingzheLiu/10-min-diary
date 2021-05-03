<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', '=', Auth::user()->id)
            ->whereDate('created_at', Carbon::today('America/Los_Angeles'))
            ->orderBy('todos.task')
            ->get();
        return view('todo.index', [
            'todos' => $todos,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|maxwords:20',
        ]);

        Todo::create([
            'task' => $request->input('task'),
            'user_id' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now(),
            'finished' => false,
        ]);

        $notification = array(
            'message' => 'I am a successful message!',
            'alert-type' => 'success'
        );

        return redirect()
            ->route('todo.index')
            ->with($notification);
    }

    public function update(Request $request)
    {
        $todos = Todo::get();
        foreach ($todos as $todo) {
            // UPDATING
            $todo->finished = $request->has($todo->id) ? true : false;
            $todo->updated_at = now();
            $todo->save();
        }

        $notification = array(
            'message' => 'Successfully update your to-do list',
            'alert-type' => 'success'
        );

        return redirect()
            ->route('todo.index')
            ->with($notification);
    }
}
