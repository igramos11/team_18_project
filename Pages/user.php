<!DOCTYPE html>
<?php
    require_once "../php/functions.php";
    require_once "../php/config.php";

    session_start();

    if (!isset($_SESSION['login_user'])) {
        header('Location: ../pages/login.php');
        exit;
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    echo '<p style="font-size: 20px; font-weight: bold;">Welcome, ' . htmlspecialchars($_SESSION['login_user']) . '!</p>';

    $UserId = $_SESSION['user_id'];
    $sql = "SELECT * FROM `user` WHERE User_ID = '$UserId'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row=mysqli_fetch_assoc($result);
    $Address=$row['Address'];
    $City=$row['City'];
    $State=$row['State'];
    $ZipCode=$row['ZipCode'];
    $profitMargin=$row['profitMargin'] * 100;

    if(isset($_POST['submit'])){
        $UserId = $_SESSION['user_id'];
        $User = $UserId;
        $Address=$_POST['Address'];
        $City=$_POST['City'];
        $State=$_POST['State'];
        $ZipCode=$_POST['ZipCode'];
        $Gallons = $_POST['Gallons'];
        if (!$Gallons || $Gallons <= 0) {
            $_SESSION['flash'] = "Invalid Gallons entered. Please enter a number greater than 0.";
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
        $Date = filter_input(INPUT_POST, 'Date', FILTER_SANITIZE_STRING);

        $profitMargin = $_POST['profitMargin'];
        $Order_total = CalculateTotal($conn, $Gallons, $User_ID, $State, $profitMargin);

        $stmt = $conn->prepare("INSERT INTO `orders` (User_ID, Address, City, State, ZipCode, Gallons, Order_total, Date, profitMargin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if (!empty($conn->error_list)) {
            print_r($conn->error_list);
        }
        $stmt->bind_param("issssiisd", $User, $Address, $City, $State, $ZipCode, $Gallons, $Order_total, $Date, $profitMargin);
        $stmt->execute();
        $_SESSION['flash'] = "Your order has been submitted. Check the Quote History tab to view your order history.";
        $Order_ID = $stmt->insert_id;
        $stmt->close();
    }
?>


<html lang="en">
<style>
    .menu-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .input_box{
        display: block;
        border-radius: 50px;
        border: 2px solid;
        border-color: black;
	    padding: 20px; 
        width: 200px;
        height: 15px;    
        margin: auto;
    }

    .block {
        display: block;
        width: 15%;
        border: none;
        border-radius: 5px;
        background-color: grey;
        color: white;
        padding: 14px 28px;
        cursor: pointer;
        text-align: center;
        margin: 10px auto;
	}
    .flash-message {
        background-color: #dff0d8;
        border-color: #d0e9c6;
        color: #3c763d;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    
</style>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Team 18 Order a Quote Page</title>

	<!-- Link to css file -->
	<link rel="stylesheet" type="text/css" href="../css/main_page.css">
    <link rel="stylesheet" type="text/css" href="../css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="icon" type="image/x-icon" href="../images/fuelpump.jpeg">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body id="top">
    <?php
    if (isset($_SESSION['flash'])) {
        echo '<div class="flash-message">' . $_SESSION['flash'] . '</div>';
        unset($_SESSION['flash']);
    }
    ?>
	<header>
		<a href="">
			<img src="../images/logo1.png">
		</a>
		<!-- Navbar Starts -->
		<nav>
			<ul>
            <li><a href="../index.php">Home</a></li>
                <li><a href="userDashboard.php">User Dashboard</a></li>
                <li><a href="editProfile.php">Edit Profile</a></li>
                <li><a href="orderHistory.php">Quote History</a></li>
                <?php if (isset($_SESSION['login_user'])) { ?>
                                <li><a href="?logout">Logout</a></li>
                            <?php } ?>
                        </div>

			</ul>
		</nav>
		<!-- Navbar End -->
	</header>
	
	<!-- Search Section Starts Here -->
	<section class="food-search text-center" style="background-image: url(../images/refinery.jpeg);">
		<span class="food-search">
		<h1 style="background-color: transparent;">Fuel Quote</h1>
		</span>
	</section>
	<!-- Search Section Ends Here -->

	<!-- Section Starts Here -->
	<section class="menu" id="menu-section">
		<div class="container activity-data"style="overflow-x: hidden; background-color: #dfdfdf; border-radius: 15px;">
			<h2 class="text-center">Get A Fuel Quote</h2>
			<div class="menu-container">
				<form method="POST">
                    <div class="">
                        <label style="display: block;"> 
                            <span class="data-title">Gallons:</span>
                        </label>
                        <input type="text" class="input_box" inputmode="numeric" pattern="\d*" name="Gallons" required>
                    </div>
                    <div class="">
                        <label style="display: block;"> 
                            <span class="data-title">Company's Profit Margin (%):</span>
                        </label>
                        <input type="text" class="input_box" name="profitMargin" value="<?php echo $profitMargin;?>" readonly required>
                    </div>
                    <div class="">
                        <label style="display: block;">
                            <span class="data-title">Address:</span>
                        </label>
                        <input type="text" class="input_box" name="Address" value="<?php echo $Address;?>" readonly required>
                    </div>
                    <div class="">
						<label style="display: block;">
							<span class="data-title">City:</span> 
						</label>
                        <input type="text" class="input_box" name="City" value="<?php echo $City;?>" readonly required>
                    </div>
                    <div class="">
                        <label style="display: block;">
                            <span class="data-title">State:</span> 
                        </label>
                        <input type="text" class="input_box" name="State" value="<?php echo $State;?>" readonly required>
                    </div>
                    <div class="">
                        <label style="display: block;">
                            <span class="data-title">ZipCode:</span> 
                        </label>
                        
                        <input type="text" class="input_box" inputmode="numeric" pattern="\d*" name="ZipCode" value="<?php echo $ZipCode;?>" readonly required>
                    </div>
                    <div class="">
                        <label style="display: block;">
                            <span class="data-title">Date:</span> 
                        </label>
                        <input type="date" class="input_box" name="Date" value="" required>
                    </div>
                    <button type="submit" class="block" name="submit">Generate</button>
                </form>
			</div>

		</div>
	</section>
</body>

<footer>
	<div class="footer-content text-center" style="margin-bottom: 10%">
		<p class="copyright">© Designed by <a href="#">Team #18 COSC 4353</a>. All rights reserved.</p>
		<a href="#top">Go to top.</a>
	</div>
</footer>

</html>