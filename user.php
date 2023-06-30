<!DOCTYPE html>
<!-- <?php
// @codeCoverageIgnoreStart
	//include('../php/loginAction.php');
    require_once "../php/functions.php";
    require_once "../php/config.php";

    $UserId = $_SESSION['user_id'];
    $sql = "SELECT * FROM `User` WHERE User_ID = '$UserId'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row=mysqli_fetch_assoc($result);
    $Addy=$row['Address'];
    $State=$row['State'];
    $Zip=$row['ZipCode'];
    $City=$row['City'];
   	if(isset($_POST['submit'])){
	   $UserId = $_SESSION['user_id'];
	   $User = $UserId;
       $St=$_POST['street'];
       $Ciudad=$_POST['city'];
       $Estado=$_POST['state'];
       $Zip=$_POST['zip'];
	   $Gal = $_POST['gallons'];
	   $Total = CalculateTotal($conn,$Gal,$User, $Estado);
	   $Date= $_POST['Fecha'];
	   $stmt = $conn->prepare("INSERT INTO `Order` (User_ID, Street_delivered_to, City_delivered_to, State_delivered_to, Zip_code_delivered_to, Gallons, Order_total, Date_of_purchase) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
       print_r($conn->error_list);
	   $stmt->bind_param("isssssds",$User, $St, $Ciudad, $Estado, $Zip, $Gal, $Total, $Date);
	   $stmt->execute();
	   $Order_ID = $stmt->insert_id;
	   $stmt->close();
   	//    $sql="INSERT INTO `Order` (User_ID, Street_delivered_to, City_delivered_to, State_delivered_to, Zip_code_delivered_to, Order_total, Date_of_purchase)
    //    VALUES ($User, $St, $Ciudad, $Estado, $Zip, $Total, $Date)";
    //    $result=mysqli_query($conn,$sql);
    //    if($result){
    //        header('Location: user.php');
    //    }
    //    else{
    //        die(mysqli_error($conn));
    //    }
   	}
// @codeCoverageIgnoreEnd ghh
?>  -->

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
    
</style>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Team 18</title>

	<!-- Link to css file -->
	<link rel="stylesheet" type="text/css" href="../css/main_page.css">
    <link rel="stylesheet" type="text/css" href="../css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="icon" type="image/x-icon" href="../images/fuelpump.jpeg">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body id="top">
	<header>
		<a href="">
			<img src="../images/logo1.png">
		</a>
		<!-- Navbar Starts -->
		<nav>
			<ul>
				<li><a href="#top">Home</a></li>
				<li>
                    <div class="dropdown">
                        <a href="#" class="drop-btn">
                            Profile
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown-content">
                            <a href="../index.php">Log Out</a>
                        </div>
                    </div>
                </li>

				<li><a href="orderHistory.php">Quote History</a></li>

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
                        <input type="text" class="input_box" inputmode="numeric" pattern="\d*" name="gallons" required>
                    </div>
                    <div class="">
                        <label style="display: block;">
                            <span class="data-title">Address:</span>
                        </label>
                        <input type="text" class="input_box" name="street" value="<?php echo $Addy;?>" readonly required>
                    </div>
                    <div class="">
						<label style="display: block;">
							<span class="data-title">City:</span> 
						</label>
                        <input type="text" class="input_box" name="city" value="<?php echo $City;?>" readonly required>
                    </div>
                    <div class="">
                        <label style="display: block;">
                            <span class="data-title">State:</span> 
                        </label>
                        <input type="text" class="input_box" name="state" value="<?php echo $State;?>" readonly required>
                    </div>
                    <div class="">
                        <label style="display: block;">
                            <span class="data-title">ZipCode:</span> 
                        </label>
                        
                        <input type="text" class="input_box" inputmode="numeric" pattern="\d*" name="zip" value="<?php echo $Zip;?>" readonly required>
                    </div>
                    <div class="">
                        <label style="display: block;">
                            <span class="data-title">Date:</span> 
                        </label>
                        <input type="date" class="input_box" name="Fecha" value="" required>
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