<?php
require "../scripts/check_session.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "../scripts/upload_resource.php";
    require "../scripts/database.php";
    
    $result = upload_resource($pdo);
    
    echo $result; // Success or fail message.
}
?>

<!DOCTYPE html>
<form class="" action="resource_form.php" method="post" autocomplete="on" enctype="multipart/form-data">
    <label for="fileName">File Name</label>
    <input type="text" id="fileName" name="fileName" placeholder="File Name">
    
    <input type="file" name="uploadFile" id="uploadFile">
    <input type="submit" name="upload" id="upload" value="Upload File">
</form>
            
</html>