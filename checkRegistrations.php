<style>
table td, th {
	padding: 4px;
}
</style>
<?php
require_once('connection.php');
$query = 'SELECT * from player';
$result = mysqli_query($con,$query);
echo '<h1>The count is <span style="padding:4px;background-color:yellow;">'.mysqli_fetch_array(mysqli_query($con,'SELECT count(pid) from player;'))[0].'</span>';
echo '<br/><br/><table border="1" style="border-collapse:collapse;">';
echo '<tr><th>ID</th><th>Name</th><th>Address</th><th>Institution</th><th>EmailID</th></tr>';
while ($row = mysqli_fetch_array($result)) {
	echo '<tr>';
	echo '<td>';
	echo $row['Pid'];
	echo "</td>";
	echo '<td>';
	echo $row['Name'];
	echo "</td>";
	echo '<td>';
	echo $row['Address'];
	echo "</td>";
	echo '<td>';
	echo $row['Institution'];
	echo "</td>";
	echo '<td>';
	echo $row['EmailId'];
	echo "</td>";
	echo "</tr>";
}
echo '</table>';
?>