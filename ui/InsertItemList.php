<?php
    session_start();
    $user = $_SESSION['email'];
    $item = $_POST['newItem'];
    
    require_once('protected/config1.php');
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    
    $sql = "INSERT INTO items (itemName, email) VALUES(?,?)";
    if ($statement = mysqli_prepare($connection, $sql)) 
    {
        mysqli_stmt_bind_param($statement, 'ss', $item, $user);
        mysqli_stmt_execute($statement);
    }
    header('Location: ItemList.php');
?>