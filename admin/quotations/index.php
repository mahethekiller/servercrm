<?php
    $pageTitle = 'Quotations';
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
                    $query     = "SELECT * FROM quotations Where status = 1 ORDER BY id DESC";
                    $quotations = $db->get_results($query);

                ?>
                <table id="companies" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>ID</th>
                            <th>Lead ID</th>
                            <th>Added By</th>
                            <th>Company Name</th>
                            <th>Client Name</th>
                            <th>Description</th>
                            <th>Quotation Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quotations as $quotation): ?>
                            <?php 
                                $company= getCompanyDetailsFromQuotationId($quotation['id']);
                                $user= getUserDetailsFromUserId($quotation['added_by']);
                                ?>
                        <tr>
                            <td><?php echo $quotation['id']; ?></td>
                            <td><?php echo $quotation['lead_id']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td><?php echo $company['name']; ?></td>
                            <td><?php echo $company['client_name']; ?></td>
                            <td><?php echo $quotation['description']; ?></td>
                            <td>
                                <?php 
                                    if($quotation['quotation_status'] == 'demo'){
                                        echo '<span class="badge bg-warning">Demo</span>';
                                    }else{
                                        echo '<span class="badge bg-success">Live</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="#"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <!-- <a href="<?php echo BASE_URL ?>admin/quotations/delete.php?id=<?php echo $quotation['id']; ?>"
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