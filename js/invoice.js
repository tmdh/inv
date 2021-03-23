var tr, code, quantity, obj, stock, tr2, tfa, total, str, ar;
$("#customerSelect").select2({
	placeholder: "Select customer"
});
$("tbody.invoice").delegate(".code, .description, .quantity, .unit, .price, .amount", "keyup", function (e) {
	if(e.key == "Enter") {
		tr2 = $("<tr><td><input type='text' class='form-control code' name='code[]'></td><td><input type='text' class='form-control description' readonly name='description[]'></td><td class='stock'>0</td><td><input type='text' class='form-control quantity' value='0' name='quantity[]'></td><td><input type='text' class='form-control unit' readonly name='unit[]'></td><td><input type='text' class='form-control price' readonly value='0' name='price[]'></td><td><input type='text' class='form-control amount' readonly value='0' name='amount[]'></td></tr>");
		$("tbody.invoice").append(tr2).find(".code").focus();
	} else if(e.key == "Delete") {
		tr = $(this).parent().parent();
		tbody = tr.parent();
		tr.remove();
		tbody.last().find(".code").focus();
		if(tbody.children().length == 0) {
			tbody.html("<tr><td><input type='text' class='form-control code' name='code[]'></td><td><input type='text' class='form-control description' readonly name='description[]'></td><td class='stock'>0</td><td><input type='text' class='form-control quantity' value='0' name='quantity[]'></td><td><input type='text' class='form-control unit' readonly name='unit[]'></td><td><input type='text' class='form-control price' readonly value='0' name='price[]'></td><td><input type='text' class='form-control amount' readonly value='0' name='amount[]'></td></tr>");
			tbody.find(".code").focus();
		}
	}
});
$("tbody.invoice").delegate(".code, .quantity", "keyup", function () {
	tr = $(this).parent().parent();
	code = tr.find(".code").val();
	quantity = tr.find(".quantity").val();
	$.ajax({
		url: "api",
		type: "get",
		data: {
			'action': 'getnups',
			'code': code
		},
		success: function (data) {
			obj = $.parseJSON(data);
			tr.find(".description").val(obj.name);
			tr.find(".price").val(obj.price);
			tr.find(".stock").text(obj.stock);
			tr.find(".unit").val(obj.unit);
			update();
		}
	});
});
$("tbody.invoice").delegate(".price, .quantity", "change, keyup", function () {
	tr = $(this).parent().parent();
	price = parseFloat(tr.find(".price").val());
	quantity = parseFloat(tr.find(".quantity").val());
	tr.find(".amount").val(price * quantity);
	tfa = $("tfoot.invoice").find(".total");
	total = parseFloat(0);
	$(".amount").each(function () {
		total += parseFloat($(this).val());
	});
	tfa.val(total);
});
$("tbody.invoice").delegate(".quantity", "keyup", function () {
	if($(this).val() == "") {
		$(this).val(0);
		$(this).parent().parent().find(".amount").val(0);
	}
	stock = parseInt($(this).parent().parent().find(".stock").text());
	if($(this).val() < 0 || $(this).val() > stock) {
		alert("There is only " + stock.toString() + " item(s) left!");
		$(this).val(0);
		$(this).parent().parent().find(".amount").val(0);
	}
	if($(this).val()[0] == 0) {
		$(this).val($(this).val().substr(1));
	}
});
$("#saveinvoice").click(function () {
	ar = $("form#invoice").serializeArray();
	if(ar[0].value == "") {
		alert("Please select a customer...");
	} else {
		str = $("form#invoice").serialize();
		$.ajax({
			url: "api",
			type: "get",
			data: "action=saveinvoice&" + str,
			success: function (data) {
				window.open("inv/?id=" + data, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=800,height=800");
			}
		});
	}
});
$(document).keyup(function (e) {
	if(e.which == 67 && e.altKey == true) {
		$("#customerSelect").val("Cash");
		$("#customerSelect").trigger("change");
	}
});
function update() {
	price = parseFloat(tr.find(".price").val());
	quantity = parseFloat(tr.find(".quantity").val());
	tr.find(".amount").val(price * quantity);
	tfa = $("tfoot.invoice").find(".total");
	total = parseFloat(0);
	$(".amount").each(function () {
		total += parseFloat($(this).val());
	});
	tfa.val(total);
}