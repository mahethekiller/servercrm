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
                                <a href="<?php echo BASE_URL ?>admin/companies/compute.php?company_id=<?php echo $company['id']; ?>"
                                    class="btn btn-sm btn-warning text-white">Compute</a>
                                <a href="<?php echo BASE_URL ?>admin/companies/documents.php?company_id=<?php echo $company['id']; ?>"
                                    class="btn btn-sm btn-secondary text-white">Documents</a>

                                <button type="button" class="btn btn-sm btn-info viewCompanyBtn"
                                    data-id="<?php echo $company['id']; ?>"
                                    data-name="<?php echo htmlspecialchars($company['name']); ?>"
                                    data-client="<?php echo htmlspecialchars($company['client_name']); ?>"
                                    data-email="<?php echo htmlspecialchars($company['email']); ?>"
                                    data-phone="<?php echo htmlspecialchars($company['phone']); ?>"
                                    data-address="<?php echo htmlspecialchars($company['address']); ?>"
                                    data-city="<?php echo htmlspecialchars($company['city']); ?>"
                                    data-state="<?php echo htmlspecialchars($company['state']); ?>"
                                    data-industry="<?php echo htmlspecialchars($company['industry']); ?>"
                                    data-gst="<?php echo htmlspecialchars($company['gst_no']); ?>"
                                    data-cin="<?php echo htmlspecialchars($company['cin_no']); ?>"
                                    data-website="<?php echo htmlspecialchars($company['website']); ?>"
                                    data-created="<?php echo $company['created_at']; ?>"
                                    data-updated="<?php echo $company['updated_at']; ?>">
                                    View
                                </button>
                                <!-- <a href="<?php echo BASE_URL ?>admin/companies/delete.php?id=<?php echo $company['id']; ?>"
                                    class="btn btn-sm btn-danger">Delete</a> -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
            <div class="modal fade" id="companyViewModal" tabindex="-1" role="dialog" aria-labelledby="companyViewLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Company Details</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <th>ID</th><td id="c_id"></td>
            <th>Name</th><td id="c_name"></td>
          </tr>
          <tr>
            <th>Client Name</th><td id="c_client"></td>
            <th>Email</th><td id="c_email"></td>
          </tr>
          <tr>
            <th>Phone</th><td id="c_phone"></td>
            <th>Address</th><td id="c_address"></td>
          </tr>
          <tr>
            <th>City</th><td id="c_city"></td>
            <th>State</th><td id="c_state"></td>
          </tr>
          <tr>
            <th>Industry</th><td id="c_industry"></td>
            <th>GST No</th><td id="c_gst"></td>
          </tr>
          <tr>
            <th>CIN No</th><td id="c_cin"></td>
            <th>Website</th><td id="c_website"></td>
          </tr>
          <tr>
            <th>Created At</th><td id="c_created"></td>
            <th>Updated At</th><td id="c_updated"></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>


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