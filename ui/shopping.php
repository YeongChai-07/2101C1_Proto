<?php
include 'header.inc.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Shopping Lists</title>

        <script>
            function checkEmptyListName() {
                var itemNameInput = document.forms["newListForm"]["newList"].value;
                if (itemNameInput == "")
                {
                    alert("Your list name can't be empty!");
                    return false;
                }
                return true;
            }
            function clearTable() {
                document.getElementById("shoppingList_REC").innerHTML = "";
            }

            function removeShoppingList(inList_Name)
            {
                document.getElementById("delShopList_ID").value = inList_Name;
            }
        </script>
    </head>
    <body class="container-fluid">
        <?php
        $user = $_SESSION['email'];
        $validNewList_Val = TRUE;
        ?>
        <div class="container" style="width:50%; float: left;">
            <br/><br>
            <h1> My Shopping Lists </h1>
            <br/><br/>


            <?php

            function populateShoppingList_CurrUser($inEmail, $shoppingListData) {

                $tableData_HTML = "    <tbody>\r\n" .
                        "        <tr>\r\n" .
                        "            <th class=\"col-sm-12\">\r\n" .
                        "                Shopping Lists Created\r\n" .
                        "            </th>\r\n" .
                        "            <th>\r\n" .
                        "                View\r\n" .
                        "            </th>\r\n" .
                        "            <th>\r\n" .
                        "                Edit\r\n" .
                        "            </th>\r\n" .
                        "            <th>\r\n" .
                        "                Delete?\r\n" .
                        "            </th>\r\n" .
                        "        </tr>";

//		echo '<script type="text/javascript">alert(\'ROWS: '. mysqli_num_rows($shoppingListData).'\');</script>';
                if (mysqli_num_rows($shoppingListData) > 0) {  // This represents there is at least ONE record of the shopping list created by the user
                    $listCount = 1;
                    while ($rowData = mysqli_fetch_row($shoppingListData)) {
                        $tableData_HTML.="\r\n        <tr id=\"list" . $listCount . "\">\r\n" .
                                "            <td class=\"col-sm-12\">" . $rowData[0] . "</td>\r\n" .
                                "            <td class=\"viewButton\">\r\n" .
                                "                <a href=\"./ViewShoppingList.php?list=" . $rowData[0] . "\">\r\n" .
                                "                    <button type=\"button\" class=\"btn\">\r\n" .
                                "                        <span class=\"glyphicon glyphicon-eye-open\"></span>\r\n" .
                                "                    </button>\r\n" .
                                "                </a>\r\n" .
                                "            </td>\r\n";

                        $tableData_HTML.="            <td class=\"editButton\">\r\n" .
                                "                <a href=\"./ShoppingListTest.php?list=" . $rowData[0] . "\">\r\n" .
                                "                    <button type=\"button\" class=\"btn\">\r\n" .
                                "                        <span class=\"glyphicon glyphicon-pencil\"></span>\r\n" .
                                "                    </button>\r\n" .
                                "                </a>\r\n" .
                                "            </td>\r\n" .
                                "            <td class=\"deleteButton\">\r\n" .
                                "                    <button type=\"submit\" class=\"btn\" " .
                                "onclick=\"removeShoppingList('" . $rowData[0] . "');\" \" value=\"" . $rowData[0] . "\" style=\"width:60px\">\r\n" .
                                "                        <span class=\"glyphicon glyphicon-trash\"></span>\r\n" .
                                "                    </button>\r\n" .
                                "            </td>\r\n" .
                                "        </tr>";

                        $listCount+=1;
                    }//End While
                    $tableData_HTML.="\r\n    </tbody>";
                }

                return $tableData_HTML;
            }

//End of function
            /* if (!isset($_GET["p"])){
              echo '<tr id="list1">';
              echo '<td class="col-sm-12"> ';
              echo "Family";
              echo '</td>';
              echo '<td class="viewButton"><a href="./ViewShoppingList.php?list=Family"><button type="button" class="btn"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>';
              echo '<td class="editButton"><a href="./ShoppingListTest.php?list=Family"><button type="button" class="btn"><span class="glyphicon glyphicon-pencil"></span></button></a></td>';
              echo '<td class="deleteButton" onclick="$('#list1').toggle(); alert('Successfully deleted Family Shopping List.');">;

              echo '<button type="button" class="btn" style="width:60px"><span class="glyphicon glyphicon-trash"></span></button></td>';
              echo '</tr>';
              } */

            //Fetch data from the ShoppingList Table
            //$queryShoppingList = "SELECT shoppingListName FROM `shoppinglist` WHERE email ='" . $user ."';";
            //$shoppingListData = mysqli_query($connection, $queryShoppingList, MYSQLI_STORE_RESULT);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //echo"<script>alert('add status: " . isset($_POST["newList"]) . "\\n Update Status: "
                //. isset($_POST["deleteShopList"]) . "');</script>";
                if (isset($_POST["newList"])) {
                    $shoppingListName = $_POST["newList"];
                    if (!empty($shoppingListName)) { //Check whether is the input empty
                        //echo '<script type="text/javascript">alert(\'okay :)\');</script>';

                        //Process the creation of this shopping list
                        $sql = 'INSERT INTO `shoppinglist`(email, shoppingListName, deadline) VALUES(?, ?, ?);';
                        if ($prepareStmt = mysqli_prepare($connection, $sql)) {
                            $deadlineDefault_val = 'NA';

                            mysqli_stmt_bind_param($prepareStmt, 'sss', $user, $shoppingListName, $deadlineDefault_val);
                            mysqli_stmt_execute($prepareStmt);
                            // Closes the prepared statement object
                            mysqli_stmt_close($prepareStmt);
                        }
                    }//end of !empty
                    else { //Empty field
                        echo '<script type="text/javascript">alert(\'List Name Cannot Be Empty\');</script>';
                        $validNewList_Val = FALSE;
                    }
                }//end of isset newList
                if (isset($_POST["deleteShopList"])) {
                    //echo "Content: ".$_POST["deleteShopList"];
                    $shopList_toDel = $_POST["deleteShopList"];
                    $queryShopList_ID = "SELECT sl.shoppingListID FROM `shoppinglist` AS sl WHERE sl.shoppingListName = '" .
                            $shopList_toDel . "';";
                    $shoppingListID_Data = mysqli_query($connection, $queryShopList_ID, MYSQLI_STORE_RESULT);
                    $rowData = mysqli_fetch_row($shoppingListID_Data);
                    $shoppingList_ID = $rowData[0];

                    $queryToDel_ShopItems = "DELETE FROM `shoppinglistitem` " .
                            "WHERE shoppingListID = " . $shoppingList_ID . ";";

                    $delShopItems_Result = mysqli_query($connection, $queryToDel_ShopItems);
                    $queryDelShoppingList = "DELETE FROM `shoppinglist` WHERE shoppingListName ='" . $shopList_toDel . "';";
                    $delshoppingList_Data = mysqli_query($connection, $queryDelShoppingList);
                }
            }//End of $_SERVER

            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET["p"])) {
                    $toDelShopList_ID = $_GET["p"];

                    if ($toDelShopList_ID > 0) {
                        $queryToDel_ShopItems = "DELETE FROM `shoppinglistitem` " .
                                "WHERE shoppingListID = " . $toDelShopList_ID . ";";

                        $delShopItems_Result = mysqli_query($connection, $queryToDel_ShopItems);

                        $queryToDel_ShopList = "DELETE FROM `shoppinglist` " .
                                "WHERE shoppingListID = " . $toDelShopList_ID . ";";

                        $delShopItems_Result = mysqli_query($connection, $queryToDel_ShopList);

                        echo "<script type=\"text/javascript\">alert(\"Deletion Success.\");</script>";
                        header('Location: shopping.php');
                    }//End of $toDelShopList_ID
                }//End of isset
            }

            /*             * *****     ELSE Block ****** */
            if ($validNewList_Val == TRUE) {
                //Fetch data from the ShoppingList Table
                $queryShoppingList = "SELECT shoppingListName FROM `shoppinglist` WHERE email ='" . $user . "';";
                $shoppingListData = mysqli_query($connection, $queryShoppingList, MYSQLI_STORE_RESULT);
            }
            ?>
            <form name="deleteShoppingList" action="shopping.php" method="POST" onsubmit="clearTable();" role="form">
                <table class="table table-bordered table-hover" id="shoppingList_REC">
                    <?php echo populateShoppingList_CurrUser($user, $shoppingListData); ?>				
                </table>
                <input type="hidden" name="deleteShopList" id="delShopList_ID">
            </form>
        </div>
        <div class="container"  style="width:50%; float:right; padding-left:10%; margin-top:10%;">
            <h3 class="h3">Add List: </h3>
            <form name="newListForm" action="shopping.php" method="POST" class="right" onsubmit="clearTable();">
                <input type="text" name="newList" placeholder="Insert list name here">
                <button class="btn">Submit</button>
            </form>	
        </div>
    </body>
</html>