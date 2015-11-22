<html>
    <head>
        <title>Shopping</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script>
            function checkEmptyItem(){
                var itemNameInput=document.forms["newListForm"]["newList"].value;
                if(itemNameInput=="")
                {
                    alert("Your list name can't be empty!");
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body class="container-fluid">
         <?php include 'header.inc.php'; ?>
        <ul class="nav nav-tabs">
            <li><a href="./ItemList.php">Item</a></li>
            <li class="active"><a href="./HomePage.php">Shopping</a></li>
            <li><a href="./GroupInfo.php">Groups</a></li>
            <li><a href="./Settings.php">Settings</a></li>
        </ul>
        <div class="container" style="width:50%; float: left;">
            <br/>
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
                        if (!isset($_GET["p"])){
                            echo '<tr id="list1">';
                            echo '<td class="col-sm-12"> ';
                            echo "Family";
                            echo '</td>';
                            echo '<td class="viewButton"><a href="./ViewShoppingList.php?list=Family"><button type="button" class="btn"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>';
                            echo '<td class="editButton"><a href="./ShoppingListTest.php?list=Family"><button type="button" class="btn"><span class="glyphicon glyphicon-pencil"></span></button></a></td>';
                            echo '<td class="deleteButton"'?> onclick="$('#list1').toggle(); alert('Successfully deleted Family Shopping List.');">
                    <?php
                            echo '<button type="button" class="btn" style="width:60px"><span class="glyphicon glyphicon-trash"></span></button></td>';
                            echo '</tr>';
                            }  
                        ?>
<!--                    <tr id="list1">
                        <td class="col-sm-12">Family</td>
                        <td class="viewButton"><a href="./ViewShoppingList.php"><button type="button" class="btn"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>
                        <td class="editButton"><a href="./ShoppingList.php"><button type="button" class="btn"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                        <td class="deleteButton" onclick="$('#list1').toggle();"><button type="button" class="btn" style="width:60px"><span class="glyphicon glyphicon-trash"></span></button></td>
                    </tr>-->
                    <tr id="list2">
                        <td class="col-sm-12">Friends</td>
                        <td class="viewButton"><a href="./ViewShoppingList.php?list=Friends"><button type="button" class="btn"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>
                        <td class="editButton"><a href="./ShoppingListTest.php?list=Friends"><button type="button" class="btn"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
                        <td class="deleteButton" onclick="$('#list2').toggle(); alert('Successfully deleted Friends Shopping List.');"><button type="button" class="btn" style="width:60px"><span class="glyphicon glyphicon-trash"></span></button></td>
                    </tr>
                    <?php
                        if (isset($_GET["newList"])){
                            echo '<tr id="list3">';
                            echo '<td class="col-sm-12"> ';
                            echo $_GET['newList'];
                            echo '</td>';
                            echo '<td class="viewButton"><a href="./ViewShoppingList.php?list=';
                            echo $_GET["newList"];
                            echo '"><button type="button" class="btn"><span class="glyphicon glyphicon-eye-open"></span></button></a></td>';
                            echo '<td class="editButton"><a href="./ShoppingListTest.php?list=';
                            echo $_GET["newList"];
                            echo '"><button type="button" class="btn"><span class="glyphicon glyphicon-pencil"></span></button></a></td>';
                            echo '<td class="deleteButton"'?> onclick="$('#list3').toggle();">
                    <?php
                            echo '<button type="button" class="btn" style="width:60px"><span class="glyphicon glyphicon-trash"></span></button></td>';
                            echo '</tr>';
                            }  
                        ?>
                </tbody>
            </table>
        </div>
        <div class="container"  style="width:50%; float:right; padding-left:10%; margin-top:10%;">
            <h3 class="h3">Add List: </h3>
            <form name="newListForm" action="HomePage.php" class="right" onsubmit="return checkEmptyItem();">
                <input type="text" name="newList" placeholder="Insert list name here">
                <button class="btn">Submit</button>
            </form>	
        </div>
    </body>
</html>