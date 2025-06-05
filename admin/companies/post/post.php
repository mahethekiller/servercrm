<?php

require_once '../../../includes/class.db.php';

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation']) && $_POST['operation'] === 'edit') {
    $id           = trim($_POST['id'] ?? '');
    $name         = trim($_POST['name'] ?? '');
    $client_name  = trim($_POST['client_name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $cin_no       = trim($_POST['cin_no'] ?? '');
    $gst_no       = trim($_POST['gst_no'] ?? '');
    $pan_no       = trim($_POST['pan_no'] ?? '');
    $country_code = trim($_POST['country_code'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $city         = trim($_POST['city'] ?? '');
    $state        = trim($_POST['state'] ?? '');
    $industry     = trim($_POST['industry'] ?? '');
    $pin_code     = trim($_POST['pin_code'] ?? '');
    $country      = trim($_POST['country'] ?? '');
    $website      = trim($_POST['website'] ?? '');

    // === Basic required field validation ===
    if (empty($id) || ! is_numeric($id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid or missing ID.']);
        exit;
    }

    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        echo json_encode(['success' => false, 'message' => 'Name, Email, Phone, and Address are required.']);
        exit;
    }

    // === Format validations ===
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
        exit;
    }

    if (! empty($website) && ! filter_var($website, FILTER_VALIDATE_URL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid website URL.']);
        exit;
    }

    if (! preg_match('/^[0-9]{6,15}$/', $phone)) {
        echo json_encode(['success' => false, 'message' => 'Phone must be numeric and 6–15 digits.']);
        exit;
    }

    if (! empty($pin_code) && ! preg_match('/^\d{4,10}$/', $pin_code)) {
        echo json_encode(['success' => false, 'message' => 'Invalid PIN code format.']);
        exit;
    }

    // === Final Update Operation ===
    $data = [
        'name'         => $name,
        'client_name'  => $client_name,
        'email'        => $email,
        'phone'        => $phone,
        'cin_no'       => $cin_no,
        'gst_no'       => $gst_no,
        'pan_no'       => $pan_no,
        'country_code' => $country_code,
        'address'      => $address,
        'city'         => $city,
        'state'        => $state,
        'industry'     => $industry,
        'pin_code'     => $pin_code,
        'country'      => $country,
        'website'      => $website,
        'updated_at'   => date('Y-m-d H:i:s'),
    ];

    $where = ['id' => $id];

    if ($db->update('companies', $data, $where)) {
        echo json_encode(['success' => true, 'message' => 'Company updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update record.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation']) && $_POST['operation'] === 'add') {
    // Collect and trim inputs
    $name         = trim($_POST['name'] ?? '');
    $client_name  = trim($_POST['client_name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $country_code = trim($_POST['country_code'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $cin_no       = trim($_POST['cin_no'] ?? '');
    $gst_no       = trim($_POST['gst_no'] ?? '');
    $pan_no       = trim($_POST['pan_no'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $city         = trim($_POST['city'] ?? '');
    $state        = trim($_POST['state'] ?? '');
    $pin_code     = trim($_POST['pin_code'] ?? '');
    $country      = trim($_POST['country'] ?? '');
    $industry     = trim($_POST['industry'] ?? '');
    $website      = trim($_POST['website'] ?? '');

    // Basic required fields validation
    if (empty($name) || empty($client_name) || empty($email) || empty($country_code) || empty($phone) || empty($address)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }

    // Validate email
    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
        exit;
    }

    // Validate website URL if not empty
    if (! empty($website) && ! filter_var($website, FILTER_VALIDATE_URL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid website URL.']);
        exit;
    }

    if (! preg_match('/^[0-9]{6,15}$/', $phone)) {
        echo json_encode(['success' => false, 'message' => 'Phone must be numeric and 6–15 digits.']);
        exit;
    }

    $data = [
        'name'         => $name,
        'client_name'  => $client_name,
        'email'        => $email,
        'country_code' => $country_code,
        'phone'        => $phone,
        'cin_no'       => $cin_no,
        'gst_no'       => $gst_no,
        'pan_no'       => $pan_no,
        'address'      => $address,
        'city'         => $city,
        'state'        => $state,
        'pin_code'     => $pin_code,
        'country'      => $country,
        'industry'     => $industry,
        'website'      => $website,
    ];

    if ($db->insert('companies', $data)) {
        echo json_encode(['success' => true, 'message' => 'Record added successfully.']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding record.']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['company_id']) && is_numeric($_GET['company_id'])) {
    $id      = $_GET['company_id'];
    $query   = "SELECT * FROM companies WHERE id = $id";
    $company = $db->get_row($query);
    if ($company) {
        echo json_encode(['success' => true, 'data' => $company]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Company not found.']);
    }
}
