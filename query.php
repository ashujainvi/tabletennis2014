<?php

$query = $_POST['query'];
$contact = $_POST['contact'];

if ($query == "") {
	echo "-2";
}elseif ($contact == "") {
	echo "-1";
}else{

	$address = "tabletennis14akgec@gmail.com";
	//akgec12345
	// $address = 'webmaster.tabletennis@gmail.com';
	include('class.phpmailer.php');

	$sub = "Table Tennis Query";
	$message = "You have a query:<br/> ".$query."<br/> from: <br/><b>".$contact;

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

			$mail->AddAddress($address, "SI");
			$mail->WordWrap   = 50; 
					$mail->IsHTML(true); // send as HTML
					
					if($mail->Send()) 
					{
						$mail->ClearAllRecipients();
					}

				}

				?>