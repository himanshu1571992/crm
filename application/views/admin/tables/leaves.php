<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`category`',
    '`from_date`',
    '`to_date`',
    '`total_days`',
    '`reason`',
    '`dateadded`'
];

$sIndexColumn = 'id';
$sTable = 'tblleaves';
$join = [];
//array_push($where, 'addedfrom = ' . );
$where = [
    'where addedfrom = '.get_staff_user_id().'',
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
	
	$row[] = 'LEA-'.number_series($aRow['id']);
    
    $url = admin_url('leaves/leave/' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . get_leave_category($aRow['category']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    if(check_permission_page(59,'edit')){
    $user_name_html .= '<a href="' . $url . '">' . _l('edit') . '</a>';
    }   
    if(check_permission_page(59,'delete')){
    $user_name_html .= ' | <a href="' . admin_url('leaves/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }

    $user_name_html .= '</div>';

    $row[] = $user_name_html;

   
	
	 // date added
	$row[] = date('d/m/Y',strtotime($aRow['from_date']));
	 // date added
	$row[] = date('d/m/Y',strtotime($aRow['to_date']));
	
	 // Order
    $row[] = $aRow['total_days'];
	
	// Order
    $row[] = $aRow['reason'];
	
	
   
	
	// status
    $row[] = get_leave_status($aRow['id']);
    
    

    $output['aaData'][] = $row;
}
