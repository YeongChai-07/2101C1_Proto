<?php
include 'header.inc.php';
$creator = '1';
$sessionemail = $_SESSION['email'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = ($_POST["email2"]);
    $name = ($_POST["grpname2"]);
}


$sql1 ="SELECT * FROM groups WHERE email = '".$email."' AND groupName = '".$name."'AND groupCreator = '".$creator."'" ;
if ($result1 = mysqli_query($connection, $sql1)){
    $sql3 = "DELETE FROM groups WHERE groupName = '".$name."'";
    if ($result3 = mysqli_query($connection, $sql3)){
        echo 'success delete all';
    }
}
else {
    $sql2 = "DELETE FROM groups WHERE email = '".$email."' AND groupName = '".$name."'";

if ($result2 = mysqli_query($connection, $sql2)){
    echo 'success';
}
}
if($email != $sessionemail ){
    header('location: ../ui/GroupInfo.php?id='.$name);
}
else {
    header('location: ../ui/Groups.php');
}	 
?>


