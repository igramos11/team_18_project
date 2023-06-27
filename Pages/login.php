<!DOCTYPE html>

<head>
	<title>Team 18 Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="icon" type="image/x-icon" href="../images/fuelpump.jpeg">
	<link rel="stylesheet" type="text/css" href="../css/main_page.css">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<script src="../js/script.js"></script>
	
<body id="#top">
	<header>
		<!-- Navbar Starts -->
		<nav>
			<ul>
				<li><a href="../index.php">Return to Home</a></li>
			</ul>
		</nav>
		<!-- Navbar End -->
	</header>

	<section>
		<form action="../php/loginAction.php" method="post">
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
			</div>
		
			<div class="container" style="background-color:#f1f1f1">
				<!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
				<button type="button" style="background-color: #0439aa;">
					<a href="../pages/userForm.php" class="signup">
						Don't have an Account? Sign up now!
					</a>
				</button>
			</div>
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