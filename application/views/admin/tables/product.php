<?php

defined('BASEPATH') or exit('No direct script access allowed');

$sTable = 'tblproducts_old';

$aColumns = [
//    '`id`',
    'tblproducts_old.id as `id`',
    'tblproducts_old.name as `name`',
    'tblproducts_old.id as `id`',
    'tblunitmaster.name as `unit_name`',
    'tblproducts_old.hsn_code as `hsn_code`',
    'tblproducts_old.sac_code as `sac_code`',
    'tblproducts_old.photo as `photo`',
    'tblproducts_old.status as `status`',
    'tblproducts_old.created_at as `created_at`',
];

$sIndexColumn = 'id';

$join = [
    'LEFT JOIN tblunitmaster ON tblunitmaster.`id` = '.'tblproducts_old.`unit_id`',
];

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $aRow['id'];
    
    //$url = admin_url('product_new/view/' . $aRow['id']);
    $detail_url = admin_url('product_new/product_used/' . $aRow['id']);

    $name_html = '<a href="' . $url . '">' . $aRow['name'] . '</a>';
    $name_html .= '<div class="row-options">';
    //$name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    //$name_html .= ' | <a target="_blank" href="' . $detail_url . '">Details</a>';
    if(check_permission_page(2,'delete') ){
        //$name_html .= ' | <a href="' . admin_url('product/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    
    $name_html .= '</div>';

    $row[] = $name_html;
    
    // Product id
  //  $row[] = "PROD-ID" . $aRow['id'];
    $row[] = "PRO - " . number_series($aRow['id']);

    // Unit Name
    $row[] = $aRow['unit_name'];

    // HSN Code
    $row[] = $aRow['hsn_code'];

    // SAC Code
    $row[] = $aRow['sac_code'];
    
    // image
    $url = base_url('assets/images/no_image_available.jpeg');
    if($aRow['photo'] != "") {
        $url = base_url('uploads/product') . "/" . $aRow['id'] . "/" . $aRow['photo'];
    }
    
    $row[] = '<img src="' . $url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="' . $aRow['name'] . '" />';
    
    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'product/change_product_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    
    // date added
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
