@extends('layouts.app')
@section('title', 'Edit Student')
@section('content')
<div class="card narrow">
    <div class="card-head"><div><h1>Edit Student</h1><p>Update the details of {{ $student->student_name }}.</p></div></div>
    <form method="POST" action="{{ route('students.update', $student) }}">
        @method('PUT')
        @include('students._form', ['submit' => 'Update Student'])
    </form>
</div>
@endsection
