$(document).ready(function () {
	var base_url = $("#base").val();
	$("#order_details_div").hide();

	$("#customer_order_confirmation_div").hide();
	$("#customer_order_confirmation_div1").hide();

	$("#customer_order_confirmation_button_div").hide();

	// get corresponding sub category by clicking category
	$("#order_area_id").change(function () {
		var area_id = $("#order_area_id").val();
		if (area_id != 0) {
			$.ajax({
				type: "POST",
				url: base_url + "Admin/order/fetch_customer",
				data: { area_id: area_id },
				success: function (data) {
					$("#order_customer_id").html(data);
				},
			});
		}
	});

	$("#order_customer_id").change(function () {
		var customer_id = $("#order_customer_id").val();
		if (customer_id != 0) {
			$.ajax({
				type: "POST",
				dataType: "json",
				url: base_url + "Admin/order/fetch_customer_details",
				data: { customer_id: customer_id },
				success: function (data) {
					$("#order_details_div").show();

					var wc = document.getElementById("customer_details_div");
					wc.innerHTML = data.message; // Insert the HTML content
				},
			});
		}
	});

	$("#customer_order_from").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: base_url + "Admin/order/create_order_id",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				console.log(data);
				if (data != "") {
					if (data.response == "success") {
						$("#customer_order_add_item").modal("show");
					} else {
						toastr["error"](data.message);
						toastr.options = {
							closeButton: true,
							progressBar: true,
						};
					}
				}
			},
		});
	});

	$("#customer_item_order_form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: base_url + "Admin/order/customer_order_taking",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				console.log(data);
				if (data != "") {
					if (data.response == "success") {
						updateOrderConfirmation(data.order_data);
						$("#customer_order_add_item").modal("hide");
						$("#customer_item_order_form")[0].reset();
						$("#customer_order_confirmation_button_div").show();
					} else {
						toastr["error"](data.message);
						toastr.options = {
							closeButton: true,
							progressBar: true,
						};
						// $("#responseMessage").html('<div class="alert alert-danger">' + data.message + '</div>');
					}
				}
			},
		});
	});

	function updateOrderConfirmation(orderData) {
		// Update the content in the order confirmation div with the retrieved data
		var orderConfirmationDiv = $("#customer_order_confirmation_div");
		var orderNumber = 1;
		// Assuming 'order_data' is an array of order details, you can loop through it and create HTML content
		var orderContent = "";
		orderData.forEach(function (order) {
			orderContent += "<tr>";
			orderContent +=
				'<td><p class="text-xs font-weight-bold mb-0">' +
				orderNumber +
				"</p></td>";
			orderContent +=
				'<td class=""><h6 class="mb-0 text-md">' +
				order.item_name +
				"</h6></td>";
			orderContent +=
				'<td><h6 class="mb-0 text-md"> ' + order.item_order_count + " </h6>";
			orderContent += '<p class="text-xs text-secondary mb-0">unit</p></td>';
			orderContent +=
				'<td><a class="mx-3" type="button" data-bs-toggle="modal" data-bs-original-title="Edit item">';
			orderContent +=
				'<i class="material-icons text-success position-relative text-lg">drive_file_rename_outline</i></a>';
			orderContent +=
				'<a href="#" id="delete_customer_item_order" value="' +
				order.customer_item_order_id +
				'" data-bs-toggle="tooltip" data-bs-original-title="Delete item ">';
			orderContent +=
				'<i class="material-icons text-danger position-relative text-lg">delete</i></a></td>';
			orderContent += "</tr>";

			// Increment the order number for the next row
			orderNumber++;
		});

		// Update the table body with the new content
		var tableBody = orderConfirmationDiv.find("tbody");
		tableBody.html(orderContent);

		// Display the updated content
		orderConfirmationDiv.show();
	}

	$(document).on("click", "#delete_customer_item_order", function (e) {
		e.preventDefault();
		var delete_id = $(this).attr("value");
		var rowToDelete = $(this).closest("tr"); // Get the closest <tr> element to be deleted
		$.ajax({
			url: base_url + "Admin/order/delete_temp_close_stock_data",
			type: "post",
			dataType: "json",
			data: {
				delete_id: delete_id,
			},
			success: function (data) {
				if (data.response == "success") {
					rowToDelete.remove();
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

	$(document).on("click", "#customer_order_confirmation_button", function (e) {
		e.preventDefault();
		$.ajax({
			url: base_url + "Admin/order/customer_order_confirmed",
			type: "post",
			dataType: "json",
			success: function (data) {
				console.log(data)
				if (data.response == "success") {
					toastr["success"](data.message);
					toastr.options = {
						closeButton: true,
						progressBar: true,
					};

					setTimeout(function () {
						window.location.href = base_url + "all-orders";
					}, 2000);
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
