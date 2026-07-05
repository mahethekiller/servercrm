<?php
require_once '../../../includes/class.db.php';

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sof_id']) && $_POST['operation'] === 'delete_request') {
    $sofId   = intval($_POST['sof_id']);
    $remarks = $_POST['remarks'];

    $update = $db->update('quotations', [
        'requested_for_deletion' => 1,
        'deletion_remarks'       => $remarks,
    ], ['sof_id' => $sofId]);

    if ($update) {
        echo json_encode(['status' => 'success', 'message' => 'Deletion request submitted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => "There was some error"]);
    }
    exit;
}

if (isset($_GET['sof_id'])) {
    $sofId = intval($_GET['sof_id']);

    $row = $db->get_row("SELECT q.sof_id, c.name, c.email, c.phone
                        FROM quotations q
                        LEFT JOIN companies c ON q.company_id = c.id
                        WHERE q.sof_id = $sofId AND q.requested_for_deletion = 0 AND q.quotation_status !='deleted'");

    echo json_encode($row);
    exit;
}