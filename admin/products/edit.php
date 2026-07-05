<?php
    $pageTitle = 'Edit Product';
    include '../../includes/header.php';
    $db = new DB();

    $id = intval($_GET['id'] ?? 0);
    $product = $db->get_row("SELECT * FROM products WHERE id = $id");

    if (!$product) {
        echo "<div class='alert alert-danger'>Product not found.</div>";
        include '../../includes/footer.php';
        exit;
    }
?>

<!--begin::Row-->
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Product Details</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE_URL ?>admin/products/post/product_crud.php" id="productUpdateForm" method="post">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                    <div class="form-group mb-3">
                        <label for="name">Product Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Price (INR) <span style="color:red">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" <?php echo $product['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo $product['status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>

                    <input type="hidden" name="operation" value="edit">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="<?php echo BASE_URL ?>admin/products/" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Row-->

<?php
    include '../../includes/footer.php';
?>

<script src="<?php echo BASE_URL ?>customjs/products.js"></script>