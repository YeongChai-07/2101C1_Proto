<?php
	session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>My Shopping List</title>
        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/main.css" />
    </head>
    <body>
         <?php include 'header.inc.php'; ?>
        <div class="container" style="margin-top: 4em ">
            <div class="row">               
            </div>
            <?php
            // define variables and set to empty values
            $email = $password = "";

            $emailErr = $passwordErr = "";

            $emailvalid = $passwordvalid = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = test_input($_POST["email"]);
                $password = test_input($_POST["password"]);

                if (empty($email)) {
                    $emailErr = "Username is empty.";
                    $emailvalid = false;
                } 
                if (empty($password)) {
                    $passwordErr = "Password is empty.";
                    $passwordvalid = false;
                } else {
                    $sql = "SELECT email, password FROM user";
                    if ($result = mysqli_query($connection, $sql)) {
                        $emailErr = "Username does not exist";
                        $emailvalid = false; //Needed when there is no entry in the table yet
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['email'] == $email) {
                                $emailErr = "";
                                $emailvalid = true;
                                
                                
                                if ($password == $row['password']) 								{
                                    $passwordErr = "";
                                    $passwordvalid = true;
                                    break;
                                } else 
								{
                                    $passwordErr = "Invalid password";
                                    $passwordvalid = false;
                                    break;
                                }
                            } else 
							{
                                $emailErr = "Username does not exist";
                                $emailvalid = false;
                            }
                        }
                    }
                }

                //If all valid 
                if ($emailvalid && $passwordvalid) {

                    $_SESSION['email'] = $email;

                    header('Location: HomePage.php');
                }
            }

            function test_input($data) {
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
            <div class="row">
                <div class="col-md-12 form">
                <form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <legend>Login</legend>
                    <div class="form-group <?php if($emailvalid) {echo $validbox;} if($emailErr != ""){echo $invalidbox;}?>">
                        <label class="col-sm-3 control-label" for="username">Email</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" id="email" name="email"
                                   value="<?php if($emailvalid) {echo htmlspecialchars($email);}?>"
                                   placeholder="<?php if($emailErr != ""){echo $emailErr;}?>" required>
                        </div>
                    </div>
                    <div class="form-group <?php if($passwordvalid) {echo $validbox;} if($passwordErr != ""){echo $invalidbox;}?>">
                        <label class="col-sm-3 control-label" for="password">Password</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="password" id="password" name="password"
                                   placeholder="<?php if($passwordErr != ""){echo $passwordErr;}?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <input type="submit" value="Login" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>
                    <a class="btn btn-success btn-md" href="signup.php">Sign Up</a>
                </div>
                <?php
                $sql = "SELECT * FROM user";
                      if ($result = mysqli_query($connection, $sql)) {
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo $row['email'];
                      }}  
                ?>
            </div>
        </div>
    </body>
</html>

