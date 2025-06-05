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
                <h3 class="card-title">Edit <?php echo $pageTitle ?></h3>
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
                    if (isset($_GET['id'])) {
                        $id      = $_GET['id'];
                        $db      = new DB();
                        $query   = "SELECT * FROM companies WHERE id = $id";
                        $company = $db->get_row($query);
                    }
                ?>
                <form action="<?php echo BASE_URL ?>admin/companies/post/post.php" id="companyUpdateForm" method="post">
                    <div class="row">
                        <!-- Company Name -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Company Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?php echo $company['name']; ?>">
                            </div>
                        </div>
                        <!-- Client Name -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="client_name">Client Name</label>
                                <input type="text" class="form-control" id="client_name" name="client_name"
                                    value="<?php echo $company['client_name']; ?>">
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="<?php echo $company['email']; ?>">
                            </div>
                        </div>
                        <!-- Phone -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="<?php echo $company['phone']; ?>">
                            </div>
                        </div>
                        <!-- CIN No -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cin_no">CIN No</label>
                                <input type="text" class="form-control" id="cin_no" name="cin_no"
                                    value="<?php echo $company['cin_no']; ?>">
                            </div>
                        </div>
                        <!-- GST No -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gst_no">GST No</label>
                                <input type="text" class="form-control" id="gst_no" name="gst_no"
                                    value="<?php echo $company['gst_no']; ?>">
                            </div>
                        </div>
                        <!-- PAN No -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pan_no">PAN No</label>
                                <input type="text" class="form-control" id="pan_no" name="pan_no"
                                    value="<?php echo $company['pan_no']; ?>">
                            </div>
                        </div>
                        <!-- Country Code -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="country_code">Country Code</label>
                                <input type="text" class="form-control" id="country_code" name="country_code"
                                    value="<?php echo $company['country_code']; ?>">
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="address">Street Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="<?php echo $company['address']; ?>">
                            </div>
                        </div>
                        <!-- City -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="<?php echo $company['city']; ?>">
                            </div>
                        </div>
                        <!-- State -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    value="<?php echo $company['state']; ?>">
                            </div>
                        </div>
                        <!-- Industry -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <input type="text" class="form-control" id="industry" name="industry"
                                    value="<?php echo $company['industry']; ?>">
                            </div>
                        </div>
                        <!-- Pin Code -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pin_code">Pin Code</label>
                                <input type="text" class="form-control" id="pin_code" name="pin_code"
                                    value="<?php echo $company['pin_code']; ?>">
                            </div>
                        </div>
                        <!-- Country -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="<?php echo $company['country']; ?>">
                            </div>
                        </div>
                        <!-- Website -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" class="form-control" id="website" name="website"
                                    value="<?php echo $company['website']; ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $company['id']; ?>">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


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