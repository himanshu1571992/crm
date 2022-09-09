<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`igst`',
    '`cgst`',
    '`sgst`',
    '`status`',
    '`created_at`',
];

$sIndexColumn = 'id';
$sTable = 'tblgst';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $aRow['id'];
    
    $url = admin_url('gst/gst/' . $aRow['id']);

    $name_html = '<a href="' . $url . '">' . $aRow['igst'] . '</a>';
    $name_html .= '<div class="row-options">';
    $name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    $name_html .= ' | <a href="' . admin_url('gst/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    $name_html .= '</div>';

    $row[] = $name_html;

    // CGST
    $row[] = $aRow['cgst'];

    // SGST
    $row[] = $aRow['sgst'];

    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'gst/change_gst_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    
    // date added
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
