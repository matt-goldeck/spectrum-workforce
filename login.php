
<?php
require_once "database.php";
$INDEX_PATH = "index.php";
// Init session
session_start();
// Define and init variables
$emailAddress = $password = "";
$username_err = $password_err = "";
Case 1: User already logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

  // == Redirect to index ==
  // header("location: ".$INDEX_PATH);
  exit;
}
// Case 2: Form submitted; user is trying to log in
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // == Validate Form Fields ==
  if(empty(trim($_POST['emailAddress']))){
    $email_err = "Enter an email address...";
  }
  else{
    $emailAddress = trim($_POST['emailAddress']);
  }
  if(empty(trim($_POST['Password']))){
    $password_err = "Enter a password...";
  }
  else{
    $password = trim($_POST['Password']);
  }
  // == Perform Credentials Validation ==
  if(empty($email_err) && empty($password_err)){
    $sql = "SELECT id, emailAddress, password, userType FROM users WHERE emailAddress= ?";
    // = Check if emailAddress exists =
    if($stmt = $pdo->prepare($sql)){
      // Execute statement
      if($stmt->execute([$emailAddress])){
        // Store result
        $user_result = $stmt->fetchall();
        // = Check if a single result was returned (User Exists) =
        if(count($user_result) == 1) {
            if(password_verify($password, $user_result[0]['password'])){
              // Password is correct -> begin new session
              session_start();
              // Init new session
              $_SESSION['loggedin'] = true;
              $_SESSION['id'] = $user_result[0]['id'];
              $_SESSION['emailAddress'] = $user_result[0]['emailAddress'];
              $_SESSION['userType'] = $user_result[0]['userType'];

              // Redirect user to dashboard
              header("location: ".$INDEX_PATH);
              exit;
            }
            // Password is incorrect
            else {
              $password_err = "Incorrect Password";
            }
        }
        // Email (user) doesn't exist
        else {
          $email_err = "No User Found With That Email Address";
        }
      }
      // Statement fails to execute
      else {
        echo "SQL Error... Contact an administrator!";
      }
    }
  }
}
?>
