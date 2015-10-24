
<html>
    <head>
        <title>Groups</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body class="container-fluid">
        <ul class="nav nav-tabs">
            <li><a href="./ItemList.php">Item</a></li>
            <li><a href="./ShoppingList.html">Shopping</a></li>
            <li class="active"><a href="#">Groups</a></li>
            <li><a href="./Settings.php">Settings</a></li>
        </ul>
        <div id='memberName' class="container-fluid" style="float: left; margin: 5px; position: relative; width: 400px">
            <br/>
            <h3>Group Name</h3>
            <br/>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ViewList">View List</button>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ShareList">Share</button>
            <br/><br/>
            <h3>Current Members</h3>
            <div class='container-fluid'>
                <table id ='memberList' class="table table-striped bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Permit</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Johnny</td>
                            <td>Admin</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mary</td>
                            <td>-</td>
                            <td><button><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>
                        <tr>
                            <td>July</td>
                            <td>-</td>
                            <td><button><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id='searchside' class = container-fluid style="float: left; margin: 5px; position: relative; width: 400px">
            <br><br><br><br>
            <h3>Search Users</h3>
            <input name='search' id ='search' type="text" class="form-control" placeholder="Search">
            <button id='adduser' >ADD</button>
            <br>
            <h5>Pending requests</h5>
            <div class='container-fluid'>
                <table id ='pendingList' class="table table-striped bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Cancel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John</td>
                            <td><button><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>
                        <tr>
                            <td>Cena</td>
                            <td><button><span class="glyphicon glyphicon-remove"></span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="ViewList" tabindex="-1" role="dialog" aria-labelledby="ViewListModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">View List</h4>
                    </div>
                    <div class="modal-body">
                        <p>No list shared yet!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ShareList" tabindex="-1" role="dialog" aria-labelledby="ShareListModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Share List</h4>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>My Family</td>
                                <td><button>Share</button></td>
                            </tr>
                            <tr>
                                <td>Chocolate cake</td>
                                <td><button>Share</button></td>
                            </tr>
                            <tr>
                                <td>Games 2015</td>
                                <td><button>Share</button></td>
                            </tr>
                            <tr>
                                <td>My stash</td>
                                <td><button>Share</button></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>