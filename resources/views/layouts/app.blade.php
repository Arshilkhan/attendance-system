<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>

    {{-- Global CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    {{-- Navbar Component --}}
    <nav-bar></nav-bar>

    {{-- Page Content Will Be Injected Here --}}
    @yield('content')

</body>
</html>
