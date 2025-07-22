<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/ams/res/victory.fav.png" type="image/x-icon" />
    <link rel="stylesheet" href="/ams/css/index.css?v=<?php echo time(); ?>" type="text/css" />
    <title>AMS - Attendance Management System</title>
</head>

<body>
    <div class="fill">
        <div class="conIndex">
            <h1>PANABO STUDENT CENTER<br>ATTENDANCE MANAGEMENT SYSTEM</h1>
            <div class="logo">
                <img src="/ams/res/victory.fav.png" alt="Logo" class="logoV">
                <img src="/ams/res/enc.fav.png" alt="Logo" class="logoE">
            </div>
            <form action="" class="logForm">
                <div class="meta-group">
                    <div class="floating-label">
                        <input type="email" name="email" id="email" placeholder="" required />
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="meta-group">
                    <div class="floating-label">
                        <input type="password" name="password" id="password" placeholder="" required />
                        <label for="password">Password</label>
                    </div>
                </div>
                <button id="loginButton" name="login-button" class="login-button">Sign in</button>
            </form>
            <a href="" class="forgetPass">Forgot password?</a>
        </div>
    </div>
</body>

</html>