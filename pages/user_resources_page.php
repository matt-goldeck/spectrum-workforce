<?php
require "../scripts/check_session.php";
check_session(false); // Init session 
require "../scripts/database.php"; // Init $pdo connection
require "../scripts/convert_path.php"; // Means of navigating around website

// == Collect all resources associated with a given user ==
$user_id = $_SESSION['id'];
$sql = "SELECT users.firstName, users.lastName, resc_association.resource_id, resource.fileName, resource.fileType, resource.filePath, resource.createdAt, resource.createdBy FROM resc_association INNER JOIN resource ON resc_association.resource_id = resource.id INNER JOIN users ON users.id = resource.createdBy WHERE resc_association.assocWith = ?;";

$stmt=$pdo->prepare($sql);
if($stmt->execute([$user_id])){
    $user_resources = $stmt->fetchall();
}
else{
    $error_msg = "Sorry, we failed to find any resources associated with this user...";
}
?>
<!DOCTYPE html>
<head><!-- Some stuff goes here --></head>
<body>
    <table>
        <tr>
            <th>Resource Name</th>
            <th>Download Size</th>
            <th>File Type</th>
            <th>Created On</th>
            <th>Created By</th>
        </tr>
    <?php
    if($user_resources){
        foreach($user_resources as $resource){
            echo "<tr>\n";
            echo "<th>".$resource['fileName']."</th>\n";
            echo "<th>".$resource['fileSize']."</th>\n";
            echo "<th>".$resource['fileType']."</th>\n";
            echo "<th>".$resource['createdAt']."</th>\n";
            echo "<th>".$resource['firstName']." ".$resource['lastName']."</th>\n";
            echo "<th><form method='get' action='".convert_path($resource['filePath'], true)."'><button type='submit'>Download</button></form></th>";
            echo "</tr>";
        }
    }
    else{
        echo "<tr><th>".$error_msg."</th></tr>";
    }
    ?>
    </table>
</body>
</html>