<?php
$host = "localhost";
$dbname = "ams";
$username = "root";
$password = ""; 

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$users = [
    [1, 'superadmin', 'Sup3rSecure!', 'amigo.marieneth@gmail.com', 'superadmin', 1],
    [2, 'AdminNikki', 'Adm1nPass123!', 'nadmardoquio12@gmail.com', 'admin', 2],
    [3, 'AdminDennis', 'Adm1nPass456!', 'dennis.mardoquio@victory.org.ph', 'admin', 2]
];

$sql = "INSERT INTO users (user_id, username, password, email, user_type, user_type_id, remember_token)
        VALUES (?, ?, ?, ?, ?, ?, NULL)";
$stmt = $conn->prepare($sql);

foreach ($users as $user) {
    $hashedPassword = password_hash($user[2], PASSWORD_BCRYPT);
    $stmt->bind_param("issssi", $user[0], $user[1], $hashedPassword, $user[3], $user[4], $user[5]);
    $stmt->execute();
}

echo "Users inserted successfully!";
$stmt->close();
$conn->close();
?>
