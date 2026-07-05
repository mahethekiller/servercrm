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

    $it_contact_name       = trim($_POST['it_contact_name'] ?? '');
    $it_contact_email      = trim($_POST['it_contact_email'] ?? '');
    $it_contact_phone      = trim($_POST['it_contact_phone'] ?? '');
    $finance_contact_name  = trim($_POST['finance_contact_name'] ?? '');
    $finance_contact_email = trim($_POST['finance_contact_email'] ?? '');
    $finance_contact_phone = trim($_POST['finance_contact_phone'] ?? '');
    $lead_value            = trim($_POST['lead_value'] ?? '0.00');

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

    // === Additional contact validations for IT and Finance ===
    if (empty($it_contact_name) || empty($it_contact_email) || empty($it_contact_phone)) {
        echo json_encode(['success' => false, 'message' => 'IT Contact details are incomplete.']);
        exit;
    }

    if (! filter_var($it_contact_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid IT contact email address.']);
        exit;
    }

    // === Validate phone format for IT contact ===
    if (empty($it_contact_phone) || ! preg_match('/^[0-9]{6,15}$/', $it_contact_phone)) {
        echo json_encode(['success' => false, 'message' => 'Invalid IT contact Phone.']);
        exit;
    }

    // // === Additional contact validations for Finance and HR ===
    // if (empty($finance_contact_name) || empty($finance_contact_email) || empty($finance_contact_phone)) {
    //     echo json_encode(['success' => false, 'message' => 'Finance Contact details are incomplete.']);
    //     exit;
    // }

    // if (! filter_var($finance_contact_email, FILTER_VALIDATE_EMAIL)) {
    //     echo json_encode(['success' => false, 'message' => 'Invalid Finance contact email address.']);
    //     exit;
    // }

    // // === Validate phone format for Finance contact ===
    // if (empty($finance_contact_phone) || ! preg_match('/^[0-9]{6,15}$/', $finance_contact_phone)) {
    //     echo json_encode(['success' => false, 'message' => 'Invalid Finance contact Phone.']);
    //     exit;
    // }

    // === Final Update Operation ===
    $data = [
        'name'                  => $name,
        'client_name'           => $client_name,
        'email'                 => $email,
        'phone'                 => $phone,
        'cin_no'                => $cin_no,
        'gst_no'                => $gst_no,
        'pan_no'                => $pan_no,
        'country_code'          => $country_code,
        'address'               => $address,
        'city'                  => $city,
        'state'                 => $state,
        'industry'              => $industry,
        'pin_code'              => $pin_code,
        'country'               => $country,
        'website'               => $website,
        'it_contact_name'       => trim($_POST['it_contact_name'] ?? ''),
        'it_contact_email'      => trim($_POST['it_contact_email'] ?? ''),
        'it_contact_phone'      => trim($_POST['it_contact_phone'] ?? ''),
        'finance_contact_name'  => trim($_POST['finance_contact_name'] ?? ''),
        'finance_contact_email' => trim($_POST['finance_contact_email'] ?? ''),
        'finance_contact_phone' => trim($_POST['finance_contact_phone'] ?? ''),
        'lead_value'            => empty($lead_value) ? 0.00 : $lead_value,
        'updated_at'            => date('Y-m-d H:i:s'),
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
    $name                  = trim($_POST['name'] ?? '');
    $client_name           = trim($_POST['client_name'] ?? '');
    $email                 = trim($_POST['email'] ?? '');
    $country_code          = trim($_POST['country_code'] ?? '');
    $phone                 = trim($_POST['phone'] ?? '');
    $cin_no                = trim($_POST['cin_no'] ?? '');
    $gst_no                = trim($_POST['gst_no'] ?? '');
    $pan_no                = trim($_POST['pan_no'] ?? '');
    $address               = trim($_POST['address'] ?? '');
    $city                  = trim($_POST['city'] ?? '');
    $state                 = trim($_POST['state'] ?? '');
    $pin_code              = trim($_POST['pin_code'] ?? '');
    $country               = trim($_POST['country'] ?? '');
    $industry              = trim($_POST['industry'] ?? '');
    $website               = trim($_POST['website'] ?? '');
    $it_contact_name       = trim($_POST['it_contact_name'] ?? '');
    $it_contact_email      = trim($_POST['it_contact_email'] ?? '');
    $it_contact_phone      = trim($_POST['it_contact_phone'] ?? '');
    $finance_contact_name  = trim($_POST['finance_contact_name'] ?? '');
    $finance_contact_email = trim($_POST['finance_contact_email'] ?? '');
    $finance_contact_phone = trim($_POST['finance_contact_phone'] ?? '');
    $lead_value            = trim($_POST['lead_value'] ?? '0.00');

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

    
    // Check if email already present
    $where = ['email' => $email];
    $count = $db->count('companies', $where);
    if ($count > 0) {
        echo json_encode(['success' => false, 'message' => 'Email already exists.']);
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
    // === Additional contact validations for IT and Finance ===
    if (empty($it_contact_name) || empty($it_contact_email) || empty($it_contact_phone)) {
        echo json_encode(['success' => false, 'message' => 'IT Contact details are incomplete.']);
        exit;
    }

    if (! filter_var($it_contact_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid IT contact email address.']);
        exit;
    }

    // === Validate phone format for IT contact ===
    if (empty($it_contact_phone) || ! preg_match('/^[0-9]{6,15}$/', $it_contact_phone)) {
        echo json_encode(['success' => false, 'message' => 'Invalid IT contact Phone.']);
        exit;
    }

    $data = [
        'name'                  => $name,
        'client_name'           => $client_name,
        'email'                 => $email,
        'country_code'          => $country_code,
        'phone'                 => $phone,
        'cin_no'                => $cin_no,
        'gst_no'                => $gst_no,
        'pan_no'                => $pan_no,
        'address'               => $address,
        'city'                  => $city,
        'state'                 => $state,
        'pin_code'              => $pin_code,
        'country'               => $country,
        'industry'              => $industry,
        'website'               => $website,
        'it_contact_name'       => trim($_POST['it_contact_name'] ?? ''),
        'it_contact_email'      => trim($_POST['it_contact_email'] ?? ''),
        'it_contact_phone'      => trim($_POST['it_contact_phone'] ?? ''),
        'finance_contact_name'  => trim($_POST['finance_contact_name'] ?? ''),
        'finance_contact_email' => trim($_POST['finance_contact_email'] ?? ''),
        'finance_contact_phone' => trim($_POST['finance_contact_phone'] ?? ''),
        'lead_value'            => empty($lead_value) ? 0.00 : $lead_value,
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


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email']) && ! empty($_GET['email'])) {
    $email = $_GET['email'];
    $query = "SELECT email FROM companies WHERE email = '$email'";
    $result = $db->get_row($query);
    if ($result) {
        echo json_encode(['success' => false, 'message' => 'Email address already exists.']);
    } else {
        echo json_encode(['success' => true, 'message' => 'Email address is available.']);
    }
}
