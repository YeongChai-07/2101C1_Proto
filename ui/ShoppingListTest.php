<!DOCTYPE html>
<?php include 'header.inc.php'; ?>


<html>
    <head>
        <title>Shopping List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../js/datepicker2.1/datepickr.css">
        <script src="../js/datepicker2.1/datepickr.js"></script>
        <script src="../js/datepicker2.1/datepickr.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
            echo '<script type="text/javascript">alert(\'ROWS: ' . mysqli_num_rows($shoppingListItems_Data) . '\');</script>';

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
                            "            <button class=\"btn-danger\" type=\"submit\" onclick=\"removeShoppingItem('" . $rowData['shoppingListDesc'] . "');\" value=\"" . $rowData['shoppingListDesc'] . "\">\r\n" .
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
                $selectedItem = $_POST["selectitem"];
                $selectedQuantity = item_input($_POST["newShoppingListQty"]);
                $selectedDescription = $_POST["newShoppingListDesc"];
                $shoppingListName = $_SESSION["selectedShoppingList"];
                if (!empty($_POST["newItem"])) {
                    $itemExist = FALSE;
                    $newItem = $_POST["newItem"];
                    $sql11 = "SELECT * FROM items";
                    if ($result = mysqli_query($connection, $sql11)) {
                        while ($row11 = mysqli_fetch_assoc($result)) {
                            if ($row11['itemName'] == $newItem) {
                                $itemExist = TRUE;
                            }
                        }
                        if (!$itemExist) {

                            $sql22 = "INSERT INTO items (itemName, email) VALUES(?,?)";
                            if ($statement = mysqli_prepare($connection, $sql22)) {
                                mysqli_stmt_bind_param($statement, 'ss', $newItem, $emailAdd);
                                mysqli_stmt_execute($statement);
                            }
                            $selectedItem = $newItem;
                        }
                    }
                }



        //Fetch data from the ShoppingList Table
                $queryShoppingList = "SELECT shoppingListID FROM `shoppinglist` WHERE shoppingListName ='" . $shoppingListName . "';";
                $shoppingListData = mysqli_query($connection, $queryShoppingList, MYSQLI_STORE_RESULT);

                while ($rowData = mysqli_fetch_row($shoppingListData)) {
                    $selectedShoppingList_ID = $rowData[0];
                }//End While
                //Fetch data from the Items Table

                $queryItemID = "SELECT itemID FROM `items` WHERE itemName = '" . $selectedItem . "' " .
                        "AND email = '" . $emailAdd . "';";

                $itemID_Data = mysqli_query($connection, $queryItemID, MYSQLI_STORE_RESULT);

                while ($rowData = mysqli_fetch_row($itemID_Data)) {
                    $selectedItem_ID = $rowData[0];
                }//End While
                //Check whether is there this Item in this ShoppingItemList
                $querySame_ShopItem = "SELECT COUNT(shoppingListItemID) FROM `shoppinglistitem` " .
                        "WHERE itemID = " . $selectedItem_ID .
                        " AND shoppingListID = " . $selectedShoppingList_ID . ";";

                $sameShopItem_DATA = mysqli_query($connection, $querySame_ShopItem, MYSQLI_STORE_RESULT);

                while ($rowData = mysqli_fetch_row($sameShopItem_DATA)) {
                    $sameShopItem_Count = $rowData[0];
                }//End While
                //IF none was found
                if ($sameShopItem_Count == 0) {
                    if (empty($selectedQuantity)) {
                       $selectedQuantity=1; //Just need to set to default quantity:1
                    } else if ((is_numeric( ($selectedQuantity) ) ) == FALSE) {
					    echo "<script type=\"text/javascript\">alert(\"Your input for Quantity is non-numeric. Please enter a numeric value.\");</script>";	
					} else if (empty($selectedDescription)) {
                        echo "<script type=\"text/javascript\">alert(\"Your description can't be empty. Please enter a value.\");</script>";
                    } else {
                        //Now let's perform a INSERT to the DB
                        $sql = 'INSERT INTO `shoppinglistitem`(shoppingListID, itemID, shoppingListQty,
			            shoppingListDesc) VALUES(?, ?, ?, ?);';

                        if ($prepareStmt = mysqli_prepare($connection, $sql)) {

                            mysqli_stmt_bind_param($prepareStmt, 'iiis', $selectedShoppingList_ID, $selectedItem_ID, $selectedQuantity, $selectedDescription);
                            mysqli_stmt_execute($prepareStmt);

                            // Closes the prepared statement object
                            mysqli_stmt_close($prepareStmt);
                        } // end of prepareStatement IF
                    }// End of inner ELSE
                }
                if ($sameShopItem_Count > 0) {
                    echo "<script type=\"text/javascript\">alert(\"This selected item is already added to this shopping list\");</script>";
                }
            }

            if (isset($_POST["deleteItems"])) {
                echo "<script>alert('Content: " . $_POST["deleteItems"] . "');</script>";
                $shoppingListName = $_SESSION["selectedShoppingList"];
                $toDeleteShopItem = $_POST["deleteItems"];

                if (!empty($_POST["deleteItems"])) {
                    //SQL for DELETION
                    $queryDel_ShopItem = "DELETE FROM `shoppinglistitem` " .
                            "WHERE shoppingListDesc = '" . $toDeleteShopItem . "' " .
                            "AND shoppingListID = (SELECT sl.shoppingListID FROM `shoppinglist` AS sl " .
                            "WHERE sl.shoppingListName = '" . $shoppingListName . "');";

                    $delResult = mysqli_query($connection, $queryDel_ShopItem);

                } else { //empty($_POST["deleteItems"])
                    $queryCountListItems = "SELECT COUNT(shoppingListID) " .
                            "FROM `shoppinglistitem` AS sli INNER JOIN `items` AS it " .
                            "WHERE (it.itemID = sli.itemID) AND " .
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
                        $sql = "UPDATE `shoppinglistitem` " .
                                "SET shoppingListDesc = '{$_POST["shopItem_DESC" . $i]}', shoppingListQty={$_POST["shopItem_Qty" . $i]} " .
                                "WHERE shoppingListItemID = {$_POST["shopItemID" . $i]}) );";
                    }

                    $updateShopItem_Result = mysqli_query($connection, $sql);
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["list"])) {
                $shoppingListName = $_GET["list"];
                $_SESSION["selectedShoppingList"] = $shoppingListName;

                echo "<script>alert('" . $shoppingListName . "');</script>";


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
            <form name="updateShoppingList"  method="POST" onsubmit="clearTable();" role="form">
                <br/>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3>Shopping List</h3>
                        <h4 style="float:right; color: black">Urgency date: <?php echo $urgency ?></h4>
                    </div>
                    <table class="table" id="addList" onclick="displayList()">
        <?php
        $queryShoppingListItems = "SELECT it.itemName, sli.shoppingListItemID, sli.shoppingListDesc, sli.shoppingListQty " .
                "FROM `shoppinglistitem` AS sli INNER JOIN `items` AS it " .
                "WHERE (it.itemID = sli.itemID) AND " .
                "( sli.shoppingListID =(SELECT sl.shoppingListID FROM `shoppinglist` AS sl WHERE sl.shoppingListName = '" .
                $_SESSION["selectedShoppingList"] . "') );";

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
                        <div class="col-sm-1" >
                            <input id="datepick" size="20" name="deadline">
                            <script type="text/javascript">
                                new datepickr('datepick');</script>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <!-- Right Container -->
        <div class="container" id="container-add">
            <h2 class="h2" id="h2-add"><?php echo $_GET["list"] ?></h2>

            <!--form name="newShoppingListItemForm" onsubmit="return checkEmptyInput();" method="post" role="form" -->
            <form name="newShoppingListItemForm" onsubmit="clearTable();" method="POST" role="form">
                <h3 class="h3">Add things to buy :</h3>
                <br/>
                <div class="btn-group"  >                       
                    <select class="btn btn-default dropdown-toggle form-control" id="dropdown-add" name="selectitem">
                        <?php
                        //echo "<script type=\"text/javascript\">alert('".$emailAdd."');</script>;";
                        $queryItemList = "SELECT itemName FROM `items` WHERE email = '" . $emailAdd . "';";
                        $itemListData = mysqli_query($connection, $queryItemList, MYSQLI_STORE_RESULT);
                        echo '<option value ="default">Choose or type </option>';
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
                    <div class="col-sm-5" id="qtyCol" ><input type="text" name="newShoppingListQty" placeholder="1" class="text-primary" id="newShoppingListQty"></div>

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
