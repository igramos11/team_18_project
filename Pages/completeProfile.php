<!DOCTYPE html>
<html>

<?php
    require_once "../php/config.php";
    require_once "../php/functions.php";
   


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
    <title>Team 18 Complete Profile page</title>
    <link rel="stylesheet" type="text/css" href="../css/accountDetails.css">
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
            <h2>Welcome! Please complete your user profile.</h2>
        </div>
        <div class="document">
        <div class="grid-item">
            <form action="../php/completeProfileAction.php" method="POST">
                <div class="grid-container2">
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
                        <button id="update" type="submit">Complete Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>