<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('department');

        // Search by name, email or department name
        if ($search = trim((string) $request->get('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('department', fn ($d) => $d->where('dept_name', 'like', "%{$search}%"));
            });
        }

        // Filters
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Sorting
        match ($request->get('sort', 'newest')) {
            'oldest' => $query->orderBy('student_id'),
            'name'   => $query->orderBy('student_name'),
            default  => $query->orderByDesc('student_id'),
        };

        $students    = $query->paginate(10)->withQueryString();
        $departments = Department::orderBy('dept_name')->get();

        $totalStudents = Student::count();
        $avgYears = $totalStudents
            ? round(Student::pluck('enrollment_date')->avg(fn ($d) => abs($d->diffInYears(now()))), 1)
            : 0;

        return view('students.index', compact('students', 'departments', 'totalStudents', 'avgYears'));
    }

    public function create()
    {
        return view('students.create', ['departments' => Department::orderBy('dept_name')->get()]);
    }

    public function store(Request $request)
    {
        Student::create($this->validated($request));

        return redirect()->route('students.index')->with('success', 'Student registered successfully.');
    }

    public function show(Student $student)
    {
        $student->load('department');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'student'     => $student,
            'departments' => Department::orderBy('dept_name')->get(),
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $student->update($this->validated($request, $student));

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

    private function validated(Request $request, ?Student $student = null): array
    {
        return $request->validate([
            'student_name'    => 'required|string|max:255',
            'email'           => ['required', 'email', 'max:255',
                                  Rule::unique('students', 'email')->ignore($student?->student_id, 'student_id')],
            'gender'          => ['required', Rule::in(['Male', 'Female'])],
            'enrollment_date' => 'required|date',
            'department_id'   => 'required|exists:departments,dept_id',
            'description'     => 'nullable|string',
        ]);
    }
}
