<?php
require_once 'includes/class.db.php';

$db = new DB();

// Check if column custom_contacts exists
$checkQuery = "SHOW COLUMNS FROM companies LIKE 'custom_contacts'";
$column = $db->get_row($checkQuery);

if (!$column) {
    // Add column
    $alterQuery = "ALTER TABLE companies ADD COLUMN custom_contacts TEXT NULL AFTER lead_value";
    if ($db->query($alterQuery)) {
        echo "Migration successful: Column 'custom_contacts' added to 'companies' table.\n";
    } else {
        echo "Migration failed: Unable to add column.\n";
    }
} else {
    echo "Migration skipped: Column 'custom_contacts' already exists in 'companies' table.\n";
}
