@extends('layouts.app')
@section('title', 'Departments')
@section('content')
<div class="card">
    <div class="card-head">
        <div><h1>Departments</h1><p>Manage all departments.</p></div>
        <a href="{{ route('departments.create') }}" class="btn btn-primary">+ New Department</a>
    </div>

    <form method="GET" action="{{ route('departments.index') }}" style="display:flex;gap:10px;margin-bottom:20px">
        <input class="input" type="text" name="search" value="{{ request('search') }}" placeholder="Search department name...">
        <button class="btn btn-primary">Search</button>
        <a href="{{ route('departments.index') }}" class="btn btn-light">Clear</a>
    </form>

    <div class="table-wrap">
        <table>
            <thead><tr><th>Dept ID</th><th>Department name</th><th>Manager ID</th><th>Location ID</th><th>Students</th><th class="right">Actions</th></tr></thead>
            <tbody>
            @forelse ($departments as $d)
                <tr>
                    <td>{{ $d->dept_id }}</td>
                    <td><span class="tag">{{ $d->dept_name }}</span></td>
                    <td>{{ $d->manager_id ?? '-' }}</td>
                    <td>{{ $d->location_id ?? '-' }}</td>
                    <td>{{ $d->students_count }}</td>
                    <td class="right">
                        <a href="{{ route('departments.edit', $d) }}" class="btn btn-light btn-sm">Edit</a>
                        <form method="POST" action="{{ route('departments.destroy', $d) }}" class="inline" onsubmit="return confirm('Delete this department?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">No departments found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="foot"><span></span>{{ $departments->links('pagination.custom') }}</div>
</div>
@endsection
