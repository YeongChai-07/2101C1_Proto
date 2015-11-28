<?php
    include 'header.inc.php';
    $email = $_SESSION['email'];
    $pending = '3';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $newname = ($_POST["newName"]);
        $grpname = ($_POST["grpName"]);
        echo $newname;
        echo $grpname;

        $sql2 = "SELECT * FROM user WHERE email ='" .$newname . "' ";
        if ($statement = mysqli_prepare($connection, $sql2)){
            $sql = "INSERT INTO groups (email, groupName, groupCreator) VALUES (?,?,?)";
            if ($statement = mysqli_prepare($connection, $sql)){
                mysqli_stmt_bind_param($statement, 'sss', $newname, $grpname, $pending);
                mysqli_stmt_execute($statement);
            }
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("User does not exist")';
            echo '</script>';
        }
        
        header('location: ../ui/GroupInfo.php?id='.$grpname);
    }
?>
