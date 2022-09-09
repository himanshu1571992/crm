<?php

defined('BASEPATH') or exit('No direct script access allowed');

$sTable = 'tblproducts';

$aColumns = [
//    '`id`',
    'tblproducts.id as `id`',
    'tblproducts.name as `name`',
    'tblproducts.id as `id`',
    'tblunitmaster.name as `unit_name`',
    'tblproducts.photo as `photo`',
    'tblproducts.status as `status`',
    'tblproducts.created_at as `created_at`',
];

$sIndexColumn = 'id';

$join = [
    'LEFT JOIN tblunitmaster ON tblunitmaster.`id` = '.'tblproducts.`unit_id`',
];
$where  = [];
array_push($where, ' AND tblproducts.is_approved= 0');
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $aRow['id'];
    
    $url = admin_url('product_new/product/' . $aRow['id']);
    $detail_url = admin_url('product_new/product_used/' . $aRow['id']);

    $name_html = '<a href="' . $url . '">' . cc($aRow['name']) . '</a>';
    $name_html .= '<div class="row-options">';
    $name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    if(is_admin() == 1){
        $name_html .= ' | <a target="_blank" href="' . $detail_url . '">Details</a>';
    }
    
    if(check_permission_page(2,'delete') ){
        $name_html .= ' | <a href="' . admin_url('product_new/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    
    $name_html .= '</div>';

    $row[] = $name_html;
    
    // Product id
  //  $row[] = "PROD-ID" . $aRow['id'];
    $row[] = "PRO - " . number_series($aRow['id']);

    // Unit Name
    $row[] = $aRow['unit_name'];
    
    // image
    $url = base_url('assets/images/no_image_available.jpeg');
    if($aRow['photo'] != "") {
        $url = base_url('uploads/product') . "/" . $aRow['photo'];
    }
    
    $row[] = '<img src="' . $url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="' . cc($aRow['name']) . '" />';
    
    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'product_new/change_product_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    
    // date added
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
