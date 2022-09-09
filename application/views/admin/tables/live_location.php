<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`user_id`',
    '`title`',
    '`location`',
    '`status`',
    '`view_status`',
    '`created_at`',
];

$sIndexColumn = 'id';
$sTable = 'tblemployeelocations';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];
$c = 1;
foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $c++;
	
	
	if (strlen($aRow['location']) > 30){
		$location = substr($aRow['location'], 0, 25) . '...';
	}else{
		$location = $aRow['location'];
	}
	
    
    $url = admin_url('live_location/add_location/' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . $location . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('edit') . '</a>';

    if(check_permission_page('143,275','delete') ){
    $user_name_html .= ' | <a href="' . admin_url('live_location/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    $user_name_html .= '</div>';

    $row[] = $user_name_html;

    // title
	if($aRow['title'] != ''){
		$title = $aRow['title'];
	}else{
		$title = '--';
	}
    $row[] = $title;

    // Added by
    $row[] = get_employee_name($aRow['user_id']);

    $checked = ($aRow['view_status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'live_location/change_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['view_status'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    

    $output['aaData'][] = $row;
}
