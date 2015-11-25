<?php
include 'header.inc.php';
$email = $_SESSION['email'];
$creator = '1';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = ($_POST["grpName"]);
}
echo $name;
echo $email;

$sql1 ="SELECT * FROM groups WHERE email = '".$email."' AND groupName = '".$name."' AND groupCreator = '".$creator."'";
if ($result1 = mysqli_query($connection, $sql1)){
    while ($row = mysqli_fetch_assoc($result1)) {
    $sql3 = "DELETE FROM groups WHERE groupName = '".$name."'";
    if ($result3 = mysqli_query($connection, $sql3)){
            echo 'success delete all'; 
    }   
    }
}

    $sql2 = "DELETE FROM groups WHERE email = '".$email."' AND groupName = '".$name."'";

if ($result2 = mysqli_query($connection, $sql2)){
    echo 'success';

}
	header('location: ../ui/Groups.php');
?>

