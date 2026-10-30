@extends('layouts.app')
@section('title', 'Add Department')
@section('content')
<div class="card narrow">
    <div class="card-head"><div><h1>Add Department</h1></div></div>
    <form method="POST" action="{{ route('departments.store') }}">
        @include('departments._form', ['submit' => 'Save Department'])
    </form>
</div>
@endsection
