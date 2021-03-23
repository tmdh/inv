var no, tr, code, name, price, id, attr, value, object;
$("#newproduct").click(function () {
	no = (parseInt($("tbody.products").last().find(".no").last().text())+1).toString();
	$("tfoot.products").append(
		"<tr>" +
			"<td id='no'>" + no + "</td>" +
			"<td><input type='text' class='form-control' id='code'></td>" +
			"<td><input type='text' class='form-control' id='name'></td>" +
			"<td><input type='text' class='form-control' id='stock'></td>" +
			"<td><input type='text' class='form-control' id='price'></td>" +
			"<td>" +
				"<select class='sedit'>" + 
					 "<option selected>C</option>" +
					 "<option>P</option>" +
					 "<option>B</option>" +
				 "</select>" +
			"</td>" +
		"</tr>");
	$("#saveproduct").removeAttr("disabled");
	$("#cancelproduct").removeAttr("disabled");
	$(this).attr("disabled", "disabled");
});
$("#saveproduct").click(function () {
	tr = $("tfoot.products").find("tr");
	name = tr.find("#name").val();
	code = tr.find("#code").val();
	price = tr.find("#price").val();
	unit = tr.find(".sedit").val();
	$.ajax({
		url: 'api',
		type: 'get',
		data: {
			'action': 'addproduct',
			'name': name,
			'code': code,
			'price': price,
			'unit': unit
		},
		success: function (data) {
			if(data == "done") {
				$("tbody.products").append(
					"<tr>" +
						"<td class='no'>" + no + "</td>" +
						"<td class='editp' id='code'>" + code + "</td>" +
						"<td>" + name + "</td>" +
						"<td>0</td>" +
						"<td class='editp' id='price'>" + price + "</td>" +
						"<td class='editp' id='unit'>" + unit + "</td>" +
					"</tr>");
				$("tfoot.products").html("");
				$("#newproduct").removeAttr("disabled");
				$(this).attr("disabled", "disabled");
				$("#cancelproduct").attr("disabled", "disabled");
				$("#customerSelect").select2("destroy");
				$("#customerSelect").append("<option value='" + no + "'>" + name + "</option>");
				$("#customerSelect").select2({
					placeholder: "Select customer"
				});
			} else {
				alert("Error");
			}
		}
	});
});
$(".editp").dblclick(function () {
	object = $(this);
	id = $(this).parent().find(".no").text();
	attr = $(this).attr("id");
	value = $(this).text();
	if(attr == "unit") {
		if(value == "C") {
			$(this).html("<select class='iedit' autofocus='on'>" + 
						 "<option selected>C</option>" +
						 "<option>P</option>" +
						 "<option>B</option>" +
						 "</select>");
		} else if (value == "P") {
			$(this).html("<select class='iedit' autofocus='on'>" + 
						 "<option>C</option>" +
						 "<option selected>P</option>" +
						 "<option>B</option>" +
						 "</select>");
		} else if (value == "B") {
			$(this).html("<select class='iedit' autofocus='on'>" + 
						 "<option>C</option>" +
						 "<option>P</option>" +
						 "<option selected>B</option>" +
						 "</select>");
		} else {
			$(this).html("<select class='iedit' autofocus='on'>" + 
						 "<option selected>C</option>" +
						 "<option>P</option>" +
						 "<option>B</option>" +
						 "</select>");
		}
	} else {
		$(this).html("<input type='text' class='form-control iedit' value='" + value + "' id='" + attr + "' autofocus='on'>");
	}
	$(".iedit").focusout(function () {
			value = $(this).val();
			$.ajax({
				url: 'api',
				type: 'get',
				data: {
					'action': 'editproduct',
					'id': id,
					'column': attr,
					'data': value
				},
				success: function (data) {
					if(data == "done") {
						object.html(value);
					} else {
						alert("Error");
					}
				}
			});
		});
});
$("#cancelproduct").click(function () {
	$("tfoot.products").html("");
	$("#newproduct").removeAttr("disabled");
	$(this).attr("disabled", "disabled");
	$("#saveproduct").attr("disabled", "disabled");
});