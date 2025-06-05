$(document).ready(function () {
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
        // showToast(resp.message, "success");
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
