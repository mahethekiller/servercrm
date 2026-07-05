<?php
$pageTitle = 'Company Documents';
include '../../includes/header.php';
$db = new DB();

$company_id = intval($_GET['company_id'] ?? 0);
$company = $db->get_row("SELECT * FROM companies WHERE id = $company_id");
if (!$company) {
    echo "<div class='alert alert-danger'>Company not found.</div>";
    include '../../includes/footer.php';
    exit;
}

// Check if company is Live (has a Live/Upgrade quotation)
$hasLiveOrUpgrade = $db->get_var("SELECT count(*) FROM quotations WHERE company_id = $company_id AND quotation_status IN ('live', 'upgrade') AND status = 1");

$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['doc_file'])) {
    if ($hasLiveOrUpgrade <= 0) {
        $errorMsg = "Documents can only be uploaded for Live/Upgrade companies.";
    } else {
        $contact_name = trim($_POST['contact_name'] ?? '');
        $file = $_FILES['doc_file'];
        
        if (empty($contact_name)) {
            $errorMsg = "Contact Name is required.";
        } elseif ($file['error'] !== UPLOAD_ERR_OK) {
            $errorMsg = "Failed to upload file. Error code: " . $file['error'];
        } else {
            // Ensure uploads directory exists
            $uploadDir = ROOT_PATH . 'uploads/documents/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
            $safeFileName = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '', pathinfo($file['name'], PATHINFO_FILENAME)) . '.' . $fileExt;
            $destination = $uploadDir . $safeFileName;
            
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $insertData = [
                    'company_id'   => $company_id,
                    'contact_name' => $contact_name,
                    'file_name'    => $file['name'],
                    'file_path'    => 'uploads/documents/' . $safeFileName
                ];
                
                if ($db->insert('company_documents', $insertData)) {
                    $successMsg = "Document uploaded successfully!";
                    
                    // Fetch Salesperson email
                    $lead = $db->get_row("SELECT * FROM crmleads WHERE company_id = $company_id ORDER BY id DESC LIMIT 1");
                    $salespersonEmail = 'sales@e2ccloud.com'; // fallback
                    $salespersonName = 'Sales Team';
                    
                    if ($lead) {
                        $salesperson = getUserDetailsFromUserId($lead['added_by']);
                        if ($salesperson && !empty($salesperson['email'])) {
                            $salespersonEmail = $salesperson['email'];
                            $salespersonName = $salesperson['name'];
                        }
                    }
                    
                    // Trigger email notification to Salesperson and Partner
                    $partnerEmail = 'partner@e2ccloud.com'; // default partner contact
                    
                    $subjectStr = "New Document Uploaded for " . $company['name'];
                    $body = "A new document has been uploaded for a Live company:\n\n"
                          . "Company: " . $company['name'] . "\n"
                          . "Contact Name: " . $contact_name . "\n"
                          . "File Name: " . $file['name'] . "\n"
                          . "Uploaded At: " . date('Y-m-d H:i:s') . "\n\n"
                          . "The file is stored at: " . BASE_URL . $insertData['file_path'] . "\n";
                    
                    // Send notification to Salesperson
                    crm_send_email($salespersonEmail, $subjectStr, $body);
                    
                    // Send notification to Partner
                    crm_send_email($partnerEmail, $subjectStr, $body);
                    
                } else {
                    unlink($destination); // delete file if DB insert fails
                    $errorMsg = "Failed to register document in database.";
                }
            } else {
                $errorMsg = "Failed to move uploaded file to destination folder.";
            }
        }
    }
}

// Fetch list of documents for this company
$documents = $db->get_results("SELECT * FROM company_documents WHERE company_id = $company_id ORDER BY id DESC") ?: [];
?>

<div class="row">
    <div class="col-md-5">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Upload Document</h3>
            </div>
            <div class="card-body">
                <?php if ($hasLiveOrUpgrade <= 0): ?>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle-fill"></i> Uploading is restricted. This company does not have an active <strong>Live</strong> or <strong>Upgrade</strong> quotation.
                    </div>
                <?php else: ?>
                    <?php if ($successMsg): ?>
                        <div class="alert alert-success"><?php echo $successMsg; ?></div>
                    <?php endif; ?>
                    <?php if ($errorMsg): ?>
                        <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
                    <?php endif; ?>

                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="contact_name">Contact Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" id="contact_name" name="contact_name" required placeholder="Associated Contact Name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="doc_file">Select Document File <span style="color:red">*</span></label>
                            <input type="file" class="form-control" id="doc_file" name="doc_file" required>
                            <small class="text-muted">Allowed files: PDF, DOC, DOCX, XLS, XLSX, PNG, JPG</small>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Upload & Notify</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Uploaded Documents List</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Contact Name</th>
                            <th>File Name</th>
                            <th>Upload Date</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($documents)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">No documents uploaded yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($documents as $doc): ?>
                                <tr>
                                    <td><?php echo $doc['id']; ?></td>
                                    <td><?php echo htmlspecialchars($doc['contact_name']); ?></td>
                                    <td><?php echo htmlspecialchars($doc['file_name']); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y H:i', strtotime($doc['uploaded_at']))); ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL . $doc['file_path']; ?>" target="_blank" class="btn btn-xs btn-primary">
                                            <i class="bi bi-download"></i> View / Download
                                        </a>
                                    </td>
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
