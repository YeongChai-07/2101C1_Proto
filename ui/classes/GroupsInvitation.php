<?php
    define("MAX_ROWS", 2);
	class GroupsInvitation
	{
		private $currGrp_Name;
		private $rcvdInviteGrp_Name;
		
		private $rcvdInviteGrp_Email;
		
		function __construct()
		{
			$this->currGrp_Name = array("Family", "Friends");
		    $this->rcvdInviteGrp_Name = array("Family", "Friends");
		    $this->rcvdInviteGrp_Email = array("abc@email.com", "bangHero@ymail.sg");
		}
		
		public function outputAsCurrentGroups()
		{
			$currGrp_Count = 0;
			while($currGrp_Count < MAX_ROWS)
			{
				if(MAX_ROWS - $currGrp_Count == 1)
				{
					echo "\r\n";
				}
				echo "<tr>
						<td>".$this->currGrp_Name[$currGrp_Count]."</td>
						<td>
						    <span class=\"glyphicon glyphicon-remove\"></span>
						    <!-- Change X to icon -->
						</td>
					  </tr>";
				$currGrp_Count++;
			}
		}
		public function outputAsReceivedInvitations()
		{
			$rcvdInvite_Count = 0;
			while($rcvdInvite_Count < MAX_ROWS)
			{
				if(MAX_ROWS - $rcvdInvite_Count == 1)
				{
					echo "\r\n";
				}
				echo "<tr>
						<td>". $this->rcvdInviteGrp_Name[$rcvdInvite_Count]. "</td>
						<td>". $this->rcvdInviteGrp_Email[$rcvdInvite_Count]. "</td>
						<td>
							<span class=\"glyphicon glyphicon-ok\"></span>
						</td>
						<td>
							<span class=\"glyphicon glyphicon-remove\"></span>
						</td>
					  </tr>";
				$rcvdInvite_Count++;
			}
		}
	} // End of class definitions

?>