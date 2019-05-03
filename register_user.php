<?php
function register_user() {
    // register_user() 
    // Called after the 'register here' form is submitted
    // Validates submitted data, and if valid, stores in database
    // Else returns array of errors distinguished by result['error'] == true
    
    require "database.php"; // Init database connection 
    
    $vresults = validate_registration_data($pdo);
    if(!$vresults['error'])
    {
        $sql = "INSERT INTO users (emailAddress, password, userType, firstName, midInit, lastName, address1, address2, city, state, zip, phone, phoneType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        
        // Using standard PHP hashing; not most ideal?
        $h_password = password_hash($vresults['password'],PASSWORD_DEFAULT);
        
        $value_array = array($vresults['email'], $h_password, $vresults['type'], $vresults['firstName'], $vresults['midInit'], $vresults['lastName'], $vresults['address1'], $vresults['address2'], $vresults['city'], $vresults['state'], $vresults['zip'], $vresults['phone'], $vresults['phoneType']);
        
        $stmt=$pdo->prepare($sql);
        if($stmt->execute($value_array)){
            // == Insertion completed succesfully ==
            echo "New Account Registered Succesfully!";
        }
        else {
            // == Some SQL error occurred == 
            echo "Something went wrong... Please contact an administrator.";
        }
    }
    else {
        // == Some entered data was not valid ==
        // Specific errors can be found in $validated_results at the index of each param eg $v_r['email'] == 'Please enter an email address'
        echo "An error occured in form validation.";
    }
}

function validate_registration_data($pdo) {
    // validate_data()
    // Called after a POST request; looks for form data 
    // If found and is valid, returns arr of values, else return arr of errors 
    // Uses result['error'] as a flag to distinguish between two conditions

    $valid_user_types = array("Employee", "Student", "Individual", "Business");
    $value_array = $error_array = array();
    $error_template = "Please enter a(n) %s"; // For missing values
    
    // == Validate Email ==
    $param_email = trim($_POST['emailAddress']);
    if(empty($param_email)){
        $error_array['email'] = sprintf($error_template, 'email address');
    }
    // = Check if email already in use =
    else{
        $sql = "SELECT id FROM users WHERE emailAddress = ?";
         if($stmt = $pdo->prepare($sql)){
                if($stmt->execute([$param_email])){
                    $result = $stmt->fetchall();
                    
                    // = Error: User exists with this email =
                    if(count($result) >= 1){
                        $error_array['email'] = "That email is already in use!";
                    }
                    // = Success: No user registered with this email =
                    else{
                        $value_array['email'] = $param_email;
                    }
                }
                // = Error: Statement fails to execute =
                else{
                    $error_array['sql']= "Failed to execute email verification statement";
                }
            }
            else {
                $error_array['sql'] = "Failed to connect to database";
            }
    }


    // == Validate Password == 
    $param_password = trim($_POST['password1']);
       
    if(empty($param_password)){
        $error_array['password'] = sprintf($error_template, "password");
    }
    // = Check arbitrary constraints on password =
    elseif(strlen($param_password) < 5){
        $error_array['password'] = "Password must have at least 6 characters";
    }
    
    else {
        $value_array['password'] = $param_password;
    }

    // == Validate the password confirmation field == 
    $confirm_password = trim($_POST['password2']);
    
    if(empty($confirm_password)) {
        $error_array['validate_password'] = "Please confirm your password";
    }
    else{
        // = Error: Passwords don't match =
        if($param_password != $confirm_password){
            $error_array['validate_password'] = "Passwords do not match!";
        }
        else{
        // = Otherwise, Success -> Passwords match =
        }
    }   


    // == Validate User Type ==
    $param_type = trim($_POST['userType']);
    if(empty($param_type)){
        $error_array['type'] = "Please select a user type";
    }
    else{
        // = Error: Somehow an invalid user type is specified =
        if(!in_array($param_type, $valid_user_types)){
            $error_array['type'] = "Invalid user type selected...";
        }
        else {
            $value_array['type'] = $param_type;
        }
    }
    
    // == Validate the rest of the REQUIRED params ==
    $req_params = array("address1", "city", "state", "zip", "phone", "phoneType", "firstName", "lastName");
    
    foreach($req_params as $param){
        $run_param = trim($_POST[$param]);
        if(empty($run_param)){
            $error_array[$param] = sprintf($error_template, $param);
        }
        else{
            $value_array[$param] = $run_param;
        }
    }
    
    // == Validate NON-REQUISTE params ==
    $non_params = array("address2", "midInit");
    foreach ($non_params as $parm){
        $run_param = trim($_POST[$param]);
        if(empty($run_param)){
            $value_array[$param] = null;
        }
        else{
            $value_array[$param] = $run_param;
        }
    }
    
    // == Determine if errors; format returned array ==
    if(empty($error_array)){
        $result_array = $value_array;
        $result_array['error'] = false;
    }
    else{
        $result_array = $error_array;
        $result_array['error'] = true;
    }
    
    return $result_array;
}
?>