<?php
require_once "config.php";
require_once 'functions.php';

session_start();

if (isset($_POST['uname']) && isset($_POST['psw'])) {
    $username = validate($_POST['uname']);
    $password = $_POST['psw']; // We don't hash this password here

    $user = getUserByUsername($conn, $username); // Get the user by username

    if ($user === false) {
        header("Location: ../pages/login.php?invalid=username");
        exit();
    }

    // Verify the password
    $passwordCheck = password_verify($password, $user['Password']); 

    if ($passwordCheck === false) {
        header("Location: ../pages/login.php?invalid=password");
        exit();
    }

    // If password is valid, start a new session and log the user in
    $_SESSION['login_user'] = $username;
    $_SESSION['user_id'] = $user['User_ID'];

    header("Location: ../pages/formCompleteProfile.php");
    exit();
} else {
    header("Location: ../pages/login.php?invalid=true");
    exit();
}
// @codeCoverageIgnoreEnd
?>
