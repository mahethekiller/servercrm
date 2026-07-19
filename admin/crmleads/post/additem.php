<?php

require_once '../../../config.php';
$db = new DB();

if (isset($_GET['operation']) && $_GET['operation'] === 'add_product') {
    if (isset($_GET['product_id'])) {
        $productId = intval($_GET['product_id']);  // sanitize product id

        if ($productId === 3) {
            // Colocation
            $tableHtml = '
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
    <tbody>
        <tr>
            <td>
                <strong>Colocation Service</strong>
                <div class="mt-2 text-left align-left">
                    <label class="small text-muted mb-0">Data Center</label>
                    <input type="text" class="form-control coloc-dc mb-1" placeholder="Data Center Location" style="text-align: left;">
                    <label class="small text-muted mb-0">Server Details</label>
                    <textarea class="form-control coloc-details" rows="2" placeholder="Server Details" style="text-align: left;"></textarea>
                </div>
                <input type="hidden" name="products[3][1][attribute_id]" value="1">
                <input type="hidden" class="custom-details-json" name="products[3][1][custom_details]" value="{}">
            </td>
            <td><input type="text" class="form-control reg-price" name="products[3][1][reg_price]" value="0"></td>
            <td>
                <label class="small text-muted mb-0">Rack U</label>
                <select class="form-control unit-select" name="products[3][1][unit]">
                    <option value="1">1U</option>
                    <option value="2">2U</option>
                    <option value="3">3U</option>
                    <option value="4">4U</option>
                </select>
            </td>
            <td><input type="text" class="form-control sale-price" name="products[3][1][sale_price]" value="0"></td>
            <td><input type="text" class="form-control total-price" name="products[3][1][total]" value="0" readonly></td>
            <td><button class="btn btn-xs btn-primary recalc-btn" type="button">Re-Calculate</button></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" class="text-right p-2">
                <button type="button" class="btn btn-success btn-xs add-custom-row-btn" data-product-id="3">
                    <i class="fas fa-plus"></i> Add Custom Row
                </button>
            </td>
        </tr>
    </tfoot>
</table>
<span><button class="btn btn-danger remove-item" data-id="3">Remove</button></span>';
            echo json_encode(['success' => true, 'data' => $tableHtml]);
            exit;
        }

        if ($productId === 4) {
            // Email Service
            $tableHtml = '
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
    <tbody>
        <tr>
            <td>
                <strong>Email Service</strong>
                <div class="mt-2 text-left align-left">
                    <label class="small text-muted mb-0">Provider</label>
                    <select class="form-control email-provider mb-1" style="text-align: left;">
                        <option value="O365">Office 365</option>
                        <option value="GSuite">Google Workspace</option>
                    </select>
                    <label class="small text-muted mb-0">Pricing Model</label>
                    <select class="form-control email-model mb-1" style="text-align: left;">
                        <option value="per_price">Per Price</option>
                        <option value="select_unit">Select Unit</option>
                    </select>
                    <label class="small text-muted mb-0">Tax</label>
                    <input type="text" class="form-control email-tax" placeholder="Tax (e.g. 18%)" value="0" style="text-align: left;">
                </div>
                <input type="hidden" name="products[4][1][attribute_id]" value="1">
                <input type="hidden" class="custom-details-json" name="products[4][1][custom_details]" value="{}">
            </td>
            <td><input type="text" class="form-control reg-price" name="products[4][1][reg_price]" value="0"></td>
            <td>
                <label class="small text-muted mb-0">Users</label>
                <input type="number" class="form-control unit-select" name="products[4][1][unit]" value="1">
            </td>
            <td><input type="text" class="form-control sale-price" name="products[4][1][sale_price]" value="0"></td>
            <td><input type="text" class="form-control total-price" name="products[4][1][total]" value="0" readonly></td>
            <td><button class="btn btn-xs btn-primary recalc-btn" type="button">Re-Calculate</button></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" class="text-right p-2">
                <button type="button" class="btn btn-success btn-xs add-custom-row-btn" data-product-id="4">
                    <i class="fas fa-plus"></i> Add Custom Row
                </button>
            </td>
        </tr>
    </tfoot>
</table>
<span><button class="btn btn-danger remove-item" data-id="4">Remove</button></span>';
            echo json_encode(['success' => true, 'data' => $tableHtml]);
            exit;
        }

        if ($productId === 5) {
            // Backup Service
            $tableHtml = '
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
    <tbody>
        <tr>
            <td>
                <strong>Backup Service</strong>
                <div class="mt-2 text-left align-left">
                    <label class="small text-muted mb-0">Storage Type</label>
                    <select class="form-control backup-type mb-1" style="text-align: left;">
                        <option value="Acronis">Acronis</option>
                        <option value="Local">Local</option>
                    </select>
                    <label class="small text-muted mb-0">Unit Type</label>
                    <select class="form-control backup-unit-type" style="text-align: left;">
                        <option value="GB">GB</option>
                        <option value="TB">TB</option>
                    </select>
                </div>
                <input type="hidden" name="products[5][1][attribute_id]" value="1">
                <input type="hidden" class="custom-details-json" name="products[5][1][custom_details]" value="{}">
            </td>
            <td><input type="text" class="form-control reg-price" name="products[5][1][reg_price]" value="0"></td>
            <td>
                <label class="small text-muted mb-0">Storage Size</label>
                <input type="number" class="form-control unit-select" name="products[5][1][unit]" value="1">
            </td>
            <td><input type="text" class="form-control sale-price" name="products[5][1][sale_price]" value="0"></td>
            <td><input type="text" class="form-control total-price" name="products[5][1][total]" value="0" readonly></td>
            <td><button class="btn btn-xs btn-primary recalc-btn" type="button">Re-Calculate</button></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" class="text-right p-2">
                <button type="button" class="btn btn-success btn-xs add-custom-row-btn" data-product-id="5">
                    <i class="fas fa-plus"></i> Add Custom Row
                </button>
            </td>
        </tr>
    </tfoot>
</table>
<span><button class="btn btn-danger remove-item" data-id="5">Remove</button></span>';
            echo json_encode(['success' => true, 'data' => $tableHtml]);
            exit;
        }

        $tableHtml = '
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

            // Fetch active attributes for this type
            $attributesQuery  = "SELECT * FROM attributes WHERE attribute_type = $typeId AND status = 'active'";
            $attributesResult = $db->get_results($attributesQuery);

            $tableHtml .= '<tr>';
            $tableHtml .= '<td>' . $typeName . '* 
                <select class="form-control attr-select" id="attribute_' . $productId . '_' . $typeId . '" name="products[' . $productId . '][' . $typeId . '][attribute_id]" data-type="' . $typeId . '">
                    <option value="">Select</option>';

            foreach ($attributesResult as $attr) {
                $attrId = $attr['id'];
                $attrName = htmlspecialchars($attr['attribute_name'], ENT_QUOTES);
                $attrPrice = $attr['price'];

                $tableHtml .= '<option value="' . $attrId . '" data-price="' . $attrPrice . '">' . $attrName . '</option>';
            }

            $tableHtml .= '</select></td>';

            // Namespaced inputs by product and attribute type
            $namePrefix = "products[$productId][$typeId]";

            $tableHtml .= '<td><input type="text" class="form-control reg-price" name="' . $namePrefix . '[reg_price]" id="reg_price_' . $productId . '_' . $typeId . '" value="0" readonly></td>';

            $tableHtml .= '<td>
                <select class="form-control unit-select" name="' . $namePrefix . '[unit]" id="unit_' . $productId . '_' . $typeId . '">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </td>';

            $tableHtml .= '<td><input type="text" class="form-control sale-price" name="' . $namePrefix . '[sale_price]" id="sale_price_' . $productId . '_' . $typeId . '" value="0"></td>';

            $tableHtml .= '<td><input type="text" class="form-control total-price" name="' . $namePrefix . '[total]" id="total_' . $productId . '_' . $typeId . '" value="0" readonly></td>';

            $tableHtml .= '<td><button class="btn btn-xs btn-primary recalc-btn" type="button">Re-Calculate</button></td>';

            $tableHtml .= '</tr>';
            
        }

        

        $tableHtml .= '
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" class="text-right p-2">
                <button type="button" class="btn btn-success btn-xs add-custom-row-btn" data-product-id="' . $productId . '">
                    <i class="fas fa-plus"></i> Add Custom Row
                </button>
            </td>
        </tr>
    </tfoot>
</table>
    <span><button class="btn btn-danger remove-item" data-id="' . $productId . '">Remove</button></span>



';

        echo json_encode(['success' => true, 'data' => $tableHtml]);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing product_id parameter.']);
        exit;
    }
}


if (isset($_GET['operation']) && $_GET['operation'] === 'add_product2') {
    // Check if the necessary GET parameters are set
    if (isset($_GET['product_id'])) {
        $id = $_GET['product_id'];

        $fields = '
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
                <tbody>
                    <tr>
                        <td>V CPU*
                        <select class="form-control"><option>Select Option</option></select>
                        </td>
                        <td><input type="text" class="form-control" value="1800" readonly></td>
                        <td><select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-primary">Re-Calculate</button></td>
                    </tr>
                    <tr>
                        <td>RAM* <select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="500" readonly></td>
                        <td><select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-primary">Re-Calculate</button></td>
                    </tr>
                    <tr>
                        <td>HDD* <select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="25" readonly></td>
                        <td><select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-primary">Re-Calculate</button></td>
                    </tr>
                    <tr>
                        <td>HDD2 (Optional)* <select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="25" readonly></td>
                        <td><select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-primary">Re-Calculate</button></td>
                    </tr>
                    <tr>
                        <td>Data Base* <select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="MySQL" readonly></td>
                        <td ><select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-primary">Re-Calculate</button></td>
                    </tr>
                    <tr>
                        <td>Operating System* <select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="CentOS 7.0" readonly></td>
                        <td ><select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-primary">Re-Calculate</button></td>
                    </tr>
                    <tr>
                        <td>IP Address* <select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="500" readonly></td>
                        <td ><select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-primary">Re-Calculate</button></td>
                    </tr>
                    <tr>
                        <td>Bandwidth* <select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="18" readonly></td>
                        <td ><select class="form-control"><option>Select Option</option></select></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><input type="text" class="form-control" value="0"></td>
                        <td><button class="btn btn-primary">Re-Calculate</button></td>
                    </tr>
                    <tr>
                        <td>Antivirus/Backup</td>
                        <td colspan="5">
                            <label><input type="radio" name="antivirus_backup" value="No"> No</label>
                            <label><input type="radio" name="antivirus_backup" value="Yes"> Yes</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Server Description</td>
                        <td colspan="5"><input type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <td>Location*</td>
                        <td colspan="5"><input type="text" class="form-control" value="Noida" readonly></td>
                    </tr>
                    <tr>
                        <td>Server Type</td>
                        <td colspan="5"><input type="text" class="form-control" value="Virtual" readonly></td>
                    </tr>
                </tbody>
                <tfoot><span><button class="btn btn-danger remove-item" data-id="' . $id . '">Remove</button></span></tfoot>
            </table>
            
            
        ';

        if ($fields) {
            echo json_encode(['success' => true, 'data' => $fields]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No data found.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Missing parameter.']);
    }
}
