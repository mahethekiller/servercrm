<?php
    $pageTitle = 'Add Product Attributes';
    include '../..//includes/header.php';

?>



<div class="row">
    <div class="col-4">
        <div class="card card-info" >
  <div class="card-header">
    <h3 class="card-title"></h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body ">
    <form action="<?php echo BASE_URL ?>admin/products/post/post.php" method="post" id="attributeForm" class="form-horizontal">
    <div class="form-group">
        <label for="attributeName">Name</label>
        <input type="text" class="form-control" id="attributeName" name="attributeName" required>
    </div>
    <div class="form-group">
        <label for="attributeType">Type</label>
        <select class="form-control" id="attributeType" name="attributeType" required>
            <option value="Ram">Ram</option>
            <option value="HDD">HDD</option>
            <option value="database">database</option>
            <option value="CPU">CPU</option>
            <option value="OS">OS</option>
            <option value="IP">IP</option>
            <option value="bandwidth">bandwidth</option>
            <!-- Add more types as needed -->
        </select>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Attribute</button>
</form>
  </div>
</div>


    </div>

    <div class="col-8">
        <div class="card">
    <div class="card-header">
        <h3 class="card-title">Product Attributes</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>

        </div>
    </div>
    <div class="card-body p-0">


        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $attributes = $db->get_results("SELECT * FROM attributes");
                foreach ($attributes as $row) {
                    echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['attribute_name']}</td>
                    <td>{$row['attribute_type']}</td>
                    <td>{$row['price']}</td>
                    <td>
                        " . ($row['status'] == "active" ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>") . "
                    </td>
                    <td>
                        <a href='javascript:void(0)' class='btn btn-success btn-sm edit-attribute' data-id='".$row['id']."'>Edit</a>


                        <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
                }
            ?>
            </tbody>
        </table>



    </div>

    <div id="editAttributeModalhtml">

    </div>
    <!-- /.card-body -->
    
    <!-- /.card-footer-->
</div>
    </div>
</div>

<!-- /.card -->


<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/attributes.js"></script>