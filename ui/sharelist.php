<?php

include 'header.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listname = ($_POST["shoppingName"]);
    $grpname = ($_POST["grpName7"]);
//    $grpname = "Spouse";
    
    $sql2 = "SELECT shoppingListID FROM shoppinglist WHERE shoppingListName ='" .$listname . "'";
    $result1 = mysqli_query($connection, $sql2);
    if ($row = mysqli_fetch_assoc($result1)){
        $listID =  $row['shoppingListID'];
    echo $listID;
    echo $grpname;
        }
        
        
        $sql = "UPDATE groups SET shoppingListID = " . $listID . " WHERE groupName ='" . $grpname . "'";
    $result = mysqli_query($connection, $sql);
}
header('location: ../ui/GroupInfo.php?id='.$grpname);
?>