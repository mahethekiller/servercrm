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
                                    value="<?php echo htmlspecialchars($company['website'] ?? ''); ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="lead_value">Monthly Lead Value (INR)</label>
                                <input type="number" step="0.01" class="form-control" id="lead_value" name="lead_value"
                                    value="<?php echo htmlspecialchars($company['lead_value'] ?? '0.00'); ?>">
                            </div>
                        </div>

                        <!-- IT Contact Name -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="it_contact_name">IT Contact Name</label>
                                <input type="text" class="form-control" id="it_contact_name" name="it_contact_name"
                                    value="<?php echo $company['it_contact_name']; ?>">
                            </div>
                        </div>
                        <!-- IT Contact Email -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="it_contact_email">IT Contact Email</label>
                                <input type="text" class="form-control" id="it_contact_email" name="it_contact_email"
                                    value="<?php echo $company['it_contact_email']; ?>">
                            </div>
                        </div>
                        <!-- IT Contact Phone -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="it_contact_phone">IT Contact Phone</label>
                                <input type="text" class="form-control" id="it_contact_phone" name="it_contact_phone"
                                    value="<?php echo $company['it_contact_phone']; ?>">
                            </div>
                        </div>
                        <!-- Finance Contact Name -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="finance_contact_name">Finance Contact Name</label>
                                <input type="text" class="form-control" id="finance_contact_name" name="finance_contact_name"
                                    value="<?php echo $company['finance_contact_name']; ?>">
                            </div>
                        </div>
                        <!-- Finance Contact Email -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="finance_contact_email">Finance Contact Email</label>
                                <input type="text" class="form-control" id="finance_contact_email" name="finance_contact_email"
                                    value="<?php echo $company['finance_contact_email']; ?>">
                            </div>
                        </div>
                        <!-- Finance Contact Phone -->
                        <div class="col-6">
                            <div class="form-group">
                                <label for="finance_contact_phone">Finance Contact Phone</label>
                                <input type="text" class="form-control" id="finance_contact_phone" name="finance_contact_phone"
                                    value="<?php echo $company['finance_contact_phone']; ?>">
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
                                <?php
                                $customContacts = [];
                                if (!empty($company['custom_contacts'])) {
                                    $customContacts = json_decode($company['custom_contacts'], true) ?: [];
                                }
                                foreach ($customContacts as $contact):
                                ?>
                                <div class="row custom-contact-row align-items-end mb-3 border-bottom pb-3">
                                    <div class="col-3">
                                        <div class="form-group mb-0">
                                            <label>Title/Role <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="custom_contact_titles[]" 
                                                   value="<?php echo htmlspecialchars($contact['title'] ?? ''); ?>" placeholder="e.g. HR Manager" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-0">
                                            <label>Contact Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="custom_contact_names[]" 
                                                   value="<?php echo htmlspecialchars($contact['name'] ?? ''); ?>" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-0">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="custom_contact_emails[]" 
                                                   value="<?php echo htmlspecialchars($contact['email'] ?? ''); ?>" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group mb-0">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control" name="custom_contact_phones[]" 
                                                   value="<?php echo htmlspecialchars($contact['phone'] ?? ''); ?>" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group mb-0">
                                            <button type="button" class="btn btn-danger btn-block remove-contact-btn" title="Remove Contact">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
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