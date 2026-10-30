@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="card auth">
    <h1>Login Form</h1>
    <p class="sub">Sign in to manage students.</p>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label>Email address</label>
            <input class="input @error('email') has-error @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email') <div class="err">{{ $message }}</div> @enderror
        </div>
        <div class="field">
            <label>Password</label>
            <input class="input" type="password" name="password" required>
        </div>
        <label class="check"><input type="checkbox" name="remember"> Remember me</label>
        <button class="btn btn-primary btn-block">Login</button>
    </form>
    <p class="muted" style="text-align:center;margin-top:16px">No account? <a href="{{ route('register') }}">Register here</a></p>
</div>
@endsection
