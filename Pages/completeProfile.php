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
<<<<<<< HEAD
=======

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

>>>>>>> cd4035980c59e7130f7ba455a54f2747495162c7
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
<<<<<<< HEAD
            <h2>Welcome! Please complete your user profile.</h2>
=======
            <h2>Please complete your user profile.</h2>
>>>>>>> cd4035980c59e7130f7ba455a54f2747495162c7
        </div>
        <div class="document">
        <div class="grid-item">
            <form action="../php/completeProfileAction.php" method="POST">
                <div class="grid-container2">
<<<<<<< HEAD
                    <h3>Personal Details</h3>
                    <div class="grid-item2">
                        <div class="flex-grid">
                            <div class="col">
                                <label for="firstName"><b><span class="required"></span>First name:</b></label>
                                <input type="text" name="firstName" id="firstName" maxlength="25" placeholder="<?php if ($row['firstName'])
                                                                                                                echo $row['firstName'];
                                                                                                            else echo 'Enter first name';?>" value="<?= $row['firstName']?>" required>

                                <label for="lastName"><b><span class="required"></span>Last name:</b></label>
                                <input type="text" name="lastName" id="lastName" maxlength="25" placeholder="<?php if ($row['lastName'])
                                                                                                                echo $row['lastName'];
                                                                                                            else echo 'Enter last name';?>" value="<?= $row['lastName']?>" required>

                            </div>
                            <div class="col">

                                <label for="phoneNumber"><b>Phone number:</b></label>
                                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="<?php if ($row['phoneNumber'])
                                                                                                                echo $row['phoneNumber'];
                                                                                                            else echo 'Enter phone number';?>" value=<?= $row['phoneNumber']?>>

                                <label for="email"><b>Email:</b></label>
                                <input type="text" name="email" id="email" placeholder="<?php if ($row['email'])
                                                                                                echo $row['email'];
                                                                                            else echo 'Enter Email';?>" value="<?= $row['email']?>"> 
=======
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
>>>>>>> cd4035980c59e7130f7ba455a54f2747495162c7

                            </div>
                        </div>
                    </div>
                    <h3>
                        <hr>Address
                    </h3>
                    <div class="grid-item2">
                        <div class="flex-grid">
                            <div class="col">
<<<<<<< HEAD
                                <label for="Adress_1"><b><span class="required"></span>Address 1:</b></label>
                                <input type="text" name="Address" id="Address" maxlength="100" placeholder="<?php if ($row['Address'])
                                                                                                                echo $row['Address'];
                                                                                                            else echo 'Enter your address';?>" value="<?= $row['Address']?>" required>
                                <label for="Adress_2"><b>Address 2:</b></label>
                                <input type="text" name="Address_2" id="Address_2" maxlength="100" pattern="\d{0,100}" placeholder="<?php if ($row['Address_2'])
                                                                                                                echo $row['Address_2'];
                                                                                                            else echo 'Enter your address';?>" value=<?= $row['Address_2']?>>
                                
                                <label for="APT"><b>APT:</b></label>
                                <input type="text" name="APT" id="APT" placeholder="<?php if ($row['APT'])
                                                                                                echo $row['APT'];
                                                                                            else echo 'Enter APT';?>" value="<?= $row['APT']?>" optional> 

                                
                            

                            </div>
                            <div class="col">
                                <label for="City"><b><span class="required"></span>City:</b></label>
                                <input type="text" name="City" id="City" maxlength="100" placeholder="<?php if ($row['City'])
                                                                                                echo $row['City'];
                                                                                            else echo 'Enter city';?>" value="<?= $row['City'] ?>" >
                                
                                <label for="State"><b><span class="required"></span>State:</b></label>
                                <select id="State" name="State" required>
                                <select>
                                    <option value="">Select a state</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                    </select>
                                </div>

                                <div class="col"> <!-- Start a new 'col' division for the Zip code -->
    <label for="Zip"><b><span class="required"></span>Zip Code:</b></label>
    <div class="zip-container">
        <input type="text" name="ZipCode" required pattern="\d{5}" maxlength="5" width= 50% placeholder="<?php if ($row['ZipCode'])
                                                                                    echo $row['ZipCode'];
                                                                                else echo 'Enter zip';?>" value=<?= $row['ZipCode']?>>
        <span> - </span>
        <input type="text" name="zip_code_extension" pattern="\d{0,4}" maxlength="4" placeholder="<?php if ($row['ZipCode'])
                                                                                    echo $row['ZipCode'];
                                                                                else echo 'optional';?>" value=<?= $row['ZipCode']?>>
    </div>
</div>

                                
                    </div>
        </div>
                
=======
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
>>>>>>> cd4035980c59e7130f7ba455a54f2747495162c7
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
<<<<<<< HEAD
                        <button id="cancel" onclick="location.href='user.php';">Cancel</button>
                        <button id="update" type="submit">Complete Profile</button>
=======
                    <button id="completeProfile" type="submit">Complete Profile</button>

>>>>>>> cd4035980c59e7130f7ba455a54f2747495162c7
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>