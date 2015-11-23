<?php
include 'header.inc.php';
$email = $_SESSION['email'];
$pending = '0';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grpname = ($_POST["grpName4"]);
    echo $grpname;

    $sql2 = "DELETE FROM groups WHERE email = '".$email."' AND groupName = '".$grpname."'";
    $result = mysqli_query($connection, $sql2);

}
	header('location: ../ui/Groups.php');
?>
