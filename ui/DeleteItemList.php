<?php
    $item = $_POST['delItem'];
    
    require_once('protected/config1.php');
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    
    $sql = "DELETE FROM items WHERE itemID = ?";
    if ($statement = mysqli_prepare($connection, $sql)) 
    {
        mysqli_stmt_bind_param($statement, 'i', $item);
        mysqli_stmt_execute($statement);
    }
    header('Location: ItemList.php');
?>