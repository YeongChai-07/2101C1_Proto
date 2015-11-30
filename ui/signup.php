<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Sign Up</title>
    </head>
    <body>
        <?php include 'header.inc.php'; ?>
        <div class="container" id="signup">
            <!--<div class="row">-->
            <div class="col-xs-6 col-md-4">
                <img src="../images/shopping-basket.jpg" alt="Shopping Basket" class="img-responsive center-block"/>
                <h1 class="text-center">Let's Get Cartified!</h1>
            </div>
            
            <?php
		// define variables and set to empty values
                $pword1 = $pword2 = $email ="";
                $pword1Err = $pword2Err = $emailErr = "";
                $pword1valid = $pword2valid = $emailvalid = "";
	
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $pword1 = test_input($_POST["pword1"]);
                    $pword2 = test_input($_POST["pword2"]);
                    $email = test_input($_POST["email"]);
                    
                    if (empty($email)){
			$emailErr = "Please do not leave your email empty.";
			$emailvalid = false;
                    }
                    else{
			$sql = "SELECT email FROM user";
                        if ($result = mysqli_query($connection, $sql)){
                            $emailvalid = true; //Needed when there is no entry in the table yet
                            while ($row = mysqli_fetch_assoc($result)){
				if ($row['email'] == $email){
                                    $emailErr = "email had been taken";
                                    echo '<script language="javascript">';
                                    echo 'alert("Email Taken")';
                                    echo '</script>';
                                    $emailvalid = false;
                                    break;
				}
                                else{
                                    $emailErr = "";
                                    $emailvalid = true;
				}
                            }
			}
                    }
                
                    if (empty($pword1)){
                        $pword1Err = "Please do not leave you Password empty.";
                        $pword1valid = false;
                    }
                    else{						
                        $pword1valid = true;
                    }

                    if (empty($pword2)){
                        $pword2Err = "Please do not leave you Password Confirm empty.";
                        $pword2valid = false;
                    } 
                    else{
                        if ($pword2 != $pword1){
                            $pword2Err = "Please enter a matching Password as above.";
                            echo '<script language="javascript">';
                            echo 'alert("Password Mismatch")';
                            echo '</script>';
                            $pword2valid = false;
                        } 
                        else{
                            $pword2valid = true;
                        }
                    }
                    //If all valid it will goes to homepage.php
                    if ($emailvalid && $pword1valid && $pword2valid){
                        $sql = "INSERT INTO user (email, password) VALUES (?,?)";

                        if ($statement = mysqli_prepare($connection, $sql)){
                            mysqli_stmt_bind_param($statement, 'ss', $email, sha1($pword1));
                            mysqli_stmt_execute($statement);
                        }

                        $_SESSION['email'] = $email;

                        header('Location: HomePage.php');
                    }
                }

                function test_input($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
            ?>
            
            <?php
                $validbox = 'has-success has-feedback';
                $invalidbox = 'has-error has-feedback';
            ?>
            
            <div class="col-xs-6 col-md-8 form">
                <form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <legend>Sign Up</legend>
                    <div class="form-group
                        <?php
                            if ($emailvalid){
                                echo $validbox;
                            }
                            if ($emailErr != ""){
                                echo $invalidbox;
                            }
                        ?>">
                    <label class="col-sm-3 control-label" for="email">Email</label>
                    <div class="col-sm-6">
                    <input class="form-control" type="text" id="email" name="email" 
                        value="
                        <?php
                            if ($emailvalid){
                                echo htmlspecialchars($email);
                            }
                        ?>" 
                        placeholder="
                        <?php
                            if ($emailErr != ""){
                                echo $emailErr;
                            }
                        ?>" 
                        required>
                    </div>
                    </div>
                    
                    <div class=" form-group 
                        <?php
                            if ($pword1valid){
                                echo $validbox;
                            }
                            if ($pword1Err != ""){
                                echo $invalidbox;
                            }
                        ?>"
                        >
                        <label class="col-sm-3 control-label" for="pword1">Password</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="password" name="pword1" id="pword1"
                                placeholder="
                                <?php
                                    if ($pword1Err != ""){
                                       echo $pword1Err;
                                    }
                                ?>" 
                                required
                                pattern="^\w{8,}$" title="Password must at least 8 alphanumeric characters">
                        </div>
                    </div>
                    
                    <div class=" form-group 
                        <?php
                            if ($pword2valid){
                                echo $validbox;
                            }
                            if ($pword2Err != ""){
                                echo $invalidbox;
                            }
                        ?>"
                        >
                        <label class="col-sm-3 control-label" for="pword2">Password Confirm</label>
                        <div class="col-sm-6">
                        <input class="form-control" type="password" name="pword2" id="pword2"
                            placeholder="
                            <?php
                                if ($pword2Err != ""){
                                    echo $pword2Err;
                                }
                            ?>" 
                            required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <input type="submit" value="Register" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>
            </div>   
        </div>
        <?php include 'footer.inc.php'; ?>
    </body>
</html>