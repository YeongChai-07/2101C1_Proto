<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
	<title>Groups</title>
        
        <script src="../js/GroupsMain/GroupsMain.js"></script>
        
        <?php
            include "./classes/GroupsInvitation.php";

            function outputCurrentGroups(){
                global $grpInvite_Obj;
                echo $grpInvite_Obj->generateCurrentGroups_HTML();
            }
            function outputReceivedInvitations(){
                global $grpInvite_Obj;
                echo $grpInvite_Obj->generateInvitations_HTML();
            }

            $grpInvite_Obj = new GroupsInvitation();
        ?>
    </head>
    <body class="container-fluid navContainSpace">
        <?php include 'header.inc.php'; ?>
        <?php
            if(!$_SESSION['email']){
                header("location:homepage.php");
                die;
            }
            $newGrpName = "";
            $create = "1";
            $email = $_SESSION['email'];

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $newGrpName = $_POST["newGrpName"];

                if (empty($newGrpName)){
                    $newGrpNameErr = "Please do not leave group name empty.";
                    $newGrpNamevalid = false;
                }
                else{
                    $sql1 = "SELECT groupName FROM groups";
                    if ($result = mysqli_query($connection, $sql1)){
                        $newGrpNamevalid = true; //Needed when there is no entry in the table yet
                        while ($row = mysqli_fetch_assoc($result)){
                            if ($row['groupName'] == $newGrpName){
                                $newGrpNameErr = "Group name had been taken";
                                echo '<script language="javascript">';
                                echo 'alert("Group Name Taken")';
                                echo '</script>';
                                $newGrpNamevalid = false;
                                break;
                            }
                            else{
                                $newGrpNameErr = "";
                                $newGrpNamevalid = true;
                            }
                        }
                    }
                }
                if ($newGrpNamevalid){
                    $sql = "INSERT INTO groups (email, groupName, groupCreator) VALUES (?,?,?)";
                    if ($statement = mysqli_prepare($connection, $sql)){
                        mysqli_stmt_bind_param($statement, 'sss', $_SESSION['email'], $newGrpName, $create);
                        mysqli_stmt_execute($statement);
                    }
                } 
            }
        ?>
        <div class="container">
            <p>&nbsp;</p>
            <div class="row">
                <div class="col-xs-6 table-responsive">
                    <label for="currGrp_List">Current Groups</label>
                    <table class="table table-hover table-bordered" id="currGrp_List">
                        <tr>
                            <th class="col-sm-12">Assigned Group(s)</th>
                            <th class="center-text">Exit Group</th>
                        </tr>
                        <?php
                            $sql ="SELECT * FROM groups where email ='" .$email . "' AND (groupCreator = '0' OR groupCreator = '1')";
                            if ($result = mysqli_query($connection, $sql)){
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo '<form method="POST" action="ExitGroup.php"'.$row['groupName'].'">';
                                    echo '<tr>';
                                    echo '<td><a href="GroupInfo.php?id='.$row['groupName'].'">';
                                    echo $row['groupName'];
                                    echo '<input type="hidden" name="grpName" value="'.$row['groupName'].'">';
                                    echo '<td> ';
                                    if ($row['groupCreator'] == '0'){
                                        echo '<button class="glyphicon glyphicon-remove btn btn-danger center-block"></button>';
                                    }
                                    if ($row['groupCreator'] == '1'){
                                        echo '<button class="btn btn-danger center-block">Delete Group</button>';
                                    }
                                    echo '</td>';
                                    echo '</tr></form>';
                                }
                            }
                        ?>
                    </table>
                </div>
                <form role="form" method="post" class="col-xs-6" action="Groups.php">
                    <div class="form-group">
                        <label for="createGrp_Name">Create New</label>
                        <input type="text" class="form-control" id="newGrpName" name="newGrpName" placeholder="Enter new group name here"/>
                    </div>
                    <button id="btnSubmit" class="btn btn-default btn-md">Submit</button>
                </form>
            </div>
            <div class="row">
                <div class="col-xs-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <label for="testTableData">Received Invitations</label>
                    <table class="table table-hover table-bordered" id="testTableData">
                        <tr>
                            <th class="col-xs-4">Group Name</th>
                            <th class="col-xs-4">Group Creator</th>
                            <th class="col-xs-2 center-text">Accept Invitation</th>
                            <th class="col-xs-2 center-text">Decline Invitation</th>
                        </tr>
                        <?php
                            $sql2 ="SELECT * FROM groups where email ='" .$email . "' AND groupCreator = '3'";
                            if ($result = mysqli_query($connection, $sql2)){
                                while ($row = mysqli_fetch_assoc($result)){
                                    $findCreator = "SELECT email FROM groups where groupName='".$row['groupName']."' and groupCreator='1'";
                                    $creatorResult = mysqli_query($connection, $findCreator);
                                    $creatorName = mysqli_fetch_assoc($creatorResult);
                                    echo '<form method="POST" action="invitation.php">';
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $row['groupName'];
                                    echo '<input type="hidden" name="grpName3" value="'.$row['groupName'].'">';
                                    echo '</td>';
                                    echo '<td>';
                                    echo $creatorName['email'];
                                    echo '<input type="hidden" name="newName3" value="'.$row['email'].'">';
                                    echo '<td>';
                                    echo '<button class="glyphicon glyphicon-ok btn btn-success center-block"></button>';
                                    echo '</td></form>';
                                    echo '<td>';
                                    echo '<form action="rejectinvite.php" method="POST">';
                                    echo '<input type="hidden" name="grpName4" value="'.$row['groupName'].'">';
                                    echo'<button class="glyphicon glyphicon-remove btn btn-danger center-block" ></button></form>';                                                                              
                                    echo '</td>';
                                    echo '</tr></form>';
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <?php include 'footer.inc.php'; ?>
    </body>
</html>