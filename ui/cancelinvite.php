<?php
    include 'header.inc.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $grpname = ($_POST["grpName5"]);
        $email = ($_POST["newName5"]);

        $sql2 = "DELETE FROM groups WHERE email = '".$email."' AND groupName = '".$grpname."'";
        $result = mysqli_query($connection, $sql2);
    }
    
    header('location: ../ui/GroupInfo.php?id='.$grpname);
?>

