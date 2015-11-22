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
                var shoppingListQty = document.forms["newShoppingListItemForm"]["newShoppingListQty"].value;
//                    var patt = *[0-9]*;
                if (shoppingListQty == "") {
                    alert("Your Quantity can't be empty. Please enter a value");
                    return false;
                }
//                        else if (shoppingListQty == patt){
//                            alert("You have input an alphabet. Please enter a number");
//                            return false;
//                        }
                else {
                    return true;
                }
            }




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
        function uploadList(){
            alert("Shopping List online has been updated");
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
        <ul class="nav nav-tabs">
            <li><a href="./ItemList.php">Item</a></li>
            <li class="active"><a href="./HomePage.php">Shopping</a></li>
            <li><a href="./Groups.php">Groups</a></li>
            <li><a href="./Settings.php">Settings</a></li>
        </ul>

        <!-- Top Left Container -->
        <?php
        $selectedItem = "";
        $selectedQuantity = "";
        $selectedDescription = "";
        $urgency = "-";

        function item_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedItem = $_POST["selectitem"];
            $selectedQuantity = item_input($_POST["newShoppingListQty"]);
            $selectedDescription = $_POST["newShoppingListDesc"];
        }


        ?>
        <div class="container" id="container-table">
<!--            <form name="updateShoppingList"  method="post" role="form">-->
                <br/><br/><br/><br/>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3>Shopping List</h3>
                        <h4 style="float:right; color: black">Urgency date: <?php echo $urgency ?></h4>
                    </div>
                    <table class="table" id="addList" onclick="displayList()">
                        <tr>
                            <td><b>Item</b></td>
                            <td><b>Description</b></td>
                            <td><b>Quantity</b></td>
                            <td><b>Delete?</b></td>
                        </tr>
                        <tr id="row1">
                            <td>Milo</td>
                            <td><input type="text" class="text-primary text-desc" value="Energy"></td>
                            <td><input type="text" class="text-primary text-qty" value="3"></td>
                            <td><button class="btn-danger" onclick="$('#row1').toggle();" value="milo"><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>
                        <tr id="row2">
                            <td>Beer</td>
                            <td><input type="text" class="text-primary text-desc" value="Tiger"></td>
                            <td><input type="text" class="text-primary text-qty"  value="4"></td>
                            <td><button class="btn-danger" onclick="$('#row2').toggle();" value="Beer"><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>
                        <tr id="row3">
                            <td>Tea</td>
                            <td><input type="text" class="text-primary text-desc" value="Pokka"></td>
                            <td><input type="text" class="text-primary text-qty"  value="1"></td>
                            <td><button class="btn-danger" onclick="$('#row3').toggle();" value="Tea"><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>                            
                        <?php
                        if (isset($_POST["selectitem"])) {

                            echo '<tr id="row4">';
                            echo '<td>';
                            echo $selectedItem;
                            echo '</td>';
                            echo '<td><input type="text" class="text-primary text-desc" value=" ' . $selectedDescription . '">';
                            echo '</td>';
                            echo '<td><input type="text" class="text-primary text-qty" value=" ' . $selectedQuantity . '">';
                            echo '</td>';
                            echo '<td><button class="btn-danger" " value=" ' . $selectedItem . ' "' ?> onclick="$('#row4').toggle();
                            <?php
                            echo '"><span class="glyphicon glyphicon-remove"></span></button></td>';
                            echo '</tr>';
                        }
                        ?>
                    </table>

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
                            <input id="datepick" size="20">
                            <script type="text/javascript">
                                    new datepickr('datepick');</script>
                        </div>
                    </div>

                </div>
<!--            </form>-->
        </div>

        <!-- Right Container -->
        <div class="container" id="container-add">
            <h2 class="h2" id="h2-add"><?php echo $_GET["list"] ?></h2>

            <form name="newShoppingListItemForm" onsubmit="return checkEmptyInput();" method="post" role="form" >
                <h3 class="h3">Add things to buy :</h3>
                <br/>
                <script type="text/javascript">
                    $(document.body).on('click', '.dropdown-menu li', function (event) {

                        var $target = $(event.currentTarget);

                        $target.closest('.btn-group')
                                .find('[data-bind="label"]').text($target.text())
                                .end()
                                .children('.dropdown-toggle').dropdown('toggle');

                        return false;

                    });
                </script>
                <div class="btn-group"  >                       
                    <select class="btn btn-default dropdown-toggle form-control" id="dropdown-add" name="selectitem">
                        <option value="Pizza">Pizza</option>
                        <option value="Beer">Beer</option>
                        <option value="Tea">Tea</option>
                        <option value="Meat">Meat</option>
                        <option value="Eggs">Eggs</option>
                    </select>
                </div>
                <br /><br /><br /><br /><br />

                <div class="row">
                    <div class="col-sm-4"><h3 class="h3">Quantity : </h3></div>
                    <div class="col-sm-5" id="qtyCol" ><input type="text" name="newShoppingListQty" class="text-primary" id="newShoppingListQty"></div>

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