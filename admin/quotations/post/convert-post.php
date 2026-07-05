<?php

require_once '../../../includes/class.db.php';

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation']) && $_POST['operation'] === 'convert') {

    $quotation_id = $_POST['quotation_id'];
    $supportRemarks = $_POST['supportRemarks'];
    $clientRemarks = $_POST['clientRemarks'];
    $accountRemark = $_POST['accountRemark'];
    $client_confirmation = $_POST['client_confirmation'];
    $contract_terms_yrs = $_POST['contract_terms_yrs'];
    $contract_term_month = $_POST['contract_term_month'];
    $billing_cycle = $_POST['billing_cycle'];
    $billing_period = $_POST['billing_period'];
    $billing_start = $_POST['billing_start'];
    $delivery_period_week = $_POST['delivery_period_week'];
    $delivery_period = $_POST['delivery_period'];
    $currency = $_POST['currency'];
    $applicabletax = $_POST['applicabletax'];
    $applicablevat = $_POST['applicablevat'];

    
    // validations
    if (empty($supportRemarks)) {
        echo json_encode(['success' => false, 'message' => 'Support Remarks is required.']);
        exit;
    }
    if (empty($clientRemarks)) {
        echo json_encode(['success' => false, 'message' => 'Client Remarks is required.']);
        exit;
    }
    if (empty($accountRemark)) {
        echo json_encode(['success' => false, 'message' => 'Account Remark is required.']);
        exit;
    }
    if (empty($client_confirmation)) {
        echo json_encode(['success' => false, 'message' => 'Client Confirmation is required.']);
        exit;
    }
    if (empty($contract_terms_yrs) || empty($contract_term_month)) {
        echo json_encode(['success' => false, 'message' => 'Contract Terms is required.']);
        exit;
    }
    if (empty($billing_cycle) || empty($billing_period) || empty($billing_start)) {
        echo json_encode(['success' => false, 'message' => 'Billing Cycle is required.']);
        exit;
    }
    if (empty($delivery_period_week) || empty($delivery_period)) {
        echo json_encode(['success' => false, 'message' => 'Delivery Period is required.']);
        exit;
    }
    if (empty($currency)) {
        echo json_encode(['success' => false, 'message' => 'Currency is required.']);
        exit;
    }
    if ($applicabletax == null || $applicablevat == null) {
        echo json_encode(['success' => false, 'message' => 'Applicable Tax/Vat is required.']);
        exit;
    }
    
    
    $data = [
        'supportRemarks' => $supportRemarks,
        'clientRemarks' => $clientRemarks,
        'accountRemarks' => $accountRemark,
        'client_confirmation' => $client_confirmation,
        'contract_terms_yrs' => $contract_terms_yrs,
        'contract_term_month' => $contract_term_month,
        'billing_cycle' => $billing_cycle,
        'billing_period' => $billing_period,
        'billing_start' => $billing_start,
        'delivery_period_week' => $delivery_period_week,
        'delivery_period' => $delivery_period,
        'currency' => $currency,
        'applicabletax' => $applicabletax,
        'applicablevat' => $applicablevat,
        'quotation_status' => 'live'
    ];
    $result = $db->update('quotations', $data, ['id' => $quotation_id]);

    if ($result) {
        echo json_encode(['success' => true, 'message' => "Quotation updated successfully."]);
    } else {
        echo json_encode(['success' => false, 'message' => "Failed to update quotation."]);
    }
    
}



if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['operation']) && $_GET['operation'] === 'view_product') {
    $quotationId = intval($_GET['quotation_id']); // sanitize

    $query = "SELECT qd.*, 
                     at.name AS type_name, 
                     a.attribute_name, 
                     p.name AS product_name
              FROM quote_details qd
              LEFT JOIN attribute_types at ON qd.attribute_type = at.id
              LEFT JOIN attributes a ON qd.attribute_id = a.id
              LEFT JOIN products p ON qd.product_id = p.id
              WHERE qd.quotation_id = $quotationId
              ORDER BY qd.product_id, qd.attribute_type";

    $rows = $db->get_results($query);

    if (!$rows) {
        echo json_encode(['success' => false, 'message' => 'No records found.']);
        exit;
    }

    $tableHtml = '
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Attribute Type</th>
                <th>Attribute</th>
                <th>Reg Price</th>
                <th>Unit</th>
                <th>Sale Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($rows as $row) {
        $tableHtml .= '<tr>
            <td>' . htmlspecialchars($row['product_name'], ENT_QUOTES) . '</td>
            <td>' . htmlspecialchars($row['type_name'], ENT_QUOTES) . '</td>
            <td>' . htmlspecialchars($row['attribute_name'], ENT_QUOTES) . '</td>
            <td>' . number_format($row['reg_price'], 2) . '</td>
            <td>' . intval($row['unit']) . '</td>
            <td>' . number_format($row['sale_price'], 2) . '</td>
            <td>' . number_format($row['total_price'], 2) . '</td>
        </tr>';
    }

    $tableHtml .= '</tbody></table>';

    echo json_encode(['success' => true, 'data' => $tableHtml]);
    exit;
}

