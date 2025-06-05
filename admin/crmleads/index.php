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
                <h3 class="card-title">All                                           <?php echo $pageTitle ?></h3>
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
                    $db    = new DB();
                    $query = "SELECT * FROM crmleads";
                    $leads = $db->get_results($query);

                ?>
                <table id="leadsTable" class="table table-bordered table-striped dttable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Lead Status</th>
                            <th>Added By</th>
                            <th>Follow Up Date</th>
                            <th>Expected Closer Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($lead['id']) ?></td>
                            <?php
                                $companyId        = $lead['company_id'];
                                $companyNameQuery = "SELECT name FROM companies WHERE id = $companyId";
                                $companyName      = $db->get_row($companyNameQuery) ?? 'N/A';
                            ?>
                            <td><?php echo htmlspecialchars($companyName['name']) ?></td>
                            <td><?php echo htmlspecialchars($lead['lead_status']) ?></td>
                            <?php
                                $addedById        = $lead['added_by'];
                                $addedByNameQuery = "SELECT name FROM users WHERE id = $addedById";
                                $addedByName      = $db->get_row($addedByNameQuery) ?? 'N/A';
                            ?>
                            <td><?php echo htmlspecialchars($addedByName['name']) ?></td>
                            <td><?php echo htmlspecialchars(date('F j, Y', strtotime($lead['follow_up_date']))) ?></td>
                            <td><?php echo htmlspecialchars(date('F j, Y', strtotime($lead['expected_closer']))) ?></td>
                            <td> <a href="createquote.php?lead_id=<?php echo $lead['id']; ?>"
                                    class="btn btn-xs btn-primary">
                                    Create
                                    Quotation</a>

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