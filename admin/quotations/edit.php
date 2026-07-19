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
                             qd.total_price,
                             qd.custom_details
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

                                        if (!empty($row['custom_details'])) {
                                            $customStr = '';
                                            $customJson = json_decode($row['custom_details'] ?? '', true);
                                            if (is_array($customJson)) {
                                                $pairs = [];
                                                foreach ($customJson as $k => $v) {
                                                    $pairs[] = ucfirst(str_replace('_', ' ', $k)) . ': ' . $v;
                                                }
                                                $customStr = implode(', ', $pairs);
                                            } else {
                                                $customStr = $row['custom_details'];
                                            }
                                            $configLine = (!empty($customStr) ? $customStr : 'Custom Details');
                                        } else {
                                            $configLine = $row['attribute_type'] . ': ' . $row['attribute_name'];
                                        }

                                        $products[$product_id]['configuration'][] =
                                            $configLine . ' (₹' . $row['attribute_price'] . ' / ₹' . $row['total_price'] . ')';
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
                                        <button class="btn btn-sm btn-warning mr-2"
                                            data-toggle="modal"
                                            data-target="#editModal"
                                            data-productname="' . htmlspecialchars($product['product_name'], ENT_QUOTES) . '"
                                            data-configuration="' . htmlspecialchars(implode('<br>', $product['configuration']), ENT_QUOTES) . '"
                                            data-productid="' . $product_id . '"


                                            >
                                            Edit
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
                    <input type="hidden" name="quotation_id" id="quotation_id" value="<?php echo $quotation_id; ?>">

                



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