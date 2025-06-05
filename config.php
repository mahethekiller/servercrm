<?php
session_start();
require_once __DIR__ . '/includes/class.db.php';
$db = new DB();
require_once __DIR__ . '/includes/functions.php';

define('BASE_URL', 'http://localhost/crm/');
define('APP_NAME', 'Customer Relationship Management (CRM)');
define('ROOT_PATH', __DIR__ . '/');

define('DEBUG', true);

if (DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function is_logged_in()
{
    return isset($_SESSION['user']);
}
