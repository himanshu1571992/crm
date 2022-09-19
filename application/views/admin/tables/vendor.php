<?php

defined('BASEPATH') or exit('No direct script access allowed');

$sTable = 'tblvendor';

$aColumns = [
//    '`id`',
    '`id`',
    '`added_by`',
    '`name`',
    '`id`',
    '`email`',
    '`description`',
    '`status`',
    '`audit_status`',
    '`created_at`',
];

$sIndexColumn = 'id';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $aRow['id'];
    $row[] = ($aRow['added_by'] > 0) ? get_employee_fullname($aRow['added_by']) : 'N/A';

    $url_edit = admin_url('vendor/vendor/' . $aRow['id']);
    $url = admin_url('vendor/vendor_profile/' . $aRow['id']);

    $name_html = '<a target="_blank" href="' . $url . '">' . cc($aRow['name']) . '</a>';
    $name_html .= '<div class="row-options">';
    $name_html .= '<a href="' . $url_edit . '">' . _l('edit') . '</a>';
     if(check_permission_page(91,'delete') ){
    $name_html .= ' | <a href="' . admin_url('vendor/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    $name_html .= '</div>';

    $row[] = $name_html;

    // vendor id
    $row[] = "VEND-" . str_pad($aRow['id'], 6, '0', STR_PAD_LEFT);

    // Location
    $row[] = $aRow['description'];
    $row[] = $aRow['email'];

    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';

    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'vendor/change_vendor_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;

    $row[] = ($aRow['audit_status'] == 1) ? "<a href='javascript:void(0);' data-id='". $aRow['id'] ."' class='btn-sm btn-success auditstatus'>Update Status</a>": "<a href='javascript:void(0);' data-id='". $aRow['id'] ."' class='btn-sm btn-info auditstatus'>Set Status</a>";
    // date added
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
