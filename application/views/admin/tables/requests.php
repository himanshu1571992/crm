<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`category`',
    '`amount`',
    '`reason`',
    '`dateadded`'
];

$sIndexColumn = 'id';
$sTable = 'tblrequests';
$join = [];
//array_push($where, 'addedfrom = ' . );
$where = [
    'where addedfrom = '.get_staff_user_id().' and cancel = 0',
];

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
    'addedfrom'
]);

$output = $result['output'];
$rResult = $result['rResult'];

$i = 1;
foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $i++;
	
	$cat = get_last(get_request_category($aRow['category']));
	
	 $row[] = 'REQ-'.get_short($cat).'-'.number_series($aRow['id']);
    
    $url = admin_url('requests/request/' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . get_request_category($aRow['category']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('edit') . '</a>';
    $user_name_html .= ' | <a href="' . admin_url('requests/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    
    $user_name_html .= '</div>';

    $row[] = $user_name_html;

   
    // Order
    $row[] = $aRow['amount'];
	
	// Order
    $row[] = $aRow['reason'];
	
	
    // date added
    $row[] = _dt($aRow['dateadded']);
	
	// status
    $row[] = get_request_status($aRow['id']);
    
    

    $output['aaData'][] = $row;
}
