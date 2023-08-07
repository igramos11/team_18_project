<?php
// Start the session
session_start();

// Check if the user is logged in and the user ID is set
if (!isset($_SESSION['login_user']) || !isset($_SESSION['user_id'])) {
    // If not, redirect to the login page or any other appropriate action
    header('Location: login.php');
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = trim($_POST['email']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $address = trim($_POST['Address']);
    $apt = trim($_POST['APT']);
    $city = trim($_POST['City']);
    $state = trim($_POST['State']);
    $zipCode = trim($_POST['ZipCode']);
    $profitMargin = trim($_POST['profitMargin']);


    // Validate the form data
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phoneNumber) || empty($address) || empty($city) || empty($state) || empty($zipCode) || empty($profitMargin)) {
        // Redirect back to form with error message
        header("Location: completeProfile.php?error=emptyfields");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If email is not valid
        header("Location: completeProfile.php?error=invalidemail");
        exit();
    }
    // Add more validation rules here as needed...

    // Access the user ID from the session variable
    $userId = $_SESSION['user_id'];

    // Insert the additional user information into the database (example using prepared statements)
    require_once "config.php";
    $stmt = $conn->prepare("UPDATE user SET firstName = ?, lastName = ?, email = ?, phoneNumber = ?, Address = ?, APT = ?, City = ?, State = ?, ZipCode = ?, profitMargin = ? WHERE User_ID = ?");
    $stmt->bind_param("sssssssssdi", $firstName, $lastName, $email, $phoneNumber, $address, $apt, $city, $state, $zipCode, $profitMargin, $userId);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Redirect to a success page or any other appropriate action
    header('Location: ../pages/UserDashboard.php');
    exit;
}
?>
