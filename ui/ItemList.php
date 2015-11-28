<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
	<title>Item List</title>
        
<!--Scenario Error: Empty item name -->
        <script>
            function checkEmptyItem(){
                var itemNameInput=document.forms["newItemForm"]["newItem"].value;
                if(itemNameInput==""){
                    alert("Your item name can't be empty! Did you click on this by accident?");
                    return false;
                }
                return true;
            }
	</script>
    </head>
    <body class="container-fluid">
        <?php include 'header.inc.php'; ?>
        <?php
            if(!$_SESSION['email']){
                header("location:homepage.php");
                die;
            }

            $user = $_SESSION['email'];
        ?>
        <div class="container navContainSpace">
            <h1 class="center">Current Items</h1>
            <div class="col-xs-6 col-md-5 center">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="col-sm-12">Item Added</th>
                            <th class="center-text">Delete?</th>
                        </tr>
                        <?php
                            //Prototype Scenario 1: Default look
                            $addItemSql = "SELECT * from items WHERE email = '".$user."'";
                            if($result = mysqli_query($connection, $addItemSql)){
                                while($row = mysqli_fetch_assoc($result)){
                                    if(count($row) != 0){ 
                                        echo '<tr><td>';
                                        echo $row['itemName'];
                                        echo '</td><td>';
                                        echo '<form name="deleteItemForm" action="DeleteItemList.php" method="post">';
                                        echo '<input type="hidden" name="delItem" value="'.$row['itemID'].'">';
                                        echo '<button type="submit" class="btn btn-danger center-block"><span class="glyphicon glyphicon-remove"></span></button></form>';
                                        echo '</td></tr>';
                                    }
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <!--Prototype scenario 2: Added new item.-->
                <form name="newItemForm" action="InsertItemList.php" method="post" onsubmit="return checkEmptyItem();">
                    <br>Add New Item:<br>
                    <input type="text" name="newItem" placeholder="Insert item name here">
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
                </form>
            </div>
        </div>
        <?php include 'footer.inc.php'; ?>
    </body>
</html>