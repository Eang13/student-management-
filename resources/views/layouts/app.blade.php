<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Student Management System')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header class="topbar">
    <div class="inner">
        <a class="brand" href="{{ url('/') }}">Student<span>MS</span></a>
        @auth
            <nav class="menu">
                <a href="{{ route('students.index') }}">Students</a>
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('departments.index') }}">Departments</a>
                @endif
            </nav>
            <div class="who">
                <span class="name"><b>{{ auth()->user()->name }}</b></span>
                <span class="role-tag">{{ auth()->user()->role }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="btn btn-light btn-sm">Logout</button>
            </form>
        @else
            <nav class="menu"></nav>
            <a href="{{ route('login') }}" style="color:#cbd5e1">Login</a>
            <a href="{{ route('register') }}" style="color:#cbd5e1">Register</a>
        @endauth
    </div>
</header>

<main class="page">
    @if (session('success')) <div class="alert success">{{ session('success') }}</div> @endif
    @if (session('error'))   <div class="alert error">{{ session('error') }}</div> @endif
    @yield('content')
</main>
</body>
</html>
