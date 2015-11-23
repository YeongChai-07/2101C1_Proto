<?php

include 'header.inc.php';
$email = $_SESSION['email'];
$pending = '0';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newname = ($_POST["newName3"]);
    $grpname = ($_POST["grpName3"]);
    echo $newname;
    echo $grpname;
    
        $sql = "UPDATE groups SET groupCreator = ".$pending." WHERE email ='" .$newname . "' AND groupName ='" .$grpname . "'";
        $result = mysqli_query($connection, $sql);
        echo 'yes';

    header('location: ../ui/Groups.php');
}

?>