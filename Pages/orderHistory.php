<!DOCTYPE html>
<html>

<?php
require_once "../php/config.php";
require_once "../php/functions.php";
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    // If not, redirect to the login page
    header('Location: ../pages/login.php');
    exit;
}
// If logout is requested, destroy the session and redirect to the current page
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM user WHERE User_ID = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Team 18 Order History Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="../images/fuelpump.jpeg">
    <link rel="stylesheet" type="text/css" href="../css/main_page.css">
    <link rel="stylesheet" type="text/css" href="../css/Admin.css">
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 2px solid black;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        /* The dropdown container */
        .dropdown {
            overflow: hidden;
        }

        /* Dropdown button */
        .dropdown .drop-btn {
            border: none;
            outline: none;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            margin-left: 7%;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        /* Add a grey background color to dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        

        .banner-image {
            background-image: url("../images/banner_gas.webp");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 200px; /* Adjust the height as needed */
            margin-top: -55px;
            margin-bottom: 30px;
        }

        

    </style>
</head>

<body>
<div class="banner-image"></div>

<header>
    <a href="../index.php">
        <img src="../images/logo1.png">
        
    </a>
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="userDashboard.php">User Dashboard</a></li>
            <li><a href="editProfile.php">Edit Profile</a></li>
            <li><a href="user.php">Order a Quote</a></li>
            <?php if (isset($_SESSION['login_user'])) { ?>
                                <li><a href="?logout">Logout</a></li>
                            <?php } ?>
                        </div>
                
           
        </ul>
    </nav>
</header>

<section>
    <div>
    <?php
        echo '<p style="font-size: 20px; font-weight: bold;">Welcome, ' . htmlspecialchars($_SESSION['login_user']) . '!</p>';
    ?>

        <h2 style="margin-top: 20px;">Stats:</h2>
        <table>
            <tr>
               <th style="color: navy;">Total Number of Orders:</th>
               <th style="color: navy;">Total Sales:</th>
            </tr>
            <tr>
                <?php
                $UserId = $_SESSION['user_id'];
                $sql = "SELECT COUNT(*) AS order_count, SUM(Order_total) AS total_sales FROM `Order` WHERE User_ID = '$UserId'";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $row = mysqli_fetch_assoc($result);
                $orderCount = $row['order_count'];
                $totalSales = $row['total_sales'];
                echo '<td>'.$orderCount.'</td><td>$'.$totalSales.'</td>';
                ?>
            </tr>
        </table>
    </div>

    <div>
        <h2 style="margin-top: 10px; ">Orders:</h2>
        <div style="border: 3px solid rgb(0, 0, 0); background-color: rgb(233, 233, 233); height: 900px; color: navy;">
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Street Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Gallons</th>
                    <th>Total</th>
                    <th>Date of Purchase</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `Order` WHERE User_ID = '$UserId'";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['Order_ID'];
                    $street = $row['Street_delivered_to'];
                    $city = $row['City_delivered_to'];
                    $state = $row['State_delivered_to'];
                    $zip = $row['Zip_code_delivered_to'];
                    $gallons = $row['Gallons'];
                    $total = $row['Order_total'];
                    $dateOfPurchase = $row['Date_of_purchase'];

                    echo '<tr>';
                    echo '<td style="color: black;">'.$id.'</td>';
                    echo '<td style="color: black;">'.$street.'</td>';
                    echo '<td style="color: black;">'.$city.'</td>';
                    echo '<td style="color: black;">'.$state.'</td>';
                    echo '<td style="color: black;">'.$zip.'</td>';
                    echo '<td style="color: black;">'.$gallons.'</td>';
                    echo '<td style="color: black;">'.$total.'</td>';
                    echo '<td style="color: black;">'.$dateOfPurchase.'</td>';
                    echo '</tr>';

                }
                ?>
            </table>
        </div>
    </div>
</section>

<footer>
    <div class="footer-content text-center" style="margin-bottom: 10%">
        <p class="copyright">
            © Designed by <a href="#">Team #18  COSC 4353</a>. All rights reserved.
        </p>
        <a href="#top">Go to top.</a>
    </div>
</footer>
</body>
</html>
