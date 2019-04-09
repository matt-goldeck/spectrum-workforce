<?php
require_once "base.php"; // Database connection

// If user not logged in, redirect to login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if($_SESSION['User_Type'] != 'Admin'){
    header("location: landing.php");
    exit;
}

$email_address = $password = $confirm_password = $user_type = "";
$username_err = $password_err = $confirm_password_err = $type_err = "";

$valid_types = array("Student", "Teacher", "Admin", "Employer");

// Case 1: Form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // Validate Email
    
    // No email entered
    if(empty(trim($_POST['Email_Address']))){
        $email_err = "Please enter an email.";
    }
    else{
        $sql = "SELECT user_id FROM users WHERE email_address = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            // Bind vars to statement as params
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST['Email_Address']);
            
            // Attempt statement execution
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // If user exists with that email
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "That email is already in use!";
                }
                // Email is untaken
                else{
                    $email_address = trim($_POST['Email_Address']);
                }
            }
            // Statement fails to execute
            else{
                echo "Some fatal error has occurred...";
            }
        mysqli_stmt_close($stmt);
        }
        
    }
    
    // Validate Password
    
    // Empty Password Form
    if(empty(trim($_POST['Password']))){
        $password_err = "Please enter a password.";
    }
    // Password length requirement
    elseif(strlen(trim($_POST['Password'])) < 5){
        $password_err = "Password must have at least 6 characters.";
    }
    else {
        $password = trim($_POST['Password']);
    }
    
    // Validate the password confirmation field
    
    // Confirm password form is empty
    if(empty(trim($_POST['Confirm_Password']))) {
        $confirm_password_err = "Please confirm your password.";
    }
    
    // Check to see if password is confirmed
    else{
        $confirm_password = trim($_POST['Confirm_Password']);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_error = "Passwords do not match.";
        }
    }
    
    // Validate User Type
    
    if(empty(trim($_POST['User_Type']))){
        $type_err = "Please select a user type...";
    }
    else{
        $user_type = trim($_POST['User_Type']);
        if(empty($type_err) && (!in_array($user_type, $valid_types))){
            $type_err = "Invalid user type selected...";
        }
        
    }
    
    // Insert into database (if no errors)
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($type_err)) {
        $sql = "INSERT INTO users (email_address, password, user_type) VALUES (?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_email, $param_password, $param_type);
            
            // Init params
            $param_email = $email_address;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_type = $user_type;
            
            // Execute
            if(mysqli_stmt_execute($stmt)){
                // Successful, redirect to login page
                echo "Baddaboom, you're in!";
            }
            else {
                echo "Some SQL error has occurred...";
                echo $user_type;
            }
            
             mysqli_stmt_close($stmt);
        }
        else {
            echo "Something is going wrong here...";
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
</head>

<body>
  <div id="main">
      <h1>Registration Page</h1>

      <form method="post" action ='registration.php' name ="registration-form" id='registration-form'>
        <fieldset>
          <label for="Email_Address">Email Address</label>
          <input type="text" id="Email" name="Email_Address" required>
          <!-- Show any errors with email entry if they exist -->
          <span class="help-block"> <?php echo $email_err; ?></span>

          <label for="Password">Password</label>
          <input type="password" id="psw" name="Password" required>
          <!-- Show any errors with password entry if they exist -->
          <span class="help-block"> <?php echo $password_err; ?></span>

          <label for="Confirm_Password">Confirm Password</label>
          <input type="password" id="psw" name="Confirm_Password" required>
          <!-- Show any errors with password confirmation entry if they exist -->
          <span class="help-block"> <?php echo $confirm_password_err; ?></span>
          
          <label for="User_Type">User Type</label>
          <select name="User_Type">
              <option value="Student">Student</option>
              <option value="Teacher">Teacher</option>
              <option value="Employer">Employer</option>
              <option value="Admin">Admin</option>
          </select>
          
          <input type="submit" name="register" id="register" value="Register">
        </fieldset>
      </form>
  </div>
</body>
</html>