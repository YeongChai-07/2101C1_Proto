<!DOCTYPE html>
<html>
    <head>
	    <title>Groups</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body class="container-fluid">
		<ul class="nav nav-tabs">
		    <li><a href="./ItemList.php">Item</a></li>
			<li><a href="./ShoppingList.html">Shopping</a></li>
			<li class="active"><a href="#">Groups</a></li>
			<li><a href="./Settings.html">Settings</a></li>
		</ul>
		<div class="container">
		    <p>&nbsp;</p>
			<div class="row">
			    <div class="col-xs-6">
				    <label for="currGrp_List">Current Groups</label>
					<table border = "1" id="currGrp_List">
					  <tr>
						<th>BANG BANG BANG</th>
						<th>&nbsp;</th>
					  </tr>
					  <tr>
						<td>Family</td>
						<td class ="glyphicon glyphicon-remove">
						  <!-- Change X to icon -->
						</td>
					  </tr>
					  <tr>
						<td>Friends</td>
						<td class="glyphicon glyphicon-remove">
						  <!-- Change X to icon -->
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					</table>
				</div>
				<div class="col-xs-6">
				    <form role="form">
					    <div class="form-group">
						    <label for="createGrp_Name">Create New</label>
							<input type="text" class="form-control" id="createGrp_Name"
							       placeholder="Enter new group name here"/>
						</div>
						<button type="submit" class="btn btn-default btn-md">Submit</button>
					</form>
				</div>
			</div>
			<div class="row">
			    <div class="col-xs-12">&nbsp;</div>
			</div>
			<div class="row">
			    <div class="col-xs-12">
					<label for="testTableData">Received Invitations</label>
						<table border = "1" id="testTableData">
							<tr>
								<th>Group Name</th>
								<th>Email Address</th>
								<th>Accept Invitation</th>
								<th>Decline Invitation</th>
							</tr>
							<tr>
								<td>Family</td>
								<td>
									abc@email.com
								</td>
								<td>
									<span class="glyphicon glyphicon-ok"></span>
								</td>
								<td>
									<span class="glyphicon glyphicon-remove"></span>
								</td>
							</tr>
							<tr>
								<td>Friends</td>
								<td>
									bangHero@ymail.sg
								</td>
								<td>
									<span class="glyphicon glyphicon-ok"></span>
								</td>
								<td>
									<span class="glyphicon glyphicon-remove"></span>
								</td>
							</tr>
						</table>
					</div>
			</div>
		</div>
	</body>
</html>