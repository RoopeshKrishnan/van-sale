$(document).ready(function () {
    var base_url = $("#base").val();
  
    $("#consolidate_filter_form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serialize();
        console.log(formData)
		$.ajax({
			url: base_url + "Admin/consolidate/fetch_customer_orders",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				console.log(data)
				var wc = document.getElementById("consolidate_div");
				if (data.response === "error") {
					toastr["error"](data.message);
					toastr.options = {
						closeButton: true,
						progressBar: true,
					};
				} else if (data.response === "success") {
					wc.innerHTML = data.message; // Insert the HTML content
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("AJAX Error:", textStatus, errorThrown);
			},
		});
	});

	$(document).on("click", "#consolidate_order_confirm_button_id", function (e) {
		e.preventDefault();
		$("#convert_to_van_stock_success").modal("show");
	  });


	$("#convert_to_van_stock_form_id").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: base_url + "Admin/consolidate/order_convert_to_van_stock",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				console.log(data)
				if (data.response === "success") {
					$("#convert_to_van_stock_success").modal("hide");
					// window.location.href = base_url + "order-to-stock";

				} else if (data.response === "error") {
					toastr["error"](data.message);
					toastr.options = {
						closeButton: true,
						progressBar: true,
					};
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("AJAX Error:", textStatus, errorThrown);
			},
		});
	});
	
	$(document).on("click", "#remove_customer_order", function (e) {
		e.preventDefault();
		var delete_id = $(this).attr("value");
		var rowToDelete = $(this).closest("tr"); // Get the closest <tr> element to be deleted

		$.ajax({
			url: base_url + "Admin/consolidate/remove_order",
			type: "post",
			dataType: "json",
			data: {
			  delete_id: delete_id,
			},
			success: function (data) {
				console.log(data)
			  if (data.response == "success") {
				rowToDelete.remove();
  // Remove the order ID from the form data
  $("input[name='consolidate_order_ids[]'][value='" + delete_id + "']").remove();
			  } else {
				toastr["error"](data.message);
				toastr.options = {
				  closeButton: true,
				  progressBar: true,
				};
			  }
			},
		  });
	  });
    // end of document ready
  });
  