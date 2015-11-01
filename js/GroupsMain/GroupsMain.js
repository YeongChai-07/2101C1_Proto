            $(document).ready(function(){
				$("#exitGrp00").click(function(){
					$("#currGrp00").remove();
					alert('Successfully Exited from Family Group.');
				});
				$("#acceptGrp00").click(function(){
					$("#inviteGrp00").remove();
					$("#currGrp_List").append("<tr>\n    <td><a href=\"GroupInfo.php\"><strong>Friends</strong></a></td>\n    <td><span class=\"glyphicon glyphicon-remove\"></span></td>\n</tr>");
					
					alert('You have Accepted the invitation to Friends Group.');
				});
				$("#declineGrp00").click(function(){
					$("#inviteGrp00").remove();
					alert('You have Declined the invitation to Friends Group.');
				});
				$("#acceptGrp01").click(function(){
					$("#inviteGrp01").remove();
					$("#currGrp_List").append("<tr>\n    <td><a href=\"GroupInfo.php\"><strong>MARKET AJUMMA (Auntie)</strong></a></td>\n    <td><span class=\"glyphicon glyphicon-remove\"></span></td>\n</tr>");
					
					alert('You have Accepted the invitation to MARKET AJUMMA (Auntie) Group.');
				});
				$("#declineGrp01").click(function(){
					$("#inviteGrp01").remove();
					alert('You have Declined the invitation to MARKET AJUMMA (Auntie) Group.');
				});
				$("#btnSubmit").click(function() {
					$inputGrp_Name = $("#createGrp_Name").val()
					if ( ! ( $inputGrp_Name.trim()) == "" )
                    {
						$("#currGrp_List").append("<tr>\n    <td><a href=\"GroupInfo.php\"><strong>" + $inputGrp_Name + "</strong></a></td>\n    <td><span class=\"glyphicon glyphicon-remove\"></span></td>\n</tr>");
					}
                    else
					{
						alert('Please enter the group name that you wish to input.');
					}
					
				});
				
			});