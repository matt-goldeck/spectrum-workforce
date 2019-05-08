<?php
$FILE_DIRECTORY = "/pidrive/websites/spectrum/uploadedDocs/";
$VALID_FILE_TYPES = array("jpg", "jpeg", "png", "gif", "pdf", "mp3", "mp4", 'mov');
function upload_resource($pdo){
    // upload_resource()
    // Driver class -- called on upload click; accepts db conn object
    // Validates and stores uploaded file if exists
    // If valid and stores, returns confirmation, else error message

    $resc_info = validate_upload($pdo);
    print_r($resc_info);
    if($resc_info['error'])
    {
        echo "We have some errors here!";
        print_r($resc_info);
    }
    else {
        $newID = insert_resource($resc_info, $pdo);

        // Filepath is valid
        if($newID > 0) {
            $resc_info['id'] = $newID;
            if(store_file($pdo, $resc_info))
            {
                return "File succesfully stored!";
            }
            else{
                return "Failed to store file and create association...";
            }
        }
        else{
            return "Failed to create SQL entry for file...";
        }
    }

}
function validate_upload($pdo){
    // validate_upload()
    // Validates form fields; returns array of information if valid
    // Array of errors otherwise; distinguished by results['error'] == true

    $_SESSION['id'] = 1; // DEBUG - SET USER ID TO 1 MANUALLY

    global $FILE_DIRECTORY, $VALID_FILE_TYPES;
    $value_array = $error_array = array();

    // == Validate user session ==
    $user_id = $_SESSION['id'];
    if(empty(trim($user_id))){
        $error_array['userID'] = "User session invalid!";
    }
    else{
        $value_array['userID'] = $user_id;
    }

    // == Validate name field ==
    $run_name = trim($_POST['fileName']);
    if(empty(trim($run_name))) {
            $error_array['fileName'] = "Please enter a name";
    }
    else{
        $value_array['fileName'] = $run_name;
    }

    // == Check if file is an allowed format ==
    $file_type = strtolower(end(explode(".",$_FILES['uploadFile']['name'])));
    if(!in_array($file_type, $VALID_FILE_TYPES)){
        $error_array['fileType'] = "Filetype ".$imageFileType." is not allowed!";
    }
    else {
        $value_array['fileType'] = $file_type;
    }

    // == Check filesize ==
    $file_size = $_FILES['uploadFile']['size'];
    if($file_size > 1000000){
        $error_array['fileSize'] = "Filesize too large!";
    }
    else
    {
        $value_array['fileSize'] = $file_size;
    }

    // == Determine what/where to name file ==
    // N = 'Nth resource a user has uploaded'
    $user_n = check_user_resc($user_id, $pdo);
    if($user_n < 0){
        $error_array['n'] = "Could not perform resource lookup!";
    }
    else{
        $value_array['n'] = $user_n + 1;
        $file_format = "%suid_%d-%d.%s"; // eg) 'path/to/file/uid_123-01.jpg'
        $file_path = sprintf($file_format, $FILE_DIRECTORY, $user_id, $value_array['n'], $file_type);
        echo $file_path;
        if(file_exists($file_path)){
            $error_array['filePath'] = "File exists in this location.";
        }
        else{
            $value_array['filePath'] = $file_path;
        }
    }

    if(!empty($error_array)){
        $error_array['error'] = true;
        return $error_array;
    }
    else{
        $value_array['error'] = false;
        return $value_array;
    }
}
function store_file($pdo, $resc){
    // store_file()
    // Called after succesful insertion into resources table
    // Attempts to store the file the user sent and add an entry in the assoc_table

    // If succesful storage, create file association
    print_r($_FILES['uploadFile']['tmp_name']);
    echo $resc['filePath'];
    if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $resc['filePath'])){
        $sql = "INSERT INTO resc_association (resource_id, assocBy, assocWith) VALUES (?, ?, ?);";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute([$resc['id'], $resc['userID'], $resc['userID']])){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}
function check_user_resc($user_id, $pdo){
    // check_user_rescs()
    // Retrieves the distinguishing number of the last resc a user has uploaded
    // Else returns 0 if none or -1 if a connection to SQL could not be made

    $sql = "SELECT n FROM resource WHERE createdBy = ? ORDER BY n DESC LIMIT 1;";
    $stmt = $pdo->prepare($sql);

    // == Retrieve highest stored id value
    if($stmt->execute([$user_id])){
        $results = $stmt->fetch();
        // No existing files
        if(empty($results)){
            return 0;
        }
        else{
            return $results['n'];
        }
    }
    else {
        // Signal that an error has occured
        return -1;
    }
}
function insert_resource($resc, $pdo){
    // insert_resource()
    // Accepts resource object; attempts to store it
    // Returns id of new item if succesful, 0 otherwise
    $newId = "";

    $sql = "INSERT INTO resource (fileName, fileSize, fileType, filePath, n, createdBy) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt=$pdo->prepare($sql);
    if($stmt->execute([$resc['fileName'], $resc['fileSize'], $resc['fileType'], $resc['filePath'], $resc['n'], $resc['userID']])){

        // Get the id of the newly inserted item and return it
        $result = get_new_item_id($pdo);
        if($result){
            $newID = $result;
        }
        else{
            $newID = 0;
        }
    }
    else{
        $newID = 0;
    }

    return $newID;
}
function get_new_item_id($pdo){
    // get_new_item_id()
    // Accepts database connection
    // Returns the new primary key

    $sql = "SELECT LAST_INSERT_ID() AS last_id"; // NOTE: This value on a per connection basis; will not return something from another user
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();

    if($result['last_id']) {;
        return $result['last_id'];
    }
    else{
        return 0;
    }
}
?>
