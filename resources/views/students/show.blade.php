@extends('layouts.app')
@section('title', 'Student Detail')
@section('content')
<div class="card narrow">
    <div class="card-head"><div><h1>{{ $student->student_name }}</h1><p>Student #{{ $student->student_id }}</p></div></div>
    <dl class="detail">
        <dt>Email</dt><dd>{{ $student->email }}</dd>
        <dt>Gender</dt><dd>{{ $student->gender }}</dd>
        <dt>Enrollment date</dt><dd>{{ $student->enrollment_date->format('M d, Y') }}</dd>
        <dt>Years enrolled</dt><dd>{{ $student->years_enrolled }} years</dd>
        <dt>Department</dt><dd><span class="tag">{{ $student->department->dept_name }}</span></dd>
        <dt>Description</dt><dd>{{ $student->description ?? 'N/A' }}</dd>
    </dl>
    <div class="actions">
        <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('students.index') }}" class="btn btn-light">Back</a>
    </div>
</div>
@endsection
