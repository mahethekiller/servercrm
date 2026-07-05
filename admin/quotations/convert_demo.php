<?php
    $pageTitle = 'Convert Quotation';
    include '../../includes/header.php';

    $id        = $_GET['id'] ?? '';
    $db        = new DB();
    $query     = "SELECT * FROM quotations WHERE id = '$id'";
    $quotation = $db->get_row($query);
    $user      = getUserDetailsFromUserId($quotation['added_by']);

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


        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Client Details</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                </div>
            </div>
            <div class="card-body">
                <?php
                    $quotation_id = $_GET['id'] ?? '';
                    $company      = getCompanyDetailsFromQuotationId($quotation_id);
                ?>
                <table class="table table-bordered table-hover client-table">
                    <tr>
                        <th>Company Name</th>
                        <td><?php echo htmlspecialchars($company['name']) ?></td>

                        <th>Company Address</th>
                        <td><?php echo htmlspecialchars($company['address']) ?></td>
                        <th>Company Phone</th>
                        <td><?php echo htmlspecialchars($company['phone']) ?></td>
                    </tr>
                    <tr>
                        <th>Company Email</th>
                        <td><?php echo htmlspecialchars($company['email']) ?></td>

                        <th>City</th>
                        <td><?php echo htmlspecialchars($company['city']) ?></td>

                        <th>State</th>
                        <td><?php echo htmlspecialchars($company['state']) ?></td>


                    </tr>
                    <tr>
                        <th>Country</th>
                        <td><?php echo htmlspecialchars($company['country']) ?></td>
                        <th>Account Manager</th>
                        <td><?php echo htmlspecialchars($user['name']) ?></td>
                        <th>Added Date</th>
                        <td><?php echo date('F j, Y', strtotime($quotation['added_date'])) ?></td>
                    </tr>


                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Commercial Details</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                </div>
            </div>
            <div class="card-body p-0 m-3">

                <div class="table-responsive ">
                    <table class="table table-bordered table-hover projects ">
                        <thead>
                            <tr>
                                <th>Product Details</th>
                                <th>Otc Price</th>
                                <th>Total Price</th>
                                <th>Sale Price</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $quoteQuery = "SELECT
                            qd.product_id,
                            p.name AS product_name,
                            q.*,
                            atype.name AS attribute_type,
                            a.attribute_name,
                            a.price AS attribute_price,
                            qd.total_price
                        FROM quotations q
                        JOIN quote_details qd ON q.id = qd.quotation_id
                        JOIN products p ON qd.product_id = p.id
                        JOIN attributes a ON qd.attribute_id = a.id
                        JOIN attribute_types atype ON qd.attribute_type = atype.id
                        WHERE q.id = '$id'";

                                $results = $db->get_results($quoteQuery);

                                if ($results) {
                                    $products = [];
                                    foreach ($results as $row) {
                                        $product_id = $row['product_id'];
                                        if (! isset($products[$product_id])) {
                                            $products[$product_id] = [
                                                'product_name'  => $row['product_name'],
                                                'otc'           => $row['otc'],
                                                'configuration' => [],
                                                'total_price'   => 0,
                                                'sale_price'    => 0,
                                            ];
                                        }
                                        $products[$product_id]['configuration'][] =
                                            $row['attribute_type'] . ': ' . $row['attribute_name'] .
                                            ' (₹' . $row['attribute_price'] . ' / ₹' . $row['total_price'] . ')';
                                        $products[$product_id]['total_price'] += $row['attribute_price'];
                                        $products[$product_id]['sale_price'] += $row['total_price'];
                                    }

                                    $tp = 0;
                                    foreach ($products as $product) {

                                        $tp += $product['sale_price'];
                                        echo '<tr>
                                    <td>
                                        <strong>' . htmlspecialchars($product['product_name']) . '</strong><br>
                                        ' . implode('<br>', $product['configuration']) . '
                                    </td>
                                    <td>₹' . number_format($product['otc'], 2) . '</td>
                                    <td>₹' . number_format($product['total_price'], 2) . '</td>
                                    <td>₹' . number_format($product['sale_price'], 2) . '</td>
                                    <td>₹' . number_format(($product['sale_price']), 2) . '</td>
                                    <td>
                                        <button class="btn btn-sm btn-info mr-2"
                                            data-toggle="modal"
                                            data-target="#viewModal"
                                            data-productname="' . htmlspecialchars($product['product_name'], ENT_QUOTES) . '"
                                            data-configuration="' . htmlspecialchars(implode('<br>', $product['configuration']), ENT_QUOTES) . '">
                                            View
                                        </button>
                                        

                                    </td>
                                </tr>';
                                    }
                                    echo '
                            <td colspan="4" class="text-center">Total Amount (Total + OTC) </td>

                            <td class="text-center">₹' . number_format(($tp + $results[0]['otc']), 2) . '</td><td>    </td></tr>';
                                } else {
                                    echo '<tr><td colspan="6" class="text-center">No quotation details found</td></tr>';
                                }
                            ?>
                        </tbody>


                    </table>
                </div>

                <form id="allProductAttributesFormDemo" method="POST" action="post/convert-demo-post.php">

                    <input type="hidden" name="quotation_id" id="quotation_id" value="<?php echo $quotation_id; ?>">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group m-3">
                                <label>Support Remarks</label>
                                <textarea class="form-control" name="supportRemarks" id="supportRemarks"
                                    rows="3"><?php echo $results[0]['supportRemarks']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-3">
                                <label>Client Remarks</label>
                                <textarea class="form-control" name="clientRemarks" id="clientRemarks"
                                    rows="3"><?php echo $results[0]['clientRemarks']; ?> </textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-3">
                                <label>Account Remarks</label>
                                <textarea class="form-control" name="accountRemark" id="accountRemark"
                                    rows="3"><?php echo $results[0]['accountRemarks']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-3">
                        <label for="billing_cycle">Confirmation Type*:</label>
                        <select name="client_confirmation" id="client_confirmation" class="form-control"
                            style="width:300px;">

                            <option value="">---Select Option----</option>
                            <?php
                                $client_confirmation = $results[0]['client_confirmation'];
                            ?>
                            <option value="Client Signed Po"
                                <?php echo($client_confirmation == 'Client Signed Po') ? 'selected' : ''; ?>>
                                Client Signed Po
                            </option>
                            <option value="Client Email Acceptance"
                                <?php echo($client_confirmation == 'Client Email Acceptance') ? 'selected' : ''; ?>>
                                Client Email Acceptance
                            </option>
                            <option value="Client Telephonic Confirmation"
                                <?php echo($client_confirmation == 'Client Telephonic Confirmation') ? 'selected' : ''; ?>>
                                Client Telephonic Confirmation
                            </option>
                            <option value="Client Meeting-Verbal Confirmation"
                                <?php echo($client_confirmation == 'Client Meeting-Verbal Confirmation') ? 'selected' : ''; ?>>
                                Client Meeting-Verbal Confirmation
                            </option>

                        </select>
                        <br><span id="contactus_client_confirmation_errorloc" class="error"></span>
                    </div>


                    <div class="clientsinfo m-3">
                        <fieldset class="border p-3 rounded">
                            <legend class="float-none w-auto px-2">Billing Information</legend>

                            <p class="text-muted small">* required fields</p>

                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <?php //echo $results[0]['client_confirmation']; ?>

                                    <!-- Contract Term -->
                                    <div class="mb-3 row align-items-center">
                                        <label for="contract_terms_yrs" class="col-sm-4 col-form-label">Contract
                                            Term:</label>
                                        <div class="col-sm-8 d-flex">
                                            <select class="form-select me-2" id="contract_terms_yrs"
                                                name="contract_terms_yrs" style="max-width:100px;">
                                                <?php
                                                    foreach (range(0, 10) as $num) {
                                                        $selected = ($results[0]['contract_terms_yrs'] == $num) ? 'selected' : '';
                                                        echo "<option value='$num' $selected>$num</option>";
                                                    }
                                                ?>
                                            </select>
                                            <span class="align-self-center me-3">Years</span>

                                            <select class="form-select me-2" id="contract_term_month"
                                                name="contract_term_month" style="max-width:100px;">
                                                <?php
                                                     foreach (range(0, 11) as $num) {
                                                         $selected = ($results[0]['contract_term_month'] == $num) ? 'selected' : '';
                                                         echo "<option value='$num' $selected>$num</option>";
                                                     }
                                                 ?>
                                            </select>
                                            <span class="align-self-center">Months</span>
                                        </div>
                                    </div>

                                    <!-- Billing Cycle -->
                                    <div class="mb-3 row">
                                        <label for="billing_cycle" class="col-sm-4 col-form-label">Billing
                                            Cycle*:</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="billing_cycle" name="billing_cycle">
                                                <option value="1"
                                                    <?php echo($results[0]['billing_cycle'] == '1') ? 'selected' : ''; ?>>
                                                    Monthly</option>
                                                <option value="3"
                                                    <?php echo($results[0]['billing_cycle'] == '3') ? 'selected' : ''; ?>>
                                                    Quarterly</option>
                                                <option value="5"
                                                    <?php echo($results[0]['billing_cycle'] == '5') ? 'selected' : ''; ?>>
                                                    Half-Yearly</option>
                                                <option value="6"
                                                    <?php echo($results[0]['billing_cycle'] == '6') ? 'selected' : ''; ?>>
                                                    Yearly</option>
                                                <option value="7"
                                                    <?php echo($results[0]['billing_cycle'] == '7') ? 'selected' : ''; ?>>
                                                    One Time</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Billing Period -->
                                    <div class="mb-3 row">
                                        <label for="billing_period" class="col-sm-4 col-form-label">Billing Period
                                            From:</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="billing_period"
                                                name="billing_period"
                                                value="<?php echo $results[0]['billing_period']; ?>">
                                        </div>
                                    </div>

                                    <!-- Billing Start -->
                                    <div class="mb-3 row">
                                        <label for="billing_start" class="col-sm-4 col-form-label">Is Billing
                                            Start:</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="billing_start" name="billing_start">
                                                <option value="Yes"
                                                    <?php echo($results[0]['billing_start'] == 'Yes') ? 'selected' : ''; ?>>
                                                    YES</option>
                                                <option value="No"
                                                    <?php echo($results[0]['billing_start'] == 'No') ? 'selected' : ''; ?>>
                                                    No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">

                                    <!-- Delivery Period -->
                                    <div class="mb-3 row align-items-center">
                                        <label for="delivery_period_week" class="col-sm-4 col-form-label">Expected
                                            Delivery
                                            Period:</label>
                                        <div class="col-sm-8 d-flex">
                                            <select class="form-select me-2" id="delivery_period_week"
                                                name="delivery_period_week" style="max-width:80px;">
                                                <option value="0"
                                                    <?php echo($results[0]['delivery_period_week'] == '0') ? 'selected' : ''; ?>>
                                                    0</option>
                                                <option value="1"
                                                    <?php echo($results[0]['delivery_period_week'] == '1') ? 'selected' : ''; ?>>
                                                    1</option>
                                                <option value="2"
                                                    <?php echo($results[0]['delivery_period_week'] == '2') ? 'selected' : ''; ?>>
                                                    2</option>
                                                <option value="3"
                                                    <?php echo($results[0]['delivery_period_week'] == '3') ? 'selected' : ''; ?>>
                                                    3</option>
                                                <option value="4"
                                                    <?php echo($results[0]['delivery_period_week'] == '4') ? 'selected' : ''; ?>>
                                                    4</option>
                                            </select>
                                            <span class="align-self-center me-3">Week</span>

                                            <select class="form-select me-2" id="delivery_period" name="delivery_period"
                                                style="max-width:80px;">
                                                <option value="0"
                                                    <?php echo($results[0]['delivery_period'] == '0') ? 'selected' : ''; ?>>
                                                    0</option>
                                                <option value="1"
                                                    <?php echo($results[0]['delivery_period'] == '1') ? 'selected' : ''; ?>>
                                                    1</option>
                                                <option value="2"
                                                    <?php echo($results[0]['delivery_period'] == '2') ? 'selected' : ''; ?>>
                                                    2</option>
                                                <option value="3"
                                                    <?php echo($results[0]['delivery_period'] == '3') ? 'selected' : ''; ?>>
                                                    3</option>
                                                <option value="4"
                                                    <?php echo($results[0]['delivery_period'] == '4') ? 'selected' : ''; ?>>
                                                    4</option>
                                                <option value="5"
                                                    <?php echo($results[0]['delivery_period'] == '5') ? 'selected' : ''; ?>>
                                                    5</option>
                                                <option value="6"
                                                    <?php echo($results[0]['delivery_period'] == '6') ? 'selected' : ''; ?>>
                                                    6</option>
                                                <option value="7"
                                                    <?php echo($results[0]['delivery_period'] == '7') ? 'selected' : ''; ?>>
                                                    7</option>
                                                <option value="8"
                                                    <?php echo($results[0]['delivery_period'] == '8') ? 'selected' : ''; ?>>
                                                    8</option>
                                                <option value="9"
                                                    <?php echo($results[0]['delivery_period'] == '9') ? 'selected' : ''; ?>>
                                                    9</option>
                                                <option value="10"
                                                    <?php echo($results[0]['delivery_period'] == '10') ? 'selected' : ''; ?>>
                                                    10</option>
                                                <option value="11"
                                                    <?php echo($results[0]['delivery_period'] == '11') ? 'selected' : ''; ?>>
                                                    11</option>
                                                <option value="12"
                                                    <?php echo($results[0]['delivery_period'] == '12') ? 'selected' : ''; ?>>
                                                    12</option>
                                                <option value="13"
                                                    <?php echo($results[0]['delivery_period'] == '13') ? 'selected' : ''; ?>>
                                                    13</option>
                                                <option value="14"
                                                    <?php echo($results[0]['delivery_period'] == '14') ? 'selected' : ''; ?>>
                                                    14</option>
                                                <option value="15"
                                                    <?php echo($results[0]['delivery_period'] == '15') ? 'selected' : ''; ?>>
                                                    15</option>
                                                <option value="16"
                                                    <?php echo($results[0]['delivery_period'] == '16') ? 'selected' : ''; ?>>
                                                    16</option>
                                                <option value="17"
                                                    <?php echo($results[0]['delivery_period'] == '17') ? 'selected' : ''; ?>>
                                                    17</option>
                                                <option value="18"
                                                    <?php echo($results[0]['delivery_period'] == '18') ? 'selected' : ''; ?>>
                                                    18</option>
                                                <option value="19"
                                                    <?php echo($results[0]['delivery_period'] == '19') ? 'selected' : ''; ?>>
                                                    19</option>
                                                <option value="20"
                                                    <?php echo($results[0]['delivery_period'] == '20') ? 'selected' : ''; ?>>
                                                    20</option>
                                                <option value="21"
                                                    <?php echo($results[0]['delivery_period'] == '21') ? 'selected' : ''; ?>>
                                                    21</option>
                                                <option value="22"
                                                    <?php echo($results[0]['delivery_period'] == '22') ? 'selected' : ''; ?>>
                                                    22</option>
                                                <option value="23"
                                                    <?php echo($results[0]['delivery_period'] == '23') ? 'selected' : ''; ?>>
                                                    23</option>
                                                <option value="24"
                                                    <?php echo($results[0]['delivery_period'] == '24') ? 'selected' : ''; ?>>
                                                    24</option>
                                                <option value="25"
                                                    <?php echo($results[0]['delivery_period'] == '25') ? 'selected' : ''; ?>>
                                                    25</option>
                                                <option value="26"
                                                    <?php echo($results[0]['delivery_period'] == '26') ? 'selected' : ''; ?>>
                                                    26</option>
                                                <option value="27"
                                                    <?php echo($results[0]['delivery_period'] == '27') ? 'selected' : ''; ?>>
                                                    27</option>
                                                <option value="28"
                                                    <?php echo($results[0]['delivery_period'] == '28') ? 'selected' : ''; ?>>
                                                    28</option>
                                                <option value="29"
                                                    <?php echo($results[0]['delivery_period'] == '29') ? 'selected' : ''; ?>>
                                                    29</option>
                                            </select>
                                            <span class="align-self-center">Days</span>
                                        </div>
                                    </div>

                                    <!-- Currency -->
                                    <div class="mb-3 row">
                                        <label for="currency" class="col-sm-4 col-form-label">Currency:</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="currency" name="currency">
                                                <option value="INR"
                                                    <?php echo($results[0]['currency'] == 'INR') ? 'selected' : ''; ?>>
                                                    INR</option>
                                                <option value="AUD"
                                                    <?php echo($results[0]['currency'] == 'AUD') ? 'selected' : ''; ?>>
                                                    AUD</option>
                                                <option value="USD"
                                                    <?php echo($results[0]['currency'] == 'USD') ? 'selected' : ''; ?>>
                                                    USD</option>
                                                <option value="AED"
                                                    <?php echo($results[0]['currency'] == 'AED') ? 'selected' : ''; ?>>
                                                    AED</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Service Tax -->
                                    <div class="mb-3 row">
                                        <label for="applicabletax" class="col-sm-4 col-form-label">Service Tax
                                            Applicable?:</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="applicabletax" name="applicabletax">
                                                <option value="1"
                                                    <?php echo($results[0]['applicabletax'] == '1') ? 'selected' : ''; ?>>
                                                    No</option>
                                                <option value="0"
                                                    <?php echo($results[0]['applicabletax'] == '0') ? 'selected' : ''; ?>>
                                                    YES</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- VAT -->
                                    <div class="mb-3 row">
                                        <label for="applicablevat" class="col-sm-4 col-form-label">Vat
                                            Applicable?:</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="applicablevat" name="applicablevat">
                                                <option value="1"
                                                    <?php echo($results[0]['applicablevat'] == '1') ? 'selected' : ''; ?>>
                                                    No</option>
                                                <option value="0"
                                                    <?php echo($results[0]['applicablevat'] == '0') ? 'selected' : ''; ?>>
                                                    YES</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="form-group m-3">
                        <button class="btn btn-sm btn-primary" type="submit" id="convert_to_live_btn"> Convert to
                            Demo</button>
                    </div>
                </form>



            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->



    </div>
    <!-- /.card-body -->

</div>
<!-- /.card -->


<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/quotation.js"></script>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Configuration Details</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <h4 id="viewProductName"></h4>
                <div id="viewConfiguration" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product Configuration</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body " id="editModalBody">

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div> -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Modal Handler
    $('#viewModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const productName = button.data('productname');
        const configuration = button.data('configuration');

        const quotation_id = $('#quotation_id').val();

        $.ajax({
            url: "post/convert-post.php",
            type: "GET",
            data: {
                operation: "view_product",
                quotation_id: quotation_id
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $("#viewModalBody").html(response.data);
                } else {
                    $("#viewModalBody").html("<p>No records found.</p>");
                }
            },
        });

    });

    // Edit Modal Handler
    $('#editModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const productName = button.data('productname');
        const configuration = button.data('configuration');
        const productid = button.data('productid');
        const quotation_id = $('#quotation_id').val();

        $.get(
            'post/edit-product-modal.php', {
                operation: 'edit_product',
                product_id: productid,
                quotation_id: quotation_id
            },
            function(response) {
                // debugger
                const responseJSON = JSON.parse(response);

                $('#editModalBody').html(responseJSON.data);
            }
        );



        // $('#editProductName').val(productName);
        // $('#editConfiguration').val(configuration.replace(/<br\s*\/?>/gi, "\n"));
    });
});
</script>

<?