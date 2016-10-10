<?php session_start();?>
<?php if(isset($_POST['enter']))
		{
			if($_POST['user']=="admin" && $_POST['pwd']=="@email1991")
				{
					$_SESSION["log"]="YES";
					header('location:db.php');
				}
			else
			
			echo "Invalid Password";			
		}
?>
<html>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body >

<form action="admin.php" method="POST">
<table style="margin: auto;padding-top: 15%;">
<tr>
<td>Username</td>
<td><input type="text" name="user" placeholder="username"></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="pwd" placeholder="password"></td>
</tr>
<tr>
<td><input class="btn-green" type="submit" style="height:40px; width: 100px;" name="enter" value="Enter"></td>
</tr>
</table>
</form>
</div>
<br />
<br /><br />
<br /><br />
<br /><br />
<br /><br />
<div id="footer">POWERED BY : SOFTWARE INCUBATOR
		</div>
		<div>
		</body>
</html>