$(document).ready(function () {
  $("#leadForm").on("submit", function (e) {
    e.preventDefault();

    // Clear previous errors
    $(".text-danger").text("");

    // Collect form data
    let formData = {
      company_id: $("#company_id").val().trim(),
      lead_status: $("#lead_status").val().trim(),
      lead_source: $("#lead_source").val().trim(),
      follow_up_date: $("#follow_up_date").val().trim(),
      expected_closer: $("#expected_closer").val().trim(),
      website: $("#website").val().trim(),
      description: $("#description").val().trim(),
      operation: "add",
    };

    // Client-side validation
    let hasError = false;

    if (!formData.company_id) {
      $("#error_company_id").text("Company is required");
      hasError = true;
    }
    if (!formData.lead_status) {
      $("#error_lead_status").text("Lead Status is required");
      hasError = true;
    }
    if (!formData.lead_source) {
      $("#error_lead_source").text("Lead Source is required");
      hasError = true;
    }
    if (!formData.follow_up_date) {
      $("#error_follow_up_date").text("Follow Up Date is required");
      hasError = true;
    }
    if (!formData.expected_closer) {
      $("#error_expected_closer").text("Expected Closer Date is required");
      hasError = true;
    }
    if (formData.website && !isValidURL(formData.website)) {
      $("#error_website").text("Enter a valid URL");
      hasError = true;
    }
    if (!formData.description) {
      $("#error_description").text("Description is required");
      hasError = true;
    }

    if (hasError) {
      return;
    }

    // Disable submit button to prevent multiple submits
    $("#submitBtn").prop("disabled", true).text("Submitting...");

    // AJAX submit
    $.ajax({
      url: $(this).attr("action"),
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        $("#submitBtn").prop("disabled", false).text("Submit");
        if (response.success) {
          toastr.success("Lead saved successfully!", "success");
          $("#leadForm")[0].reset();
        } else {
          toastr.success("Error: " + response.message, "danger");
        }
      },
      error: function () {
        $("#submitBtn").prop("disabled", false).text("Submit");
        toastr.success("AJAX error occurred.", "danger");
      },
    });
  });

  // URL validation helper
  function isValidURL(url) {
    let pattern = new RegExp(
      "^(https?:\\/\\/)?" + // protocol
        "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|" + // domain name
        "((\\d{1,3}\\.){3}\\d{1,3}))" + // OR ip (v4) address
        "(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*" + // port and path
        "(\\?[;&a-z\\d%_.~+=-]*)?" + // query string
        "(\\#[-a-z\\d_]*)?$",
      "i"
    );
    return !!pattern.test(url);
  }

  $("#company_id").change(function () {
    let companyId = $(this).val();
    $.ajax({
      url: `../../admin/companies/post/post.php?company_id=${companyId}`,
      type: "GET",
      dataType: "json",
      success: function (response) {
        if (response.success) {
          let data = response.data;
          let html = `
            <table class="table table-bordered table-condensed table-striped">
              <tr>
                <th>ID</th>
                <td>${data.id}</td>
              </tr>
              <tr>
                <th>Name</th>
                <td>${data.name}</td>
              </tr>
              <tr>
                <th>Client Name</th>
                <td>${data.client_name}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>${data.email}</td>
              </tr>
              <tr>
                <th>Phone</th>
                <td>${data.phone}</td>
              </tr>
              <tr>
                <th>Address</th>
                <td>${data.address}</td>
              </tr>
              <tr>
                <th>City</th>
                <td>${data.city}</td>
              </tr>
              <tr>
                <th>State</th>
                <td>${data.state}</td>
              </tr>
              <tr>
                <th>PIN Code</th>
                <td>${data.pin_code}</td>
              </tr>
              <tr>
                <th>Country</th>
                <td>${data.country}</td>
              </tr>
              
              <tr>
                <th>Country Code</th>
                <td>${data.country_code}</td>
              </tr>
              <tr>
                <th>GST No</th>
                <td>${data.gst_no}</td>
              </tr>
              <tr>
                <th>CIN No</th>
                <td>${data.cin_no}</td>
              </tr>
              <tr>
                <th>Industry</th>
                <td>${data.industry}</td>
              </tr>
              <tr>
                <th>PAN No</th>
                <td>${data.pan_no}</td>
              </tr>
              <tr>
                <th>Website</th>
                <td>${data.website}</td>
              </tr>
            </table>
          `;
          $("#company_data").html(html);
        } else {
          $("#company_data").html("No data found");
        }
      },
      error: function () {
        $("#company_data").html("AJAX error occurred");
      },
    });
  });
});
