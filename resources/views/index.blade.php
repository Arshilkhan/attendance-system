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
        <form action="php/login.php" method="POST" class="frm">
            <input type="text" name="username" placeholder="Username" id="user" required>
            <input type="password" name="password" placeholder="Password" id="pass" required>
            <input type="submit" class="btn" value="Login">
        </form>
        <div class="misc">
            <a href="account.php">Create Account</a>
            <h6>|</h6>
            <a href="">Forgot Password</a>
        </div>
    </div>
</body>
</html>