<?php
    include 'header.inc.php';
    if(!$_SESSION['email']){
        header("location:homepage.php");
        die;
    }

    $user = $_SESSION['email'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Shopping Lists</title>

        <script>
            function checkEmptyListName(){
                var itemNameInput = document.forms["newListForm"]["newList"].value;
                if (itemNameInput == ""){
                    alert("Your list name can't be empty!");
                    return false;
                }
                return true;
            }

            function removeShoppingList(inList_Name){
                document.getElementById("delShopList_ID").value = inList_Name;
            }
        </script>
    </head>
    <body class="container-fluid">
        <div class="container navContainSpace">
            <div class="row">
                <div class="col-xs-5 col-xs-offset-2">
                    <h1>My Shopping Lists</h1>
                    <?php
                        function populateShoppingList_CurrUser($inEmail, $shoppingListData){

                        $tableData_HTML = 
                                "<tbody>"
                                . "<tr><th class=\"col-sm-12\">Shopping Lists Created</th>"
                                . "<th>View</th>"
                                . "<th>Edit</th>"
                                . "<th>Delete?</th>"
                                . "</tr>";

                        if (mysqli_num_rows($shoppingListData) > 0){  // This represents there is at least ONE record of the shopping list created by the user
                            $listCount = 1;
                            while ($rowData = mysqli_fetch_row($shoppingListData)){
                                $tableData_HTML.="<tr id=\"list" . $listCount . "\">"
                                        . "<td class=\"col-sm-12\">" . $rowData[0] . "</td>"
                                        . "<td class=\"viewButton\"><a href=\"./ViewShoppingList.php?list=" . $rowData[0] . "\"><button type=\"button\" class=\"btn btn-default\"><span class=\"glyphicon glyphicon-eye-open\"></span></button></a></td>";

                                $tableData_HTML.="<td class=\"editButton\"><a href=\"./EditShoppingList.php?list=" . $rowData[0] . "\"><button type=\"button\" class=\"btn btn-default\"><span class=\"glyphicon glyphicon-pencil\"></span></button></a></td>"
                                        . "<td class=\"deleteButton\"><button type=\"submit\" class=\"btn btn-default\"onclick=\"removeShoppingList('" . $rowData[0] . "');\" \" value=\"" . $rowData[0] . "\" style=\"width:60px\"><span class=\"glyphicon glyphicon-trash\"></span></button></td>"
                                        . "</tr>";

                                $listCount+=1;
                            }
                            $tableData_HTML.="</tbody>";
                        }

                        return $tableData_HTML;
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                            if (isset($_POST["newList"])){
                                $shoppingListName = $_POST["newList"];
                                if (!empty($shoppingListName)){ //Check whether is the input empty
								    //Before we add check whether is there such 
									//shoppinglist with the same name that exists 
					                $querySame_ShopList = "SELECT COUNT(shoppingListName) FROM `shoppinglist` " .
							        "WHERE shoppingListName = '" . $shoppingListName . "';";
									$sameShopList_DATA = mysqli_query($connection, $querySame_ShopList, MYSQLI_STORE_RESULT);
									
									$rowData = mysqli_fetch_row($sameShopList_DATA);
									$sameShopList_Count = $rowData[0];
									
									if($sameShopList_Count == 0) //IF none was found
									{
										//Process the creation of this shopping list
										$sql = 'INSERT INTO `shoppinglist`(email, shoppingListName, deadline) VALUES(?, ?, ?);';
										if ($prepareStmt = mysqli_prepare($connection, $sql)){
											$deadlineDefault_val = 'NA';

											mysqli_stmt_bind_param($prepareStmt, 'sss', $user, $shoppingListName, $deadlineDefault_val);
											mysqli_stmt_execute($prepareStmt);
											// Closes the prepared statement object
											mysqli_stmt_close($prepareStmt);
										}
									}// End of $sameShopList_Count IF block
									else
									{
										echo "<script type=\"text/javascript\">alert(\"The entered shopping list name already exists.\");</script>";
									}
                                }
                                else{
                                    echo '<script type="text/javascript">alert(\'List Name Cannot Be Empty\');</script>';
                                }
                            }
                            if (isset($_POST["deleteShopList"])){
                                $shopList_toDel = $_POST["deleteShopList"];
                                $queryShopList_ID = "SELECT sl.shoppingListID FROM `shoppinglist` AS sl WHERE sl.shoppingListName = '" .$shopList_toDel . "';";
                                $shoppingListID_Data = mysqli_query($connection, $queryShopList_ID, MYSQLI_STORE_RESULT);
                                $rowData = mysqli_fetch_row($shoppingListID_Data);
                                $shoppingList_ID = $rowData[0];

                                $queryToDel_ShopItems = "DELETE FROM `shoppinglistitem` WHERE shoppingListID = " . $shoppingList_ID . ";";

                                $delShopItems_Result = mysqli_query($connection, $queryToDel_ShopItems);
                                $queryDelShoppingList = "DELETE FROM `shoppinglist` WHERE shoppingListName ='" . $shopList_toDel . "';";
                                $delshoppingList_Data = mysqli_query($connection, $queryDelShoppingList);
                            }
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "GET"){
                            if (isset($_GET["p"])){
                                $toDelShopList_ID = $_GET["p"];

                                if ($toDelShopList_ID > 0){
                                    $queryToDel_ShopItems = "DELETE FROM `shoppinglistitem` WHERE shoppingListID = " . $toDelShopList_ID . ";";
                                    $delShopItems_Result = mysqli_query($connection, $queryToDel_ShopItems);
                                    $queryToDel_ShopList = "DELETE FROM `shoppinglist` WHERE shoppingListID = " . $toDelShopList_ID . ";";
                                    $delShopItems_Result = mysqli_query($connection, $queryToDel_ShopList);

                                    echo "<script type=\"text/javascript\">alert(\"Deletion Success.\");</script>";
                                    header('Location: shopping.php');
                                }
                            }
                        }

                            //Fetch data from the ShoppingList Table
                            $queryShoppingList = "SELECT shoppingListName FROM `shoppinglist` WHERE email ='" . $user . "';";
                            $shoppingListData = mysqli_query($connection, $queryShoppingList, MYSQLI_STORE_RESULT);
                    ?>
                    <form name="deleteShoppingList" action="shopping.php" method="POST" role="form">
                        <table class="table table-bordered table-hover" id="shoppingList_REC">
                            <?php echo populateShoppingList_CurrUser($user, $shoppingListData); ?>				
                        </table>
                        <input type="hidden" name="deleteShopList" id="delShopList_ID">
                    </form>
                </div>
                <div class="col-xs-5">
                    <br><br>
                    <h4>Add List: </h4>
                    <form name="newListForm" action="shopping.php" method="POST" class="right">
                        <input type="text" name="newList" placeholder="Insert list name here">
                        <button class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>