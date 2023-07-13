<?php
require_once "config.php";
require_once 'functions.php';

$Username = $_POST['Username'];
$Password = $_POST['Password']; // Retrieve the password without hashing it

// Check if a user with this username already exists
$stmt = $conn->prepare("SELECT * FROM user WHERE Username = ?");
$stmt->bind_param("s", $Username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If a user with this username exists, redirect back to the login page with an error parameter
    header('Location: ../pages/login.php?error=usernameExists');
    exit;
}

$stmt->close();

// If the username doesn't exist, continue with the registration process...
// Hash the password before storing it in the database
$hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO user (Username, Password) VALUES (?, ?)");
$stmt->bind_param("ss", $Username, $hashedPassword);

if ($stmt->execute()) {
    // Registration successful, redirect to login page
    header('Location: ../pages/login.php?created=true');
    exit;
}

else {
    // Registration failed, handle the error
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();


?>