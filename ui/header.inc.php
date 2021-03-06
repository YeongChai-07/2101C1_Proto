<?php
    require_once('protected/config1.php');
	
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
						
    if (mysqli_connect_errno()){ 		// mysqli_connect_errno returns the last error code
	die(mysqli_connect_error()); 		// die() is equivalent to exit()	
    }
    
    session_start();
?>

<html>
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css" />
    <link href="../css/main.css" rel="stylesheet" type="text/css"/>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>    

    <div class="container">
        <div class="nav navbar-inverse navbar-fixed-top">
            <div class="navbar-header"><a href="homepage.php" class="navbar-brand">BuyMeLeh!</a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="shopping.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="ItemList.php"><span class="glyphicon glyphicon-tasks"></span> Item List</a></li>
                    <li><a href="Groups.php"><span class="glyphicon glyphicon-th"></span> Groups</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if ((!isset($_SESSION['email']))) 
                        {
                    ?>
                        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php  
                    
                        } 
                    else 
			{
                    ?>
                        <li class="dropdown">
                            <a href="shopping.php" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['email'] ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                            </ul>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</html>