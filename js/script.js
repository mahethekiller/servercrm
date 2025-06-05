$(document).ready(function () {
  $(".select2").select2({
    placeholder: "Select an option",
  });

  $(".dttable").DataTable({
    paging: true,
    lengthChange: false,
    searching: true,
    ordering: true,
    info: true,
    autoWidth: false,
  });
});
