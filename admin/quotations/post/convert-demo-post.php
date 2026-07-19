<?php

require_once '../../../includes/class.db.php';

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation']) && $_POST['operation'] === 'convert') {

    $quotation_id = $_POST['quotation_id'];
    $supportRemarks = $_POST['supportRemarks'];
    $clientRemarks = $_POST['clientRemarks'];
    $accountRemark = $_POST['accountRemark'];
    $client_confirmation = $_POST['client_confirmation'];
    $demo_start_date = $_POST['demo_start_date'] ?? '';
    $demo_end_date = $_POST['demo_end_date'] ?? '';

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
    if (empty($demo_start_date)) {
        echo json_encode(['success' => false, 'message' => 'Demo Start Date is required.']);
        exit;
    }
    if (empty($demo_end_date)) {
        echo json_encode(['success' => false, 'message' => 'Demo End Date is required.']);
        exit;
    }
    
    $data = [
        'supportRemarks' => $supportRemarks,
        'clientRemarks' => $clientRemarks,
        'accountRemarks' => $accountRemark,
        'client_confirmation' => $client_confirmation,
        'demo_start_date' => $demo_start_date,
        'demo_end_date' => $demo_end_date,
        'quotation_status' => 'demo'
    ];
    $result = $db->update('quotations', $data, ['id' => $quotation_id]);

    if ($result) {
        echo json_encode(['success' => true, 'message' => "Quotation updated successfully."]);
    } else {
        echo json_encode(['success' => false, 'message' => "Failed to update quotation."]);
    }
    
}




