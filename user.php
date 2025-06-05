<?php
require_once 'config.php';
require_once 'includes/menu.php';

if (!is_logged_in() || $_SESSION['user']['role'] !== 'user') {
    die('Access denied');
}

include 'includes/header.php';
echo "<h1>User Dashboard</h1>";
display_menu('user');
echo '<br><a href="logout.php">Logout</a>';
include 'includes/footer.php';