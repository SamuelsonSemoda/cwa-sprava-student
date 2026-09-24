<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $query = Task::with('student')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $tasks = $query->paginate(10)->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $students = Student::orderBy('last_name')->get();
        return view('tasks.create', compact('students'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Úkol byl úspěšně vytvořen.');
    }

    public function edit(Task $task): View
    {
        $students = Student::orderBy('last_name')->get();
        return view('tasks.edit', compact('task', 'students'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $this->validateData($request);
        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Úkol byl aktualizován.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Úkol byl smazán.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:nezahájeno,probíhá,hotovo',
            'priority' => 'required|in:nízká,střední,vysoká',
            'due_date' => 'nullable|date',
            'student_id' => 'nullable|exists:students,id',
        ]);
    }
}
