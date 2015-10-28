<!DOCTYPE html>
<?php
session_start();
include 'shoppingListFunctions.php';
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
        <script src="js/MobileGroceryListjs.js"></script>


    </head>
    <body class="container-fluid" style="height:768px;">
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
        <div class="container" style="width:50%; float: left;">
            <br/><br/><br/><br/>
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
                        <td><input type="text" class="text-primary" style="width:80px;" value="Energy"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="3"></td>
                        <td><input type="button" class="btn btn-danger" value="X" style="height:30px;"></td>
                    </tr>
                    
                    <tr>
                        <td>Beer</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Tiger"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="4"></td>
                        <td><input type="button" class="btn btn-danger" value="X" style="height:30px;"></td>
                    </tr>
                    
                    <tr>
                        <td>Tea</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Pokka"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="1"></td>
                        <td><input type="button" class="btn btn-danger" value="X" style="height:30px;"></td>
                    </tr>
                    
                    <tr>
                        <td>Bread</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Soft"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="3"></td>
                        <td><input type="button" class="btn btn-danger" value="X" style="height:30px;"></td>
                    </tr>
                    
                    <tr>
                        <td>Rice</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Phoenix"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="1"></td>
                        <td><input type="button" class="btn btn-danger" value="X" style="height:30px;"></td>
                    </tr>
                    
                    <tr>
                        <td>Coke</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="F & N"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="2"></td>
                        <td><input type="button" class="btn btn-danger" value="X" style="height:30px;"></td>
                    </tr>
                </table>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-4"><h3 class="h3">Set Urgency Dateline</h3></div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><h3 class="h3">By : </h3></div>
                    <div class="col-sm-1" style="padding-top:2%;">
                        <input id="datepick" size="20">
                        <script type="text/javascript">
			new datepickr('datepick');
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="container"  style="width:50%; float:right; padding-left:10%;">
            <h2 class="h2" style="padding-left:50%;">List Name</h2>
            <h3 class="h3">Add things to buy :</h3>
            <br/>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                    Select things to buy
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="height: auto; max-height: 250%; overflow-x: hidden;">
                    <li><a href="#">Pizza</a></li>
                    <li><a href="#">Milk</a></li>
                    <li><a href="#">Eggs</a></li>
                    <li><a href="#">Cheese</a></li>
                    <li><a href="#">Meat</a></li>
                    <li><a href="#">Vegetables</a></li>
                    <li><a href="#">Milo</a></li>
                    <li><a href="#">Tea</a></li>
                    <li><a href="#">Beer</a></li>
                    <li><a href="#">Bread</a></li>
                    <li><a href="#">Rice</a></li>
                    <li><a href="#">Coke</a></li>
                </ul>
            </div>
            <br /><br /><br /><br /><br />
            <div class="row">
                <div class="col-sm-4"><h3 class="h3">Quantity : </h3></div>
                <div class="col-sm-5" style="padding-top:2%;"><input type="text" class="text-primary" style="width:50px; height:50px;"></div>
            </div>
            <div class="row">
                <div class="col-sm-4"><h3 class="h3">Description : </h3></div>
                <div class="col-sm-5" style="padding-top:4%;"><textarea style="resize:none; height: 150px; width:200px;" class="text-primary" placeholder="Any descriptions ?">
                    </textarea></div>
                <div class="col-sm-4" style="padding-left:15%;">
                    <input type="button" class="btn btn-primary" value="Add" style="width:80px; height:50px;">
                </div>
            </div>


        </div>


    </body>
</html>