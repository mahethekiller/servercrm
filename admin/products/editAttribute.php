<?php
require_once('../../config.php');
// Function to generate edit form
function generateEditForm($attributeId) {
    global $db;

    // Get attribute details from database
    $attribute = $db->get_row("SELECT * FROM attributes WHERE id = '$attributeId'");

    // Generate edit form
    ?>
    <div class="modal fade" id="editAttributeModal" tabindex="-1" role="dialog" aria-labelledby="editAttributeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAttributeModalLabel">Edit Attribute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo BASE_URL ?>admin/products/post/post.php" method="post" id="editAttributeForm" class="form-horizontal">
                        <input type="hidden" name="attributeId" value="<?php echo $attributeId; ?>">
                        <div class="form-group">
                            <label for="attributeName">Name</label>
                            <input type="text" class="form-control" id="attributeName" name="attributeName" required value="<?php echo $attribute['attribute_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="attributeType">Type</label>
                            <select class="form-control" id="attributeType" name="attributeType" required>
                                <option value="Ram" <?php if ($attribute['attribute_type'] == "Ram") echo "selected"; ?>>Ram</option>
                                <option value="HDD" <?php if ($attribute['attribute_type'] == "HDD") echo "selected"; ?>>HDD</option>
                                <option value="database" <?php if ($attribute['attribute_type'] == "database") echo "selected"; ?>>database</option>
                                <option value="CPU" <?php if ($attribute['attribute_type'] == "CPU") echo "selected"; ?>>CPU</option>
                                <option value="OS" <?php if ($attribute['attribute_type'] == "OS") echo "selected"; ?>>OS</option>
                                <option value="IP" <?php if ($attribute['attribute_type'] == "IP") echo "selected"; ?>>IP</option>
                                <option value="bandwidth" <?php if ($attribute['attribute_type'] == "bandwidth") echo "selected"; ?>>bandwidth</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required value="<?php echo $attribute['price']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Attribute</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// Call the function when edit button is clicked
if (isset($_GET['editAttribute'])) {
    generateEditForm($_GET['editAttribute']);
}