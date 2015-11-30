<?php
    include 'header.inc.php';
    $email = $_SESSION['email'];
    $pending = '3';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $newname = ($_POST["newName"]);
        $grpname = ($_POST["grpName"]);
        echo $newname;
        echo $grpname;

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
                    }
                    
                }

            }    
        }

//        if ($checkDup){
//            echo "<script> alert('User does not exist'); window.location.href='ui//GroupInfo.php?id='.$grpname; </script>";
//        
//        }
        header('location: ../ui/GroupInfo.php?id='.$grpname);
    }
?>
