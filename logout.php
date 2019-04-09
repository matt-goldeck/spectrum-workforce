<?php
// Init session
session_start();
 
// Wipe variabels and session
$_SESSION = array();
session_destroy();
 
// Redirect to login
header("location: login.php");
exit;
?>