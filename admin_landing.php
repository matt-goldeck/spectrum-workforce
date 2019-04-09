<?php
    // Initialize the session
    session_start();
 
    // If user not logged in, redirect to login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    if($_SESSION['User_Type'] != 'Admin'){
        header("location: landing.php");
        exit;
    }
?>

<!DOCTYPE html>
<head>
    <title>Admin Landing</title>
</head>

<body>
    <h1> This is the Admin Control Panel. Beep boop. </h1>
    <ul>
        <li><a href="registration.php" class="btn btn-danger">Register a New User</a> </li>
        
    </ul>
</body>
