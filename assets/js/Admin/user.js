$(document).ready(function () {
    var base_url = $("#base").val();

    $("#user_creation_form").submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
          url: base_url + "Admin/user/add_user",
          type: "POST",
          data: formData,
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
                $('#user_creation_form')[0].reset();

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
  