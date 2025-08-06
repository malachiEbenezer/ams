<?php
session_start();

// Track login attempts
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

// Lockout after 3 failed attempts within 1 hour
if ($_SESSION['login_attempts'] >= 3) {
    $elapsed = time() - $_SESSION['last_attempt_time'];
    if ($elapsed < 3600) {
        $minutes_left = ceil((3600 - $elapsed) / 60);
        header("Location: /ams/views/index.php?error=Too many attempts. Try again in {$minutes_left} minutes.");
        exit;
    } else {
        $_SESSION['login_attempts'] = 0;
    }
}

// Connect to DB
$conn = new mysqli("localhost", "root", "", "ams");
if ($conn->connect_error) {
    header("Location: /ams/views/index.php?error=Database connection failed.");
    exit;
}

// Validate input
if (empty($_POST['email']) || empty($_POST['password'])) {
    header("Location: /ams/views/index.php?error=Empty credentials.");
    exit;
}

$email = trim($_POST['email']);
$password = trim($_POST['password']);

// Query using email only
$stmt = $conn->prepare("SELECT user_id, username, password, user_type, user_type_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password'])) {
        // Success
        unset($_SESSION['login_attempts']);
        unset($_SESSION['last_attempt_time']);
        session_regenerate_id(true);

        $_SESSION['user'] = [
            'user_id' => $row['user_id'],
            'email' => $email,
            'username' => $row['username'],
            'user_type' => $row['user_type'],
            'user_type_id' => $row['user_type_id']
        ];


        // Redirect with username in URL
        $username = urlencode($row['username']);
        $user_type = urlencode($row['user_type']);
        $user_type_id = urlencode($row['user_type_id']);
        $user_id = urlencode($row['user_id']);

        $user_type_lower = strtolower($user_type);
        switch ($user_type_lower) {
            case 'superadmin':
            case 'admin':
            case 'student':
                header("Location: /ams/views/home.php?user_type_id={$user_type_id}&user_type={$user_type}&user_id={$user_id}&username={$username}");
                exit;
            default:
                header("Location: /ams/views/index.php?error=Unknown user type.");
                exit;
        }
        exit;
    } else {
        $_SESSION['login_attempts']++;
        $_SESSION['last_attempt_time'] = time();
        header("Location: /ams/views/index.php?error=Invalid credentials.");
        exit;
    }
} else {
    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt_time'] = time();
    header("Location: /ams/views/index.php?error=Invalid credentials.");
    exit;
}

$stmt->close();
$conn->close();
