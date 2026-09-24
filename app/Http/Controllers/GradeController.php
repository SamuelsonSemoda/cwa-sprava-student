<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GradeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Grade::with(['student', 'task'])->latest('date');

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }

        $grades = $query->paginate(12)->withQueryString();
        $students = Student::orderBy('last_name')->get();

        return view('grades.index', compact('grades', 'students'));
    }

    public function create(): View
    {
        $students = Student::orderBy('last_name')->get();
        $tasks = Task::orderBy('title')->get();
        return view('grades.create', compact('students', 'tasks'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        Grade::create($validated);

        return redirect()->route('grades.index')->with('success', 'Známka byla úspěšně zapsána.');
    }

    public function edit(Grade $grade): View
    {
        $students = Student::orderBy('last_name')->get();
        $tasks = Task::orderBy('title')->get();
        return view('grades.edit', compact('grade', 'students', 'tasks'));
    }

    public function update(Request $request, Grade $grade): RedirectResponse
    {
        $validated = $this->validateData($request);
        $grade->update($validated);

        return redirect()->route('grades.index')->with('success', 'Známka byla aktualizována.');
    }

    public function destroy(Grade $grade): RedirectResponse
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Známka byla smazána.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'student_id' => 'required|exists:students,id',
            'task_id' => 'nullable|exists:tasks,id',
            'subject' => 'required|string|max:255',
            'value' => 'required|integer|min:1|max:5',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);
    }
}
