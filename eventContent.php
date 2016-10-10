<?php
	error_reporting(0);
	session_start();
	$id=$_SESSION['ID'];
	require_once('connection.php');

	if(isset($_POST['val'])){
		if ($_POST['val'] == 2) {
			echo '<form id="teamMember">
		      <table>
		           <tr><td>Registration ID-</td></tr>
		           <tr><td>Memeber 1 :</td><td><input type="text" id="member1" name="member1" /></td><td id="m1"></td></tr>
		           <tr><td>Memeber 2 :</td><td><input type="text" id="member2" name="member2" /></td><td id="m2"></td></tr>
		           <tr><td><input type="button" value="submit" id="createTeamButton" onclick="createTeam()"</td></tr>
		           <tr><td><input type="button" value="Goto Single Player Events" id="singlebtn" onclick="onSingleBtnClick()"/></td></tr>
		      </table>
		   </form>';

		}
		elseif ($_POST['val'] == 1) {
			$id=$_SESSION['ID'];
			$dob=$_SESSION['DOB'];
			$g=$_SESSION['Gender'];

			$sql = "select * from event where Gender = $g";
			$result = mysqli_query($con,$sql);
			$s='<form id="EventForm">';

			while ($row = mysqli_fetch_array($result)) {
				if ($row['Eid'] == 7 || $row['Eid'] == 8) {
					if($row['Birthdate']>=$dob){
	        			$s .= '<input type="checkbox" name="a[]" value="'.$row['Eid'].'"/>'.$row['Ename'].'<br />';
	      			}  
				}elseif($row['Birthdate']<=$dob){
				 	$s .= '<input type="checkbox" name="a[]" value="'.$row['Eid'].'"/>'.$row['Ename'].'<br />';
				 }
			}
			$s .= '<input id="submitSingleEventBtn" type="button" value="submit" onclick="fun()" /><br/>';
			$s .= '<input id="teambtn" type="button" name="EventType" value="Create a Team" onclick="onEventBtnClick()"/>';
			$s .= '</form>';	 	 
			echo $s;
		}
	}

	if(isset($_POST['formData'])){
		$formData = $_POST['formData']; 
		for ($i=0; $i < strlen($formData)-1; $i++) { 
			if ($formData[$i] == '=') {
				$Eid = $formData[$i+1];
				$sql = "INSERT INTO single(Pid,Eid) VALUES($id,$Eid)";
				$result = mysqli_query($con,$sql);
				}
			}
			echo '<b>You have successfully registered for the individual events if you have not already registered then you can also register for the team event</b>
			<br/><input id="teambtn" type="button" name="EventType" value="Team" onclick="onEventBtnClick()"/>';	
		}

	if (isset($_POST['member2'])&&isset($_POST['member1'])) {
		$member1 = $_POST['member1'];
		$member2 = $_POST['member2'];
		$sql = "select Pid,EmailId from player where Pid = '$member1' OR Pid = '$member2' OR Pid = '$id'";
		$result = mysqli_query($con,$sql);
		if (mysqli_num_rows($result) == 3) {	
		$emailArray = array();
		while ($row = mysqli_fetch_array($result)) {
				array_push($emailArray, $row['EmailId']);
			}	
		$sql = "select Tid from team where LeaderId = '$id' or LeaderId = '$member1' or LeaderId = '$member2' or Member1 = '$id' or Member1 = '$member1' or Member1 = '$member2' or Member2 = '$id' or Member2 = '$member1' or Member2 = '$member2' ";
		$result = mysqli_query($con,$sql);
		if(mysqli_num_rows($result) > 0){
			echo 'One of your team members is already registered for another team. Or maybe you entered incorrect Details so try again<br/>
			  <form id="teamMember">
		      <table>
		           <tr><td>Registration ID-</td></tr>
		           <tr><td>Memeber 1 :</td><td><input type="text" id="member1" name="member1" /></td><td id="m1"></td></tr>
		           <tr><td>Memeber 2 :</td><td><input type="text" id="member2" name="member2" /></td><td id="m2"></td></tr>
		           <tr><td><input type="button" value="submit" id="createTeamButton" onclick="createTeam()"</td></tr>
		      </table>
		   </form>';
		}else{
		$sql = "INSERT into  team(LeaderId,Member1,Member2) VALUES('$id','$member1','$member2')";
		$result =mysqli_query($con,$sql);
		if($result){
			$query="SELECT Tid from team where LeaderId='$id'";
			$result=mysqli_query($con,$query);
			$r=mysqli_fetch_array($result);
			echo '<b>Your Team ID is </b>'.$r[0].'<br/>If you have not registered for single events then you can register here &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><input id="singlebtn" type="button" name="EventType" value="Single Player Events" onclick="onSingleBtnClick()" />';
			sendemail($r[0],$emailArray);
			}
		}
		}else{
			echo 'Your team Members must be registered before you can create a team.<br/>
			<input id="teambtn" type="button" name="EventType" value="Create a Team" onclick="onEventBtnClick()"/>
			<input id="singlebtn" type="button" name="EventType" value="Single Player Events" onclick="onSingleBtnClick()" />';
		}
	}

	function sendemail($id,$emailArray){
		include('class.phpmailer.php');

		$sub = "Table Tennis Tournament Team Details";
		$message = "<b>Dear Participant,</b><br/>You have successfully registered your team for the table Tennis Tournament. Your team id is ".$id;

		$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "tabletennis14akgec@gmail.com";  // GMAIL username, consider changing
			$mail->Password   = "akgec12345";            // GMAIL password, consider changing
			$mail->AddReplyTo("tabletennis14akgec@gmail.com","First Last");
			$mail->From       = "tabletennis14akgec@gmail.com";//email id of PDF_set_text_rendering()
			$mail->CharSet    = "utf-8";

					$mail->FromName   = "Query";
					$mail->Subject    = $sub;
					$mail->Body = $message;
					
					foreach ($emailArray as $value) {
						$mail->AddAddress($value, "SI");
						$mail->WordWrap   = 50; 
						$mail->IsHTML(true); // send as HTML
						
						if($mail->Send()) 
						{
							$mail->ClearAllRecipients();
						}
					}	
	}
?>