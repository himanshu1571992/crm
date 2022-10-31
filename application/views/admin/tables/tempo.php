<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`added_by`',
    '`name`',
    '`number`',
    '`driver_id`',
    '`order`',
    '`status`',
    '`created_at`',
];

$sIndexColumn = 'id';
$sTable = 'tbltempo';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];

$i = 1;
foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $i++;
    $row[] = ($aRow['added_by'] > 0) ? get_employee_fullname($aRow['added_by']) : 'N/A';
    $url = admin_url('expenses/add_tempo/' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . $aRow['name'] . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    if(check_permission_page('141,273','delete') ){
    $user_name_html .= ' | <a href="' . admin_url('expenses/delete_tempo/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    $user_name_html .= '</div>';

    $row[] = $user_name_html;

    
    // Order
    $row[] = (!empty($aRow['number'])) ? $aRow['number'] : '--';
    $row[] = (!empty($aRow['driver_id'])) ? get_employee_name($aRow['driver_id']) : '--';
    $row[] = $aRow['order'];

    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'expenses/change_tempo_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;

    $file_info = $this->ci->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$aRow['id']."' and rel_type = 'tempo' ")->result();
    $files = '';
    if(!empty($file_info)){
        foreach ($file_info as $file) {
            $files .= '<a download href="'.site_url('uploads/tempo/'.$aRow['id'].'/'.$file->file_name).'">'.$file->file_name.'</a><br>';
        }
    }else{
        $files = '--';
    }
    
    // date added
    $row[] = $files;
    $row[] = _d($aRow['created_at']);
    $output['aaData'][] = $row;
}
