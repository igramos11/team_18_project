<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    // If not, redirect to the login page
    header('Location: ../pages/login.php');
    exit;
}

require_once "config.php";

$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM user WHERE User_ID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}

$stmt->close();
$conn->close();

// If we get here, the user is logged in
// You can access their username with $_SESSION['login_user']
// And their user ID with $_SESSION['user_id']

echo '<p style="font-size: 20px; font-weight: bold;">Welcome, ' . htmlspecialchars($_SESSION['login_user']) . '!</p>';
?>