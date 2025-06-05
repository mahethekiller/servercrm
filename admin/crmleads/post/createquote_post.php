<?php
require_once '../../../config.php';
$db = new DB();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ! empty($_POST['products'])) {
    $products      = $_POST['products'];
    $errors        = [];
    $insertedCount = 0;

// Check if quotation already exists for the given company_id and lead_id
    $existingQuotationQuery = "SELECT id FROM quotations WHERE company_id = " . (int) $_POST['company_id'] . " AND lead_id = " . (int) $_POST['lead_id'];
    $existingQuotationId    = $db->num_rows($existingQuotationQuery);

    if ($existingQuotationId > 0) {
        echo json_encode(['success' => false, 'message' => 'Quotation already exists for this company and lead.']);
        exit;
    }

    foreach ($products as $productId => $attributes) {
        if (! is_numeric($productId)) {
            $errors[] = "Invalid product ID: $productId";
            continue;
        }

        $productName = $db->get_var("SELECT name FROM products WHERE id = $productId");

        foreach ($attributes as $attributeTypeId => $fields) {
            $attributeName = $db->get_var("SELECT name FROM attribute_types WHERE id = $attributeTypeId");
            $rowId         = "Product $productName, Attribute Type $attributeName";

            // Validate all fields
            if (empty($fields['attribute_id'])) {
                $errors[] = "$rowId: Attribute is required. <br>";
            }

            if (! isset($fields['reg_price']) || ! is_numeric($fields['reg_price'])) {
                $errors[] = "$rowId: Regular price must be a number.";
            }

            if (! isset($fields['unit']) || ! is_numeric($fields['unit'])) {
                $errors[] = "$rowId: Unit must be a number.";
            }

            if (! isset($fields['sale_price']) || ! is_numeric($fields['sale_price'])) {
                $errors[] = "$rowId: Sale price must be a number.";
            }

            if (! isset($fields['total']) || ! is_numeric($fields['total'])) {
                $errors[] = "$rowId: Total must be a number.";
            }
        }
    }

    // If there are validation errors, return them
    if (! empty($errors)) {
        echo json_encode(['success' => false, 'message' => $errors]);
        exit;
    }

    // Insert into quotations table
    $quotationData = [
        'lead_id'          => (int) $_POST['lead_id'],
        'company_id'       => (int) $_POST['company_id'],
        'added_by'         => (int) $_SESSION['user']['id'],
        'description'      => $_POST['description'],
        'antivirus_backup' => $_POST['antivirus_backup'],
        'location'         => $_POST['location'],
        'server_type'      => $_POST['server_type'],
        'otc'              => $_POST['otc'],
        'sub_total'        => $_POST['sub_total'],
    ];

    if (! $db->insert('quotations', $quotationData)) {
        // $errors[] = "Failed to insert into quotations table.";
        echo json_encode(['success' => false, 'message' => "Failed to insert into quotations table."]);
        exit;
    }

    $quotation_id = $db->lastid();

    // If validation passed, proceed with insert
    foreach ($products as $productId => $attributes) {
        foreach ($attributes as $attributeTypeId => $fields) {
            $insertData = [
                'product_id'     => (int) $productId,
                'quotation_id'   => (int) $quotation_id,
                'attribute_type' => (int) $attributeTypeId,
                'attribute_id'   => (int) $fields['attribute_id'],
                'reg_price'      => number_format((float) $fields['reg_price'], 2, '.', ''),
                'unit'           => (int) $fields['unit'],
                'sale_price'     => number_format((float) $fields['sale_price'], 2, '.', ''),
                'total_price'    => number_format((float) $fields['total'], 2, '.', ''),
                'added_date'     => date('Y-m-d H:i:s'),
            ];

            if ($db->insert('quote_details', $insertData)) {
                $insertedCount++;
            } else {
                $errors[] = "Database error for Product $productId, Attribute Type $attributeTypeId.";
            }
        }
    }

    if ($insertedCount > 0 && empty($errors)) {
        echo json_encode(['success' => true, 'message' => "Quotation created successfully."]);
    } else {
        echo json_encode(['success' => false, 'message' => $errors ?: 'Failed to insert data.']);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'No data received.']);
    exit;
}
