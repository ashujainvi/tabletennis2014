<?php
    error_reporting(0);
	require_once('connection.php');

	if((isset($_POST["Name"]))&&(isset($_POST["DOB"]))&&(isset($_POST["Gender"]))&&(isset($_POST["Institution"]))&&(isset($_POST["Address"]))&&(isset($_POST["ContactNo"]))&&(isset($_POST["Member"]))&&(isset($_POST["Accomodation"]))){

		$name=$_POST["Name"];
		$dob=$_POST["DOB"];
		$gender=$_POST["Gender"];
		$institution=$_POST["Institution"];
		$address=$_POST["Address"];
		$contact_no=$_POST["ContactNo"];
		$email_id=$_POST["EmailId"];
		$member=$_POST["Member"];
		$accomodation=$_POST["Accomodation"];

		$g = $gender == "Male" ? 1 : 0;
		$m = $member == "Yes" ? 1 : 0;
		$a = $accomodation == "Yes" ? 1 : 0;

		$sql = "SELECT Pid from Player WHERE EmailId= '$email_id' AND ContactNo= '$contact_no' AND DOB= '$dob' AND name= '$name'";
		$result = mysqli_query($con,$sql);
		$num = mysqli_num_rows($result);

		session_start();

		if ($num > 0) {
			$row = mysqli_fetch_array($result);
			$id = $row['Pid'];
			echo '<p style="font-size: 20px;"><b>It seems you have already registered for the event your Id for the tournament is'.$id.'</b></p><br/>  
			 ';
				$_SESSION['ID']=$id['Pid'];		
		}
		else{
			$string="INSERT INTO player(Name,DOB,Gender,Institution,Address,ContactNo,EmailId,Member,Accomodation) VALUES ('$name','$dob',$g,'$institution','$address','$contact_no','$email_id',$m,$a)";
			$result=mysqli_query($con,$string); 
			if(!$result)
				die ("error-".mysqli_error($con));
			
			$query="SELECT  Pid from player WHERE Name='$name' AND EmailId= '$email_id' ";
			$r=mysqli_query($con,$query);
			$id=mysqli_fetch_array($r);
			echo '<b><p style="font-size: 20px;">Congratulations you have successfully registered for the event. Your Id for the 18th Ajay Kumar Garg Open Table Tennis Tournament is '.$id[0].'<br/>  
				 <br/><br/>
				 Kindly download this
				 <a href="Form.rtf" title="Download this for registrations" id="download-form" style="color:blue; font-weight:bold;">form</a>
                     , and bring it along with you at the tournament time.
		 		</p></b>';
				$_SESSION['ID']=$id[0];	
				sendEmail();
		}

		$_SESSION['DOB']=$dob;
		$_SESSION['Gender']=$g;
		$_SESSION['EmailId'] = $email_id;
		$_SESSION['Name'] = $name;

	}else{
		echo "You must fill all your Details properly";
	}

	function sendEmail(){
		include('class.phpmailer.php');

		$sub = "18th Ajay Kumar Garg Open Table Tennis Tournament Details";
		$message = "<b>Dear Participant<b><br/>You have successfully registered for the 18th Ajay Kumar Garg Open Table Tennis Tournament. Your id is ".$_SESSION['ID'] .". Kindly bring the downloaded form along with you.";

		$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = "queryscrolls13@gmail.com";  // GMAIL username, consider changing
			$mail->Password   = "@email991";            // GMAIL password, consider changing
			$mail->AddReplyTo("queryscrolls13@gmail.com","First Last");
			$mail->From       = "queryscrolls13@gmail.com";//email id of PDF_set_text_rendering()
			$mail->CharSet    = "utf-8";

					$mail->FromName   = "Query";
					$mail->Subject    = $sub;
					$mail->Body = $message;
					
					$mail->AddAddress($_SESSION['EmailId'], "SI");
					$mail->WordWrap   = 50; 
					$mail->IsHTML(true); // send as HTML
					
					if($mail->Send()) 
					{
						$mail->ClearAllRecipients();
					}
			}

?>