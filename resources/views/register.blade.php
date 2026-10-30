@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="card auth">
    <h1>Register Form</h1>
    <p class="sub">Create an account (view-only access).</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="field">
            <label>Name</label>
            <input class="input @error('name') has-error @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="please input your name" required>
            @error('name') <div class="err">{{ $message }}</div> @enderror
        </div>
        <div class="field">
            <label>Email address</label>
            <input class="input @error('email') has-error @enderror" type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div class="err">{{ $message }}</div> @enderror
        </div>
        <div class="field">
            <label>Password</label>
            <input class="input @error('password') has-error @enderror" type="password" name="password" required>
            @error('password') <div class="err">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary btn-block">Register</button>
    </form>
    <p class="muted" style="text-align:center;margin-top:16px">Already registered? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection
