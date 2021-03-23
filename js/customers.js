var district, phone;
$("#newcustomer").click(function () {
	no = (parseInt($("tbody.customers").last().find(".no").last().text())+1).toString();
	$("tfoot.customers").append(
		"<tr>" +
			"<td id='no'>" + no + "</td>" +
			"<td><input type='text' class='form-control' id='name'></td>" +
			"<td><input type='text' class='form-control' id='district'></td>" +
			"<td><input type='text' class='form-control' id='phone'></td>" +
		"</tr>");
	$("#savecustomer").removeAttr("disabled");
	$("#cancelcustomer").removeAttr("disabled");
	$(this).attr("disabled", "disabled");
});
$("#savecustomer").click(function () {
	tr = $("tfoot.customers").find("tr");
	name = tr.find("#name").val();
	district = tr.find("#district").val();
	phone = tr.find("#phone").val();
	$.ajax({
		url: 'api',
		type: 'get',
		data: {
			'action': 'addcustomer',
			'name': name,
			'district': district,
			'phone': phone
		},
		success: function (data) {
			if(data == "done") {
				$("tbody.customers").append(
					"<tr>" +
						"<td class='no'>" + no + "</td>" +
						"<td>" + name + "</td>" +
						"<td>" + district + "</td>" +
						"<td>" + phone + "</td>" +
					"</tr>");
				$("tfoot.customers").html("");
				$("#newcustomer").removeAttr("disabled");
				$(this).attr("disabled", "disabled");
				$("#cancelcustomer").attr("disabled", "disabled");
			} else {
				alert("Error");
			}
		}
	});
});
$("#cancelcustomer").click(function () {
	$("tfoot.customers").html("");
	$("#newcustomer").removeAttr("disabled");
	$(this).attr("disabled", "disabled");
	$("#savecustomer").attr("disabled", "disabled");
});