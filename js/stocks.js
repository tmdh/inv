var val, tr, tbody, str;
$("form#addstocks").delegate(".code", "keyup", function () {
	val = $(this).val();
	tr = $(this).parent().parent();
	$.ajax({
		url: "api",
		type: "get",
		data: {
			'action': 'getav',
			'code': val
		},
		success: function (data) {
			if(parseInt(data) == 1) {
				tr.find(".addition").removeAttr("disabled");
			} else {
				tr.find(".addition").attr("disabled", "disabled");
			}
		}
	});
});
$("form#addstocks").delegate(".addition", "keyup", function (e) {
	if(e.key == "Enter") {
		tr = $("<tr><td><input type='text' class='form-control code' name='code[]'></td><td><input type='text' class='form-control addition' disabled name='addition[]'></td></tr>");
		$("tbody.stocks").append(tr).find(".code").focus();
	}
});
$("form#addstocks").delegate(".code, .addition", "keyup", function (e) {
	if(e.key == "Delete") {
		tr = $(this).parent().parent();
		tbody = tr.parent();
		tr.remove();
		tbody.last().find(".code").focus();
		if(tbody.children().length == 0) {
			tbody.html("<tr><td><input type='text' class='form-control code' name='code[]'></td><td><input type='text' class='form-control addition' disabled name='addition[]'></td></tr>");
			tbody.find(".code").focus();
		}
	}
});
$("#savestocks").click(function () {
	str = $("form#addstocks").serialize();
	$.ajax({
		url: "api",
		type: "get",
		data: "action=savestocks&" + str,
		success: function (data) {
			if(data == "done") {
				$("tbody.stocks").html("<tr><td><input type='text' class='form-control code' name='code[]'></td><td><input type='text' class='form-control addition' disabled name='addition[]'></td></tr>");
				$(".mbody").prepend("<div class='alert alert-success alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Well done!</strong> Stocks successfully added.</div>");
			}
			else {
				$(".mbody").prepend("<div class='alert alert-danger alert-dismissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Something went wrong!</strong> Try submitting again or contact owner.</div>");
			}
		}
	});
});