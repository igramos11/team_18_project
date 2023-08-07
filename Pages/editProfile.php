
<!DOCTYPE html>
<html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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

// If logout is requested, destroy the session and redirect to the current page
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $Address = $_POST['Address'];
    $APT = $_POST['APT'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $ZipCode = $_POST['ZipCode'];
    $Email = $_POST['email'];
    $Username = $_POST['Username'];
    $profitMargin = $_POST['profitMargin'] / 100;

    if (!empty($_POST['Password']) && $_POST['Password'] == $_POST['RePassword']) {
        $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); // remember to hash your passwords!
        // If so, also update the password
        $updateStmt = $conn->prepare("UPDATE user SET firstName = ?, lastName = ?, phoneNumber = ?,  Address = ?, APT = ?,  City = ?, State = ?, ZipCode = ?, email = ?, Username = ?, Password = ?, profitMargin = ? WHERE User_ID = ?");
        $updateStmt->bind_param("sssssssssssi", $firstName, $lastName, $phoneNumber, $Address, $APT, $City, $State, $ZipCode, $Email, $Username, $Password, $profitMargin, $userId);
    } else {
        // If not, only update other user data
        $updateStmt = $conn->prepare("UPDATE user SET firstName = ?, lastName = ?, phoneNumber = ?,  Address = ?, APT = ?,  City = ?, State = ?, ZipCode = ?, email = ?, Username = ?, profitMargin = ? WHERE User_ID = ?");
        $updateStmt->bind_param("sssssssssssi", $firstName, $lastName, $phoneNumber, $Address, $APT, $City, $State, $ZipCode, $Email, $Username, $profitMargin, $userId);
    }
    
    if($updateStmt->execute()){
        //if the update is successful, it will refresh the page
        header('Location: ' . $_SERVER['PHP_SELF'].'?updated=true');
        exit;
    }
    
    
        // Fetch the updated user data
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        }
        $stmt->close();

    // Check if a new password has been provided
    if (!empty($_POST['Password']) && strlen($_POST['Password']) >= 8 && $_POST['Password'] == $_POST['RePassword']) {
    // Rest of the code...
    }

    
    }
    
    $conn->close();
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
                <li><a href="../index.php">Home</a></li>
                <li><a href="userDashboard.php">User Dashboard</a></li>
                <li><a href="orderHistory.php">Quote History</a></li>
                <li><a href="user.php">Request New Quote</a></li>
                <?php if (isset($_SESSION['login_user'])) { ?>
                                <li><a href="?logout">Logout</a></li>
                            <?php } ?>
                        </div>
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
<span style="font-weight: 600">Username:</span><br>
<?php echo '@' . (isset($user['Username']) ? htmlspecialchars($user['Username']) : ''); ?></p>
<p><span style="font-weight: 600">Phone Number:</span><br>
<?php echo (isset($user['phoneNumber']) ? htmlspecialchars($user['phoneNumber']) : ''); ?></p>
<p><span style="font-weight: 600">Shipping Address:</span><br>
<?php echo (isset($user['Address']) ? htmlspecialchars($user['Address']) : '');
if(isset($user['APT'])) {
    echo htmlspecialchars($user['APT']) . ', ';
}
echo (isset($user['City']) ? htmlspecialchars($user['City']) : '') . ', ' . (isset($user['State']) ? htmlspecialchars($user['State']) : '') . ', ' . (isset($user['ZipCode']) ? htmlspecialchars($user['ZipCode']) : ''); ?>
</p>


        </div>
        <div class="grid-item">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="grid-container2">
                <h2 id="about">Edit your profile information below: </h2>
                <?php
                    if (isset($_GET["updated"])) {
                        echo "<style> .updated {color: green; text-align: center;}</style><p class='updated'>Profile successfully updated!</p>";
                    }
                ?>

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
                                <input type="text" name="ZipCode" required value="<?php echo isset($user['ZipCode']) ? $user['ZipCode'] : ''; ?>">

                            </div>
                            <div class="col">
                                <label for="City"><b>City:</b></label>
                                <input type="text" name="City" required value="<?php echo isset($user['City']) ? $user['City'] : ''; ?>">

                                <label for="State"><b>State:</b></label>
                                <input type="text" name="State" required value="<?php echo isset($user['State']) ? $user['State'] : ''; ?>">

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
                                <div class="col">
                                <label for="email"><b>*Email: </b><i style="font-size: 14px">Required</i></label>
                                <input type="email" name="email" required value="<?php echo isset ($user['email']) ? $user['email'] : '';?> ">
                                </div>
                                <div class="col">
                                <label for="profitMargin"><b>Company Profit Margin (%): </b><i style="font-size: 14px"></i></label>
                                <input type="range" name="profitMargin" min="0" max="100" step="0.01" value="<?php echo isset($user['profitMargin']) ? $user['profitMargin'] * 100 : ''; ?>">
                                <span id="profitMarginValue"><?php echo isset($user['profitMargin']) ? $user['profitMargin'] : '0'; ?>%</span>

                            </div>

                            </div>

                            <div class="col">
                                <label for="Password"><b>Password: </b><i style="font-size: 14px">(fill only if you want to change your password)</i></label>
                                <input type="password" name="Password" id="Password" placeholder="Enter new password" onkeyup="matchPasswords()" minlength="8">


                                <label for="RePassword"><b>Re-enter Password: </b><i style="font-size: 14px">(fill only if you want to change your password)</i></label>
                                <input type="password" name="RePassword" id="RePassword" placeholder="Re-enter new password" oninput="matchPasswords()" minlength="8">

                                <div id="confirmPassword">❗ Passwords do not match.</div>
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
                    <button id="cancel" type="button" onclick="location.href='userDashboard.php';">Cancel</button>
                    <button id="update" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
   function matchPasswords() {
    var pass = document.getElementById('Password').value;
    var confirmPass = document.getElementById('RePassword').value;
    
    if (pass == '' || (pass == confirmPass && pass.length >= 8)) {
        document.getElementById('update').disabled = false;
        document.getElementById('update').style = "cursor: pointer";
        document.getElementById('confirmPassword').style.display = "none";
    } else if (pass.length < 8) {
        document.getElementById('update').disabled = true;
        document.getElementById('update').style = "cursor: not-allowed";
        document.getElementById('confirmPassword').innerHTML = "❗ Password must be a minimum of 8 characters.";
        document.getElementById('confirmPassword').style.display = "block";
    } else {
        document.getElementById('update').disabled = true;
        document.getElementById('update').style = "cursor: not-allowed";
        document.getElementById('confirmPassword').innerHTML = "❗ Passwords do not match.";
        document.getElementById('confirmPassword').style.display = "block";
    }
}

document.getElementsByName('profitMargin')[0].oninput = function() {
    document.getElementById('profitMarginValue').innerText = this.value + "%";
}



    
</script>

</html>
