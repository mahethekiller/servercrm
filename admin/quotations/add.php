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

                <form action="<?php echo BASE_URL ?>admin/companies/post/post.php" id="companyAddForm" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Company Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Company Name"
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="client_name">Client Name <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="client_name" name="client_name"
                                    placeholder="Client Name" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email <span style="color:red">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="country_code">Country Code <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="country_code" name="country_code"
                                    placeholder="+91" required>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="phone">Phone <span style="color:red">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cin_no">CIN No</label>
                                <input type="text" class="form-control" id="cin_no" name="cin_no"
                                    placeholder="CIN Number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gst_no">GST No</label>
                                <input type="text" class="form-control" id="gst_no" name="gst_no"
                                    placeholder="GST Number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pan_no">PAN No</label>
                                <input type="text" class="form-control" id="pan_no" name="pan_no"
                                    placeholder="PAN Number">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="address">Address <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Address" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="City">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="State">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="pin_code">PIN Code</label>
                                <input type="text" class="form-control" id="pin_code" name="pin_code"
                                    placeholder="PIN Code">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    placeholder="Country">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <input type="text" class="form-control" id="industry" name="industry"
                                    placeholder="Industry Type">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website" name="website"
                                    placeholder="Company Website">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="operation" value="add">
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