<?php
    $pageTitle = 'Create Quotation';
    include '../../includes/header.php';

?>


<div class="row">


<div class="col-12 ">




<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Company Details</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>

        </div>
    </div>
    <div class="card-body p-0">

        <?php
            $lead_id   = $_GET['lead_id'] ?? '';
            $company = getCompanyDetailsFromLeadId($lead_id);
        ?>
<?php if (isset($company)): ?>
        <!-- <h4>Company Details</h4> -->
        <table class="table table-striped projects">
            <tr>
                <th>Company Name</th>
                <td><?php echo htmlspecialchars($company['name']) ?></td>

                <th>Company Address</th>
                <td><?php echo htmlspecialchars($company['address']) ?></td>
            </tr>
            <tr>
                <th>Company Phone</th>
                <td><?php echo htmlspecialchars($company['phone']) ?></td>

                <th>Company Email</th>
                <td><?php echo htmlspecialchars($company['email']) ?></td>
            </tr>
        </table>
        <?php endif; ?>

    </div>
    <!-- /.card-body -->

</div>
<!-- /.card -->
</div>
</div>



<div class="row">
    <div class="col-12">
        <form id="allProductAttributesForm" method="post" action="<?php echo BASE_URL ?>admin/crmleads/post/createquote_post.php">
        <div class="row">
        <div class="col-md-2">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Click To Add Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <?php
                    $productsQuery = "SELECT * FROM products WHERE status = 'active'";
                    $products      = $db->get_results($productsQuery);

                foreach ($products as $item) {?>
                                        <li class="list-group-item">
                                            <input type="checkbox" class="item-checkbox" data-title="<?php echo $item["name"] ?>"
                                                value="<?php echo $item["id"] ?>">
                                            <?php echo $item["name"] ?>
                                        </li>
                                    <?php }?>
                                </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
<div class="col-md-6" id="form-container">

        <input type="hidden" name="lead_id" value="<?php echo $lead_id ?>">
        <input type="hidden" name="company_id" value="<?php echo $company['id'] ?>">





        <!-- Multiple tables will be dynamically inserted here -->
        <div id="dynamicTablesContainer" ></div>

        




        </div>


        <div class="col-md-4">
            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Other Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table table-condensed table-bordered">

                <tbody>
                    <tr>
                        <td>Antivirus/Backup</td>
                        <td >
                            <label><input type="radio" name="antivirus_backup" checked value="No"> No</label>
                            <label><input type="radio" name="antivirus_backup" value="Yes"> Yes</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Server Description</td>
                        <td >
                            <textarea class="form-control" rows="3" name="description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Location*</td>
                        <td >
                            <select class="form-control" name="location">
                                <option value="Noida">Noida</option>
                                <option value="Delhi">Delhi</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Server Type</td>
                        <td >
                            <select class="form-control" name="server_type">
                                <option value="Virtual">Virtual</option>
                                <option value="Physical">Physical</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>OTC</td>
                        <td >
                            <input type="number" class="form-control" id="otc" name="otc" placeholder="OTC">
                        </td>
                    </tr>
                    <tr>
                        <td>Sub Total</td>
                        <td >
                            <div class="input-group">
                                <input type="number" class="form-control" id="sub_total" name="sub_total" placeholder="Sub Total">
                                <div class="input-group-append">
                                    <button class="btn btn-success" id="sub_total_btn" type="button">Update</button>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                </tbody>
            </table>

            </div>
            <!-- /.card-body -->
             <div class="card-footer">
                        <button type="submit" class="btn btn-success" id="submit-quotation" style="display: none;">Create Quote</button>
                    </div>
          </div>
        </div>

      </div>
      </form>
    </div>
</div>



<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/quotation.js"></script>