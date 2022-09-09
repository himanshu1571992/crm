<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`name`',
    '`branch`',
    '`payment_type`',
    '`phone_no`',
    '`balance`',
    '`created_at`',
];

$sIndexColumn = 'id';
$sTable = 'tblbankmaster';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    $row[] = $aRow['id'];
    
    $url = admin_url('settings?group=bank&id=' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['name']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    $user_name_html .= ' | <a href="' . admin_url('Settings/deletebank/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    
    $user_name_html .= '</div>';

    $row[] = $user_name_html;
	$row[] = $aRow['branch'];
	$row[] = value_by_id("tblpaymenttypes", $aRow['payment_type'], "name");
    $row[] = $aRow['balance'];
    $row[] = $aRow['phone_no'];
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
