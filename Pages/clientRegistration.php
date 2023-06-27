<!DOCTYPE html>
<html>
<head>
    <title>Team 18 Registration Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/clientRegistration.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="icon" type="image/x-icon" href="../images/fuelpump.jpeg">

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

</head>
<body>
    <div class="Form">
    <div class="head">
    <h1>New Client Registration</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <form action="../php/signupAction.php" method="post">
        <div class="container">
            <div class="entry">
                <label for="Username"><b>Username:</b></label>
                <input type="text" name="Username" id="Username" placeholder="Enter username" required>
            </div>

            <div class="entry">
                <label for="Password"><b>Password:</b></label>
                <input type="password" name="Password" id="Password" placeholder="Enter password" required>
            </div>
            <hr>
        </div>
        <?php
        if(isset($_GET["invalid"])) {
            if($_GET["invalid"] == "username") {
                echo "<style> .invalid {color: red; text-align: center;}</style><p class='invalid'> Username already taken. Please enter a new one.</p>";
            }
        }
    ?>
        <button type="submit" class="registerbtn" style="background-color: #0439aa;">Register</button>
    </form>
    </div>
    <?php
        if(isset($_GET["created"])) {
            echo "<style> .success {font-size: larger; text-decoration: bold; text-align: center;}</style><p class='success'>Account successfully created! Please <a href=../pages/login.php>login</a> to complete your profile.</p>";
        }
    ?>
</body>
</html>
