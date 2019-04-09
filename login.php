<?php 
require_once "base.php";

// Init session
session_start();

// Define and init variables
$email_address = $password = "";
$username_err = $password_err = "";

// Case 1: User already logged in
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    
  // == Redirect to landingsomehow == 
  header("location: landing.php");
  exit;
}

// Case 2: Form submitted; user is trying to log in
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  // Check existence of fields
  if(empty(trim($_POST['Email_Address']))){
    $email_err = "Enter an email address...";
  }
  else{
    $email_address = trim($_POST['Email_Address']);
  }

  if(empty(trim($_POST['Password']))){
    $password_err = "Enter a password...";
  }
  else{
    $password = trim($_POST['Password']);
  }

  // Perform credentials validation
  if(empty($email_err) && empty($password_err)){
    $sql = "SELECT user_id, email_address, password, user_type FROM users WHERE email_address = ?";

    if($stmt = mysqli_prepare($link, $sql)){
      // Bind variables to statement as parameters
      $stmt->bind_param("s", $param_email);

      // Set parameters
      $param_email= $email_address;

      // Execute statement
      if($stmt->execute()){
        // Store result
        $stmt->store_result();

        // Check if there's a result (user exists)
        if($stmt->num_rows == 1) {
          $stmt->bind_result($user_id, $email_address, $hashed_password, $user_type); // Store results
          if($stmt->fetch()){
            if(password_verify($password, $hashed_password)){
              // Password is correct -> begin new session
              session_start();

              // Init new session
              $_SESSION['loggedin'] = true;
              $_SESSION['User_ID'] = $user_id;
              $_SESSION['Email_Address'] = $email_address;
              $_SESSION['User_Type'] = $user_type;

              // Redirect user to dashboard
              header("location: landing.php");
              exit;
            }
            // Password is incorrect
            else {
              $password_err = "Incorrect password...";
            }
          }
        }
        // Email (user) doesn't exist
        else {
          $email_err = "No user found with that email address...";
        }
      }
      // Statement fails to execute
      else {
        echo "Something has gone seriously wrong...";
      }
    }

    // Close SQL Statement
    $stmt->close();

  }
}
?>
<!-- Case 3: User has just navigated to the page (or had trouble logging in...) -->
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>

<body>
  <div id="main">
      <h1>Login Page</h1>

      <form method="post" action ='login.php' name ="login-form" id='login-form'>
        <fieldset>
          <label for="Email_Address">Email Address</label>
          <input type="text" id="Email_Address" name="Email_Address" required>
          <!-- Show any errors with email entry if they exist -->
          <span class="help-block"> <?php echo $email_err; ?></span>

          <label for="Password">Password</label>
          <input type="password" id="psw" name="Password" required>
          <!-- Show any errors with password entry if they exist -->
          <span class="help-block"> <?php echo $password_err; ?></span>

          <input type="submit" name="login" id="login" value="Login">
        </fieldset>
      </form>
  </div>
</body>
</html>
