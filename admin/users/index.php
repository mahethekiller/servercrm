<?php
    $pageTitle = 'Users';
    include '../../includes/header.php';

?>


<div class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header ">
        <h3 class="card-title">User Management</h3>
        <button class="btn btn-success btn-sm float-right" id="addNew">Add New</button>
      </div>
      <div class="card-body">
        <div id="msg" class="mb-2"></div>
        <table class="table table-bordered table-hover" id="userTable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Gender</th>
              <th>Username</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="userList"></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
    <form id="userForm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalTitle">Add User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="form-group"><label>Name</label><input type="text" name="name" id="name" class="form-control" required></div>
          <div class="form-group"><label>Email</label><input type="email" name="email" id="email" class="form-control" required></div>
          <div class="form-group"><label>Gender</label>
            <select name="gender" id="gender" class="form-control" required>
              <option value="">Select</option>
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
            </select>
          </div>
          <div class="form-group"><label>Username</label><input type="text" name="username" id="username" class="form-control" required></div>
          <div class="form-group" id="passwordGroup"><label>Password</label><input type="password" name="password" id="password" class="form-control" required></div>
          <div class="form-group"><label>Role</label>
            <select name="role" id="role" class="form-control" required>
              <option value="">Select</option>
              <option>admin</option>
              <option>user</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>



<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/users.js"></script>