<?php include 'header.inc.php'; ?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Shopping</title>
        
		<?php
		function populateShoppingList_Items($shoppingListItems_Data)
		{
			$tableData_HTML = "";
			echo '<script type="text/javascript">alert(\'ROWS: '. mysqli_num_rows($shoppingListItems_Data).'\');</script>';
			
			//Encode the Table Header Row FIRST
			$tableData_HTML.="\r\n    <tr>\r\n".
			"        <td>\r\n".
			"            <b>Item</b>\r\n".
			"        </td>\r\n".
			"        <td>\r\n".
			"            <b>Description</b>\r\n".
			"        </td>\r\n".
            "        <td>\r\n".
			"            <b>Quantity</b>\r\n".
			"        </td>\r\n".
            "        <td>\r\n".
			"            <b>Bought?</b>\r\n".
			"        </td>\r\n".
			"    </tr>";
			
			if(mysqli_num_rows($shoppingListItems_Data) > 0)  // This represents there is at least ONE record of the shopping list item created by the user
			{
				$itemCount = 1;
				while($rowData = mysqli_fetch_assoc($shoppingListItems_Data) )
				{
					//Process the Table output...
				    $tableData_HTML.="\r\n    <tr>\r\n".
					"        <td>".$rowData['itemName']."</td>\r\n".
					"        <td>\r\n".
					"            <input type=\"text\" class=\"text-primary\" style=\"width:80px;\" value=\"".$rowData['shoppingListDesc']."\">\r\n".
					"        </td>\r\n".
					"        <td>\r\n".
					"            <input type=\"text\" class=\"text-primary\" style=\"width:55px;\" value=\"".$rowData['shoppingListQty']."\">\r\n".
					"        </td>\r\n".
					"        <td onclick=\"checked(this)\">\r\n".
					"            <button type=\"button\" class=\"btn btn-default\">\r\n".
					"            <span class=\"glyphicon glyphicon-unchecked\"></span>\r\n".
					"            </button>\r\n".
					"            <input type=\"hidden\" name=\"shopItemID". $itemCount."\" value=\"".$rowData['shoppingListItemID']. "\" />\r\n".
					"        </td>\r\n".
					"    </tr>";
					
					$itemCount++;
				}
				
			}
			
			return $tableData_HTML;

		}//End of function
		
		$shoppingList_ID=-1;
	
	    if($_SERVER["REQUEST_METHOD"] == "GET")
		{
			if (isset($_GET["list"])) {
				$shoppingListName = $_GET["list"];
				
				echo "<script>alert('".$shoppingListName."');</script>";
				
				$queryShopList_ID="SELECT sl.shoppingListID FROM `shoppinglist` AS sl WHERE sl.shoppingListName = '".
									$shoppingListName."';";
			    $shoppingListID_Data = mysqli_query($connection, $queryShopList_ID, MYSQLI_STORE_RESULT);
				$rowData = mysqli_fetch_row($shoppingListID_Data);
				$shoppingList_ID=$rowData[0];
				
		    }
			
		}
	
	
	
	    ?>
        <script>
            var itemsRow = 0;
            function checked(param){
                var rowCount = $('#addList tr').length;
                var button = param.children[0];
                var checked = button.children[0];
                if (checked.className == "glyphicon glyphicon-unchecked"){
                    checked.className = "glyphicon glyphicon-check"
                    itemsRow += 1;
                    if (itemsRow == (rowCount -1)){
                        var ans = confirm("All items are checked!\nRemove list?");
                        if (ans == true){
                            window.location = "../ui/shopping.php?p=<?php echo $shoppingList_ID;?>";
                        }
                        else{
                            checked.className = "glyphicon glyphicon-unchecked"
                            itemsRow -= 1;
                        }
                    }
                }
                else{
                    checked.className = "glyphicon glyphicon-unchecked"
                    itemsRow -= 1;
                }
            }
        </script>
    </head>
    <body class="container-fluid">
        <ul class="nav nav-tabs">
            <li><a href="./ItemList.php">Item</a></li>
            <li class="active"><a href="./HomePage.php">Shopping</a></li>
            <li><a href="./GroupInfo.php">Groups</a></li>
            <li><a href="./Settings.php">Settings</a></li>
        </ul>
        
        <div class="container" style="width:50%; float: left;">
            <br/>
            <h1><?php echo $_GET["list"] ?></h1>
            <br/><br/>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>Shopping List</h3>
                </div>
                <table class="table" id="addList">
				    <?php
						    $queryShoppingListItems = "SELECT it.itemName, sli.shoppingListItemID, sli.shoppingListDesc, sli.shoppingListQty ".
							"FROM `shoppinglistitem` AS sli INNER JOIN `items` AS it ".
							"WHERE (it.itemID = sli.itemID) AND ".
							        "( sli.shoppingListID =(SELECT sl.shoppingListID FROM `shoppinglist` AS sl WHERE sl.shoppingListName = '".
									$shoppingListName."') );";
									
							$shoppingListItems_Data = mysqli_query($connection, $queryShoppingListItems, MYSQLI_STORE_RESULT);
							
							echo populateShoppingList_Items($shoppingListItems_Data);
                        ?>
					
                    <!--tr>
                        <td><b>Item</b></td>
                        <td><b>Description</b></td>
                        <td><b>Quantity</b></td>
                        <td><b>Bought?</b></td>
                    </tr>
                    
                    <tr>
                        <td>Milo</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Energy"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="3"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Beer</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Tiger"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="4"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Tea</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Pokka"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="1"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Bread</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Soft"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="3"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Rice</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Phoenix"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="1"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Coke</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="F & N"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="2"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr-->
                </table>
            </div>
    </body>
</html>