$(document).ready(function () {
	var base_url = $("#base").val();

	$("#stock_id_form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: base_url + "Admin/stock/create_stock_id",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				console.log(data);
				if (data != "") {
					if (data.response == "success") {
						window.location.href = base_url + "add-stock";
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

	// get corresponding sub category by clicking category
	$("#s_category_id").change(function () {
		var category_id = $("#s_category_id").val();
		if (category_id != 0) {
			$.ajax({
				type: "POST",
				url: base_url + "Admin/stock/fetch_sub_category",
				data: { category_id: category_id },
				success: function (data) {
					$("#s_sub_category_id").html(data);
				},
			});
		}
	});
	// get corresponding  category type  by clicking sub category
	$("#s_sub_category_id").change(function () {
		var sub_category_id = $("#s_sub_category_id").val();
		var category_id = $("#s_category_id").val();
		if (sub_category_id != 0) {
			$.ajax({
				type: "POST",
				url: base_url + "Admin/stock/fetch_category_type",
				data: { sub_category_id: sub_category_id, category_id: category_id },
				success: function (data) {
					$("#s_category_type_id").html(data);
				},
			});
		}
	});
	$("#item_filter_form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: base_url + "Admin/stock/item_filter",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				console.log(data)
				var wc = document.getElementById("item_table_id");
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

	var totalNetWeight = 0; // Initialize the total net weight
	var totalNetWeight_copy=0;
	// add stock
	$("#stock_add_form").submit(function (e) {
		e.preventDefault();
		// Serialize the form data
		var formData = $(this).serializeArray();
		// Send an Ajax request to the server
		$.ajax({
			type: "POST",
			url: base_url + "Admin/stock/item_stock",
			data: formData,
			dataType: "json",
			success: function (response) {
				console.log(response)
				// Handle the success response
				if (response.success) {
					populateModalWithData(response.temp_data);
					$("#stock_conformation_model").modal("show");
				} else {
					alert("Error: " + response.message);
				}
			},
			error: function (error) {
				// Handle errors
				console.log(error);
				alert("An error occurred while processing your request.");
			},
		});
	});

	// var totalNetWeight = 0; // Initialize the total net weight

	// Function to populate the modal with inserted data
	function populateModalWithData(temp_data) {
		var modalBody = $("#stock_conformation_model .tbody");
		// Clear existing data in the modal body
		modalBody.empty();

		// Loop through the insertedData array and generate HTML for each item
		temp_data.forEach(function (item) {

				 // Calculate the totalNetWeight here
				 totalNetWeight = totalNetWeight + parseFloat(item.net_weight);

			var itemHTML = `
          <tbody class="tbody" >
			<tr>
				<td>
					<h6 class="mb-0 text-xs"> ${item.item_name}</h6>
				</td>
				<td>
					<h6 class="mb-0 text-xs"> ${item.number_of_stock} &nbsp; &nbsp;</h6>
					 <p class="text-xs text-secondary mb-0"></p>
				</td>
				<td>
					<h6 class="mb-0 text-xs"> ${item.net_weight}&nbsp; kg </h6>
					 <p class="text-xs text-secondary mb-0"></p>
				</td>
				
				<td> <a href="#" id="delete_stock_item_temp" value="${item.add_stock_temp_id}" data-bs-toggle="tooltip" data-bs-original-title="Delete item stock">
						<i class="material-icons text-danger position-relative text-lg">delete</i>
					</a> 
				</td>
			</tr>
			
     	 </tbody>
      `;
			// Append the itemHTML to the modal body
			modalBody.append(itemHTML);
		});

		 // Display the total net weight after the loop
		 var totalNetWeightHTML = `
		 <tbody class="tbody">
			 <tr>
				 <td colspan="2"></td>
				 <td id="total_weight_div" >
					 <h6 class="mb-0 text-xs">Total Net Weight: ${totalNetWeight.toFixed(1)}kg</h6>
				 </td>
			 </tr>
		 </tbody>
	 `;
 
	 modalBody.append(totalNetWeightHTML);
	  totalNetWeight_copy = totalNetWeight
	 totalNetWeight=0;
	}

  $(document).on("click", "#delete_stock_item_temp", function (e) {
    e.preventDefault();
    var delete_id = $(this).attr("value");
    var rowToDelete = $(this).closest("tr"); // Get the closest <tr> element to be deleted
	// Find the net weight element and extract its text content
	var netWeightElement = rowToDelete.find("h6.text-xs:eq(2)");
	var netWeightText = netWeightElement.text();
  
	// Extract the numeric value from the text
	var deletedItemNetWeight = parseFloat(netWeightText.replace(/[^\d.]/g, ''));
      $.ajax({
        url: base_url + "Admin/stock/delete_temp_stock_data",
        type: "post",
        dataType: "json",
        data: {
          delete_id: delete_id,
        },
        success: function (data) {
          if (data.response == "success") {
            rowToDelete.remove();

			 // Update the totalNetWeight by subtracting the deleted item's net_weight
			 totalNetWeight_copy -= deletedItemNetWeight;

			 // Update the totalNetWeight in the modal
			 updateTotalNetWeight(totalNetWeight_copy);
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

// Function to update the totalNetWeight in the modal
function updateTotalNetWeight(newTotalNetWeight) {
	var totalNetWeightElement = $("#total_weight_div");
	totalNetWeightElement.empty(); // Clear the existing content
	// totalNetWeightElement.append("Total Net Weight: " + newTotalNetWeight.toFixed(1) + "kg");
	totalNetWeightElement.append('<h6 class="mb-0 text-xs">Total Net Weight: ' + newTotalNetWeight.toFixed(1) + 'kg</h6>');

}

  $(document).on("click", "#stock_conformation_model_button", function (e) {
    e.preventDefault();
    $.ajax({
      url: base_url + "Admin/stock/stock_confirmation",
      type: "POST",
      dataType: "json",
      success: function (data) {
		console.log(data)
        if (data != "") {
          if (data.response == "success") {
            toastr["success"](data.message);
            toastr.options = {
              closeButton: true,
              progressBar: true,
            };
			$("#stock_conformation_model").modal("hide");
            // $("#category-list").load(location.href + " #category-list>*", "");
            // $("#card_id").load(location.href + " #card_id>*", "");
            // $('#stock_add_form')[0].reset();
			setTimeout(function () {
				window.location.href = base_url + "all-stock";
			}, 2000);
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
	/// category edit button click, show model and data
	// $(document).on("click", "#edit_user", function (e) {
	//   e.preventDefault();
	//   var edit_id = $(this).attr("value");
	//   if (edit_id == "") {
	//   } else {
	//     $.ajax({
	//       url: base_url + "admin/user/edit_user",
	//       type: "post",
	//       dataType: "json",
	//       data: {
	//         edit_id: edit_id,
	//       },
	//       success: function (data) {
	//         if (data.response == "success") {
	//           $("#card-body").html(data.html);
	//           // $("#edit_model").modal("show");
	//           // $("#edit_model_heading").text("Edit Category");
	//           // $("#edit_model_label_name").text("Category Name");
	//           // $("#which_model").val("category");
	//           // $("#primary_key_id").val(data.post.category_id);
	//           // $("#edit_model_input_name").val(data.post.category);
	//         } else {
	//           toastr["error"](data.message);
	//           toastr.options = {
	//             closeButton: true,
	//             progressBar: true,
	//           };
	//         }
	//       },
	//     });
	//   }
	// });

	$("#user_edit_form").submit(function (e) {
		e.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: base_url + "Admin/user/update_user",
			type: "POST",
			data: formData,
			dataType: "json",
			success: function (data) {
				if (data != "") {
					if (data.response == "success") {
						// var urlVariable = "some_value";
						toastr.options = {
							closeButton: true,
							progressBar: true,
						};
						toastr["success"](data.message);
						setTimeout(function () {
							window.location.href = base_url + "All-users";
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
	

	// update stock item 
	$("#stock_update_form").submit(function (e) {
		e.preventDefault();
		// Serialize the form data
		var formData = $(this).serializeArray();
		// Send an Ajax request to the server
		$.ajax({
			type: "POST",
			url: base_url + "Admin/stock/update_item_stock",
			data: formData,
			dataType: "json",
			success: function (response) {
				console.log(response)
				// Handle the success response
				if (response.response == "success") {
					toastr.options = {
						closeButton: true,
						progressBar: true,
					};
					toastr["success"](response.message);
					setTimeout(function () {
						window.location.href = base_url + "all-stock";
					}, 2000);
				} else {
					toastr["error"](data.message);
					toastr.options = {
						closeButton: true,
						progressBar: true,
					};				}
			},
			error: function (error) {
				// Handle errors
				console.log(error);
			},
		});
	});

	

// close stock
	$("#stock_close_form").submit(function (e) {
		e.preventDefault();
		// Serialize the form data
		var formData = $(this).serializeArray();
		// Send an Ajax request to the server
		$.ajax({
			type: "POST",
			url: base_url + "Admin/stock/item_close_stock",
			data: formData,
			dataType: "json",
			success: function (response) {
				console.log(response)
				// Handle the success response
				if (response.success) {
					populateModalWithCloseStockData(response.temp_data);
					$("#stock_close_conformation_modell").modal("show");
				} else {
					alert("Error: " + response.message);
				}
			},
			error: function (error) {
				// Handle errors
				// console.log(error);
				alert("An error occurred while processing your request.");
			},
		});
	});

	// Function to populate the modal with inserted data
	function populateModalWithCloseStockData(temp_data) {
		var modalBody = $("#stock_close_conformation_modell .t_close_body");
		// Clear existing data in the modal body
		modalBody.empty();
		temp_data.forEach(function (item) {
			

			var itemHTML = `
          <tbody class="tbody" >
			<tr>
				<td>
					<h6 class="mb-0 text-xs"> ${item.item_name}</h6>
				</td>
				<td>
					<h6 class="mb-0 text-xs"> ${item.number_of_stock} &nbsp; &nbsp;</h6>
					 <p class="text-xs text-secondary mb-0"></p>
				</td>
				<td>
					<h6 class="mb-0 text-xs"> ${item.close_stock} &nbsp; &nbsp;</h6>
					 <p class="text-xs text-secondary mb-0"></p>
				</td>
				<td>
					<h6 class="mb-0 text-xs"> ${item.balance_stock} &nbsp; &nbsp;</h6>
					 <p class="text-xs text-secondary mb-0"></p>
				</td>
				
				<td> <a href="#" id="delete_close_stock_item_temp" value="${item.close_stock_temp_id}" data-bs-toggle="tooltip" data-bs-original-title="Delete item stock">
						<i class="material-icons text-danger position-relative text-lg">delete</i>
					</a> 
				</td>
			</tr>
			
     	 </tbody>
      `;
			// Append the itemHTML to the modal body
			modalBody.append(itemHTML);
		});

	}

	$(document).on("click", "#delete_close_stock_item_temp", function (e) {
		e.preventDefault();
		var delete_id = $(this).attr("value");
		var rowToDelete = $(this).closest("tr"); // Get the closest <tr> element to be deleted
		  $.ajax({
			url: base_url + "Admin/stock/delete_temp_close_stock_data",
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

	  $(document).on("click", "#stock_close_conformation_model_button", function (e) {
		e.preventDefault();
		$.ajax({
		  url: base_url + "Admin/stock/close_stock_confirmation",
		  type: "POST",
		  dataType: "json",
		  success: function (data) {
			console.log(data)
			if (data != "") {
			  if (data.response == "success") {
				toastr["success"](data.message);
				toastr.options = {
				  closeButton: true,
				  progressBar: true,
				};
				$("#stock_close_conformation_modell").modal("hide");
				// $("#category-list").load(location.href + " #category-list>*", "");
				// $("#card_id").load(location.href + " #card_id>*", "");
				$('#stock_close_form')[0].reset();
				setTimeout(function () {
					window.location.href = base_url + "all-stock";
				}, 2000);
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

	const addButtons = document.querySelectorAll('.add-item-btn');
	const itemNameElement = document.getElementById('item-name');
	const itemStockElement = document.getElementById('item-stock');
	const extraStockInput = document.getElementById('extra-stock-input');
	let currentItem = null;
	
	addButtons.forEach(function (button) {
		button.addEventListener('click', function () {
			const itemName = button.dataset.itemName;
			const itemStock = button.dataset.itemStock;
			const itemIndex = button.dataset.itemIndex;
	
			// Update modal content with item details
			itemNameElement.textContent = itemName;
			itemStockElement.textContent = itemStock;
	
			// Clear the extra stock input field
			extraStockInput.value = '';
	
			// Store the current item details
			currentItem = {
				index: itemIndex,
				cellId: 'extra_stock' + itemIndex,
				totalCellId: 'total_count' + itemIndex  // New identifier for total count cell
			};
		});
	});
	
	const addStockBtn = document.getElementById('add-stock-btn');
	addStockBtn.addEventListener('click', function () {
		if (currentItem) {
			const enteredValue = extraStockInput.value;
	
			// Update the corresponding table cell with the entered value
			const tableCellId = currentItem.cellId;
			const tableCell = document.getElementById(tableCellId);
	
			// Update the corresponding total count cell
			const totalCellId = currentItem.totalCellId;
			const totalCell = document.getElementById(totalCellId);
			const currentCount = parseInt(itemStockElement.textContent);
			const extraStockValue = parseInt(enteredValue);
			const newTotalCount = currentCount + extraStockValue;
	
			// Update the cells
			tableCell.innerHTML = '<h6 class="mb-0 text-md">' + enteredValue + '</h6><p class="text-xs text-secondary mb-0">unit</p>';
			totalCell.innerHTML = '<h6 class="mb-0 text-md">' + newTotalCount + '</h6><p class="text-xs text-secondary mb-0">unit</p>';
	
			// Close the modal
			$('#add-item-stock').modal('hide');
	
			// Reset currentItem after updating the value
			currentItem = null;
		}
	});

	let formDataSerialized;
	$("#consolidate_stock_form").submit(function (e) {
		e.preventDefault();
		var formDataSerialized = $(this).serialize();

		 // Gather data from the table
		 const totalCounts = [];
		 const extraStocks = [];
		 const itemIds = [];
	 
		 // Iterate over each row in the table
		 $("#consolidate-order-convert tbody tr").each(function () {
			 const totalCountElement = $(this).find("[id^='total_count']");
			 const extraStockElement = $(this).find("[id^='extra_stock']");
			 const itemIdInput = $(this).find("input[name='item_ids[]']");
	 
			 const totalCount = totalCountElement.find("h6").text();
			 const extraStock = extraStockElement.find("h6").text();
			 const itemId = itemIdInput.val();
	 
			 // Store the values in arrays
			 totalCounts.push(totalCount);
			 extraStocks.push(extraStock);
			 itemIds.push(itemId);
		 });
	 
		 // Combine form data and additional data
		 const combinedFormData = {
			 serialized_data: formDataSerialized,
			 additional_data: {
				 total_counts: totalCounts,
				 extra_stocks: extraStocks,
				 item_ids: itemIds,
				 // Add other data if needed
			 }
		 };
	 
		 // Debugging console.log statement
		//  console.log("Combined Form Data:", combinedFormData);
		$.ajax({
			url: base_url + "Admin/stock/consolidate_to_vanstock",
			type: "POST",
			data: combinedFormData,
			dataType: "json",
			success: function (response) {
				console.log(response)
				// Handle the success response
				if (response.success) {
					populateModalWithData(response.temp_data);
					$("#stock_conformation_model").modal("show");
				} else {
					alert("Error: " + response.message);
				}
			},
			error: function (error) {
				console.error(error);
			}
		});
	});

	$(document).on("click", "#delete_consolidate_item", function (e) {
		e.preventDefault();

		// var formData = new FormData(document.getElementById('consolidate_stock_form'));

		var delete_id = $(this).attr("value");
		var rowToDelete = $(this).closest("tr"); // Get the closest <tr> element to be deleted
		 // Remove the row from the table
		 rowToDelete.remove();

		// Remove the corresponding item_id from the form data
		$('input[name="item_ids[]"][value="' + delete_id + '"]').remove();
		// $.ajax({
		// 	url: base_url + "Admin/stock/delete_temp_stock_data",
		// 	type: "post",
		// 	dataType: "json",
		// 	data: {
		// 	  delete_id: delete_id,
		// 	},
		// 	success: function (data) {
		// 		console.log(data)
		// 	  if (data.response == "success") {
		// 		// rowToDelete.remove();
			  
		// 	  } else {
		// 		toastr["error"](data.message);
		// 		toastr.options = {
		// 		  closeButton: true,
		// 		  progressBar: true,
		// 		};
		// 	  }
		// 	},
		//   });

	  });


	
	
	// end of document ready
});
