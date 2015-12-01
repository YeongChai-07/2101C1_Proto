<?php
    include 'header.inc.php';
    $email = $_SESSION['email'];
    $pending = '3';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $newname = ($_POST["newName"]);
        $grpname = ($_POST["grpName"]);
        echo $newname;
        echo $grpname;
        $deny = TRUE;
        $sql1 = "SELECT * FROM groups";
        if ($result1 = mysqli_query($connection, $sql1)){
            while ($statement1 = mysqli_fetch_assoc($result1)){
              if ($statement1['email'] == $newname AND $statement1['groupName'] == $grpname){
                  $deny = FALSE;
                  echo "<script> alert('User already in group'); "
            .       "window.location.href='Groupinfo.php?id=$grpname'; </script>";        
              }  
            }
        }
        
        if ($deny){
        $check = "SELECT * FROM user";
        if ($result = mysqli_query($connection, $check)){
            $checkDup = TRUE;
            while ($statement = mysqli_fetch_assoc($result)) 
            {
                if ($statement['email'] == $newname){
                    $checkDup = FALSE;
                    $sql = "INSERT INTO groups (email, groupName, groupCreator) VALUES (?,?,?)";
                    if ($statement = mysqli_prepare($connection, $sql)){
                        mysqli_stmt_bind_param($statement, 'sss', $newname, $grpname, $pending);
                        mysqli_stmt_execute($statement);
                        echo "<script> alert('User added'); "
            .       "window.location.href='Groupinfo.php?id=$grpname'; </script>";
                        //header('location: ../ui/GroupInfo.php?id='.$grpname);
                    }                 
                }
            }    
        }    
        }
        
        
        if ($checkDup){
            echo "<script> alert('User does not exist'); "
            . "window.location.href='Groupinfo.php?id=$grpname'; </script>";
      
       }
        
    }
?>
