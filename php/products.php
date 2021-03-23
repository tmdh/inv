<?php
$conn = new mysqli("localhost", "root", "", "hl");
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<tr>
	<td class='no'>" . $row['id'] . "</td>
	<td class='editp' id='code'>" . $row['code'] . "</td>
	<td>" . $row['name'] . "</td>
	<td>" . $row['stock'] . "</td>
	<td class='editp' id='price'>" . $row['price'] . "</td>
	<td class='editp' id='unit'>" . $row['unit'] . "</td>
	</tr>";
}
?>