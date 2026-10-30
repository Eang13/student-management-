@extends('layouts.app')
@section('title', 'Edit Department')
@section('content')
<div class="card narrow">
    <div class="card-head"><div><h1>Edit Department</h1></div></div>
    <form method="POST" action="{{ route('departments.update', $department) }}">
        @method('PUT')
        @include('departments._form', ['submit' => 'Update Department'])
    </form>
</div>
@endsection
