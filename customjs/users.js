$(function () {
  loadUsers();

  $("#addNew").click(function () {
    $("#userForm")[0].reset();
    $("#id").val("");
    $("#modalTitle").text("Add User");
    $("#passwordGroup").show();
    $("#userModal").modal("show");
  });

  $("#userForm").submit(function (e) {
    e.preventDefault();
    let formData = $(this).serialize();
    $.post(
      ROOT_PATH + "admin/users/post/user_crud.php",
      formData,
      function (res) {
        if (res.type == "danger") {
          toastr.error(res.message, "Error");
        } else {
          toastr.success(res.message, "Success");
          $("#userModal").modal("hide");
          loadUsers();
        }
        //   $('#msg').html(res.message).removeClass().addClass('alert alert-' + res.type).fadeIn().delay(2000).fadeOut();
      },
      "json"
    );
  });

  $(document).on("click", ".editBtn", function () {
    let id = $(this).data("id");
    $.get(
      ROOT_PATH + "admin/users/post/user_crud.php",
      { id },
      function (user) {
        $("#modalTitle").text("Edit User");
        $("#id").val(user.id);
        $("#name").val(user.name);
        $("#email").val(user.email);
        $("#gender").val(user.gender);
        $("#username").val(user.username);
        $("#role").val(user.role);
        $("#passwordGroup").hide(); // Hide password on update
        $("#userModal").modal("show");
      },
      "json"
    );
  });

  $(document).on("click", ".deleteBtn", function () {
    if (confirm("Are you sure to delete this user?")) {
      let id = $(this).data("id");
      $.post(
        ROOT_PATH + "admin/users/post/user_crud.php",
        { delete_id: id },
        function (res) {
          $("#msg")
            .html(res.message)
            .removeClass()
            .addClass("alert alert-" + res.type)
            .fadeIn()
            .delay(2000)
            .fadeOut();
          loadUsers();
        },
        "json"
      );
    }
  });

  function loadUsers() {
    $.get(
      ROOT_PATH + "admin/users/post/user_crud.php",
      { list: 1 },
      function (data) {
        let rows = "";
        data.forEach((user) => {
          rows += `<tr>
          <td>${user.name}</td>
          <td>${user.email}</td>
          <td>${user.gender}</td>
          <td>${user.username}</td>
          <td>${user.role}</td>
          <td>
            <button class="btn btn-info btn-sm editBtn" data-id="${user.id}">Edit</button>
            <button class="btn btn-danger btn-sm deleteBtn" data-id="${user.id}">Delete</button>
          </td>
        </tr>`;
        });
        $("#userList").html(rows);
      },
      "json"
    );
  }
});
