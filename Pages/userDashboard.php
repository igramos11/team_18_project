<?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['login_user'])) {
        // If not, redirect to the login page
        header('Location: ../pages/login.php');
        exit;
    }

    // If we get here, the user is logged in
    // You can access their username with $_SESSION['login_user']
    // And their user ID with $_SESSION['user_id']

    echo '<p style="font-size: 20px; font-weight: bold;">Welcome, ' . htmlspecialchars($_SESSION['login_user']) . '!</p>';

?>



<!DOCTYPE html>
<html>
<head>
  <title>User Dashboard</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/clientRegistration.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="icon" type="image/x-icon" href="../images/fuelpump.jpeg">

    <body id="#top">
	<header>
  <a href="index.php">
        	<img src="../images/logo1.png">
    	</a>
		<!-- Navbar Starts -->
		<nav>
			<ul>
        <li><a href="../index.php">Home</a></li>
<?php
    if (isset($_SESSION['login_user'])) {
      if (isset($_GET['logout'])) {
          // Clear the session data
          session_unset();
          session_destroy();

         // Redirect to the home page
          header("Location: ../index.php");
          exit();
    }
    echo '<li><a href="?logout">Logout</a></li>';
}
?>
</ul>

		</nav>
		<!-- Navbar End -->
	</header>

  <style>
    .icon-container {
      display: flex;
      justify-content: space-around;
      padding: 40px 20px;
    }
    .icon-card {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100px;
    }
    .icon-card img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        max-width: 100px; /* Set the maximum width as needed */
        max-height: 100px; /* Set the maximum height as needed */
      }
    .icon-card button {
  margin-top: 10px;
  padding: 5px 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  border: none;
  border-radius: 5px;
  background-color: #0439aa;
  color: white;
  cursor: pointer;
  width: 200px; /* set fixed width according to your need */
  text-align: center; /* to center the text in the button */
}

    .icon-card button:hover {
      background-color: #45a049;
    }
    .header {
      text-align: center;
      padding: 20px;
      font-size: 24px;
      background-color: #0439aa;
      color: white;
    }
  </style>
</head>
<body>
  <div class="header">
    User Dashboard
  </div>
  <div class="icon-container">
    <div class="icon-card">
      <img src="../images/editProfile.png" alt="Edit Profile Icon">
      <button onclick="location.href='editProfile.php'">Edit Profile</button>
    </div>
    <div class="icon-card">
      <img src="../images/orderHistory.png" alt="Order History Icon">
      <button onclick="location.href='orderHistory.php'">Order History</button>
    </div>
    <div class="icon-card">
      <img src="../images/newQuote.png" alt="Request Quote Icon">
      <button onclick="location.href='user.php'">New Quote</button>
    </div>
  </div>
</body>
</html>
