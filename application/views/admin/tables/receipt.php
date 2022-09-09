<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`name`',
    '`bank_name`',
    '`account_no`',
    '`ifsc_code`'
];

$sIndexColumn = 'id';
$sTable = 'tblreceiptmaster';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    $row[] = $aRow['id'];
    
    $url = admin_url('settings?group=receipt&id=' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['name']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    
    $user_name_html .= '</div>';

    $row[] = $user_name_html;
    $row[] = $aRow['bank_name'];
    $row[] = $aRow['account_no'];
    $row[] = $aRow['ifsc_code'];
    
    $output['aaData'][] = $row;
}
