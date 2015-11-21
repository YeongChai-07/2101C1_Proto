<!DOCTYPE html>
<?php
	session_start();
?>
<html>
    <head>
	    <title>Groups</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		 <script src="../js/GroupsMain/GroupsMain.js"></script>
		<?php
		    include "./classes/GroupsInvitation.php";
			
			function outputCurrentGroups()
			{
				global $grpInvite_Obj;
				echo $grpInvite_Obj->generateCurrentGroups_HTML();
			}
			function outputReceivedInvitations()
			{
				global $grpInvite_Obj;
				echo $grpInvite_Obj->generateInvitations_HTML();
			}
			
			$grpInvite_Obj = new GroupsInvitation();
		?>
	</head>
	<body class="container-fluid">
             <?php include 'header.inc.php'; ?>
		<ul class="nav nav-tabs">
		    <li><a href="./ItemList.php">Item</a></li>
                    <li><a href="./HomePage.php">Shopping</a></li>
			<li class="active"><a href="#">Groups</a></li>
			<li><a href="./Settings.php">Settings</a></li>
		</ul>
		<div class="container">
		    <p>&nbsp;</p>
			<div class="row">
			    <div class="col-xs-6 table-responsive">
				    <label for="currGrp_List">Current Groups</label>
					<table class="table table-hover table-bordered" id="currGrp_List">
					  <tr>
						<th>Assigned Group(s)</th>
						<th>Exit Group</th>
					  </tr>
                      <!-- php while loop to echo all the group names and edit groupinfo page respectively-->
					  
					  <?php
		                  outputCurrentGroups();
		              ?>
					</table>
				</div>
				<div class="col-xs-6">
					    <div class="form-group">
						    <label for="createGrp_Name">Create New</label>
							<input type="text" class="form-control" id="createGrp_Name"
							       placeholder="Enter new group name here"/>
						</div>
						<button id="btnSubmit" class="btn btn-default btn-md">Submit</button>
				</div>
			</div>
			<div class="row">
			    <div class="col-xs-12">&nbsp;</div>
			</div>
			<div class="row">
			    <div class="col-xs-12 table-responsive">
					<label for="testTableData">Received Invitations</label>
						<table class="table table-hover table-bordered" id="testTableData">
							<tr>
								<th>Group Name</th>
								<th>Email Address</th>
								<th>Accept Invitation</th>
								<th>Decline Invitation</th>
							</tr>
							<?php
							    outputReceivedInvitations();
							?>
						</table>
					</div>
			</div>
		</div>
	</body>
</html>