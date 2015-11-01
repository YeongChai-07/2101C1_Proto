<?php
	class GroupsInvitation
	{
		private $currGrp_Name;
		private $rcvdInviteGrp_Name;
		
		private $rcvdInviteGrp_Email;
		
		function __construct()
		{
			$this->currGrp_Name = array("Family");
		    $this->rcvdInviteGrp_Name = array("Friends", "MARKET AJUMMA (Auntie)");
		    $this->rcvdInviteGrp_Email = array("abc@email.com", "bangHero@ymail.sg");
		}
		
		public function generateCurrentGroups_HTML()
		{
			$currGrpHTML = "";
			$currGrp_Count = 0;
			$currGrpArr_Size = count($this->currGrp_Name);
			while($currGrp_Count < $currGrpArr_Size)
			{
				//if(MAX_ROWS - $currGrp_Count == 1)
				//{
				//	echo "\r\n";
				//}
				$currGrpHTML.= "<tr id =\"currGrp0".$currGrp_Count."\">
						<td><a href=\"GroupInfo.php\"><strong>".$this->currGrp_Name[$currGrp_Count]."</strong></a></td>
						<td>
						    <span id=\"exitGrp0".$currGrp_Count."\" class=\"glyphicon glyphicon-remove\"></span>
						    <!-- Change X to icon -->
						</td>
					  </tr>";
				$currGrp_Count++;
			}
			
			return $currGrpHTML;
		}
		public function generateInvitations_HTML()
		{
			$rcvdInvitationsHTML = "";
			$rcvdInvite_Count = 0;
			$rcvdInvitesArr_Size = count($this->rcvdInviteGrp_Name);
			while($rcvdInvite_Count < $rcvdInvitesArr_Size)
			{
				if($rcvdInvitesArr_Size - $rcvdInvite_Count == 1)
				{
					$rcvdInvitationsHTML .= "\r\n";
				}
				$rcvdInvitationsHTML .= "<tr id =\"inviteGrp0".$rcvdInvite_Count."\">
						<td>". $this->rcvdInviteGrp_Name[$rcvdInvite_Count]. "</td>
						<td>". $this->rcvdInviteGrp_Email[$rcvdInvite_Count]. "</td>
						<td>
							<span id=\"acceptGrp0".$rcvdInvite_Count."\" class=\"glyphicon glyphicon-ok\"></span>
						</td>
						<td>
							<span id=\"declineGrp0".$rcvdInvite_Count."\" class=\"glyphicon glyphicon-remove\"></span>
						</td>
					  </tr>";
				$rcvdInvite_Count++;
			}
			return $rcvdInvitationsHTML;
		}
	} // End of class definitions

?>