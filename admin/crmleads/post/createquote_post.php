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
            $isCustomProduct = in_array($productId, [3, 4, 5]);
            $attributeName = $isCustomProduct ? "Custom Details" : $db->get_var("SELECT name FROM attribute_types WHERE id = $attributeTypeId");
            $rowId         = "Product $productName, Attribute Type $attributeName";

            // Validate all fields
            if (!$isCustomProduct && empty($fields['attribute_id'])) {
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
    $quote_id = 'imegh-' . uniqid();

    $quotationData = [
        'lead_id'          => (int) $_POST['lead_id'],
        'sof_id'           => $quote_id,
        'company_id'       => (int) $_POST['company_id'],
        'added_by'         => (int) $_SESSION['user']['id'],
        'description'      => $_POST['description'],
        'antivirus_backup' => $_POST['antivirus_backup'],
        'location'         => $_POST['location'],
        'server_type'      => $_POST['server_type'],
        'otc'              => (is_numeric($_POST['otc'] ?? '') ? (float)$_POST['otc'] : 0.00),
        'sub_total'        => (is_numeric($_POST['sub_total'] ?? '') ? (float)$_POST['sub_total'] : 0.00),
        'quotation_status' => $_POST['quotation_status'] ?? 'demo',
        'demo_start_date'  => (!empty($_POST['demo_start_date']) ? $_POST['demo_start_date'] : NULL),
        'demo_end_date'    => (!empty($_POST['demo_end_date']) ? $_POST['demo_end_date'] : NULL),
    ];

    if (! $db->insert('quotations', $quotationData)) {
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
                'attribute_id'   => (int) ($fields['attribute_id'] ?? 1),
                'reg_price'      => number_format((float) $fields['reg_price'], 2, '.', ''),
                'unit'           => (int) $fields['unit'],
                'sale_price'     => number_format((float) $fields['sale_price'], 2, '.', ''),
                'total_price'    => number_format((float) $fields['total'], 2, '.', ''),
                'custom_details' => $fields['custom_details'] ?? NULL,
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
        // Trigger email notification
        $quoteStatus = $_POST['quotation_status'] ?? 'demo';
        $companyDetails = getCompanyDetailsFromQuotationId($quotation_id);
        $user = getUserDetailsFromUserId($_SESSION['user']['id']);
        
        $subjectStr = "New " . ucfirst($quoteStatus) . " Quotation Created for " . ($companyDetails['name'] ?? 'Company');
        $body = "A new quotation has been created.\n\n"
              . "Quotation ID: " . $quotation_id . "\n"
              . "Company: " . ($companyDetails['name'] ?? 'N/A') . "\n"
              . "Status: " . ucfirst($quoteStatus) . "\n"
              . "Created By: " . ($user['name'] ?? 'N/A') . " (" . ($user['email'] ?? 'N/A') . ")\n"
              . "Sub Total: " . $_POST['sub_total'] . "\n";
        
        if ($quoteStatus === 'demo') {
            $body .= "Demo Period: " . ($_POST['demo_start_date'] ?? 'N/A') . " to " . ($_POST['demo_end_date'] ?? 'N/A') . "\n";
        }
        
        $recipients = ['support@e2ccloud.com', 'subject@e2ccloud.com'];
        if (!empty($user['email'])) {
            $recipients[] = $user['email'];
        }
        if ($quoteStatus === 'live' || $quoteStatus === 'upgrade') {
            $recipients[] = 'accounts@e2ccloud.com';
        }
        
        foreach ($recipients as $toEmail) {
            crm_send_email($toEmail, $subjectStr, $body);
        }

        echo json_encode(['success' => true, 'message' => "Quotation created successfully."]);
    } else {
        echo json_encode(['success' => false, 'message' => $errors ?: 'Failed to insert data.']);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'No data received.']);
    exit;
}
