<!DOCTYPE html>
<?php
session_start();
?>


<html>
    <head>
        <title>Shopping List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="js/datepicker2.1/datepickr.css">
        <script src="js/datepicker2.1/datepickr.js"></script>
        <script src="js/datepicker2.1/datepickr.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="js/libs/twitter-bootstrap/"></script>
        
        <script>
                    function checkEmptyInput() {
                    var shoppingListQty = document.forms["newShoppingListItemForm"]["newShoppingListQty"].value
                        if (shoppingListQty == "") {
                            alert("Your Quantity can't be empty. Please enter a value");
                            return false
                        }else{
                            return true;
                        }
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
    <body class="container-fluid">
        <?php
        $_SESSION["USERNAME"] = "USERNAME";
        $_SESSION["PASSWORD"] = "PASSWORD";
        ?>
        <ul class="nav nav-tabs">
            <li><a href="./ItemList.php">Item</a></li>
            <li class="active"><a href="#">Shopping</a></li>
            <li><a href="./Groups.php">Groups</a></li>
            <li><a href="./Settings.php">Settings</a></li>
        </ul>
        <div class="container" id="container-table">
            <br/><br/><br/><br/>
            <?php
            if (empty($_GET)) {
                
            }
            ?>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>Shopping List</h3>
                </div>
                <table class="table" id="addList" onclick="displayList()">
                    <tr>
                        <td><b>Item</b></td>
                        <td><b>Description</b></td>
                        <td><b>Quantity</b></td>
                        <td><b>Delete?</b></td>
                    </tr>
                    <tr>
                        <td>Milo</td>
                        <td><input type="text" class="text-primary text-desc" value="Energy"></td>
                        <td><input type="text" class="text-primary text-qty" value="3"></td>
                        <td><form action="ShoppingList.php"><button name="deleteFromShoppingList" class="btn btn-danger btn-del" value="milo">X</button></form></td>
                    </tr>

                    <tr>
                        <td>Beer</td>
                        <td><input type="text" class="text-primary text-desc" value="Tiger"></td>
                        <td><input type="text" class="text-primary text-qty"  value="4"></td>
                        <td><form action="ShoppingList.php"><button name="deleteFromShoppingList" class="btn btn-danger btn-del" value="beer">X</button></form></td>
                    </tr>

                    <tr>
                        <td>Tea</td>
                        <td><input type="text" class="text-primary text-desc" value="Pokka"></td>
                        <td><input type="text" class="text-primary text-qty"  value="1"></td>
                        <td><form action="ShoppingList.php"><button name="deleteFromShoppingList" class="btn btn-danger btn-del" value="tea">X</button></form></td>
                    </tr>

                </table>

            </div>

            <div class="container">
                <div class="row btn-update-row">
                    <form name="updateShoppingList" action="ShoppingList.php">
                        <button class="btn btn-primary" type="submit" onsubmit="">Update List</button>
                    </form>
                </div>

                <div class="row">
                    <div class="col-sm-4"><h3 class="h3">Set Urgency Dateline</h3></div>
                </div>

                <div class="row">
                    <div class="col-sm-1"><h3 class="h3">By : </h3></div>
                    <div class="col-sm-1" >
                        <input id="datepick" size="20">
                        <script type="text/javascript">
                                    new datepickr('datepick');</script>
                    </div>
                </div>

            </div>
        </div>


        <div class="container" id="container-add">
            <h2 class="h2" id="h2-add">List Name</h2>

            <form name="newShoppingListItemForm" action="ShoppingList.php" onsubmit="return checkEmptyInput();">
                <h3 class="h3">Add things to buy :</h3>
                <br/>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                        Select things to buy
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" id="dropdown-add" >
                        <li><a>Pizza</a></li>
                        <li><a>Milo</a></li>
                        <li><a>Beer</a></li>
                        <li><a>Tea</a></li>
                        <li><a>Meat</a></li>
                    </ul>
                </div>
                <br /><br /><br /><br /><br />

                <div class="row">

                    <div class="col-sm-4"><h3 class="h3">Quantity : </h3></div>
                    <div class="col-sm-5" id="qtyCol" ><input type="text" name="newShoppingListQty" class="text-primary" id="qtyBtn"></div>

                </div>
                <div class="row">
                    <div class="col-sm-4"><h3 class="h3">Description : </h3></div>
                    <div class="col-sm-5" id="descCol"><textarea id="descTxtArea" name="newShoppingListDesc" class="text-primary"></textarea></div>

                    <div class="col-sm-4" id="addBtnCol">
                        <button type="submit" class="btn btn-primary" id="addBtn">Add</button>
                    </div>
                </div>
            </form>

        </div>


    </body>
</html>