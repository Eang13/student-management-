@extends('layouts.app')
@section('title', 'Student Registration')
@section('content')
<div class="card narrow">
    <div class="card-head"><div><h1>Student Registration</h1><p>Fill in the form to register a new student.</p></div></div>
    <form method="POST" action="{{ route('students.store') }}">
        @include('students._form', ['submit' => 'Submit Registration'])
    </form>
</div>
@endsection
