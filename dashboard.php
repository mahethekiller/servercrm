<?php
require_once 'config.php';

if (!is_logged_in()) {
    header('Location: index.php');
    exit;
}

$role = $_SESSION['user']['role'];

if ($role === 'admin') {
    header('Location: admin.php');
} else {
    header('Location: user.php');
}
exit;