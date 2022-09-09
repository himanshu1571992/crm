<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`designation`',
    '`color`',
    '`order`',
    '`status`',
    '`created_at`',
];

$sIndexColumn = 'id';
$sTable = 'tbldesignation';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    $row[] = $aRow['id'];
    
    $url = admin_url('designation/designation/' . $aRow['id']);
    $permission_url = admin_url('menu_master/designation_assign/' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['designation']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    $user_name_html .= ' | <a target="_blank" href="' . $permission_url . '">Set Permission</a>';
    if(check_permission_page('126,258','delete')){
    $user_name_html .= ' | <a href="' . admin_url('designation/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    $user_name_html .= '</div>';

    $row[] = $user_name_html;
    
    // Color
    $row[] = $aRow['color'] . '&nbsp;&nbsp;&nbsp;<div style="height : 30px; width: 30px; background-color : ' . $aRow['color'] . '; border : 1px solid #000;"></div>';

    // Order
    $row[] = $aRow['order'];

    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive designation
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'designation/change_designation_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;

    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
