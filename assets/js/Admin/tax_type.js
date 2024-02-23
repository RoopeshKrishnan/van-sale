$(document).ready(function () {
    var base_url = $("#base").val();
  
 // area creation
 $(document).on("click", "#tax_type_add_button", function (e) {
    e.preventDefault();
    var formData = $("#tax_type_form").serialize();
    $.ajax({
      url: base_url + "Admin/tax_type/add_tax_type",
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
            $("#tax_type_model").modal("hide");
            $("#tax_type-list").load(location.href + " #tax_type-list>*", "");
            $("#card_id").load(location.href + " #card_id>*", "");
            $('#tax_type_form')[0].reset();
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
  