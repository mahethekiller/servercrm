<?php
    $pageTitle = 'Add Product';
    include '../../includes/header.php';
?>

<!--begin::Row-->
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo BASE_URL ?>admin/products/post/product_crud.php" id="productAddForm" method="post">
                    <div class="form-group mb-3">
                        <label for="name">Product Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Product Name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Product Description"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="price">Price (INR) <span style="color:red">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="0.00" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <input type="hidden" name="operation" value="add">
                    <button type="submit" class="btn btn-primary">Submit</button>
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