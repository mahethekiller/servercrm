<?php
$pageTitle = 'Compute Details';
include '../../includes/header.php';
$db = new DB();

$company_id = intval($_GET['company_id'] ?? 0);
$company = $db->get_row("SELECT * FROM companies WHERE id = $company_id");
if (!$company) {
    echo "<div class='alert alert-danger'>Company not found.</div>";
    include '../../includes/footer.php';
    exit;
}

$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $node_name = trim($_POST['node_name'] ?? '');
    $private_ip = trim($_POST['private_ip'] ?? '');
    $public_ip = trim($_POST['public_ip'] ?? '');
    $server_name = trim($_POST['server_name'] ?? '');
    
    if (empty($node_name) || empty($private_ip) || empty($public_ip) || empty($server_name)) {
        $errorMsg = "All fields are required.";
    } else {
        $insertData = [
            'company_id'  => $company_id,
            'node_name'   => $node_name,
            'private_ip'  => $private_ip,
            'public_ip'   => $public_ip,
            'server_name' => $server_name
        ];
        
        if ($db->insert('compute_details', $insertData)) {
            // Check for Live or Upgrade quotation
            $hasLiveOrUpgrade = $db->get_var("SELECT count(*) FROM quotations WHERE company_id = $company_id AND quotation_status IN ('live', 'upgrade') AND status = 1");
            
            // Notify recipients
            $recipients = ['sales@e2ccloud.com', 'subject@e2ccloud.com'];
            if ($hasLiveOrUpgrade > 0) {
                $recipients[] = 'accounts@e2ccloud.com';
            }
            
            $subjectStr = "Compute Details Submitted for " . $company['name'];
            $body = "Compute details have been submitted:\n\n"
                  . "Company: " . $company['name'] . "\n"
                  . "Node Name: " . $node_name . "\n"
                  . "Private IP: " . $private_ip . "\n"
                  . "Public IP: " . $public_ip . "\n"
                  . "Server Name: " . $server_name . "\n";
                  
            foreach ($recipients as $toEmail) {
                crm_send_email($toEmail, $subjectStr, $body);
            }
            
            $successMsg = "Compute details saved and notifications sent successfully!";
        } else {
            $errorMsg = "Failed to save compute details.";
        }
    }
}

// Fetch existing compute details
$computeList = $db->get_results("SELECT * FROM compute_details WHERE company_id = $company_id ORDER BY id DESC") ?: [];
?>

<div class="row">
    <div class="col-md-5">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Compute Details for <?php echo htmlspecialchars($company['name']); ?></h3>
            </div>
            <div class="card-body">
                <?php if ($successMsg): ?>
                    <div class="alert alert-success"><?php echo $successMsg; ?></div>
                <?php endif; ?>
                <?php if ($errorMsg): ?>
                    <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="form-group mb-3">
                        <label for="node_name">Node Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="node_name" name="node_name" required placeholder="Node Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="private_ip">Private IP <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="private_ip" name="private_ip" required placeholder="Private IP Address">
                    </div>
                    <div class="form-group mb-3">
                        <label for="public_ip">Public IP <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="public_ip" name="public_ip" required placeholder="Public IP Address">
                    </div>
                    <div class="form-group mb-3">
                        <label for="server_name">Server Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="server_name" name="server_name" required placeholder="Server Name">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Submit Compute Details</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Existing Compute Configurations</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Node Name</th>
                            <th>Private IP</th>
                            <th>Public IP</th>
                            <th>Server Name</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($computeList)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">No compute configurations found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($computeList as $compute): ?>
                                <tr>
                                    <td><?php echo $compute['id']; ?></td>
                                    <td><?php echo htmlspecialchars($compute['node_name']); ?></td>
                                    <td><?php echo htmlspecialchars($compute['private_ip']); ?></td>
                                    <td><?php echo htmlspecialchars($compute['public_ip']); ?></td>
                                    <td><?php echo htmlspecialchars($compute['server_name']); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($compute['created_at']))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include '../../includes/footer.php';
?>
