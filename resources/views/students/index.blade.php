@extends('layouts.app')
@section('title', 'Student Directory')
@section('content')
@php $isAdmin = auth()->user()->role === 'admin'; @endphp
<div class="card">
    <div class="card-head">
        <div>
            <h1>Student Directory</h1>
            <p>Browse all registered students{{ $isAdmin ? ' and manage them' : ' (view only)' }}.</p>
        </div>
        @if ($isAdmin)
            <a href="{{ route('students.create') }}" class="btn btn-primary">+ New Student</a>
        @endif
    </div>

    <div class="stats">
        <div class="stat"><b>{{ $totalStudents }}</b><span>Total students</span></div>
        <div class="stat"><b>{{ $departments->count() }}</b><span>Departments</span></div>
        <div class="stat"><b>{{ $avgYears }} yrs</b><span>Average enrollment</span></div>
    </div>

    <form method="GET" action="{{ route('students.index') }}" class="filters">
        <input class="input wide" type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email or department...">
        <select name="department_id" onchange="this.form.submit()">
            <option value="">All departments</option>
            @foreach ($departments as $d)
                <option value="{{ $d->dept_id }}" @selected(request('department_id') == $d->dept_id)>{{ $d->dept_name }}</option>
            @endforeach
        </select>
        <select name="gender" onchange="this.form.submit()">
            <option value="">All genders</option>
            <option value="Male" @selected(request('gender') === 'Male')>Male</option>
            <option value="Female" @selected(request('gender') === 'Female')>Female</option>
        </select>
        <select name="sort" onchange="this.form.submit()">
            <option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest first</option>
            <option value="oldest" @selected(request('sort') === 'oldest')>Oldest first</option>
            <option value="name" @selected(request('sort') === 'name')>Name A-Z</option>
        </select>
        <button class="btn btn-primary">Search</button>
        <a href="{{ route('students.index') }}" class="btn btn-light">Clear</a>
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>Student</th><th>Contact</th><th>Enrollment</th><th>Department</th>
                    @if ($isAdmin) <th class="right">Actions</th> @endif
                </tr>
            </thead>
            <tbody>
            @forelse ($students as $s)
                <tr>
                    <td>{{ $s->student_id }}</td>
                    <td><b>{{ $s->student_name }}</b><br><small>{{ $s->gender }}</small></td>
                    <td>{{ $s->email }}<br><small>{{ $s->description ?? 'N/A' }}</small></td>
                    <td>{{ $s->enrollment_date->format('M d, Y') }}<br><small>{{ $s->years_enrolled }} years</small></td>
                    <td><span class="tag">{{ $s->department->dept_name }}</span></td>
                    @if ($isAdmin)
                    <td class="right">
                        <a href="{{ route('students.show', $s) }}" class="btn btn-light btn-sm">View</a>
                        <a href="{{ route('students.edit', $s) }}" class="btn btn-light btn-sm">Edit</a>
                        <form method="POST" action="{{ route('students.destroy', $s) }}" class="inline" onsubmit="return confirm('Delete this student?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @empty
                <tr><td colspan="{{ $isAdmin ? 6 : 5 }}" class="empty">No students found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="foot">
        <span class="muted">Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} entries</span>
        {{ $students->links('pagination.custom') }}
    </div>
</div>
@endsection
