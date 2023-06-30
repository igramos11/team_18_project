<!DOCTYPE html>

<?php
	include('../php/loginAction.php');
?>
<html>

<?php
    require_once "../php/config.php";
    $User_ID = $_SESSION['user_id'];
    $sql = "SELECT firstName, lastName, Address, APT, City, State, ZipCode, Username FROM `user` WHERE User_ID = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $User_ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Team 18</title>
    <link rel="stylesheet" type="text/css" href="../css/user.css">
    <link rel="stylesheet" type="text/css" href="../css/accountDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type="image/x-icon" href="../images/fuelpump.jpeg">
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <link rel="icon" type="image/png" href="../images/cs-logo.png">
</head>

<header>
    <a href="">
        <img src="../images/logo1.png">
    </a>
    <!-- Navbar Starts -->
    <nav>
        <ul>
            <li><a href="user.php">Home</a></li>
            <li>
                <div class="dropdown">
                    <a href="#" class="drop-btn">
                        Profile
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="#">Account Details</a>
                        <a href="../index.php">Log Out</a>
                    </div>
                </div>
            </li>

            <li><a href="orderHistory.php">Quote History</a></li>

            <li><a href="user.php#menu-section" class="order-btn btn btn-primary">Order Now</a></li>
        </ul>
    </nav>
    <!-- Navbar End -->
</header>

<body>
    <div class="grid-container">

        </div>
        <div class="document">
        <div class="grid-item">
            <form action="../php/accountDetailsAction.php" method="POST">
                <div class="grid-container2">
                    <h3>Personal Details</h3>
                    <div class="grid-item2">
                        <div class="flex-grid">
                            <div class="col">
                                <label for="First_name"><b><span class="required"></span>First name:</b></label>
                                <input type="text" name="First_name" id="First_name" maxlength="25" placeholder="<?php if ($row['First_name'])
                                                                                                                echo $row['First_name'];
                                                                                                            else echo 'Enter first name';?>" value="<?= $row['First_name']?>" required>

                                <label for="Last_name"><b><span class="required"></span>Last name:</b></label>
                                <input type="text" name="Last_name" id="Last_name" maxlength="25" placeholder="<?php if ($row['Last_name'])
                                                                                                                echo $row['Last_name'];
                                                                                                            else echo 'Enter last name';?>" value="<?= $row['Last_name']?>" required>

                            </div>
                            <div class="col">

                                <label for="Phone_number"><b>Phone number:</b></label>
                                <input type="text" name="Phone_number" id="Phone_number" placeholder="<?php if ($row['Phone_number'])
                                                                                                                echo $row['Phone_number'];
                                                                                                            else echo 'Enter phone number';?>" value=<?= $row['Phone_number']?>>

                                <label for="Email"><b>Email:</b></label>
                                <input type="text" name="Email" id="Email" placeholder="<?php if ($row['Email'])
                                                                                                echo $row['Email'];
                                                                                            else echo 'Enter Email';?>" value="<?= $row['Email']?>"> 

                            </div>
                        </div>
                    </div>
                    <h3>
                        <hr>Address
                    </h3>
                    <div class="grid-item2">
                        <div class="flex-grid">
                            <div class="col">
                                <label for="Adress_1"><b><span class="required"></span>Address 1:</b></label>
                                <input type="text" name="Address_1" id="Address_1" maxlength="100" placeholder="<?php if ($row['Address_1'])
                                                                                                                echo $row['Address_1'];
                                                                                                            else echo 'Enter your address';?>" value="<?= $row['Address_1']?>" required>
                                <label for="Adress_2"><b>Address 2:</b></label>
                                <input type="text" name="Address_2" id="Address_2" maxlength="100" pattern="\d{0,100}" placeholder="<?php if ($row['Address_2'])
                                                                                                                echo $row['Address_2'];
                                                                                                            else echo 'Enter your address';?>" value=<?= $row['Address_2']?>>
                                
                                <label for="APT"><b>APT:</b></label>
                                <input type="text" name="APT" id="APT" placeholder="<?php if ($row['APT'])
                                                                                                echo $row['APT'];
                                                                                            else echo 'Enter APT';?>" value="<?= $row['APT']?>" required> 

                                
                            

                            </div>
                            <div class="col">
                                <label for="City"><b><span class="required"></span>City:</b></label>
                                <input type="text" name="City" id="City" maxlength="100" placeholder="<?php if ($row['City'])
                                                                                                echo $row['City'];
                                                                                            else echo 'Enter city';?>" value="<?= $row['City'] ?>" >
                                
                                <label for="State"><b><span class="required"></span>State:</b></label>
                                
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

                                <label for="Zip"><b><span class="required"></span>ZIP code:</b></label>
                                <div class="zip-container">
                                    <input type="text" name="zip_code" required pattern="\d{5}" maxlength="5" placeholder="<?php if ($row['zip_code'])
                                                                                                                echo $row['zip_code'];
                                                                                                            else echo 'Enter zip';?>" value=<?= $row['zip_code']?>>
                                    <span>-</span>
                                    <input type="text" name="zip_code_extension" pattern="\d{0,4}" maxlength="4" placeholder="<?php if ($row['zip_code'])
                                                                                                                echo $row['zip_code'];
                                                                                                            else echo 'optional';?>" value=<?= $row['zip_code']?>>
                            </div>
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

</html>