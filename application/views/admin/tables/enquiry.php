<?php

defined('BASEPATH') or exit('No direct script access allowed');

$sTable = 'tblenquiry';

$aColumns = [
//    '`id`',
    'tblenquiry.id as `id`',
    'tblenquiry.client_id as `client_id`',
    'tblenquiry.enquiry_date as `enquiry_date`',
    'tblclients.company as `company`',
    'tblenquiry.created_at as `created_at`',
    'tblenquiry.status as `status`',
   
];

$sIndexColumn = 'client_id';

$join = [
    'LEFT JOIN tblclients ON tblclients.`userid` = '.'tblenquiry.`client_id`',
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
    
    $url = admin_url('leads/leads/' . $aRow['id']);

    $name_html = '<a href="' . $url . '">ENQ-ID' . $aRow['id'] . '</a>';
    $name_html .= '<div class="row-options">';
    $name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    $name_html .= ' | <a href="' . admin_url('leads/deletelead/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    $name_html .= '</div>';
    $row[] = $name_html;
    $row[] =  $aRow['company'];
    $row[] = $aRow['enquiry_date'];
    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'product/change_product_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';
    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

   // $row[] = $toggleActive;
    
    // date added
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
