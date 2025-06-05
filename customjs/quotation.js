$(document).ready(function () {
  $(".item-checkbox").change(function () {
    let value = $(this).val();
    let title = $(this).data("title");

    let id = value.replace(/\s+/g, "-");

    if ($(this).is(":checked")) {
      $.get(
        ROOT_PATH + "admin/crmleads/post/additem.php",
        {
          product_id: id,
          operation: "add_product",
        },
        function (data) {
          data = JSON.parse(data);
          if (data.success == false) {
            alert(data.message);
            return;
          }

          $("#dynamicTablesContainer").append(`
                    <div class="card card-info" id="${id}">
                        <div class="card-header">
                            <h3 class="card-title">${title}</h3>

                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                        <div class="product-table-wrapper" data-product-id="' + id + '">
                            ${data.data}
                            </div>
                        </div>
                        </div>
                `);
          $("#" + id)
            .find(".remove-item")
            .attr("data-id", id); // Set correct ID for removal

          if ($("#dynamicTablesContainer table").length === 0) {
            $("#submit-quotation").hide();
          } else {
            $("#submit-quotation").show();
          }
        }
      );
    } else {
      $("#" + id).remove();
      if ($("#dynamicTablesContainer table").length === 0) {
        $("#submit-quotation").hide();
      } else {
        $("#submit-quotation").show();
      }
    }
  });

  $(document).on("click", ".remove-item", function () {
    let id = $(this).data("id");
    $("#" + id).remove();
    
    $('.item-checkbox[value="' + id + '"]').prop("checked", false);
    if ($("#dynamicTablesContainer table").length === 0) {
      $("#submit-quotation").hide();
    } else {
      $("#submit-quotation").show();
    }
  });

  // When attribute dropdown changes
  $(document).on("change", ".attr-select", function () {
    var $row = $(this).closest("tr");
    var selected = $(this).find("option:selected");
    var price = parseFloat(selected.data("price")) || 0;

    $row.find(".reg-price").val(price);
    calculateRowTotal($row);
  });

  // When unit or sale price changes
  $(document).on("input change", ".unit-select, .sale-price", function () {
    var $row = $(this).closest("tr");
    calculateRowTotal($row);
  });

  // When Re-Calculate is clicked
  $(document).on("click", ".recalc-btn", function () {
    var $row = $(this).closest("tr");
    calculateRowTotal($row);
  });

  // Main calculation function
  function calculateRowTotal($row) {
    var price = parseFloat($row.find(".reg-price").val()) || 0;
    var unit = parseInt($row.find(".unit-select").val()) || 1;
    var salePrice = parseFloat($row.find(".sale-price").val()) || 0;

    var finalPrice = salePrice > 0 ? salePrice : price;
    var total = unit * finalPrice;

    $row.find(".total-price").val(total.toFixed(2));
    calculateTotalPrice();
  }

  // Function to calculate total price of all products
  function calculateTotalPrice() {
    var total = 0;
    $(".total-price").each(function () {
      total += parseFloat($(this).val()) || 0;
    });

    var otc = parseFloat($("#otc").val()) || 0;
    total += otc;

    $("#sub_total").val(total.toFixed(2));

  }


  $("#sub_total_btn").click(function() {
    calculateTotalPrice();
  });

  $("#otc").on("keyup", function() {
    calculateTotalPrice();
  });
  

  // Call function when page loads and when changes are made
  



  $("#allProductAttributesForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr("action"),
      method: "POST",
      data: $(this).serialize(),
      success: function (response) {
        // toastr.success("Lead saved successfully!", "success");
        response = JSON.parse(response);
        if (response.success == true) {
          toastr.success(response.message, "Success");
        } else {
          toastr.error(response.message, "Error!!");
        }
      },
      error: function () {
        toastr.error("AJAX error occurred.", "Error!!");
      },
    });
  });
});
