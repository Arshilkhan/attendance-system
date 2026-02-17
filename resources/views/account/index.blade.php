<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="stylesheet" href="{{ asset('css/account.css') }}">
</head>

<body>
    <div class="container">
        <form action="php/account.php" method="POST" class="frm">
            <input type="text" name="firstname" placeholder="First Name" id="user" required>
            <input type="text" name="lastname" placeholder="Last Name" id="user" required>
            <select name="subject" id="">
                <option value="dsba">DSBA</option>
                <option value="wt">WT</option>
                <option value="ai">AI</option>
                <option value="cc">CC</option>
            </select>
            <input type="text" name="username" placeholder="Username" id="user" required>
            <input type="password" name="password" placeholder="Password" id="pass" required>
            <input type="password" name="cnfrm_password" placeholder="Confirm Password" id="pass" required>
            <input type="submit" class="btn" value="Submit">
        </form>
    </div>
</body>
</html>