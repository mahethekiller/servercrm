<?php

require '../../../config.php';

// Create/Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $db->filter($_POST);

    // Basic validation
    if (empty($data['name']) || empty($data['email']) || empty($data['gender']) || empty($data['username']) || empty($data['role'])) {
        echo json_encode(['type' => 'danger', 'message' => 'All fields are required.']);
        exit;
    }

    // Email validation
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['type' => 'danger', 'message' => 'Invalid email address.']);
        exit;
    }

    $id = !empty($data['id']) ? intval($data['id']) : 0;

    // Check for duplicate email or username
    $conditions = "email = '{$data['email']}' OR username = '{$data['username']}'";
    if ($id) {
        $conditions .= " AND id != $id";
    }
    $exists = $db->get_row("SELECT * FROM users WHERE $conditions");
    if ($exists) {
        $field = ($exists['email'] === $data['email']) ? 'Email' : 'Username';
        echo json_encode(['type' => 'danger', 'message' => "$field already exists."]);
        exit;
    }

    if ($id) {
        unset($data['id'], $data['password']);
        $update = $db->update('users', $data, ['id' => $id]);
        echo json_encode(['type' => $update ? 'success' : 'danger', 'message' => $update ? 'User updated' : 'Failed to update']);
    } else {
        // Validate password
        if (empty($data['password']) || strlen($data['password']) < 6) {
            echo json_encode(['type' => 'danger', 'message' => 'Password must be at least 6 characters.']);
            exit;
        }
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $insert = $db->insert('users', $data);
        echo json_encode(['type' => $insert ? 'success' : 'danger', 'message' => $insert ? 'User added' : 'Failed to add user']);
    }
    exit;
}

// Delete
if (!empty($_POST['delete_id'])) {
    $id = $db->filter($_POST['delete_id']);
    $del = $db->delete('users', ['id' => $id]);
    echo json_encode(['type' => $del ? 'success' : 'danger', 'message' => $del ? 'User deleted' : 'Delete failed']);
    exit;
}

// Fetch single user
if (!empty($_GET['id'])) {
    $id = $db->filter($_GET['id']);
    $user = $db->get_row("SELECT * FROM users WHERE id = $id");
    echo json_encode($user);
    exit;
}

// List all users
if (isset($_GET['list'])) {
    $users = $db->get_results("SELECT * FROM users ORDER BY id DESC");
    echo json_encode($users);
    exit;
}

?>
