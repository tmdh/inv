<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Hamid Est. - Sweets & Herb. Div. - Welcome</title>
		<link rel="stylesheet" href="src/bootstrap-4/css/bootstrap.min.css">
		<link rel="stylesheet" href="src/select2.min.css">
		<link rel="stylesheet" href="src/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="src/style.css">
	</head>
	<body>
		<nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
		  	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<a class="navbar-brand" href="#">Hamid Est.</a>

		  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<button class="btn btn-active my-2 my-sm-0" type="button" data-toggle="modal" data-target="#customers"><i class="fa fa-building-o" aria-hidden="true"></i> Customers</button>
					<div class="space"></div>
					<button class="btn btn-active my-2 my-sm-0" type="button" data-toggle="modal" data-target="#products"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Products</button>
					<div class="space"></div>
					<button class="btn btn-active my-2 my-sm-0" type="button" data-toggle="modal" data-target="#stocks"><i class="fa fa-plus" aria-hidden="true"></i> Add Stock</button>
				</ul>
		  	</div>
		</nav>
		<!-- Main -->
		<div class="container">
			<h2>New invoice</h2>
			<form role="form" id="invoice">
				<div class="form-group row">
					 <label for="customerSelect" class="col-sm-2 col-form-label">Customer's name</label>
					 <div class="col-sm-5">
					 	<select class="form-control" id="customerSelect" name="customer">
					 		<option></option>
					 		<?php include "php/customers.select2.php"; ?>
						</select>
					 </div>
					 <div class="col-sm-5"></div>
				</div>
				<table class="table table-hover table-stripped table-bordered table-inverted">
					<thead>
						<tr>
							<th>Code</th>
							<th>Description</th>
							<th>Stock</th>
							<th>Quantity</th>
							<th>Unit</th>
							<th>Price</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody class="invoice">
						<tr>
							<td><input type="text" class="form-control code" name="code[]"></td>
							<td><input type="text" class="form-control description" readonly name="description[]"></td>
							<td class="stock">0</td>
							<td><input type="text" class="form-control quantity" value="0" name="quantity[]"></td>
							<td><input type="text" class="form-control unit" readonly name="unit[]"></td>
							<td><input type="text" class="form-control price" readonly value="0" name="price[]"></td>
							<td><input type="text" class="form-control amount" readonly value="0" name="amount[]"></td>
						</tr>
					</tbody>
					<tfoot class="invoice">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Total Amount</th>
						<th><input type="text" class="form-control total" readonly value="0" name="total"></th>
					</tfoot>
				</table>
			</form>
		</div>
		<!-- Main End -->
		
		<!-- Customers modal -->
		<div id="customers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="customersLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="customersLabel"><i class="fa fa-building" aria-hidden="true"></i> Customers</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<button type="button" class="btn btn-primary" id="newcustomer"><i class="fa fa-plus" aria-hidden="true"></i> New customer</button>
						<button type="button" class="btn btn-warning" id="savecustomer" disabled="disabled"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save customer</button>
						<button type="button" class="btn" id="cancelcustomer" disabled="disabled"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
						<div class="divider"></div>
						<table class="table table-stripped table-hover table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>District</th>
									<th>Phone</th>
								</tr>
							</thead>
							<tbody class="customers">
								<?php include "php/customers.php"; ?>
							</tbody>
							<tfoot class="customers"></tfoot>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Customers modal End -->
		
		<!-- Products modal -->
		<div id="products" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productsLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="productsLabel"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Products</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<button type="button" class="btn btn-primary" id="newproduct"><i class="fa fa-plus" aria-hidden="true"></i> New product</button>
						<button type="button" class="btn btn-warning" id="saveproduct" disabled="disabled"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save product</button>
						<button type="button" class="btn" id="cancelproduct" disabled="disabled"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
						<div class="divider"></div>
						<table class="table table-stripped table-hover table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Code</th>
									<th>Name</th>
									<th>Stock</th>
									<th>Price</th>
									<th>Unit</th>
								</tr>
							</thead>
							<tbody class="products">
								<?php include "php/products.php"; ?>
							</tbody>
							<tfoot class="products"></tfoot>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Products modal End -->
		
		<!-- Stocks modal -->
		<div id="stocks" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="stocksLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="stocksLabel"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Stocks</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body mbody">
						<form id="addstocks">
							<table class="table table-hover table-bordered table-stripped stocks">
							<thead>
								<tr>
									<th>Code</th>
									<th>Addition</th>
								</tr>
							</thead>
							<tbody class="stocks">
								<tr>
									<td><input type="text" class="form-control code" name="code[]"></td>
									<td><input type="text" class="form-control addition" disabled name="addition[]"></td>
								</tr>
							</tbody>
						</table>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-success btn-offset" id="savestocks"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
						<button type="button" class="btn btn-secondary" id="close" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Stocks modal End -->
		<nav class="navbar navbar-toggleable-md navbar-inverse bg-primary fixed-bottom">
		  	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navbarSupportedContent2">
				<ul class="navbar-nav mr-auto">
					<button class="btn btn-success my-2 my-sm-0" type="button" id="saveinvoice"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Invoice</button>
					<div class="space"></div>
					<button class="btn btn-warning my-2 my-sm-0" type="button" onclick="location.reload()"><i class="fa fa-repeat" aria-hidden="true"></i> Refresh</button>
				</ul>
		  	</div>
		</nav>
		<script src="src/jquery.min.js"></script>
		<script src="src/bootstrap-4/js/tether.min.js"></script>
		<script src="src/bootstrap-4/js/bootstrap.min.js"></script>
		<script src="src/select2.min.js"></script>
		<script src="js/products.js"></script>
		<script src="js/customers.js"></script>
		<script src="js/stocks.js"></script>
		<script src="js/invoice.js"></script>
	</body>
</html>