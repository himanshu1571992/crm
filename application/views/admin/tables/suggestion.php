<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`added_by`',
    '`suggestion`',
    '`status`',
    '`created_at`',
];

$sIndexColumn = 'id';
$sTable = 'tblsuggestion';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $aRow['id'];
    $row[] = ($aRow['added_by'] > 0) ? get_employee_fullname($aRow['added_by']) : '--';
    
    $url = admin_url('follow_up/suggestion_add/' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['suggestion']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    if(check_permission_page('151,277','delete')){
        $user_name_html .= ' | <a href="' . admin_url('follow_up/delete_suggestion/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    $user_name_html .= '</div>';

    $row[] = $user_name_html;



    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'follow_up/change_suggestion_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    
    // date added
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
