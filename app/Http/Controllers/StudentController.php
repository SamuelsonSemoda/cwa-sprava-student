<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::withCount('tasks')->orderBy('last_name');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('class', 'like', "%{$search}%");
            });
        }

        $students = $query->paginate(10)->withQueryString();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student byl úspěšně přidán.');
    }

    public function show(Student $student): View
    {
        $student->load('tasks');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $this->validateData($request, $student->id);
        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Údaje studenta byly aktualizovány.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student byl smazán.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email' . ($ignoreId ? ",{$ignoreId}" : ''),
            'class' => 'nullable|string|max:50',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:30',
            'note' => 'nullable|string',
        ]);
    }
}
