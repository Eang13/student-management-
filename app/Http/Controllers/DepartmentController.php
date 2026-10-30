<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::withCount('students')
            ->when($request->filled('search'),
                fn ($q) => $q->where('dept_name', 'like', '%' . trim($request->search) . '%'))
            ->orderBy('dept_id')
            ->paginate(10)
            ->withQueryString();

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        Department::create($this->validated($request));

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $department->update($this->validated($request, $department));

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        if ($department->students()->exists()) {
            return back()->with('error', 'Cannot delete a department that still has students.');
        }

        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }

    private function validated(Request $request, ?Department $department = null): array
    {
        return $request->validate([
            'dept_name'   => ['required', 'string', 'max:255',
                              Rule::unique('departments', 'dept_name')->ignore($department?->dept_id, 'dept_id')],
            'manager_id'  => 'nullable|integer|min:1',
            'location_id' => 'nullable|integer|min:1',
        ]);
    }
}
