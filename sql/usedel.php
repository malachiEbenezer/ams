<?php
$host = "localhost";
$dbname = "ams";
$username = "root";
$password = ""; 

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id_to_delete = 1;
//$user_id_to_delete = $_GET['user_id']; // or use POST for more security

// Fetch the user_type
$sql = "SELECT user_type FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id_to_delete);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && $row['user_type'] === 'superadmin') {
    echo "🚫 Superadmin cannot be deleted!";
} else {
    $deleteSql = "DELETE FROM users WHERE user_id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $user_id_to_delete);
    $deleteStmt->execute();
    echo "✅ User deleted successfully!";
}

?>