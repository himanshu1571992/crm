<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
    '`id`',
    '`name`',
    '`enquiry_type_main_id`',
    '`color`',
    '`order`',
    '`status`',
    '`created_at`'
];

$sIndexColumn = 'id';
$sTable = 'tblenquirytypemaster';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];
    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // 
    
    $category = value_by_id_empty("tblmainenquirytypemaster", $aRow['enquiry_type_main_id'], "name");
    
    $row[] = $aRow['id'];
    
    $url = admin_url('enquirytype/enquirytype/' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['name']) . '</a>';
    
    
    

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    if(check_permission_page('11,239','delete') ){
    $user_name_html .= ' | <a href="' . admin_url('enquirytype/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    $user_name_html .= '</div>';

    $row[] = $user_name_html;

    if (!empty($category)){
        $row[] = '<a href="javascript:void(0);" class="btn-sm btn-success">' . cc($category) . '</a>';
    }else{
        $row[] = '<a href="javascript:void(0);" class="btn-sm btn-danger enquirytype_cls" data-id="'.$aRow['id'].'" data-toggle="modal" data-target="#myModal1">Not Set</a>';
    }
    
    // Color
    $row[] = $aRow['color'] . '&nbsp;&nbsp;&nbsp;<div style="height : 30px; width: 30px; background-color : ' . $aRow['color'] . '; border : 1px solid #000;"></div>';

    // Order
    $row[] = $aRow['order'];

    $checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'enquirytype/change_enquirytype_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    
    // date added
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
