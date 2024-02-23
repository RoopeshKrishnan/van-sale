$(document).ready(function () {
	var base_url = $("#base").val();

    
    $("#customer_details_div").hide();

    $("#customer_type").change(function () {
        $("#customer_details_div").hide();

		var customer_type = $("#customer_type").val();
			$.ajax({
				type: "POST",
				url: base_url + "Admin/bill/fetch_customer_by_type",
				data: { customer_type: customer_type },
				success: function (data) {
                    console.log(data)
					$("#customers").html(data);
				},
			});
	});

    $("#customers").change(function () {
        var customer_id = $("#customers").val();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: base_url + "Admin/bill/fetch_selected_customer_details",
                data: { customer_id: customer_id },
                success: function (data) {
                    $("#customer_details_div").show();

                    var wc = document.getElementById("customer_details_div");
                    wc.innerHTML = data.message; // Insert the HTML content
                },
            });
	});
	// end of document ready
});
