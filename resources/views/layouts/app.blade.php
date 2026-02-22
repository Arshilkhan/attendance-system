<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <nav-bar></nav-bar>
    @yield('content')
    <script src="{{ asset('js/navbar.js') }}?v={{ time() }}"></script>

</body>
</html>
