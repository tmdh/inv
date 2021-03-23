<?php
if(isset($_GET['id'])) {
	sleep(3);
	$id = $_GET['id'];
	$conn = new mysqli("localhost", "root", "", "hl");
	$sql = "SELECT cust_id FROM invoices WHERE inv_id=$id LIMIT 1";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$cust_id = $row['cust_id'];
	$sql2 = "SELECT name FROM customers WHERE id=$cust_id";
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	$name = $row2['name'];
} else {
	header("Location: /index.php");
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>مؤسسة حميد محمد عبيد المستادي</title>
		<link rel="stylesheet" href="../src/invoice.style.css">
	</head>
	<body>
		<center>
			<h5>Invoice - <?php echo $id; ?></h5>
			<?php
				echo "Name: " . $name ;
			?>
		</center>
		<table>
			<thead>
				<th>Description</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Amount</th>
			</thead>
			<tbody>
				<?php
				$sql3 = "SELECT * FROM invoices WHERE inv_id=$id";
				$result3 = $conn->query($sql3);
				while($row3 = $result3->fetch_assoc()) {
					echo "<tr>
					<td>" . $row3['description'] . "</td>
					<td class='right'>" . $row3['quantity'] . "</td>
					<td class='right'>" . $row3['price'] . "</td>
					<td class='right'>" . $row3['amount'] . "</td>
					</tr>";
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th class='right'>Total amount:</th>
					<th class="right"><?php
						$sql4 = "SELECT total FROM invoices_da WHERE inv_id=$id";
						$result4 = $conn->query($sql4);
						$row = $result4->fetch_assoc();echo $row['total']; ?></th>
				</tr>
			</tfoot>
		</table>
<SCRIPT SRC="../src/jquery.min.js"></SCRIPT>
<SCRIPT>

</SCRIPT>
	</body>
</html>