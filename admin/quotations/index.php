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
                <h3 class="card-title">All                                                                                     <?php echo $pageTitle ?></h3>
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
                    $db         = new DB();
                    $status_filter = $_GET['status'] ?? 'all';
                    if ($status_filter === 'demo') {
                        $query = "SELECT * FROM quotations WHERE status = 1 AND quotation_status = 'demo' ORDER BY id DESC";
                    } elseif ($status_filter === 'live') {
                        $query = "SELECT * FROM quotations WHERE status = 1 AND quotation_status = 'live' ORDER BY id DESC";
                    } elseif ($status_filter === 'upgrade') {
                        $query = "SELECT * FROM quotations WHERE status = 1 AND quotation_status = 'upgrade' ORDER BY id DESC";
                    } else {
                        $query = "SELECT * FROM quotations WHERE status = 1 ORDER BY id DESC";
                    }
                    $quotations = $db->get_results($query);
                ?>

                <!-- Status Tabs -->
                <div class="mb-3 d-flex gap-2 align-items-center">
                    <strong>Filter Status: </strong>
                    <a href="?status=all" class="btn btn-sm btn-outline-secondary <?php echo $status_filter === 'all' ? 'active' : ''; ?>">All</a>
                    <a href="?status=demo" class="btn btn-sm btn-outline-warning <?php echo $status_filter === 'demo' ? 'active' : ''; ?>">Demo</a>
                    <a href="?status=live" class="btn btn-sm btn-outline-success <?php echo $status_filter === 'live' ? 'active' : ''; ?>">Live</a>
                    <a href="?status=upgrade" class="btn btn-sm btn-outline-danger <?php echo $status_filter === 'upgrade' ? 'active' : ''; ?>">Upgrade</a>
                </div>

                <?php if (isset($_GET['msg'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($_GET['msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <table id="companies" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>SOF ID</th>
                            <th>Lead ID</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Client Name</th>
                            <th>Description</th>
                            <th>Added By</th>
                            <th>Status</th>
                            <th>Convert</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quotations as $quotation): ?>
<?php
    $company = getCompanyDetailsFromQuotationId($quotation['id']);
    $user    = getUserDetailsFromUserId($quotation['added_by']);
?>
                        <tr>
                            <td><?php echo $quotation['sof_id']; ?></td>
                            <td><?php echo $quotation['lead_id']; ?></td>

                            <td><?php echo $company['name']; ?></td>
                            <td><?php echo $company['email']; ?></td>
                            <td>
                                <?php echo $company['phone']; ?><br>
                                IT: <?php echo $company['it_contact_name']; ?> - <?php echo $company['it_contact_phone']; ?><br>
                                Finance: <?php echo $company['finance_contact_name']; ?> - <?php echo $company['finance_contact_phone']; ?>
                            </td>
                            <td><?php echo $company['client_name']; ?></td>
                            <td><?php echo $quotation['description']; ?></td>

                            <td><?php echo $user['name']; ?></td>
                            <td>
                                <?php
                                    if ($quotation['quotation_status'] == 'demo') {
                                        echo '<span class="badge bg-warning">Demo</span>';
                                    } else if ($quotation['quotation_status'] == 'live') {
                                        echo '<span class="badge bg-success">Live</span>';
                                    } else if ($quotation['quotation_status'] == 'upgrade') {
                                        echo '<span class="badge bg-danger">Upgrade</span>';
                                    } else {
                                        echo '<span class="badge bg-info">Open</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo BASE_URL ?>admin/quotations/convert_demo.php?id=<?php echo $quotation['id']; ?>" 
                            class="btn btn-xs btn-outline-warning btn-flat"><i class="fas fa-user-tie"></i> Demo</a>
                                <a href="<?php echo BASE_URL ?>admin/quotations/convert_live.php?id=<?php echo $quotation['id']; ?>" 
                            class="btn btn-xs btn-outline-success btn-flat"><i class="fas fa-play"></i> Live</a>
                                <?php if ($quotation['quotation_status'] == 'live'): ?>
                                    <a href="<?php echo BASE_URL ?>admin/quotations/convert_upgrade.php?id=<?php echo $quotation['id']; ?>" 
                                class="btn btn-xs btn-outline-danger btn-flat" onclick="return confirm('Are you sure you want to convert this quotation to an Upgrade?');"><i class="fas fa-arrow-up"></i> Upgrade</a>
                                <?php endif; ?>
                        </td>
                            <td>
                                <a href="<?php echo BASE_URL ?>admin/quotations/edit.php?id=<?php echo $quotation['id']; ?>"
                                    class="btn btn-xs btn-outline-info btn-flat"><i class="fas fa-edit"></i>Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
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