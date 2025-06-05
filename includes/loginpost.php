<?php
require './class.db.php';

$db = new DB();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $db->filter($_POST['username']);
    $password = $db->filter($_POST['password']);

    $user = $db->get_row("SELECT * FROM users WHERE username = '$username'");

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user'] = [
            'id'       => $user['id'],
            'username' => $user['username'],
            'name'     => $user['name'],
            'role'     => $user['role'],
        ];

        echo "true";
    } else {
        echo "false";
    }
}
