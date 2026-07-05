<?php
require_once '../../config.php';
require_once '../../includes/functions.php';

if (!is_logged_in()) {
    header('Location: ' . BASE_URL);
    exit;
}

// Check if request is AJAX
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
          strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['status' => 'error', 'message' => ''];
    
    try {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');

        // Server-side validation
        if (empty($name) || empty($email)) {
            throw new Exception('Name and email are required');
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }
        
        if (!empty($password) && $password !== $confirm_password) {
            throw new Exception('Passwords do not match');
        }

        // Update profile
        $success = updateUserProfile(
            $_SESSION['user']['id'],
            $name,
            $email,
            empty($password) ? null : $password
        );

        if (!$success) {
            throw new Exception('Failed to update profile');
        }

        // Update session data
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        
        $response = [
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'redirect' => BASE_URL . 'profile.php'
        ];

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        $_SESSION[$response['status']] = $response['message'];
        header('Location: ' . ($response['status'] === 'success' ? $response['redirect'] : BASE_URL . 'profile/edit.php'));
        exit;
    }
}

// If not POST request, redirect to profile
header('Location: ' . BASE_URL . 'profile.php');
exit;
