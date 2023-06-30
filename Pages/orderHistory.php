<!DOCTYPE html>
<html>
<head>
    <title>Team 18</title>
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
        }

        

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
            <li><a href="user.php">Home</a></li>
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

<section>
    <div>
        <h2 style="margin-top: -5px;">Stats:</h2>
        <table>
            <tr>
                <th>Total Number of Orders:</th>
                <th>Total Sales:</th>
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
        <h2 style="margin-top: 10px;">Orders:</h2>
        <div style="border: 3px solid rgb(0, 0, 0); background-color: rgb(233, 233, 233); height: 900px;">
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
                    echo '<td>'.$id.'</td>';
                    echo '<td>'.$street.'</td>';
                    echo '<td>'.$city.'</td>';
                    echo '<td>'.$state.'</td>';
                    echo '<td>'.$zip.'</td>';
                    echo '<td>'.$gallons.'</td>';
                    echo '<td>'.$total.'</td>';
                    echo '<td>'.$dateOfPurchase.'</td>';
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
            © Designed by <a href="#">Team # COSC 4353</a>. All rights reserved.
        </p>
        <a href="#top">Go to top.</a>
    </div>
</footer>
</body>
</html>

