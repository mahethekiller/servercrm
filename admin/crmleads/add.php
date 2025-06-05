<?php
    $pageTitle = 'Add Crm Lead';
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

        <!-- Include AdminLTE CSS & JS (assumed included already in your project) -->

        <form id="leadForm" action="<?php echo BASE_URL ?>admin/crmleads/post/post.php" class="form-horizontal"
            method="post">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" id="formTitle">Add Lead</h3>
                </div>

                <div class="card-body">



                    <div class="row">
                        <div class="col-md-8">


                            <!-- Company -->
                            <div class="form-group row">
                                <label for="company_id" class="col-sm-2 col-form-label">Company</label>
                                <div class="col-sm-10">

                                    <label for="company_id">Select Company
                                        <a href="<?php echo BASE_URL ?>admin/companies/add.php"
                                            class=" btn  btn-outline-primary btn-xs" type="button" id="button-addon2">
                                            <i class="bi bi-plus-lg"></i> Add new
                                        </a>

                                    </label>

                                    <select class="form-select select2" id="company_id" style="width: 100%;"
                                        name="company_id">
                                        <option value="">Select Company</option>
                                        <?php
                                            $db        = new DB();
                                            $query     = "SELECT * FROM companies";
                                            $companies = $db->get_results($query);
                                            foreach ($companies as $company):
                                        ?>
                                        <option value="<?php echo $company['id']; ?>"><?php echo $company['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>


                                    <span class="text-danger" id="error_company_id"></span>
                                </div>
                            </div>

                            <!-- Lead Status -->
                            <div class="form-group row">
                                <label for="lead_status" class="col-sm-2 col-form-label">Lead Status *</label>
                                <div class="col-sm-10">
                                    <select name="lead_status" id="lead_status" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <option value="Not Interested/ Junk Lead">Not Interested/ Junk Lead</option>
                                        <option value="Not Interested/ Can be contacted in Future">Not Interested/ Can
                                            be
                                            contacted in Future</option>
                                        <option value="New Contact/ Lead Under Evaluation">New Contact/ Lead Under
                                            Evaluation
                                        </option>
                                        <option value="Prospect/ Pre Sales Evaulation/ Proposal  in progress">Prospect/
                                            Pre
                                            Sales Evaulation/ Proposal in progress</option>
                                        <option value="Meeting Completed/ Pre Sales Evaulation/ Proposal  in progress">
                                            Meeting
                                            Completed/ Pre Sales Evaulation/ Proposal in progress</option>
                                        <option value="Proposal Submitted/ Under Followup">Proposal Submitted/ Under
                                            Followup
                                        </option>
                                        <option value="Lost">Lost</option>
                                        <option value="Won">Won</option>
                                    </select>
                                    <span class="text-danger" id="error_lead_status"></span>
                                </div>
                            </div>

                            <!-- Lead Source -->
                            <div class="form-group row">
                                <label for="lead_source" class="col-sm-2 col-form-label">Lead Source *</label>
                                <div class="col-sm-10">
                                    <select name="lead_source" id="lead_source" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <option value="Outbound - Cold Call by Sales Team">Outbound - Cold Call by Sales
                                            Team
                                        </option>
                                        <!-- add more options dynamically if needed -->
                                    </select>
                                    <span class="text-danger" id="error_lead_source"></span>
                                </div>
                            </div>

                            <!-- Follow Up Date -->
                            <div class="form-group row">
                                <label for="follow_up_date" class="col-sm-2 col-form-label">Follow Up Date *</label>
                                <div class="col-sm-10">
                                    <input type="date" name="follow_up_date" id="follow_up_date" class="form-control"
                                        required>
                                    <span class="text-danger" id="error_follow_up_date"></span>
                                </div>
                            </div>

                            <!-- Expected Closer Date -->
                            <div class="form-group row">
                                <label for="expected_closer" class="col-sm-2 col-form-label">Expected Closer Date
                                    *</label>
                                <div class="col-sm-10">
                                    <input type="date" name="expected_closer" id="expected_closer" class="form-control"
                                        required>
                                    <span class="text-danger" id="error_expected_closer"></span>
                                </div>
                            </div>

                            <!-- Website -->
                            <div class="form-group row">
                                <label for="website" class="col-sm-2 col-form-label">Website</label>
                                <div class="col-sm-10">
                                    <input type="url" name="website" id="website" class="form-control"
                                        placeholder="https://example.com">
                                    <span class="text-danger" id="error_website"></span>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description *</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" class="form-control" rows="4"
                                        required></textarea>
                                    <span class="text-danger" id="error_description"></span>
                                </div>
                            </div>

                            <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>

                        </div>

                        <div class="col-md-4 " id="company_data">
                        </div>
                    </div>

                </div>

                <div class="card-footer">

                </div>
            </div>
        </form>





    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->


<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/crmleads.js"></script>