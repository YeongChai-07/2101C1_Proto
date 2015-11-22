<html>
    <head>
        <title>Settings</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
	<body class="container-fluid">
            <?php include 'header.inc.php'; ?>
		<ul class="nav nav-tabs">
                    <li><a href="./ItemList.php">Item</a></li>
			<li><a href="./HomePage.php">Shopping</a></li>
                        <li><a href="./Groups.php">Groups</a></li>
			<li class="active"><a href="#">Settings</a></li>
		</ul>
		<div class="container">
		    <br/><br/><br/>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ChangeEmail">Change Email</button>
                    <br>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ChangePass">Change Password</button>
                    <br>
                    <label><input type="checkbox"> Do not logout</label>
                    <br>
                    <label><input type="checkbox"> On notification alerts</label>
                    <div class="modal fade" id="ChangeEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Change Email</h4>
                                </div>
                                <div class="modal-body">
                                   <div class="form-group">
                                       <label for="email">Current Email</label>
                                       <input type="text" class="form-control" id="email">
                                   </div>
                                   <div class="form-group">
                                       <label for="pwd">Password:</label>
                                       <input type="password" class="form-control" id="pwd">
                                   </div>
                                    <div class="form-group">
                                       <label for="newEmail">New Email</label>
                                       <input type="text" class="form-control" id="newEmail">
                                   </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Change Email</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="ChangePass" tabindex="-1" role="dialog" aria-labelledby="ChangePassModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                                </div>
                                <div class="modal-body">
                                   <div class="form-group">
                                       <label for="email">Current Email</label>
                                       <input type="text" class="form-control" id="email">
                                   </div>
                                   <div class="form-group">
                                       <label for="pwd">Password:</label>
                                       <input type="password" class="form-control" id="pwd">
                                   </div>
                                    <div class="form-group">
                                       <label for="newPass">New Password</label>
                                       <input type="text" class="form-control" id="newPass">
                                   </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
		</div>
	</body>
</html>