$(document).ready(function () {
	var base_url = $("#base").val();

	// Check the initial state of the checkbox
	if (!$("#have_box").is(":checked")) {
		$("#box_view").show();
	}

	// Listen for changes in the checkbox state
	$("#have_box").change(function () {
		if ($(this).is(":checked")) {
			$("#box_view").show();
		} else {
			$("#box_view").hide();
		}
	});

	var itemValueInput = $("#item_value");
	var itemBoxValueInput = $("#item_box_value");
	itemBoxValueInput.prop("disabled", true);
	// Listen for changes in the first input field
	itemValueInput.on("input", function () {
		// Get the value from the first input
		var value = $(this).val();

		// Set the value of the second input and disable it
		itemBoxValueInput.val(value).prop("disabled", true);
		itemBoxValueInput.trigger("click");
		// itemBoxValueInput.val(value)
	});

	var numberOfItemsInput = $("#box_number_of_items");
	var netWeightInput = $("#net_weight");
	var boxNetWeightInput = $("#box_net_weight");
	boxNetWeightInput.prop("disabled", true);

	// Add an input event listener to both the "Number of items" and "Net Weight" inputs
	numberOfItemsInput.on("input", updateBoxNetWeight);
	netWeightInput.on("input", updateBoxNetWeight);

	// Function to update the "box_net_weight" input
	function updateBoxNetWeight() {
		// Get the values from the input fields
		var numberOfItems = parseFloat(numberOfItemsInput.val()); // Parse as a float
		var netWeight = parseFloat(netWeightInput.val()); // Parse as a float

		// Check if the "Net Weight" input is not empty
		if (netWeightInput.val() !== "") {
			// Check if both values are valid numbers
			if (!isNaN(numberOfItems) && !isNaN(netWeight)) {
				// Calculate the result
				var boxNetWeight = numberOfItems * netWeight;

				// Display the result in the "box_net_weight" input
				boxNetWeightInput.val(boxNetWeight.toFixed(2)); // Display with two decimal places
			} else {
				// Handle invalid input (e.g., clear the result field)
				boxNetWeightInput.val("");
			}
		} else {
			// "Net Weight" is empty, clear the result field
			boxNetWeightInput.val("");
		}
	}

	// item creation

	// get corresponding sub category by clicking category
	$("#i_category_id").change(function () {
		var category_id = $("#i_category_id").val();

		if (category_id != 0) {
			$.ajax({
				type: "POST",
				url: base_url + "Admin/item/fetch_sub_category",
				data: { category_id: category_id },
				success: function (data) {
					$("#i_sub_category_id").html(data);
				},
			});
		}
	});

	// get corresponding  category type  by clicking sub category
	$("#i_sub_category_id").change(function () {
		var sub_category_id = $("#i_sub_category_id").val();
		var category_id = $("#i_category_id").val();
		if (sub_category_id != 0) {
			$.ajax({
				type: "POST",
				url: base_url + "Admin/item/fetch_category_type",
				data: { sub_category_id: sub_category_id, category_id: category_id },
				success: function (data) {
					$("#i_category_type_id").html(data);
				},
			});
		}
	});

	$("#tax_id_div").hide();

	$("#tax_yes").click(function () {
		$("#tax_id_div").show();
	});
	$("#tax_no").click(function () {
		$("#tax_id_div").hide();
	});


	// item creation
	$("#item_form").submit(function (e) {
		e.preventDefault();
		$("#box_net_weight").prop("disabled", false);
		$("#item_box_value").prop("disabled", false);

		var formData = $(this).serialize();
		$.ajax({
			url: base_url + "Admin/item/add_item",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				$("#box_net_weight").prop("disabled", true);
				$("#item_box_value").prop("disabled", true);

				// console.log(data);
				if (data != "") {
					if (data.response == "success") {
						toastr["success"](data.message);
						toastr.options = {
							closeButton: true,
							progressBar: true,
						};
						$("#item_form")[0].reset();
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

	// item unit creation
	$(document).on("click", "#item_unit_add_button", function (e) {
		e.preventDefault();
		var formData = $("#item_unit_form").serialize();
		$.ajax({
			url: base_url + "Admin/item/add_item_unit",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				if (data != "") {
					if (data.response == "success") {
						toastr["success"](data.message);
						toastr.options = {
							closeButton: true,
							progressBar: true,
						};
						$("#item_unit_model").modal("hide");
						$("#item_unit-list").load(location.href + " #item_unit-list>*", "");
						$("#card_id").load(location.href + " #card_id>*", "");
						$("#item_unit_form")[0].reset();
						$("#item_unit_div").load(location.href + " #item_unit_div>*", "");
						$("#box_unit_div").load(location.href + " #item_unit_div>*", "");
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
	// item edit form submission
	$("#item_edit_form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: base_url + "Admin/item/update_item",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				if (data != "") {
					if (data.response == "success") {
						toastr.options = {
							closeButton: true,
							progressBar: true,
						};
						toastr["success"](data.message);
						setTimeout(function () {
							window.location.href = base_url + "All-items";
						}, 2000);
						// window.location.href = base_url + "All-users?variable_name=" + encodeURIComponent(urlVariable);
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

	// end of document ready
});
