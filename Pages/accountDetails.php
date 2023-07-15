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
    <link rel="stylesheet" type="text/css" href="../css/accountDetails.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
</head>

<header>
    <a href="user.php">
        <img src="../images/fuelpump.jpeg">
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
                        <!-- <a href="#">Profile Management</a> -->
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
        <div class="grid-item aboutInfo">
            <h2 class="name"><?php echo $row['firstName'] . ' ' . $row['lastName']?></h2>
            <p id="displayEmail"><?php echo $row['email']?></p>
            <h2 id="about">About</h2>
            <p><?php echo '@' . $row['Username']?></p>
            <p><?php echo '<b>Phone: </b>'. $row['phoneNumber']?></p>
            <p><span style="font-weight: 600">Shipping Address:</span><br>
            <?php echo $row['Address'] . ', ';
            if($row['APT']) {
                echo $row['APT'] . ', ';
            }
            echo $row['City'] . ', ' . $row['State'] . ', ' . $row['zipCode']?>
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
                                <input type="text" name="firstName" id="firstName" required value="<?= $row['firstName'] ?>" value=<?= $row['firstName'] ?> >

                            </div>
                            <div class="col">
                                <label for="lastName"><b>Last name:</b></label>
                                <input type="text" name="lastName" id="lastName" placeholder="<?= $row['lastName'] ?>" value=<?= $row['lastName'] ?> >

                                <label for="phoneNumber"><b>Phone number:</b></label>
                                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="<?php if ($row['phoneNumber'])
                                                                                                                echo $row['phoneNumber'];
                                                                                                            else echo 'Enter phone number';?>" value=<?= $row['phoneNumber']?>>
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
                                <input type="text" name="Address" id="Address" placeholder="<?= $row['Address'] ?>" value="<?= $row['Address'] ?>">

                                <label for="APT"><b>APT:</b></label>
                                <input type="text" name="APT" id="APT" placeholder="<?php if ($row['APT'])
                                                                                                echo $row['APT'];
                                                                                            else echo 'Enter APT';?>" value="<?= $row['APT'] ?>" >

                                <label for="Zip"><b>Zipcode:</b></label>
                                <input type="text" name="Zipcode" id="Zipcode" placeholder="<?= $row['Zipcode'] ?>" value=<?= $row['Zipcode'] ?>>
                            </div>
                            <div class="col">
                                <label for="City"><b>City:</b></label>
                                <input type="text" name="City" id="City" placeholder="<?= $row['City'] ?>" value=<?= $row['City'] ?>>

                                <label for="State"><b>State:</b></label>
                                <input type="text" name="State" id="State" placeholder="<?= $row['State'] ?>" value=<?= $row['State'] ?>>
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
                                <input type="text" name="Username" id="Username" placeholder="<?= $row['Username'] ?>" value =<?= $row['Username'] ?> required>
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