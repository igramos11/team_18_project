<?php
// Start the session
session_start();

// If the user is logged in, display the welcome message
if (isset($_SESSION['login_user'])) {
    echo '<p style="font-size: 20px; font-weight: bold;">Welcome, ' . htmlspecialchars($_SESSION['login_user']) . '!</p>';

    // If logout is requested, destroy the session and redirect to the current page
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    require_once 'php/config.php';
}

?>



<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Team 18 Home Page</title>

	<!-- Link to css file -->
	<link rel="stylesheet" type="text/css" href="css/main_page.css">

</head>

<body id="top">
	<header>
		<a href="index.php">
        	<img src="images/logo1.png">
    	</a>
		<!-- Navbar Starts -->
		<nav>
			<ul>
				<li><a href="#top"></a></li>
				<?php if (isset($_SESSION['login_user'])) { ?>
                    <li><a href="?logout">Logout</a></li>
                <?php } ?>
			</ul>
		</nav>
		<!-- Navbar End -->
	</header>
	
<!-- Main Page Banner Section Starts Here -->
<section class="food-search" style="display: flex; flex-direction: column;">
	<div style="width: 100%; text-align: center;">
		<h1 style="background-color: transparent; color: black;">Welcome to Team 18's Fueling Company!</h1>
	</div>
	<section style="display: flex; align-items: center; justify-content: space-around;">
		<div style="width: 50%;">
			<img src="images/refinery.jpeg" alt="refinery" style="width: 100%; height: 60vh;">
		</div>
		<div style="width: 50%; text-align: center;">
			<h2 class="text-center">Get Started with a Fuel Quote</h2>
			<div class="button-container" style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;">
<<<<<<< HEAD
				<a href="pages/login.php" style="color: white; background-color: #0439aa; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Login</a>
				<a href="pages/signup.php" style="color: white; background-color: #0439aa; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Sign Up</a>
			</div>
=======
    <?php
        if(!isset($_SESSION['login_user'])) { // if user is not logged in
    ?>
        <a href="pages/login.php" style="color: white; background-color: #0439aa; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Login</a>
        <a href="pages/signup.php" style="color: white; background-color: #0439aa; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Sign Up</a>
    <?php
        } else { // if user is logged in
    ?>
        <a href="pages/userDashboard.php" style="color: white; background-color: #0439aa; padding: 10px 20px; text-decoration: none; border-radius: 5px;">User Dashboard</a>
    <?php
        }
    ?>
</div>

>>>>>>> cd4035980c59e7130f7ba455a54f2747495162c7
		</div>
	</section>
</section>
<!-- Main Page Banner Ends Here -->
</body>


<footer>
	<div class="footer-content text-center" style="margin-bottom: 0%">
		<p class="copyright">© Designed by <a href="#">Team 18 COSC 4353</a>. All rights reserved.</p>
		<a href="#top">Go to top.</a>
	</div>
</footer>

</html>
