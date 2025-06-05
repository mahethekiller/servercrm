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
