<?php
 require_once('connection.php');
 $query="SELECT  * from player  ";
 $r=mysqli_query($con,$query);
  $r1=mysqli_query($con,$query);
 $count=0;
 while ($cid=mysqli_fetch_array($r1)) {
 	$count++;
 }


echo "</br>Total no of registrations:	".$count."</br></br></br></br>";

 $i=0;
 print "<table border=1 style='border-collapse:collapse;'>";
 print "<tr>
<td><b><u>Pid</u></b></td>
<td><b><u>Name</u></b></td>
<td><b><u>DOB</u></b></td>
<td><b><u>Gender</u></b></td>
<td><b><u>Address</u></b></td>
<td><b><u>Institution</u></b></td>
<td><b><u>Contact No.</u></b></td>
<td><b><u>EmailId</u></b></td>
<td><b><u>Member</u></b></td>
<td><b><u>Accomodation</u></b></td>
 <tr>";

 while ($id=mysqli_fetch_array($r)) {
 	# code...
 $i=0;
 print "<tr >";
 while($i<10)
 {  
 	print "<td width=\"200\">";
 	echo($id[$i]);
 	$i++;
 	print "</td>";
 }


 print "</tr>";

			
}
print "</table>";