<!DOCTYPE html>
<html>
    <head>
	    <title>Item List</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--Scenario Error: Empty item name -->
		<script>
		    function checkEmptyItem(){
			var itemNameInput=document.forms["newItemForm"]["newItem"].value;
			if(itemNameInput=="")
			  {
			  alert("Your item name can't be empty! Did you click on this by accident?");
			  return false;
			  }
			return true;
			}
		</script>
		<style>
			.container {
				width: 1200px;
			}
			table.currentItem{
				border: 1px solid black;
				width: 500px;
				float:left;
			}
			td{
				border: 1px solid black;
			}
			td.deleteButton{
				text-align: center;
				width:35px;
			}
			form.right{
				float:right;
				margin-right: 350px;
			}
		</style>
	</head>
	<body class="container-fluid">
		<ul class="nav nav-tabs">
		    <li class="active"><a href="#">Item</a></li>
			<li><a href="./ShoppingList.php">Shopping</a></li>
                        <li><a href="./Groups.php">Groups</a></li>
                        <li><a href="./Settings.php">Settings</a></li>
		</ul>
		<div class="container">
		    <br/><br/><br/><br/>
		    <h1> Current Items </h1>
			<?php
			if(empty($_GET)){
//Prototype Scenario 1: Default look
			?>
			<table class="currentItem">
				<tr>
				<td>Beer</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
				<tr>
				<td>Cookies</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
				<tr>
				<td>Instant Noodle</td>
				<td class="deleteButton"><form action="ItemList.php"><button type="submit" class="btn btn-danger" name="deleteItem" value="noodle">X</button></form></td>
				</tr>
			</table>
			<form name="newItemForm" action="ItemList.php" class="right" onsubmit="return checkEmptyItem();">
			<br>Add New Item:<br>
			<input type="text" name="newItem" placeholder="Insert item name here">
			<button type="submit">+</button>
			</form>			
			<?php 
			} 
			else {
				if(isset($_GET["newItem"])){
//Prototype scenario 2: Added new item.
			?>
			<table class="currentItem">
				<tr>
				<td>Beer</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
				<tr>
				<td>Cookies</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
				<tr>
				<td>Instant Noodle</td>
				<td class="deleteButton"><form action="ItemList.php"><button type="submit" class="btn btn-danger" name="deleteItem" value="newadded">X</button></form></td>
				</tr>
				<tr>
				<td><?php echo $_GET["newItem"]; ?></td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
			</table>
			<form name="newItemForm" action="ItemList.php" class="right" onsubmit="return checkEmptyItem();">
			<br>Add New Item:<br>
			<input type="text" name="newItem" placeholder="Insert item name here">
			<button type="submit">+</button>
			</form>
			<?php
			}
				else if(isset($_GET["deleteItem"])){
					if($_GET["deleteItem"]=="noodle"){
//Prototype Scenario 3: When an item is deleted from the Default page. 
			?>
			<table class="currentItem">
				<tr>
				<td>Beer</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
				<tr>
				<td>Cookies</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
			</table>
			<form name="newItemForm" action="ItemList.php" class="right" onsubmit="return checkEmptyItem();">
			<br>Add New Item:<br>
			<input type="text" name="newItem" placeholder="Insert item name here">
			<button type="submit">+</button>
			</form>
			<?php
					}
					else if($_GET["deleteItem"]=="newadded"){
			?>
			<table class="currentItem">
				<tr>
				<td>Beer</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
				<tr>
				<td>Cookies</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
				<td>Eggs</td>
				<td class="deleteButton"><b><button type="button" class="btn btn-danger">X</button></b></td>
				</tr>
			</table>
			<form name="newItemForm" action="ItemList.php" class="right" onsubmit="return checkEmptyItem();">
			<br>Add New Item:<br>
			<input type="text" name="newItem" placeholder="Insert item name here">
			<button type="submit">+</button>
			</form>
			<?php
					}
				}
			}
			?>
		</div>
	</body>
</html>