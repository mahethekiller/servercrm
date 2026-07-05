$(document).ready(function () {
  
  // Submit Add Product Form
  $("#productAddForm").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      dataType: "json",
      success: function (resp) {
        if (resp.success) {
          toastr.success(resp.message, "Success");
          setTimeout(function () {
            window.location.href = "index.php";
          }, 1000);
        } else {
          toastr.error(resp.message, "Error");
        }
      },
      error: function (xhr, status, error) {
        toastr.error("AJAX error occurred.", "Error");
      }
    });
  });

  // Submit Update Product Form
  $("#productUpdateForm").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      dataType: "json",
      success: function (resp) {
        if (resp.success) {
          toastr.success(resp.message, "Success");
          setTimeout(function () {
            window.location.href = "index.php";
          }, 1000);
        } else {
          toastr.error(resp.message, "Error");
        }
      },
      error: function (xhr, status, error) {
        toastr.error("AJAX error occurred.", "Error");
      }
    });
  });

  // Handle Delete Product button click
  $(document).on("click", ".deleteProductBtn", function () {
    var id = $(this).data("id");
    if (confirm("Are you sure you want to delete this product?")) {
      $.ajax({
        url: "post/product_crud.php",
        type: "POST",
        data: { operation: "delete", id: id },
        dataType: "json",
        success: function (resp) {
          if (resp.success) {
            toastr.success(resp.message, "Deleted");
            $("#product-row-" + id).fadeOut(500, function () {
              $(this).remove();
            });
          } else {
            toastr.error(resp.message, "Error");
          }
        },
        error: function (xhr, status, error) {
          toastr.error("AJAX error occurred.", "Error");
        }
      });
    }
  });

});
