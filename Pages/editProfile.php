
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

    <body>
    <div class="grid-container">
        <div class="grid-item aboutInfo">
        <h2 class="name"><?php echo isset($user['firstName']) ? htmlspecialchars($user['firstName']) . ' ' . htmlspecialchars($user['lastName']) : ''; ?></h2>
<p id="displayEmail"><?php echo isset($user['email']) ? htmlspecialchars($user['email']) : ''; ?></p>
<h2 id="about">About</h2>
<p><?php echo '@' . (isset($user['Username']) ? htmlspecialchars($user['Username']) : ''); ?></p>
<p><?php echo '<b>Phone: </b>'. (isset($user['phoneNumber']) ? htmlspecialchars($user['phoneNumber']) : ''); ?></p>
<p><span style="font-weight: 600">Shipping Address:</span><br>
<?php echo (isset($user['Address']) ? htmlspecialchars($user['Address']) : '');
if(isset($user['APT'])) {
    echo htmlspecialchars($user['APT']) . ', ';
}
echo (isset($user['City']) ? htmlspecialchars($user['City']) : '') . ', ' . (isset($user['State']) ? htmlspecialchars($user['State']) : '') . ', ' . (isset($user['zipCode']) ? htmlspecialchars($user['zipCode']) : ''); ?>
</p>


        </div>
        <div class="grid-item">
            <form action="../php/accountDetailsAction.php" method="POST">
                <div class="grid-container2">
                    <h3>Personal Details</h3>
                    <div class="grid-item2">
                        <div class="flex-grid">
                            <div class="col">
                                <label for="firstName"><b>First name:</b></label>
                                <input type="text" name="firstName" required value="<?php echo isset($user['firstName']) ? htmlspecialchars($user['firstName']) : ''; ?>">
                            </div>
                            <div class="col">
                                <label for="lastName"><b>Last name:</b></label>
                                <input type="text" name="lastName" required value="<?php echo isset($user['lastName']) ? $user['lastName'] : ''; ?>">

                                <label for="phoneNumber"><b>Phone number:</b></label>
                                <input type="text" name="phoneNumber" placeholder="<?php echo (isset($user['phoneNumber']) && $user['phoneNumber'] != '') ? $user['phoneNumber'] : 'Enter phone number'; ?>" value="<?php echo (isset($user['phoneNumber']) && $user['phoneNumber'] != '') ? $user['phoneNumber'] : ''; ?>">

                            </div>
                        </div>
                    </div>
                    <h3>
                        <hr>Address
                    </h3>
                    <div class="grid-item2">
                        <div class="flex-grid">
                            <div class="col">
                                <label for="Address"><b>Street address:</b></label>
                                <input type="text" name="Address" required value="<?php echo isset($user['Address']) ? $user['Address'] : ''; ?>">

                                <label for="APT"><b>APT:</b></label>
                                <input type="text" name="APT" id="APT" placeholder="<?php if ($user['APT'])
                                                                                                echo $user['APT'];
                                                                                            else echo 'Enter APT';?>" value="<?= $user['APT'] ?>" >

                                <label for="Zip"><b>Zipcode:</b></label>
                                <input type="text" name="zipCode" required value="<?php echo isset($user['ZipCode']) ? $user['ZipCode'] : ''; ?>">

                            </div>
                            <div class="col">
                                <label for="City"><b>City:</b></label>
                                <input type="text" name="City" required value="<?php echo isset($user['City']) ? $user['City'] : ''; ?>">

                                <label for="State"><b>State:</b></label>
                                <input type="text" name="state" required value="<?php echo isset($user['State']) ? $user['State'] : ''; ?>">

                            </div>
                        </div>
                    </div>
                    <h3>
                        <hr>Account Details
                    </h3>
                    <div class="grid-item2">
                        <div class="flex-grid">
                            <div class="col">
                                <label for="Username"><b>*Username: </b><i style="font-size: 14px">Required</i></label>
                                <input type="text" name="Username" id="Username" placeholder="<?= $user['Username'] ?>" value =<?= $user['Username'] ?> required>
                            </div>
                            <div class="col">
                                <label for="Password"><b>*Password: </b><i style="font-size: 14px">Required</i></label>
                                <input type="password" name="Password" id="Password" placeholder="Enter password" onkeyup="matchPasswords()" required>

                                <label for="RePassword"><b>*Re-enter Password: </b><i style="font-size: 14px">Required</i></label>
                                <input type="password" name="RePassword" id="RePassword" placeholder="Enter password" onkeyup="matchPasswords()" required>
                                <div id="confirmPassword">❗ Passwords do not match.</div>

                                <input type="hidden" name="User_ID" value=<?= $_SESSION['user_id'] ?>>
                            </div>
                        </div>
                    </div>
                    <h3>
                        <hr>
                        <?php
                        if (isset($_GET["invalid"])) {
                            if ($_GET["invalid"] == "email") {
                                echo "<style> .invalid {color: red; text-align: center;}</style><p class='invalid'>Email already exists for another user. Please try again.</p>";
                            }
                            if ($_GET["invalid"] == "username") {
                                echo "<style> .invalid {color: red; text-align: center;}</style><p class='invalid'>Username already exists for another user. Please try again.</p>";
                            }
                        }

                        if (isset($_GET["created"])) {
                            echo "<style> .invalid {color: green; text-align: center;}</style><p class='invalid'>Account successfully updated!</p>";
                        }
                        ?>
                    </h3>
                    <div class="grid-item2 buttons">
                        <button id="cancel" onclick="location.href='user.php';">Cancel</button>
                        <button id="update" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    function matchPasswords() {
        if (document.getElementById('Password').value ==
            document.getElementById('RePassword').value) {
            document.getElementById('update').disabled = false;
            document.getElementById('update').style = "cursor: pointer";
            document.getElementById('confirmPassword').style.display = "none";
        } else {
            document.getElementById('update').disabled = true;
            document.getElementById('update').style = "cursor: not-allowed";
            document.getElementById('confirmPassword').style.display = "block";
        }
    }
</script>

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