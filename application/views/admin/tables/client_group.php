<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`userid`',
    '`company`',
    '`client_branch_name`',
    '`location`',
    '`staff_group`',
    '`phone_no_1`',
];

$sIndexColumn = 'userid';
$sTable = 'tblclientbranch';


$jon = [];

$where = [
    " where staff_group != '' and followup = 1 ",
];

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $jon, $where);
$output = $result['output'];
$rResult = $result['rResult'];

$i = 1;
foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $i++;
    
    $url = admin_url('follow_up/allot_group/' . $aRow['userid']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['client_branch_name']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    
    $user_name_html .= '</div>';

    $row[] = $user_name_html;

    
    // Order
    $row[] = $aRow['location'];
    $row[] = $aRow['phone_no_1'];
    $row[] = get_groups_name($aRow['staff_group']);
      

    $output['aaData'][] = $row;
}
