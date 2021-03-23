<?php
$conn = new mysqli("localhost", "root", "", "hl");
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
}
?>