<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    // Log the redirection for already logged in users
    error_log("User  already logged in: username={$_SESSION['user']['username']}, user_type={$_SESSION['user']['user_type']}, user_id={$_SESSION['user']['user_id']}");

    // Prepare raw values with boundary characters for URL
    $user_type_id_val =  $_SESSION['user']['user_type_id'] . '-';
    $user_type_val = $_SESSION['user']['user_type'] . '-';
    $user_id_val = $_SESSION['user']['user_id'] . '-';

    // Redirect based on user type with raw values and boundaries in URL
    $user_type_lower = strtolower($_SESSION['user']['user_type']);
    switch ($user_type_lower) {
        case 'superadmin':
        case 'admin':
        case 'student':
            header("Location: /ams/views/home.php?{$user_type_id_val}&{$user_type_val}&{$user_id_val}");
            exit;
        default:
            // Log an unexpected user type, destroy session and redirect to login with error
            error_log("Unexpected user type during redirection: " . $_SESSION['user']['user_type']);
            session_destroy();
            header('Location: /ams/views/index.php?error=Invalid user role.');
            exit;
    }
}

// Capture any error messages from the URL safely
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
?>

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
            <form action="/ams/action/submit-login.php" class="logForm" method="post">
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