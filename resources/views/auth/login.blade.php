<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        @if ($errors->any())
            <div style="color:red; margin-bottom:10px;">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST" class="frm">
            @csrf

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <input type="submit" class="btn" value="Login">
        </form>

        <div class="misc">
            <a href="{{ url('/account') }}">Create Account</a>
            <h6>|</h6>
            <a href="#">Forgot Password</a>
        </div>

    </div>
</body>
</html>