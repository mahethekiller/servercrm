<?php


function getCompanyDetailsFromLeadId($leadId) {
    global $db;
    $query = "SELECT companies.* FROM crmleads 
              INNER JOIN companies ON crmleads.company_id = companies.id 
              WHERE crmleads.id = $leadId";
    $row = $db->get_row($query);
    
    return $row;
}


function getCompanyDetailsFromQuotationId($quotationId) {
    global $db;
    $query = "SELECT companies.* FROM quotations 
              INNER JOIN crmleads ON quotations.lead_id = crmleads.id
              INNER JOIN companies ON crmleads.company_id = companies.id 
              WHERE quotations.id = $quotationId";
    $row = $db->get_row($query);
    
    return $row;
}


function getUserDetailsFromUserId($userId) {
    global $db;
    $query = "SELECT * FROM users WHERE id = $userId";
    $row = $db->get_row($query);
    
    return $row;
}

function updateUserProfile($userId, $name, $email, $password = null) {
    global $db;
    
    // Validate inputs
    if (empty($name) || empty($email)) {
        return false;
    }
    
    // Prepare update data
    $updateData = [
        'name' => $name,
        'email' => $email,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    // Handle password update if provided
    if (!empty($password)) {
        $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
    
    // Update database
    $result = $db->update('users', $updateData, ['id' => $userId]);
    
    return $result;
}


function getAttributeTypeById($attrbuteId) {
    global $db;
    $query = "SELECT * FROM attribute_types WHERE id = '$attrbuteId'";
    $row = $db->get_row($query);
    
    return $row;
}

function crm_send_email($to, $subject, $body) {
    $headers = "From: CRM System <noreply@e2ccloud.com>\r\n" .
               "Reply-To: noreply@e2ccloud.com\r\n" .
               "X-Mailer: PHP/" . phpversion();
               
    // Log to a local file for development verification
    $logFile = ROOT_PATH . 'mail.log';
    $logEntry = "[" . date('Y-m-d H:i:s') . "] To: $to | Subject: $subject\nBody:\n$body\n" . str_repeat('-', 40) . "\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND);
    
    return @mail($to, $subject, $body, $headers);
}
