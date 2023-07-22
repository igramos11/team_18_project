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

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team 18 Complete Profile page</title>
    <link rel="stylesheet" type="text/css" href="../css/accountDetails.css">

    <script>
    window.onload = function() {
        const requiredFields = [
            'firstName',
            'lastName',
            'phoneNumber',
            'Address',
            'ZipCode',
            'City',
            'State',
            'Username',
            'email'
            'proftiMargin'
        ];

        let form = document.querySelector('form');

        form.addEventListener('input', function () {
            let isFormValid = requiredFields.every(function (fieldId) {
                let field = document.querySelector(`input[name=${fieldId}]`);
                return field && field.value;
            });

            document.querySelector('#completeProfile').disabled = !isFormValid;
        });
    }
</script>

</head>

<header>
    <a href="">
        <img src="../images/logo1.png">
    </a>
    <!-- Navbar Starts -->
    <nav>
        <ul>
           
        </ul>
    </nav>
    <!-- Navbar End -->
</header>

<body>
    <div class="grid-container">

        </div>
        <div class="welcome-message">
            <h2>Please complete your user profile.</h2>
        </div>
        <div class="document">
        <div class="grid-item">
            <form action="../php/completeProfileAction.php" method="POST">
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
                                <input type="text" name="phoneNumber" required placeholder="<?php echo (isset($user['phoneNumber']) && $user['phoneNumber'] != '') ? $user['phoneNumber'] : 'Enter phone number'; ?>" value="<?php echo (isset($user['phoneNumber']) && $user['phoneNumber'] != '') ? $user['phoneNumber'] : ''; ?>">

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
                                <label for="Username"><b>*Username: </b><i style="font-size: 14px"></i></label>
                                <input type="text" name="Username" required value="<?php echo isset($user['Username']) ? htmlspecialchars($user['Username']) : ''; ?>">

                            <div class="col">
                                <label for="email"><b>*Email: </b><i style="font-size: 14px"></i></label>
                                <input type="email" name="email" required value="<?php echo isset ($user['email']) ? $user['email'] : '';?> ">
                            </div>

                            <div class="col">
                                <label for="profitMargin"><b>Company Profit Margin: </b><i style="font-size: 14px"></i></label>
                                <input type="number" name="profitMargin" step="0.01" min="0" value="<?php echo isset($user['profitMargin']) ? $user['profitMargin'] : ''; ?>">
                            </div>

                            </div>

                            <div class="col">
                                <label for="Password"><b>Password: </b><i style="font-size: 14px">(fill only if you want to change your password)</i></label>
                                <input type="password" name="Password" id="Password" placeholder="Enter new password" onkeyup="matchPasswords()">

                                <label for="RePassword"><b>Re-enter Password: </b><i style="font-size: 14px">(fill only if you want to change your password)</i></label>
                                <input type="password" name="RePassword" id="RePassword" placeholder="Re-enter new password" onkeyup="matchPasswords()">
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
                    <button id="completeProfile" type="submit">Complete Profile</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>