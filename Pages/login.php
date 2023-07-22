<!DOCTYPE html>

<head>
	<title>Team 18 Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../css/main_page.css">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<script src="../js/script.js"></script>
</head>

<body id="top">
	<header>
	<a href="index.php">
        	<img src="../images/logo1.png">
    	</a>
		<!-- Navbar Starts -->
		<nav>
			<ul>
				<li><a href="../index.php">Home</a></li>
			</ul>
		</nav>
		<!-- Navbar End -->
	</header>

	<section>
	<div class="welcome" style="text-align: left;">
    <h1 style="color: black; margin-bottom: 20px; background-color: #ffffff;">Welcome back! Ready to fuel up?</h1>
    <p1 style="margin-bottom: 20px;">Please login below</p1>
</div>

<form action="../php/loginAction.php" method="post" style="margin-top: 20px;">

			<div class="imgcontainer">
				<img src="../images/login icon.png" alt="Avatar" class="avatar">
			</div>
		
			<div class="container">
				<label for="uname"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname" required>
				<br>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" id="passInput" required>
				<i class="bi bi-eye-slash" id="togglePassword" style="margin-left: -5%;display:inline;
				vertical-align: middle" onclick="togglePassword()"></i>

				<?php
					if(isset($_GET["invalid"])) {
						if($_GET["invalid"] == "true") {
							echo "<style> .invalid {color: red; text-align: center;}</style><p class='invalid'> Invalid username or password. Please try again!</p>";
						}
					}

				
				?>
  
				<button type="submit" class="signup"style="background-color: #0439aa;">Login</button>
				<label>
				<input type="checkbox" checked="checked" name="remember"> Remember me
				</label>
			
		</form>
	</section>

</body>

<footer>
	<div class="footer-content text-center" style="margin-bottom: 10%">
		<p class="copyright">© Designed by <a href="#">Team #18 COSC 4353 Summer 2023</a>. All rights reserved.</p>
		<a href="#top">Go to top.</a>
	</div>
</footer>
</html>
