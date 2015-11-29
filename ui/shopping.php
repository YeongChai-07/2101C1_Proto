<?php
//    if(!$_SESSION['email']){
//        header("location:homepage.php");
//        die;
//    }
//
//    $user = $_SESSION['email'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Shopping Lists</title>
        
        <script>
            function checkEmptyListName(){
                var itemNameInput=document.forms["newListForm"]["newList"].value;
                if(itemNameInput=="")
                {
                    alert("Your list name can't be empty!");
                    return false;
                }
                return true;
            }
			function clearTable(){
				document.getElementById("#shoppingList_REC").innerHTML = "";
			}			
        </script>
    </head>
    <body class="container-fluid">
         <?php include 'header.inc.php'; ?>
        <div class="container" style="width:50%; float: left;">
            <br/><br>
            <h1> My Shopping Lists </h1>
            <br/><br/>
            <table class="table table-bordered table-hover">
                <tbody>
                    <tr>
                        <th class="col-sm-12">Shopping Lists Created</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete?</th>
                    </tr>
                    
                    <?php
					    function populateShoppingList_CurrUser($inEmail, $shoppingListData)
						{
							
							$tableData_HTML = "";
						
						    echo '<script type="text/javascript">alert(\'ROWS: '. mysqli_num_rows($shoppingListData).'\');</script>';
						    if(mysqli_num_rows($shoppingListData) > 0)  // This represents there is at least ONE record of the shopping list created by the user
						    {
								$listCount = 1;
								while($rowData = mysqli_fetch_row($shoppingListData) )
								{
									$tableData_HTML.="\r\n        <tr id=\"list".$listCount."\">\r\n".
									"            <td class=\"col-sm-12\">".$rowData[0]."</td>\r\n".
						            "            <td class=\"viewButton\">\r\n".
									"                <a href=\"./ViewShoppingList.php?list=".$rowData[0]."\">\r\n".
									"                    <button type=\"button\" class=\"btn\">\r\n".
									"                        <span class=\"glyphicon glyphicon-eye-open\"></span>\r\n".
									"                    </button>\r\n".
									"                </a>\r\n".
									"            </td>\r\n";
									
									$tableData_HTML.="            <td class=\"editButton\">\r\n".
									"                <a href=\"./ShoppingListTest.php?list=".$rowData[0]."\">\r\n".
									"                    <button type=\"button\" class=\"btn\">\r\n".
									"                        <span class=\"glyphicon glyphicon-pencil\"></span>\r\n".
									"                    </button>\r\n".
									"                </a>\r\n".
									"            </td>\r\n".
						            "            <td class=\"deleteButton\" onclick=\"$('#list'".$listCount."').toggle();\">\r\n".
									"                    <button type=\"button\" class=\"btn\" style=\"width:60px\">\r\n".
									"                        <span class=\"glyphicon glyphicon-trash\"></span>\r\n".
									"                    </button>\r\n".
									"            </td>\r\n".
                                    "        </tr>";
									
									$listCount+=1;

								}//End While
						    }
							
							return $tableData_HTML;
							
						}//End of function
                        /*if (!isset($_GET["p"])){
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

						$isPosted = FALSE;	
						
					    //$emailAdd = $_SESSION['email'];
						//My Code-testing on email
						$emailAdd = 'ahtancw123@gmail.com';
						
						//Fetch data from the ShoppingList Table
						$queryShoppingList = "SELECT shoppingListName FROM `shoppinglist` WHERE email ='" . $emailAdd ."';";
						$shoppingListData = mysqli_query($connection, $queryShoppingList, MYSQLI_STORE_RESULT);
						
					    if ($_SERVER["REQUEST_METHOD"] == "POST")
						{
							if (isset($_POST["newList"])){
								$isPosted = TRUE;
								$shoppingListName = $_POST["newList"];
								if(!empty($shoppingListName)) //Check whether is the input empty
								{
									echo '<script type="text/javascript">alert(\'okay :)\');</script>';
									
									//Process the creation of this shopping list
									$sql = 'INSERT INTO `shoppinglist`(email, shoppingListName, deadline) VALUES(?, ?, ?);';
									if($prepareStmt = mysqli_prepare($connection, $sql))
									{
										$deadlineDefault_val = 'NA';
										
									    mysqli_stmt_bind_param($prepareStmt, 'sss', $emailAdd, $shoppingListName, $deadlineDefault_val );
									    mysqli_stmt_execute($prepareStmt);
									    // Closes the prepared statement object
									    mysqli_stmt_close($prepareStmt);
									}
									
									//Fetch data from the ShoppingList Table
						            //$queryShoppingList = "SELECT shoppingListName FROM `shoppinglist` WHERE email ='" . $inEmail ."';";
						            $shoppingListData = mysqli_query($connection, $queryShoppingList, MYSQLI_STORE_RESULT);
									echo populateShoppingList_CurrUser($emailAdd, $shoppingListData);
											
								}//end of !empty
								else //Empty field
								{
									echo '<script type="text/javascript">alert(\'BOO :(\');</script>';
									
									
								}
						    }//end of isset
						}//End of $_SERVER
						
						if($_SERVER["REQUEST_METHOD"] == "GET")
						{
							if(isset($_GET["p"]))
							{
								$toDelShopList_ID = $_GET["p"];
								
								if($toDelShopList_ID >0)
								{
									$queryToDel_ShopItems = "DELETE FROM `shoppinglistitem` ".
									"WHERE shoppingListID = " .$toDelShopList_ID. ";";
									
									$delShopItems_Result = mysqli_query($connection, $queryToDel_ShopItems);
									
									$queryToDel_ShopList = "DELETE FROM `shoppinglist` ".
									"WHERE shoppingListID = " .$toDelShopList_ID. ";";
									
									$delShopItems_Result = mysqli_query($connection, $queryToDel_ShopList);
									
									echo "<script type=\"text/javascript\">alert(\"Deletion Success.\");</script>";
									header('Location: shopping.php');
									
								}//End of $toDelShopList_ID
							}//End of isset
						}
						
												/*******     ELSE Block *******/
						if(!$isPosted)
						{
							echo populateShoppingList_CurrUser($emailAdd, $shoppingListData);
						}
                            echo '</tr>';
                    ?>
                </tbody>
            </table>
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