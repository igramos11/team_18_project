<!DOCTYPE html>
<html>
<head>
    <title>Complete Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../css/main_page.css">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<script src="../js/script.js"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #aaaaaa;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5C6BC0;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #3949AB;
        }
    </style>

</style>
</head>

<body>
<div class="banner-image"></div>

<header>
    <a href="">
        <img src="../images/logo1.png">
    </a>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
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
            <li><a href="#">Quote History</a></li>
        </ul>
    </nav>
</header>


    <div class="container">
        <div class="form-container">
            <h1>Complete Your Profile</h1>
            <form action="../php/completeProfileAction.php" method="POST">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" required>

                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" required>

                <label for="email">Email:</label>
                <input type="email" name="email" required>

                <label for="phoneNumber">Phone Number:</label>
                <input type="text" name="phoneNumber" required>

                <label for="Address">Address:</label>
                <input type="text" name="Address" required>

                <label for="APT">Apartment:</label>
                <input type="text" name="APT">

                <label for="City">City:</label>
                <input type="text" name="City" required>

                <label for="State">State:</label>
                <input type="text" name="State" required>

                <label for="ZipCode">Zip Code:</label>
                <input type="text" name="ZipCode" required>

                <button type="submit">Complete Profile</button>
            </form>
        </div>
    </div>
</body>
</html>
