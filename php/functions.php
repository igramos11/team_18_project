<?php
function emailExists($conn, $Email) {

    $sql = "SELECT * FROM User WHERE Email = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}

function usernameExists($conn, $Username) {

    $sql = "SELECT * FROM User WHERE Username = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $Username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}

function getUserByUsername($conn, $Username) {
    $sql = "SELECT * FROM User WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Debugging statements
        echo "User found: ";
        print_r($user);
        return $user;
    } else {
        echo "User not found.";
        return false;
    }
}


function emailExistsForOtherUser($conn, $Email, $User_ID) {

    $sql = "SELECT * FROM User WHERE Email = ? AND NOT User_ID = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "si", $Email, $User_ID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}

function usernameExistsForOtherUser($conn, $Username, $User_ID) {

    $sql = "SELECT * FROM User WHERE Username = ? AND NOT User_ID = ?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "si", $Username, $User_ID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;  
 }

 function setFirstLoginFlag($conn, $user, $flag) {
    // Set flag to integer 0 or 1
    $flag = $flag ? 1 : 0;
    
    // Prepare SQL statement
    $stmt = $conn->prepare("UPDATE user SET first_login = ? WHERE username = ?");
    if ($stmt === false) {
        // Check for errors
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("is", $flag, $user);

    // Execute the statement
    $stmt->execute();

    if ($stmt->error) {
        // Check for errors
        die("Execution failed: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();
}

function PreviousQuotes($conn, $User_ID){
    $sql = "SELECT COUNT(*) AS num_orders FROM `orders` WHERE User_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $User_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($row['num_orders'] > 0){
        return .01; // Rate for users with previous orders
    }
    else{
        return .00; // Rate for new users
    }
}

function State_or_Outside($State){
    if($State === 'TX'){
        return .02; // Rate for users in TX
    }
    else{
        return .04; // Rate for users outside TX
    }
}

function GallonsRequested($num){
    if($num >= 1000){
        return .02; // Rate for users ordering 1000 or more gallons
    }
    else{
        return .03; // Rate for users ordering less than 1000 gallons
    }
}

function ProfitMarginRate($profitMargin){
    if ($profitMargin <= .10){
        return .05; // If profitMargin is less than or equal to 0.10, return 0.05
    }
    else if ($profitMargin >= .11 && $profitMargin <= .50 ){
        return .10; // If profitMargin is between 0.11 and 0.50, return 0.10
    }
    else {
        return .15; // If profitMargin is greater than 0.50, return 0.15
    }
}


function CalculateTotal($conn, $Gallons, $User_ID, $State, $profitMargin){
    
    $currentRate = 1.50;
    $RateHistory = PreviousQuotes($conn, $User_ID);
    $Location = State_or_Outside($State);
    $GallonsRequested = GallonsRequested($Gallons);
    $ProfitMarginRate = ProfitMarginRate($profitMargin);
    $OverallRate = ($Location + $RateHistory + $GallonsRequested + $ProfitMarginRate) + $currentRate;
    $Order_total = $OverallRate * $Gallons;

    return ($Order_total);
}

