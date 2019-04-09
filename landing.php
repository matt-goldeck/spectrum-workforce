<?php
session_start();
// If user not logged in, redirect to login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<head>
    <title>Landing</title>
</head>
<body>
    <h1>You've reached the landing page!</h1
    
    <!-- Navigation -->
    <ul>
        <li>Resources</li>
        <li>Forums</li>
        
        <!-- Display user-specific functions-->
        <?php if($_SESSION['User_Type'] == 'Admin') {
            echo "<li><a href='admin_landing.php' class='btn btn-danger'>Admin Control Panel</a></li>"; } ?>
        <li>Information</li>    
        <li><a href="logout.php" class="btn btn-danger">Sign Out</a> 
        </li>
    </ul>
</body>
