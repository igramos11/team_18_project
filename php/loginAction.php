<?php
require_once "config.php";
require_once 'functions.php';

session_start();

if (isset($_POST['uname']) && isset($_POST['psw'])) {
    $username = validate($_POST['uname']);
    $password = $_POST['psw'];

    $user = getUserByUsername($conn, $username); // Get the user by username

    if ($user === false) {
        header("Location: ../pages/login.php?invalid=true");
        exit();
    }

    // Verify the password
    $passwordCheck = password_verify($password, $user['Password']);

    if ($passwordCheck === false) {
        header("Location: ../pages/login.php?invalid=true");
        exit();
    }

    // If username and password are valid, start a new session and log the user in
    $_SESSION['login_user'] = $username;
    $_SESSION['user_id'] = $user['User_ID'];

    // Check if it's the user's first login and if so, direct them to completeProfile.php
    if ($user['first_login']) {
        // Update the 'first_login' flag in the database (assumes setFirstLoginFlag() is a function you've created)
        setFirstLoginFlag($conn, $username, false);
        header("Location: ../pages/completeProfile.php");
        exit();
    } else {
        // For successive logins, redirect to user dashboard
        header("Location: ../pages/userDashboard.php");
        exit();
    }
} else {
    header("Location: ../pages/login.php?invalid=true");
    exit();
}
?>

