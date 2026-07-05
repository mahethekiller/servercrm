<?php

require_once '../../../includes/class.db.php';

$db = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['operation']) && $_GET['operation'] === 'edit_product') {
    $productId   = intval($_GET['product_id']);   // sanitize
    $quotationId = intval($_GET['quotation_id']); // sanitize

    // Build table HTML
    $tableHtml = '
    <form id="editProductForm">
    <input type="hidden" name="quotation_id" value="'.$quotationId.'"> <!-- dynamically set -->
    <table class="table table-condensed table-bordered">
        <thead>
            <tr>
                <th>Commercial Details</th>
                <th>Reg Price</th>
                <th>Select Unit</th>
                <th>Sale Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';

    // Fetch active attribute types
    $typesQuery  = "SELECT * FROM attribute_types WHERE status = 1";
    $typesResult = $db->get_results($typesQuery);

    foreach ($typesResult as $type) {
        $typeId   = $type['id'];
        $typeName = htmlspecialchars($type['name'], ENT_QUOTES);

        // Fetch all attributes for this type
        $attributesQuery  = "SELECT * FROM attributes WHERE attribute_type = $typeId AND status = 'active'";
        $attributesResult = $db->get_results($attributesQuery);

        // Fetch existing quote_details row (if any) for this product, type and quotation
        $quoteQuery = "SELECT * FROM quote_details 
                       WHERE product_id = $productId 
                         AND quotation_id = $quotationId 
                         AND attribute_type = $typeId
                       LIMIT 1";
        $quoteRow = $db->get_row($quoteQuery);

        $selectedAttr  = $quoteRow ? $quoteRow['attribute_id'] : '';
        $regPrice      = $quoteRow ? $quoteRow['reg_price'] : 0;
        $unit          = $quoteRow ? $quoteRow['unit'] : 1;
        $salePrice     = $quoteRow ? $quoteRow['sale_price'] : 0;
        $totalPrice    = $quoteRow ? $quoteRow['total_price'] : 0;

        $tableHtml .= '<tr>';
        $tableHtml .= '<td>' . $typeName . '* 
            <select class="form-control attr-select" 
                    id="attribute_' . $productId . '_' . $typeId . '" 
                    name="products[' . $productId . '][' . $typeId . '][attribute_id]" 
                    data-type="' . $typeId . '">
                <option value="">Select</option>';

        foreach ($attributesResult as $attr) {
            $attrId    = $attr['id'];
            $attrName  = htmlspecialchars($attr['attribute_name'], ENT_QUOTES);
            $attrPrice = $attr['price'];
            $isSelected = ($selectedAttr == $attrId) ? 'selected' : '';

            $tableHtml .= '<option value="' . $attrId . '" data-price="' . $attrPrice . '" ' . $isSelected . '>' . $attrName . '</option>';
        }

        $tableHtml .= '</select></td>';

        // Input prefix
        $namePrefix = "products[$productId][$typeId]";

        $tableHtml .= '<td><input type="text" class="form-control reg-price" name="' . $namePrefix . '[reg_price]" value="' . $regPrice . '" readonly></td>';

        // Unit dropdown
        $tableHtml .= '<td>
            <select class="form-control unit-select" name="' . $namePrefix . '[unit]">';
        for ($i = 1; $i <= 10; $i++) {
            $sel = ($unit == $i) ? 'selected' : '';
            $tableHtml .= '<option value="' . $i . '" ' . $sel . '>' . $i . '</option>';
        }
        $tableHtml .= '</select>
        </td>';

        $tableHtml .= '<td><input type="text" class="form-control sale-price" name="' . $namePrefix . '[sale_price]" value="' . $salePrice . '"></td>';

        $tableHtml .= '<td><input type="text" class="form-control total-price" name="' . $namePrefix . '[total]" value="' . $totalPrice . '" readonly></td>';

        $tableHtml .= '<td><button class="btn btn-xs btn-primary recalc-btn" type="button">Re-Calculate</button></td>';

        $tableHtml .= '</tr>';
    }

    $tableHtml .= '
        </tbody>
    </table>
     <button type="button" id="saveProductBtn" class="btn btn-success">Save</button>
</form>
    ';

    echo json_encode(['success' => true, 'data' => $tableHtml]);
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['products'], $_POST['quotation_id']) && $_POST['operation'] === 'save_product') {
    $quotationId = intval($_POST['quotation_id']);
    $products    = $_POST['products'];

    foreach ($products as $productId => $types) {
        foreach ($types as $typeId => $data) {
            $attributeId = intval($data['attribute_id']);
            $regPrice    = floatval($data['reg_price']);
            $unit        = intval($data['unit']);
            $salePrice   = floatval($data['sale_price']);
            $totalPrice  = floatval($data['total']);

            // Check if record exists
            $checkQuery = "SELECT id FROM quote_details 
                           WHERE quotation_id = $quotationId 
                             AND product_id = $productId 
                             AND attribute_type = $typeId 
                           LIMIT 1";
            $existing = $db->get_row($checkQuery);

            if ($existing) {
                // Update existing row
                $updateQuery = "UPDATE quote_details 
                                SET attribute_id = $attributeId,
                                    reg_price = $regPrice,
                                    unit = $unit,
                                    sale_price = $salePrice,
                                    total_price = $totalPrice
                                WHERE id = {$existing['id']}";
                $db->query($updateQuery);
            } else {
                // Insert new row
                $insertQuery = "INSERT INTO quote_details 
                                (quotation_id, product_id, attribute_type, attribute_id, reg_price, unit, sale_price, total_price) 
                                VALUES ($quotationId, $productId, $typeId, $attributeId, $regPrice, $unit, $salePrice, $totalPrice)";
                $db->query($insertQuery);
            }
        }
    }

    echo json_encode(['success' => true, 'message' => 'Product details updated successfully.']);
    exit;
}

