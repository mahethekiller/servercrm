<?php
require_once '../../config.php';
$db = new DB();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $quoteId = intval($_GET['id']);
    
    // Get original quotation
    $quote = $db->get_row("SELECT * FROM quotations WHERE id = $quoteId");
    if ($quote) {
        // Clone quotation record, setting status to 'upgrade'
        $newQuoteData = [
            'lead_id'          => $quote['lead_id'],
            'company_id'       => $quote['company_id'],
            'added_by'         => $_SESSION['user']['id'],
            'description'      => $quote['description'] . ' (Upgrade from Quote #' . $quoteId . ')',
            'antivirus_backup' => $quote['antivirus_backup'],
            'location'         => $quote['location'],
            'server_type'      => $quote['server_type'],
            'otc'              => $quote['otc'],
            'sub_total'        => $quote['sub_total'],
            'quotation_status' => 'upgrade',
            'status'           => 1
        ];
        
        if ($db->insert('quotations', $newQuoteData)) {
            $newQuoteId = $db->lastid();
            
            // Clone quote_details
            $details = $db->get_results("SELECT * FROM quote_details WHERE quotation_id = $quoteId");
            if ($details) {
                foreach ($details as $row) {
                    $newDetailData = [
                        'quotation_id'   => $newQuoteId,
                        'product_id'     => $row['product_id'],
                        'attribute_type' => $row['attribute_type'],
                        'attribute_id'   => $row['attribute_id'],
                        'reg_price'      => $row['reg_price'],
                        'unit'           => $row['unit'],
                        'sale_price'     => $row['sale_price'],
                        'total_price'    => $row['total_price'],
                        'custom_details' => $row['custom_details'],
                        'added_date'     => date('Y-m-d H:i:s')
                    ];
                    $db->insert('quote_details', $newDetailData);
                }
            }
            
            header("Location: " . BASE_URL . "admin/quotations/index.php?status=upgrade&msg=Quotation converted to Upgrade successfully.");
            exit;
        }
    }
}
header("Location: " . BASE_URL . "admin/quotations/index.php");
exit;
