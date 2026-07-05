<?php
    $pageTitle = 'Products';
    include '../../includes/header.php';
    $db = new DB();
?>

<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">All Products</h3>
                <div class="card-tools ms-auto">
                    <a href="<?php echo BASE_URL ?>admin/products/add.php" class="btn btn-sm btn-success">
                        <i class="bi bi-plus-lg"></i> Add New Product
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php
                    $query    = "SELECT * FROM products ORDER BY id DESC";
                    $products = $db->get_results($query) ?: [];
                ?>
                <table id="products" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price (INR)</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                        <tr id="product-row-<?php echo $product['id']; ?>">
                            <td><?php echo $product['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($product['name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($product['description'] ?? 'N/A'); ?></td>
                            <td><?php echo number_format($product['price'], 2); ?></td>
                            <td>
                                <?php if ($product['status'] === 'active'): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo BASE_URL ?>admin/products/edit.php?id=<?php echo $product['id']; ?>"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger deleteProductBtn" data-id="<?php echo $product['id']; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--end::Row-->

<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/products.js"></script>