<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
//    '`id`',
    '`id`',
    '`name`',
    '`status`'
];

$sIndexColumn = 'id';
$sTable = 'tblpaymentmethod';

$result = data_tables_init($aColumns, $sIndexColumn, $sTable);
$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    if($aRow['status'] == 0){
        $status = 'Inactive';
        $cls = 'btn-danger';
    }elseif($aRow['status'] == 1){
        $status = 'Active';
        $cls = 'btn-success';
    }
    $row = [];

    $row[] = $aRow['id'];
    $row[] = cc($aRow['name']);
    
    $url = admin_url('settings?group=payment_method&id=' . $aRow['id']);
    $user_name_html = '<a href="' . $url . '">' . 'Edit' . '</a>';

    $row[] ='<button type="button" class="'.$cls.' btn-sm status" >'.$status.'</button>';

    $row[] = $user_name_html;
    
    $output['aaData'][] = $row;
}
