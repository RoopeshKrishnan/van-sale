$(document).ready(function () {
    var base_url = $("#base").val();

    $("#customer_creation_form").submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
          url: base_url + "Admin/customer/add_customer",
          type: "POST",
          data: formData,
          dataType: "json",
          success: function (data) {
            // console.log(data)
            if (data != "") {
              if (data.response == "success") {
                toastr["success"](data.message);
                toastr.options = {
                  closeButton: true,
                  progressBar: true,
                };
                $('#customer_creation_form')[0].reset();
                // Reset dropdowns to their initial state
                $('#state').val("");
                $('#choices-district').val("");
                $('#choices-price').val("");
                $('#choices-area').val("");
                $('#choices-group').val("");

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
  /// customer edit 
  $("#customer_edit_form").submit(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: base_url + "Admin/customer/update_customer",
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
              window.location.href = base_url + "All-customers";
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
  