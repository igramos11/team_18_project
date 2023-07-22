
<!DOCTYPE html>
<html>

<?php
require_once "../php/config.php";
require_once "../php/functions.php";
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    // If not, redirect to the login page
    header('Location: ../pages/login.php');
    exit;
}

echo '<p style="font-size: 20px; font-weight: bold;">Welcome, ' . htmlspecialchars($_SESSION['login_user']) . '!</p>';




$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM user WHERE User_ID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}


?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team 18 Edit Profile Page</title>
    <link rel="stylesheet" type="text/css" href="../css/user.css">
    <link rel="stylesheet" type="text/css" href="../css/accountDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type="image/x-icon" href="../images/fuelpump.jpeg">
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
</head>

    <header>
        <!-- Navbar Starts -->
        <nav>
            <ul>
                <li><a href="userDashboard.php">Home</a></li>
                <li>
                    <div class="dropdown">
                        <a href="#" class="drop-btn">
                            Profile
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-content">
                            <a href="#">Account Details</a>
                            <?php if (isset($_SESSION['login_user'])) { ?>
                                <li><a href="?logout">Logout</a></li>
                            <?php } ?>
                        </div>
                    </div>
                </li>
                <li><a href="orderHistory.php">Quote History</a></li>
                <li><a href="orderHistory.php">Log Out</a></li>
            </ul>
        </nav>
        <!-- Navbar End -->
    </header>

    <div class="container">
        <div class="form-container">
            <h1>Edit Your Profile</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" required value="<?php echo isset($user['firstName']) ? htmlspecialchars($user['firstName']) : ''; ?>">


                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" required value="<?php echo isset($user['lastName']) ? $user['lastName'] : ''; ?>">

                <label for="email">Email:</label>
                <input type="text" name="email" required value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>">

                <label for="phoneNumber">Phone Number:</label>
                <input type="text" name="phoneNumber" required value="<?php echo isset($user['phoneNumber']) ? $user['phoneNumber'] : ''; ?>">

                <label for="address">Address:</label>
                <input type="text" name="Address" required value="<?php echo isset($user['Address']) ? $user['Address'] : ''; ?>">

                <label for="APT">APT:</label>
                <input type="text" name="APT"  value="<?php echo isset($user['APT']) ? $user['APT'] : ''; ?>">

                <label for="city">City:</label>
                <input type="text" name="City" required value="<?php echo isset($user['City']) ? $user['City'] : ''; ?>">

                <label for="state">State:</label>
                <input type="text" name="state" required value="<?php echo isset($user['State']) ? $user['State'] : ''; ?>">

                <label for="zipCode">Zip Code:</label>
                <input type="text" name="zipCode" required value="<?php echo isset($user['ZipCode']) ? $user['ZipCode'] : ''; ?>">

                <button type="submit">Update Profile</button>
            </form>
        </div>
    </div>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $Address = $_POST['Address'];
    $APT = $_POST['APT'];
    $City = $_POST['city'];
    $State = $_POST['state'];
    $ZipCode = $_POST['zipCode'];

    $updateStmt = $conn->prepare("UPDATE user SET firstName = ?, lastName = ?, email = ?, phoneNumber = ?,  Address = ?, APT = ?,  City = ?, State = ?, ZipCode = ? WHERE User_ID = ?");
    $updateStmt->bind_param("ssssssi", $firstName, $lastName, $email, $phoneNumber, $Address, $APT, $City, $State,  $ZipCode, $userId);
    $updateStmt->execute();

    // Fetch the updated user data
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
}

$stmt->close();
$conn->close();
?>
</html>