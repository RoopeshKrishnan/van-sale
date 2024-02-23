$(document).ready(function () {
    var base_url = $("#base").val();
  
    $("#price_list_form").submit(function (e) {
        e.preventDefault();
        // Serialize the form data
        var formData = $(this).serialize();
    
        $.ajax({
            type: "POST",
            url: base_url + "Admin/pricelist/add_price_list",
            data: { formData: formData }, // Pass formData as an object with key 'formData'
            dataType: "json",
            success: function (response) {
                console.log(response);
                // if (response.success) {
                //     // Handle the success response
                //     // For example, update the UI or show a success message
                // } else {
                //     // Handle the case where 'price_list_a' is not found
                //     alert("Error: " + response.message);
                // }
            },
            error: function (error) {
                // Handle errors
                console.log(error.responseText);
                alert("An error occurred while processing your request.");
            },
        });
    });

    $("#price_list_form_try").submit(function (e) {
      e.preventDefault();
      // Serialize the form data
      var formData = $(this).serialize();
  
      $.ajax({
          type: "POST",
          url: base_url + "Admin/pricelist/add_price_list_try",
          data: { formData: formData }, // Pass formData as an object with key 'formData'
          dataType: "json",
          success: function (response) {
              console.log(response);
              // if (response.success) {
              //     // Handle the success response
              //     // For example, update the UI or show a success message
              // } else {
              //     // Handle the case where 'price_list_a' is not found
              //     alert("Error: " + response.message);
              // }
          },
          error: function (error) {
              // Handle errors
              console.log(error.responseText);
              alert("An error occurred while processing your request.");
          },
      });
  });

  /// category edit button click, show model and data
  $(document).on("click", "#edit_category", function (e) {
    e.preventDefault();
    var edit_id = $(this).attr("value");
    if (edit_id == "") {
    } else {
      $.ajax({
        url: base_url + "admin/category/edit_category",
        type: "post",
        dataType: "json",
        data: {
          edit_id: edit_id,
        },
        success: function (data) {
          if (data.response == "success") {
            $("#edit_model").modal("show");
            $("#edit_model_heading").text("Edit Category");
            $("#edit_model_label_name").text("Category Name");
            $("#which_model").val("category");
            $("#primary_key_id").val(data.post.category_id);
            $("#edit_model_input_name").val(data.post.category);
          } else {
            toastr["error"](data.message);
            toastr.options = {
              closeButton: true,
              progressBar: true,
            };
          }
        },
      });
    }
  });
  // delete category
  $(document).on("click", "#delete_category", function (e) {
    e.preventDefault();
    var del_id = $(this).attr("value");
    if (del_id == "") {
      alert("Something Wrong");
    } else {
      bootbox.confirm({
        title: "Alert ",
        message: "Do you want to Delete This Category?",
        buttons: {
          cancel: {
            label: '<i class="fa fa-times"></i> Cancel',
          },
          confirm: {
            label: '<i class="fa fa-check"></i> Confirm',
          },
        },
        callback: function (result) {
          if (result) {
            $.ajax({
              url: base_url + "admin/category/delete_category",
              type: "post",
              dataType: "json",
              data: {
                del_id: del_id,
              },
              success: function (data) {
                if (data != "") {
                  if (data.response == "success") {
                    toastr["success"](data.message);
                    toastr.options = {
                      closeButton: true,
                      progressBar: true,
                    };
                    $("#table_id").load(location.href + " #table_id>*", "");
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
          } else {
          }
        },
      });
    }
  });
    // end of document ready
  });
  