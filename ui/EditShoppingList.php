<!DOCTYPE html>
<?php include 'header.inc.php'; ?>


<html>
    <head>
        <title>Shopping List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
 <!--       <link rel="stylesheet" type="text/css" href="../js/datepicker2.1/datepickr.css"> -->
        <script src="../js/datepicker2.1/datepickr.js"></script>
        <script src="../js/datepicker2.1/datepickr.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="js/libs/twitter-bootstrap/"></script>

        <script>
            function updateList() {
                var updateItemQty = document.forms["updateShoppingList"]["updateQty"].value;
                var updateItemDesc = document.forms["updateShoppingList"]["updateDesc"].value;
                if (updateItemQty == 4) {
                    alert("Your quantity is the same. Please enter another value");
                    if (updateItemDesc == "Tiger") {
                        alert("Your description is the same. Please enter another description");
                        return false;
                    }

                }
                else if (updateItemDesc == "Tiger") {
                    alert("Your description is the same. Please enter another description");
                    if (updateItemQty == 4) {
                        alert("Your quantity is the same. Please enter another value");
                        return false;
                    }
                }
                else {
                    return true;
                }
            }
            function uploadList() {
                alert("Shopping List online has been updated");
            }
            function clearTable() {
                document.getElementById("addList").innerHTML = "";
            }
            function removeShoppingItem(inItemName)
            {
                document.getElementById("delItems_ID").value = inItemName;
            }

        </script>
        <style>
            .container-fluid {
                height:768px;
            }
            #container-add {
                width:50%; 
                float:right; 
                padding-left:10%;
            }
            #container-table {
                width: 50%; 
                float: left;
            }
            .text-desc {
                width: 80px;
            }
            .text-qty {
                width: 50px;    
            }
            .btn-del {
                height: 30px;
            }
            .btn-update-row {
                padding-left:40%;
            }
            .datepick-col {
                padding-top: 2%;
            }
            #container-add {
                padding-left:8%;
            }
            #h2-add {
                padding-left:50%;
            }
            #dropdown-add {
                height: auto; 
                max-height: 250%; 
                overflow-x: hidden;
            }
            #qtyCol {
                padding-top:2%;
            }
            #descCol {
                padding-top:4%;
            }
            #qtyBtn {
                width:50px; 
                height:50px;
            }
            #descTxtArea {
                resize:none; 
                height: 150px; 
                width:200px;
            }
            #addBtnCol {
                padding-left:15%;
            }
            #addBtn {
                width:80px; 
                height:50px;
            }
        </style>

    </head>
    <body class="container">
        <!-- Top Left Container -->
        <?php
        $selectedItem = "";
        $selectedQuantity = "";
        $selectedDescription = "";
        $urgency = "-";
        $selectedShoppingList_ID = -1;
        $selectedItem_ID = -1;
        $shoppingListName = "";


        function item_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function populateShoppingList_Items($shoppingListItems_Data) {
            $tableData_HTML = "";
            //echo '<script type="text/javascript">alert(\'ROWS: ' . mysqli_num_rows($shoppingListItems_Data) . '\');</script>';

            //Encode the Table Header Row FIRST
            $tableData_HTML.="\r\n    <tr>\r\n" .
                    "        <td>\r\n" .
                    "            <b>Item</b>\r\n" .
                    "        </td>\r\n" .
                    "        <td>\r\n" .
                    "            <b>Description</b>\r\n" .
                    "        </td>\r\n" .
                    "        <td>\r\n" .
                    "            <b>Quantity</b>\r\n" .
                    "        </td>\r\n" .
                    "        <td>\r\n" .
                    "            <b>Delete?</b>\r\n" .
                    "        </td>\r\n" .
                    "    </tr>";

            if (mysqli_num_rows($shoppingListItems_Data) > 0) {  // This represents there is at least ONE record of the shopping list item created by the user
                $itemCount = 1;
                while ($rowData = mysqli_fetch_assoc($shoppingListItems_Data)) {
                    //Process the Table output...
                    $tableData_HTML.="\r\n    <tr id=\"row" . $itemCount . "\">\r\n" .
                            "        <td>" . $rowData['itemName'] . "</td>\r\n" .
                            "        <td>\r\n" .
                            "            <input type=\"text\" name=\"shopItem_DESC" . $itemCount . "\" class=\"text-primary text-desc\" value=\"" . $rowData['shoppingListDesc'] . "\">\r\n" .
                            "        </td>\r\n" .
                            "        <td>\r\n" .
                            "            <input type=\"text\" name=\"shopItem_Qty" . $itemCount . "\" class=\"text-primary text-qty\" value=\"" . $rowData['shoppingListQty'] . "\">\r\n" .
                            "        </td>\r\n" .
                            "        <td>\r\n" .
                            "            <button class=\"btn-danger\" type=\"submit\" onclick=\"removeShoppingItem('" . $rowData['shoppingListItemID'] . "');\" value=\"" . $rowData['shoppingListDesc'] . "\">\r\n" .
                            "            <span class=\"glyphicon glyphicon-remove\"></span>\r\n" .
                            "            </button>\r\n" .
                            "            <input type=\"hidden\" name=\"shopItemID" . $itemCount . "\" value=\"" . $rowData['shoppingListItemID'] . "\" />\r\n" .
                            "        </td>\r\n" .
                            "    </tr>";

                    //"            <button class=\"btn-danger\" type=\"submit\" onclick=\"$('#row".$itemCount."').toggle(); value=\"".$rowData[0]."\">\r\n".

                    $itemCount++;
                }
            }

            return $tableData_HTML;
        }

//End of function
        $emailAdd = $_SESSION['email'];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
//            echo"<script>alert('add status: " . isset($_POST["selectitem"]) . "\\n Update Status: "
//            . isset($_POST["deleteItems"]) . "');</script>";
            if (isset($_POST["selectitem"])) {
				$checkDup = TRUE;
                $selectedItem = $_POST["selectitem"];
                $selectedQuantity = item_input($_POST["newShoppingListQty"]);
                $selectedDescription = $_POST["newShoppingListDesc"];
                $shoppingListName = $_SESSION["selectedShoppingList"];
                //if (!empty($_POST["newItem"])) {
                if ($selectedItem == "default") { //This INDIRECTLY represent $_POST["newItem"] was SET
                    $newItem = $_POST["newItem"];
					$selectedItem="";
					if(!empty($newItem))
					{
						$check = "SELECT * FROM items";
						if ($result = mysqli_query($connection, $check)){
							while ($statement = mysqli_fetch_assoc($result)) 
							{
								if (strtolower($statement['itemName']) == strtolower($newItem) AND $statement['email'] == $emailAdd){
									$checkDup = FALSE;
                                                                        $selectedItem = $newItem;
									//echo "<script type=\"text/javascript\">alert(\"Item exists in item list\");</script>";
								}
							}   
						}
						if ($checkDup){
							$sql22 = "INSERT INTO items (itemName, email) VALUES(?,?)";
							if ($statement = mysqli_prepare($connection, $sql22)) 
							{
								mysqli_stmt_bind_param($statement, 'ss', $newItem, $emailAdd);
								mysqli_stmt_execute($statement);
							}
							$selectedItem = $newItem;
						}

					}
                }
				//echo $selectedItem;
                if(!empty($selectedItem))
				{                
                    //echo "Shop List Name : " . $shoppingListName;
					//Fetch data from the ShoppingList Table
					$queryShoppingList = "SELECT shoppingListID FROM `shoppinglist` WHERE shoppingListName ='" . $shoppingListName . "';";
					$shoppingListData = mysqli_query($connection, $queryShoppingList, MYSQLI_STORE_RESULT);
					
					while ($rowData = mysqli_fetch_row($shoppingListData)) {
						$selectedShoppingList_ID = $rowData[0];
					}//End While
					
					//Check whether is there this Item in this ShoppingItemList
					$querySame_ShopItem = "SELECT COUNT(shoppingListItemID) FROM `shoppinglistitem` " .
							"WHERE itemName = '" . $selectedItem .
							"' AND shoppingListID = " . $selectedShoppingList_ID . ";";		
					$sameShopItem_DATA = mysqli_query($connection, $querySame_ShopItem, MYSQLI_STORE_RESULT);
					while ($rowData = mysqli_fetch_row($sameShopItem_DATA)) {
						$sameShopItem_Count = $rowData[0];
					}//End While
					//IF none was found
					if ($sameShopItem_Count == 0) {
						if ((is_numeric( ($selectedQuantity) ) ) == FALSE) {
							echo "<script type=\"text/javascript\">alert(\"Your input for Quantity is non-numeric. Please enter a numeric value.\");</script>";	
						} 
	//                                        else if (empty($selectedDescription)) {
	//                        echo "<script type=\"text/javascript\">alert(\"Your description can't be empty. Please enter a value.\");</script>";
	//                    }
						else {
							if ($selectedQuantity<1) {
						   		$selectedQuantity=1; //Just need to set to default quantity:1
							}
							//Now let's perform a INSERT to the DB
							$sql = 'INSERT INTO `shoppinglistitem`(shoppingListID, itemName, shoppingListQty,
							shoppingListDesc, is_Checked) VALUES(?, ?, ?, ?, ?);';
							if ($prepareStmt = mysqli_prepare($connection, $sql)) {
                                $isCheckedDefault_val = 0;
								mysqli_stmt_bind_param($prepareStmt, 'isisi', $selectedShoppingList_ID, $selectedItem, $selectedQuantity, $selectedDescription,$isCheckedDefault_val);
								mysqli_stmt_execute($prepareStmt);
								// Closes the prepared statement object
								mysqli_stmt_close($prepareStmt);
							} // end of prepareStatement IF
						}// End of inner ELSE
					}
					if ($sameShopItem_Count > 0) {
						echo "<script type=\"text/javascript\">alert(\"This selected item is already added to this shopping list\");</script>";
					}
				} // End of !Empty(selectedItem) block
				else 
				{
					if($checkDup){
						echo "<script type=\"text/javascript\">alert(\"The selected item is empty. It is either you left the new item name blank \\n".
					     "OR you chose an invalid item.\");</script>";
					}
					
				}
            } //End of isset($_POST["selectitem"])
            if (isset($_POST["deleteItems"])) {
//                echo "<script>alert('Content: " . $_POST["deleteItems"] . "');</script>";
                $shoppingListName = $_SESSION["selectedShoppingList"];
                $toDeleteShopItem = $_POST["deleteItems"];

                if (!empty($_POST["deleteItems"])) {
                    //SQL for DELETION
                    $queryDel_ShopItem = "DELETE FROM `shoppinglistitem` " .
                            "WHERE shoppingListItemID = '" . $toDeleteShopItem . "'";

                    $delResult = mysqli_query($connection, $queryDel_ShopItem);

                } else { //empty($_POST["deleteItems"])
                    $queryCountListItems = "SELECT COUNT(shoppingListID) " .
                            "FROM `shoppinglistitem` AS sli INNER JOIN `items` AS it " .
                            "WHERE (it.itemName = sli.itemName) AND " .
                            "( sli.shoppingListID =(SELECT sl.shoppingListID FROM `shoppinglist` AS sl WHERE sl.shoppingListName = '" .
                            $_SESSION["selectedShoppingList"] . "') );";

                    $countListItems_Data = mysqli_query($connection, $queryCountListItems, MYSQLI_STORE_RESULT);
                    $rowData = mysqli_fetch_row($countListItems_Data);

                    $numOfListItems = $rowData[0];

                    $sql = "";
                    //$name="deadline";
                    //echo "Deadline : ".$_POST["deadline"];
                    if (!empty($_POST["deadline"])) {
                        $queryUpdateDeadline = "UPDATE `shoppinglist` " .
                                "SET deadline = '" . $_POST["deadline"] . "' " .
                                "WHERE shoppingListName = '" . $_SESSION["selectedShoppingList"] . "';";

                        $updateDeadline_Data = mysqli_query($connection, $queryUpdateDeadline);
                        $_SESSION["shopList_Deadline"] = $_POST["deadline"];
                    }


                    for ($i = 1; $i <= $numOfListItems; $i++) {
                    	if((is_numeric($_POST["shopItem_Qty" . $i])==FALSE) || $_POST["shopItem_Qty" . $i]<1){
			$_POST["shopItem_Qty" . $i] = 1;
			}
                        $sql = "UPDATE `shoppinglistitem` " .
                                "SET shoppingListDesc = '{$_POST["shopItem_DESC" . $i]}', shoppingListQty={$_POST["shopItem_Qty" . $i]} " .
                                "WHERE shoppingListItemID = {$_POST["shopItemID" . $i]};";
			$updateShopItem_Result = mysqli_query($connection, $sql);
                    }

                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["list"])) {
                $shoppingListName = $_GET["list"];
                $_SESSION["selectedShoppingList"] = $shoppingListName;

//                echo "<script>alert('" . $shoppingListName . "');</script>";


                //Fetch data from the ShoppingList Table
                $queryDeadline = "SELECT deadline FROM `shoppinglist` WHERE shoppingListName ='" . $shoppingListName . "';";

                $deadline_Data = mysqli_query($connection, $queryDeadline, MYSQLI_STORE_RESULT);
                $rowData = mysqli_fetch_row($deadline_Data);

                if ($rowData[0] == "NA") {
                    $urgency = "-";
                } else {
                    $urgency = $rowData[0];
                }
                $_SESSION["shopList_Deadline"] = $urgency;
            }
        }

        if (isset($_SESSION["shopList_Deadline"])) {
            $urgency = $_SESSION["shopList_Deadline"];
        }
        ?>
        <div class="container" id="container-table">
            <br></br>
            <form name="updateShoppingList"  method="POST" role="form">
                <br/>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3>Shopping List: <?php echo $_GET["list"] ?></h3>
                        <h4 style="float:right; color: black">Urgency date: <?php echo $urgency ?></h4>
                    </div>
                    <table class="table" id="addList" onclick="displayList()">
        <?php
	$queryShoppingListItems = "SELECT sli.itemName, sli.shoppingListItemID, sli.shoppingListDesc, sli.shoppingListQty " .
        	"FROM `shoppinglistitem` as sli WHERE sli.shoppingListID=(SELECT shoppingListID FROM shoppinglist WHERE shoppingListName='".$_SESSION["selectedShoppingList"]."')";

        $shoppingListItems_Data = mysqli_query($connection, $queryShoppingListItems, MYSQLI_STORE_RESULT);

        echo populateShoppingList_Items($shoppingListItems_Data);
        ?>			
                    </table>
                    <input type="hidden" name="deleteItems" id="delItems_ID">

                </div>

                <!-- Bottom Left Container -->            

                <div class="container">
                    <div class="row btn-update-row">

                        <button class="btn btn-primary" type="submit" onsubmit="return updateList();" onclick="uploadList();">Update List</button>

                    </div>

                    <div class="row">
                        <div class="col-sm-4"><h3 class="h3">Set Urgency Dateline</h3></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1"><h3 class="h3">By : </h3></div>
                        <br />
                        <div class="col-sm-1" >
                            <input type="text" id="datepick" size="20" name="deadline" placeholder="Select Date">
                            <script type="text/javascript">$('#datepick').datepicker({ minDate: 0 });</script>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <!-- Right Container -->
        <div class="container" id="container-add">

            <!--form name="newShoppingListItemForm" onsubmit="return checkEmptyInput();" method="post" role="form" -->
            <form name="newShoppingListItemForm" method="POST" role="form">
                <h3 class="h3">Add things to buy :</h3>
                <br/>
                <div class="btn-group"  >                       
                    <select class="btn btn-default dropdown-toggle form-control" id="dropdown-add" name="selectitem">
                        <?php
                        //echo "<script type=\"text/javascript\">alert('".$emailAdd."');</script>;";
                        $queryItemList = "SELECT itemName FROM `items` WHERE email = '" . $emailAdd . "';";
                        $itemListData = mysqli_query($connection, $queryItemList, MYSQLI_STORE_RESULT);
                        echo '<option value ="default">Choose existing item </option>';
                        while ($rowData = mysqli_fetch_row($itemListData)) {
                            $itemName = $rowData[0];
                            echo "\r\n        <option value=\"" . $itemName . "\">" . $itemName . "</option>";
                        }//End While
                        ?>
                    </select>
                    <input placeholder="type here for new item" type="text" name="newItem">
                </div>
                <br /><br /><br /><br /><br />

                <div class="row">
                    <div class="col-sm-4"><h3 class="h3">Quantity : </h3></div>
                    <div class="col-sm-5" id="qtyCol" ><input type="text" name="newShoppingListQty" value="1" class="text-primary" id="newShoppingListQty"></div>

                </div>
                <div class="row">
                    <div class="col-sm-4"><h3 class="h3">Description : </h3></div>
                    <div class="col-sm-5" id="descCol"><textarea id="descTxtArea" name="newShoppingListDesc" class="text-primary" id="newShoppingListDesc"></textarea></div>
                    <div class="col-sm-4" id="addBtnCol">
                        <button type="submit" class="btn btn-primary" id="addBtn">Add</button>
                    </div>
                </div>
            </form>

        </div>

    </body>
</html>
