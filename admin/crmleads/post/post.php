<?php
session_start();
require_once '../../../includes/class.db.php';

$db = new DB();
function isValidURL($url)
{
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation']) && $_POST['operation'] === 'edit') {

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation']) && $_POST['operation'] === 'add') {
    // Helper function to validate URL

// Sanitize and validate inputs
    $company_id      = filter_input(INPUT_POST, 'company_id', FILTER_VALIDATE_INT);
    $lead_status     = trim($_POST['lead_status'] ?? '');
    $lead_source     = trim($_POST['lead_source'] ?? '');
    $follow_up_date  = $_POST['follow_up_date'] ?? '';
    $expected_closer = $_POST['expected_closer'] ?? '';
    $website         = trim($_POST['website'] ?? '');
    $description     = trim($_POST['description'] ?? '');

// Validation
    $errors = [];

    if (! $company_id) {
        $errors[] = 'Company is required and must be a valid ID.';
    }

    if (empty($lead_status)) {
        $errors[] = 'Lead Status is required.';
    }

    if (empty($lead_source)) {
        $errors[] = 'Lead Source is required.';
    }

    if (! $follow_up_date || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $follow_up_date)) {
        $errors[] = 'Follow Up Date is required and must be in YYYY-MM-DD format.';
    }

    if (! $expected_closer || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $expected_closer)) {
        $errors[] = 'Expected Closer Date is required and must be in YYYY-MM-DD format.';
    }

    if ($website !== '' && ! isValidURL($website)) {
        $errors[] = 'Website URL is invalid.';
    }

    if (empty($description)) {
        $errors[] = 'Description is required.';
    }

    if (count($errors) > 0) {
        echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
        exit;
    }

    $lead = [
        'company_id'      => $company_id,
        'lead_status'     => $lead_status,
        'lead_source'     => $lead_source,
        'follow_up_date'  => $follow_up_date,
        'expected_closer' => $expected_closer,
        'website'         => $website,
        'description'     => $description,
        'added_by'        => $_SESSION['user']['id'],
    ];

    if ($db->insert('crmleads', $lead)) {
        echo json_encode(['success' => true, 'message' => 'Lead added successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error inserting lead: ' . $db->get_error_message()]);
    }

}
