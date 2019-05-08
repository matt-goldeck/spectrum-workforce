<?php
function check_session($reqUser) {
    $INDEX_PATH = "";
    $LOGIN_PATH = "index.php";

    session_start();
    // If user not logged in, redirect to login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        echo print_r($_POST);;
        //header("location: ".$LOGIN_PATH);
        exit;

    }

    if($reqUser) {
        // If user not required type, redirect to landing
        if($_SESSION['User_Type'] != $reqUser){
            header("location: ".$INDEX_PATH);
            exit;
        }
    }
}
?>
