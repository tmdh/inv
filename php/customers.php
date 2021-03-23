<?php
$conn = new mysqli("localhost", "root", "", "hl");
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<tr>
	<td class='no'>" . $row['id'] . "</td>
	<td>" . $row['name'] . "</td>
	<td>" . $row['district'] . "</td>
	<td>" . $row['phone'] . "</td>
	</tr>";
}
?>