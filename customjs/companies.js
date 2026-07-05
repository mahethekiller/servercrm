$(document).ready(function () {


  $(document).on("click", ".viewCompanyBtn", function () {
    $("#c_id").text($(this).data("id"));
    $("#c_name").text($(this).data("name"));
    $("#c_client").text($(this).data("client"));
    $("#c_email").text($(this).data("email"));
    $("#c_phone").text($(this).data("phone"));
    $("#c_address").text($(this).data("address"));
    $("#c_city").text($(this).data("city"));
    $("#c_state").text($(this).data("state"));
    $("#c_industry").text($(this).data("industry"));
    $("#c_gst").text($(this).data("gst"));
    $("#c_cin").text($(this).data("cin"));
    $("#c_website").html(`<a href="${$(this).data("website")}" target="_blank">${$(this).data("website")}</a>`);
    $("#c_created").text($(this).data("created"));
    $("#c_updated").text($(this).data("updated"));

    $("#companyViewModal").modal("show");
});


  $("#companies").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
  });
});

$("#companyUpdateForm").submit(function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("operation", "edit");
  $.ajax({
    url: $(this).attr("action"),
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (response) {
      var resp = JSON.parse(response);
      if (resp.success == true) {
        // window.alert(resp.message);
        toastr.success(resp.message, "success");
        // toastr.info(resp.message);
      } else {
        toastr.success(resp.message, "danger");
      }
    },
    error: function (xhr, status, error) {
      window.alert(xhr.responseText);
    },
  });
});

// Copy IT Details to Finance Fields
$('#copyItDetails').change(function() {
    if(this.checked) {
        $('#finance_contact_name').val($('#it_contact_name').val());
        $('#finance_contact_email').val($('#it_contact_email').val());
        $('#finance_contact_phone').val($('#it_contact_phone').val());
    } else {
        $('#finance_contact_name').val('');
        $('#finance_contact_email').val('');
        $('#finance_contact_phone').val('');
    }
});

$("#companyAddForm").submit(function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("operation", "add");
  $.ajax({
    url: $(this).attr("action"),
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function (response) {
      var resp = JSON.parse(response);
      if (resp.success == true) {
        // window.alert(resp.message);
        toastr.success(resp.message, "Success");
        $("#companyAddForm")[0].reset();
        // showToast(resp.message, "success");
        // toastr.info(resp.message);
      } else {
        toastr.error(resp.message, "Error!!");
      }
    },
    error: function (xhr, status, error) {
      window.alert(xhr.responseText);
    },
  });
});


$("#email").change(function() {
    $.get(
        ROOT_PATH + "admin/companies/post/post.php",
        {
            email: $("#email").val(),
        },
        function (data) {
            data = JSON.parse(data);
            if (data.success == false) {
                $("#email_error").text(data.message);
                $("#email_error").show();
            } else {
                $("#email_error").hide();
            }
        }
    );
});
