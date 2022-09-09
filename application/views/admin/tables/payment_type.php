<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`name`',
    '`created_at`',
];

$sIndexColumn = 'id';
$sTable = 'tblpaymenttypes';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);

$output = $result['output'];
$rResult = $result['rResult'];
$i = 0;
foreach ($rResult as $aRow) {
    $row = [];

    $row[] = ++$i;
    
    $url = admin_url('settings?group=paymenttype&id=' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['name']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    $user_name_html .= ' | <a href="' . admin_url('Settings/deletepaymenttype/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    
    $user_name_html .= '</div>';

    $row[] = $user_name_html;
    $row[] = _dt($aRow['created_at']);

    $output['aaData'][] = $row;
}
