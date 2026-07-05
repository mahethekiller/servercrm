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

  $("#sub_total_btn").click(function () {
    calculateTotalPrice();
  });

  $("#otc").on("keyup", function () {
    calculateTotalPrice();
  });

  // Quotation status toggling (Demo/Live/Upgrade)
  $(document).on("change", "#quotation_status", function () {
    let status = $(this).val();
    if (status === "demo") {
      $("#demo_dates_row").show();
      $(".billing-info-row").hide();
    } else {
      $("#demo_dates_row").hide();
      $(".billing-info-row").show();
    }
  });

  // Trigger initial state
  if ($("#quotation_status").length) {
    $("#quotation_status").trigger("change");
  }

  // Serialize custom products to JSON
  $(document).on("input change", ".coloc-dc, .coloc-details", function () {
    let $wrapper = $(this).closest("td");
    let json = {
      data_center: $wrapper.find(".coloc-dc").val(),
      server_details: $wrapper.find(".coloc-details").val()
    };
    $wrapper.find(".custom-details-json").val(JSON.stringify(json));
  });

  $(document).on("input change", ".email-provider, .email-model, .email-tax", function () {
    let $wrapper = $(this).closest("td");
    let json = {
      provider: $wrapper.find(".email-provider").val(),
      pricing_model: $wrapper.find(".email-model").val(),
      tax: $wrapper.find(".email-tax").val()
    };
    $wrapper.find(".custom-details-json").val(JSON.stringify(json));
  });

  $(document).on("input change", ".backup-type, .backup-unit-type", function () {
    let $wrapper = $(this).closest("td");
    let json = {
      type: $wrapper.find(".backup-type").val(),
      unit_type: $wrapper.find(".backup-unit-type").val()
    };
    $wrapper.find(".custom-details-json").val(JSON.stringify(json));
  });

  // Call function when page loads and when changes are made

  $("#allProductAttributesForm").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("operation", "convert");
    $.ajax({
      url: $(this).attr("action"),
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      success: function (response) {
        debugger;
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

  $("#allProductAttributesFormDemo").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("operation", "convert");
    $.ajax({
      url: $(this).attr("action"),
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      cache: false,
      success: function (response) {
        debugger;
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

  $(document).on("click", "#saveProductBtn", function (e) {
    e.preventDefault();

    let formData = $("#editProductForm").serialize(); // serialize all inputs in form
    formData += "&operation=save_product";

    $.ajax({
      url: "post/edit-product-modal.php", // your PHP handler file
      type: "POST",
      data: formData,
      dataType: "json",
      beforeSend: function () {
        $("#saveProductBtn").prop("disabled", true).text("Saving...");
      },
      success: function (response) {
        if (response.success) {
          alert(response.message);
          location.reload();

          // Optionally refresh products table or close modal
          // $("#productsTable").load(location.href + " #productsTable");
        } else {
          toastr.error(response.message, "Error");
        }
      },
      error: function (xhr, status, error) {
        console.log("AJAX Error:", error);
        toastr.error("Something went wrong while saving product.", "Error!!");
      },
      complete: function () {
        $("#saveProductBtn").prop("disabled", false).text("Save");
      },
    });
  });

  function loadViewTable(quotationId) {
    $.ajax({
      url: "post/convert-post.php",
      type: "GET",
      data: { operation: "view_product", quotation_id: quotationId },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#viewTableContainer").html(response.data);
        } else {
          $("#viewTableContainer").html("<p>No records found.</p>");
        }
      },
    });
  }
});

$(document).ready(function () {
  // Fetch quotation when SOF ID is entered and focus leaves input
  $("#sof_id").on("keyup", function () {
    let sofId = $(this).val().trim();
    if (sofId.length >= 3) {
      if (sofId) {
        $.get(
          "post/delete-post.php",
          { sof_id: sofId },
          function (data) {
            if (data && data.sof_id) {
              $("#quotationDetails").show();
              $("#detail_sof_id").text(data.sof_id);
              $("#detail_company").text(data.name);
              $("#detail_email").text(data.email);
              $("#detail_phone").text(data.phone);
            } else {
              $("#quotationDetails").hide();
              toastr.error("No quotation found for SOF ID: " + sofId);
            }
          },
          "json"
        );
      }
    }
  });

  // Submit request
  $("#deleteRequestForm").on("submit", function (e) {
    e.preventDefault();
    let formData = $(this).serialize() + "&operation=delete_request";
    $.post(
      "post/delete-post.php",
      formData,
      function (response) {
        if (response.status === "success") {
          toastr.success(response.message);
          $("#deleteRequestForm")[0].reset();
          $("#quotationDetails").hide();
        } else {
          toastr.error(response.message);
        }
      },
      "json"
    );
  });
});
