<?php
require_once '../../../includes/class.db.php';
$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $operation = trim($_POST['operation'] ?? '');

    if ($operation === 'add') {
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = trim($_POST['price'] ?? '0.00');
        $status = trim($_POST['status'] ?? 'active');

        if (empty($name)) {
            echo json_encode(['success' => false, 'message' => 'Product Name is required.']);
            exit;
        }

        if (!is_numeric($price)) {
            echo json_encode(['success' => false, 'message' => 'Price must be a valid number.']);
            exit;
        }

        $insertData = [
            'name' => $name,
            'description' => empty($description) ? null : $description,
            'price' => number_format((float)$price, 2, '.', ''),
            'status' => $status,
            'added_date' => date('Y-m-d H:i:s')
        ];

        if ($db->insert('products', $insertData)) {
            echo json_encode(['success' => true, 'message' => 'Product added successfully.']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add product to database.']);
            exit;
        }
    }

    if ($operation === 'edit') {
        $id = intval($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = trim($_POST['price'] ?? '0.00');
        $status = trim($_POST['status'] ?? 'active');

        if ($id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid Product ID.']);
            exit;
        }

        if (empty($name)) {
            echo json_encode(['success' => false, 'message' => 'Product Name is required.']);
            exit;
        }

        if (!is_numeric($price)) {
            echo json_encode(['success' => false, 'message' => 'Price must be a valid number.']);
            exit;
        }

        $updateData = [
            'name' => $name,
            'description' => empty($description) ? null : $description,
            'price' => number_format((float)$price, 2, '.', ''),
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($db->update('products', $updateData, ['id' => $id])) {
            echo json_encode(['success' => true, 'message' => 'Product updated successfully.']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update product.']);
            exit;
        }
    }

    if ($operation === 'delete') {
        $id = intval($_POST['id'] ?? 0);

        if ($id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid Product ID.']);
            exit;
        }

        if ($db->delete('products', ['id' => $id])) {
            echo json_encode(['success' => true, 'message' => 'Product deleted successfully.']);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete product.']);
            exit;
        }
    }
}

echo json_encode(['success' => false, 'message' => 'Invalid Request.']);
exit;
