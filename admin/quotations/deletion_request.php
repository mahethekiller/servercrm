<?php
    $pageTitle = 'Deletion Request';
    include '../../includes/header.php';

?>


<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $pageTitle ?></h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>

        </div>
    </div>
    <div class="card-body">
    <form id="deleteRequestForm">
        <div class="form-group">
            <label for="sof_id">Enter SOF ID:</label>
            <input type="text" id="sof_id" name="sof_id" class="form-control" required>
        </div>

        <div id="quotationDetails" style="display:none; margin-top:15px;">
            <h5>Quotation Details</h5>
            <table class="table table-bordered">
                <tr><th>SOF ID</th><td id="detail_sof_id"></td></tr>
                <tr><th>Company Name</th><td id="detail_company"></td></tr>
                <tr><th>Email</th><td id="detail_email"></td></tr>
                <tr><th>Phone</th><td id="detail_phone"></td></tr>
            </table>
            

            <div class="form-group">
                <label for="remarks">Remarks / Comments:</label>
                <textarea id="remarks" name="remarks" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-danger">Request Deletion</button>
        </div>
    </form>
</div>

    <!-- /.card-body -->
    <!-- <div class="card-footer">
        Footer
    </div> -->
    <!-- /.card-footer-->
</div>
<!-- /.card -->


<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/quotation.js"></script>