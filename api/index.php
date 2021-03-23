<?php
$conn = new mysqli("localhost", "root", "", "hl");
switch ($_GET['action']) {
	case "addproduct":
		$code = $_GET['code'];
		$name = $_GET['name'];
		$price = $_GET['price'];
		$unit = $_GET['unit'];
		$sql = "INSERT into products VALUES( NULL, '$code', '$name', 0, '$price', '$unit')";
		if($conn->query($sql) == true) {
			echo "done";
		} else {
			echo "Error";
		}
		break;
	case "editproduct":
		$id = $_GET['id'];
		$column = $_GET['column'];
		$value = $_GET['data'];
		$sql = "UPDATE products SET $column='$value' WHERE id=$id";
		if($conn->query($sql) == true) {
			echo "done";
		} else {
			echo "Error";
		}
		break;
	case "addcustomer":
		$name = $_GET['name'];
		$district = $_GET['district'];
		$phone = $_GET['phone'];
		$sql = "INSERT into customers VALUES( NULL, '$name', '$district', '$phone')";
		if($conn->query($sql) == true) {
			echo "done";
		} else {
			echo "Error";
		}
		break;
	case "getav":
		$code = $_GET['code'];
		$sql = "SELECT id FROM products WHERE code='$code'";
		$result = $conn->query($sql);
		echo $result->num_rows;
		break;
	case "savestocks":
		$sql2 = "";
		for($i = 0; $i < count($_GET['code']); $i++) {
			$code = $_GET['code'][$i];
			$sql = "SELECT stock FROM products WHERE code='$code'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$stock = (int)$row['stock'];
			$addition = (int)$_GET['addition'][$i];
			$total = $stock + $addition;
			$sql2.= "UPDATE products SET stock = $total WHERE code='$code';";
		}
		if($conn->multi_query($sql2) == true) {
			echo "done";
		}
		else {
			echo "Error";
		}
		break;
	case "getnups":
		$code = $_GET['code'];
		$sql = "SELECT name, stock, price, unit FROM products WHERE code='$code'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		echo '{"name": "' . $row['name'] . '", "stock": ' . (int)$row['stock'] . ', "price": ' . (float)$row['price'] . ', "unit": "' . $row['unit'] . '"}';
		break;
	case "saveinvoice":
		$cust_id = $_GET['customer'];
		$sql = "SELECT inv_id FROM invoices ORDER BY inv_id DESC LIMIT 1";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$new_inv_id = (int)$row['inv_id'] + 1;
		$sql = "";
		for($i = 0; $i < count($_GET['code']); $i++) {
			$sql.= "INSERT INTO invoices VALUES ($new_inv_id, $cust_id, '{$_GET['description'][$i]}', '{$_GET['quantity'][$i]}', '{$_GET['unit'][$i]}', '{$_GET['price'][$i]}', '{$_GET['amount'][$i]}');";
			$sql2 = "SELECT stock FROM products WHERE code='{$_GET['code'][$i]}'";
			$result = $conn->query($sql2);
			$row = $result->fetch_assoc();
			$stock = (int)$row['stock'];
			$quantity = (int)$_GET['quantity'][$i];
			$remaining = $stock - $quantity;
			$sql.= "UPDATE products SET stock = $remaining WHERE code='{$_GET['code'][$i]}';";
		}
		$date = date("d/m/Y");
		$sql.= "INSERT INTO invoices_da VALUES ($new_inv_id, '$date', '{$_GET['total']}');";
		if($conn->multi_query($sql) == true) {
			echo $new_inv_id;
		}
		else {
			echo "Error : " . $conn->error;
		}
		break;
	default:
		echo "Access denied";
}
?>