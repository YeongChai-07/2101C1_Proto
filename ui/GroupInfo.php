<html>
    <head>
        <title>Groups</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <?php include 'header.inc.php'; ?>
    <body class="container-fluid">
         
        <?php
        $currentuser = $_SESSION['email'];
        if (isset($_GET['id'])) 
        {
            $grpName = $_GET['id'];
        }
        $userisadmin = FALSE;
        $sql9 = "SELECT * FROM groups WHERE email ='" . $currentuser . "' AND groupName ='" .$grpName . "' AND groupCreator ='1' " ;
        if ($result = mysqli_query($connection, $sql9)) {
            if ($row = mysqli_fetch_assoc($result)){
            $userisadmin = TRUE;}
            }
       
            
        ?>
        <div id='memberName' class="container-fluid" style="float: left; margin: 5px; position: relative; width: 400px">
            <br/>
            <br/>
            <h2><?php echo $grpName; ?></h2>
            <br/>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ViewList">View List</button>
            <?php
            if ($result = mysqli_query($connection, $sql9)) {
            if ($row = mysqli_fetch_assoc($result)){
             echo '<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ShareList">Share</button>';   
            }}
            ?>
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
                    <?php
                    $sql = "SELECT * FROM groups WHERE groupName ='" .$grpName . "' AND (groupCreator ='1' OR groupCreator ='0')" ;
                    if ($result = mysqli_query($connection, $sql)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<form method="POST" action="withingroupdelete.php">';
                            echo '<tr>';
                            echo '<td > ';
                            echo $row['email'];
                            echo '<input type="hidden" name="email2" value="'.$row['email'].'">';
                            echo '<input type="hidden" name="grpname2" value="'.$row['groupName'].'">';
                            echo '</td>';
                            echo '<td> ';
                            if ($row['groupCreator'] == '1'){
                                echo 'Admin';
                                echo '</td>';
                                if ($userisadmin){
                                    echo '<td> ';
                                echo '<button class="btn btn-danger">Delete Group</button>';
                                echo '</td>'; 
                                }                        
                                echo '</tr></form>';
                            } 
                            if ($row['groupCreator'] == '0') {
                                echo '-';
                                echo '</td>';
                                if ($userisadmin){
                                echo '<td> ';
                                echo '<button class="glyphicon glyphicon-remove btn btn-danger"></button>';
                                echo '</td>'; 
                                }                         
                                echo '</tr></form>'; 
                            }
                            
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
                    function checkEmptyName(){
                        var NameInput=document.forms["newNameForm"]["newName"].value;
                        if(NameInput=="")
                          {
                          alert("Username can't be empty!");
                          return false;
                          }
                        return true;
                       }
                        
                    function getGroupName(){
                       var groupInput = document.forms["groupForm"]["groupName"].value;
                       if (groupInput =="")
                       {
                           alert ("No list shared");
                           $groupname = 'Nothing';
                           return false;
                       }
                       return true;
                    }
        </script>
        <div id='searchside' class = container-fluid style="float: left; margin: 5px; position: relative; width: 400px">
            <br/>
            <br/>
            <br>
            <a href="./Groups.php" class="btn btn-danger" role="button" style="float: right">Back</a>
            <br><br>
            <br>
            <?php
            if ($result = mysqli_query($connection, $sql9)) {
            if ($row = mysqli_fetch_assoc($result)){
            echo '<h3>Search Users</h3>';
            echo '<form name="newNameForm" onsubmit="return checkEmptyName();" action="invitemember.php" role="form" method="post">';
            echo '<input name="newName" id ="search" type="text" class="form-control" placeholder="Search">';
            echo '<input name="grpName" id ="search" type="hidden" value="'.$grpName.'" >';
            echo '<button id="adduser" class="btn btn-primary btn-md" ><strong>ADD</strong></button></form>';
            }}
            ?>
            
                
                
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
                        <?php
                        $sql2 = "SELECT * FROM groups WHERE groupName ='" . $grpName . "' AND groupCreator ='3' ";
                        if ($result = mysqli_query($connection, $sql2)) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<form method="POST" action="cancelinvite.php"'.$row['groupName'].'">';
                                echo '<tr>';
                                echo '<td > ';
                                echo $row['email'];
                                echo '<input type="hidden" name="grpName5" value="'.$row['groupName'].'">';
                                echo '<input type="hidden" name="newName5" value="'.$row['email'].'">';
                                echo '</td>';
                                echo '<td> ';
                                echo '<button class="glyphicon glyphicon-remove btn btn-danger"></button>';
                                echo '</td>';
                                echo '</tr></form>';
                                                         
                            }
                        }
?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="ViewList" tabindex="-1" role="dialog" aria-labelledby="ViewListModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php
                        $sql7 = "SELECT * FROM groups WHERE groupName ='" . $grpName . "' ";
                                 if ($result = mysqli_query($connection, $sql7)) {
                                     $row = mysqli_fetch_assoc($result);
                                     
                                     if ($row['shoppingListID'] > 0){
                                         $listID = $row['shoppingListID'];
                                         $sql77 = "SELECT * FROM shoppinglist WHERE shoppingListID ='" . $listID . "' ";
                                        if ($result = mysqli_query($connection, $sql77)) {
                                            $row = mysqli_fetch_assoc($result);
                                            echo '<h4 class="modal-title" id="myModalLabel">'; 
                                            echo $row['shoppingListName'];
                                            echo'</h4>';
                                 }
                                     }
                                     else {
                                         echo 'No List Shared';
                                     }
                                 }
                        ?> 
                    </div>
                    <div class="modal-body">
                        
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
                                 <?php
                                 $sql6 = "SELECT * FROM shoppinglist WHERE email ='" . $currentuser . "' ";
                                 if ($result = mysqli_query($connection, $sql6)) {
                                     while ($row = mysqli_fetch_assoc($result)) {
                                     
                                        echo '<form method="POST" action="sharelist.php"' . $currentuser . '">';
                                        echo '<tr>';
                                        echo '<td > ';
                                        echo $row['shoppingListName'];
                                        echo '<input type="hidden" name="shoppingName" value="' . $row['shoppingListName'] . '">';
                                        echo '<input type="hidden" name="grpName7" value="' . $grpName . '">';
                                        echo '</td>';
                                        echo '<td> ';
                                        echo '<button class="btn btn-primary">Share</button>';
                                        echo '</td>';
                                        echo '</tr></form>';
                                    
                                    }
}
                                 ?>
                             </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="notfound" tabindex="-1" role="dialog" aria-labelledby="notfound">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2>User not found! <br>Please try another name</h2>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>