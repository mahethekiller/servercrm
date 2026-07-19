<?php
    $pageTitle = 'Add Company';
    include '../../includes/header.php';

?>


<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <?php echo $pageTitle ?></h3>
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
                                <label for="email">Email <span style="color:red">*</span> <span id="email_error" class="text-danger"></span></label>
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
                        <div class="col-12">
                            <div class="form-group">
                                <label for="lead_value">Monthly Lead Value (INR)</label>
                                <input type="number" step="0.01" class="form-control" id="lead_value" name="lead_value"
                                    placeholder="0.00">
                            </div>
                        </div>

                        <!-- IT Contact Section -->
                        <div class="col-12 mt-4">
                            <h5 class="mb-3">IT Contact Details</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="it_contact_name">Contact Name</label>
                                <input type="text" class="form-control" id="it_contact_name" name="it_contact_name" placeholder="IT Contact Name">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="it_contact_email">Email</label>
                                <input type="email" class="form-control" id="it_contact_email" name="it_contact_email" placeholder="IT Contact Email">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="it_contact_phone">Phone</label>
                                <input type="tel" class="form-control" id="it_contact_phone" name="it_contact_phone" placeholder="IT Contact Phone">
                            </div>
                        </div>

                        <!-- Finance Contact Section -->
                        <div class="col-12 mt-4">
                            <h5 class="mb-3">Finance Contact Details</h5>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="copyItDetails">
                                <label class="form-check-label" for="copyItDetails">Same as IT Details</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="finance_contact_name">Contact Name</label>
                                <input type="text" class="form-control" id="finance_contact_name" name="finance_contact_name" placeholder="Finance Contact Name">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="finance_contact_email">Email</label>
                                <input type="email" class="form-control" id="finance_contact_email" name="finance_contact_email" placeholder="Finance Contact Email">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="finance_contact_phone">Phone</label>
                                <input type="tel" class="form-control" id="finance_contact_phone" name="finance_contact_phone" placeholder="Finance Contact Phone">
                            </div>
                        </div>

                        <!-- Custom Contacts Section -->
                        <div class="col-12 mt-4 border-top pt-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Custom Contact Details</h5>
                                <button type="button" class="btn btn-success btn-sm" id="add-more-contact-btn">
                                    <i class="bi bi-plus-lg"></i> Add More
                                </button>
                            </div>
                            <div id="custom-contacts-wrapper">
                                <!-- Dynamic contacts will be appended here via JS -->
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
