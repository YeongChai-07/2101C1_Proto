<?php
    session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Shopping</title>
        
        <script>
            var itemsRow = 0;
            function checked(param){
                var rowCount = $('#addList tr').length;
                var button = param.children[0];
                var checked = button.children[0];
                if (checked.className == "glyphicon glyphicon-unchecked"){
                    checked.className = "glyphicon glyphicon-check"
                    itemsRow += 1;
                    if (itemsRow == (rowCount -1)){
                        var ans = confirm("All items are checked!\nRemove list?");
                        if (ans == true){
                            window.location = "../ui/HomePage.php?p=1";
                        }
                        else{
                            checked.className = "glyphicon glyphicon-unchecked"
                            itemsRow -= 1;
                        }
                    }
                }
                else{
                    checked.className = "glyphicon glyphicon-unchecked"
                    itemsRow -= 1;
                }
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
            <h1><?php echo $_GET["list"] ?></h1>
            <br/><br/>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>Shopping List</h3>
                </div>
                <table class="table" id="addList">
                    <tr>
                        <td><b>Item</b></td>
                        <td><b>Description</b></td>
                        <td><b>Quantity</b></td>
                        <td><b>Bought?</b></td>
                    </tr>
                    
                    <tr>
                        <td>Milo</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Energy"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="3"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Beer</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Tiger"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="4"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Tea</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Pokka"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="1"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Bread</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Soft"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="3"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Rice</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="Phoenix"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="1"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                    
                    <tr>
                        <td>Coke</td>
                        <td><input type="text" class="text-primary" style="width:80px;" value="F & N"></td>
                        <td><input type="text" class="text-primary" style="width:55px;" value="2"></td>
                        <td onclick="checked(this)"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-unchecked"></span></button></td>
                    </tr>
                </table>
            </div>
    </body>
</html>