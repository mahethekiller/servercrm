<?php
    $pageTitle = 'Companies';
    include '../../includes/header.php';

?>


<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All <?php echo $pageTitle ?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">

                <?php
                    $db        = new DB();
                    $query     = "SELECT * FROM companies";
                    $companies = $db->get_results($query);

                ?>
                <table id="companies" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($companies as $company): ?>
                        <tr>
                            <td><?php echo $company['id']; ?></td>
                            <td><?php echo $company['name']; ?></td>
                            <td><?php echo $company['address']; ?></td>
                            <td><?php echo $company['phone']; ?></td>
                            <td><?php echo $company['email']; ?></td>
                            <!-- <td><?php echo $company['website']; ?></td> -->
                            <td>
                                <a href="<?php echo BASE_URL ?>admin/companies/edit.php?id=<?php echo $company['id']; ?>"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <!-- <a href="<?php echo BASE_URL ?>admin/companies/delete.php?id=<?php echo $company['id']; ?>"
                                    class="btn btn-sm btn-danger">Delete</a> -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">Footer</div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </div>
</div>
<!--end::Row-->


<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/companies.js"></script>