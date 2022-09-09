<?php

defined('BASEPATH') or exit('No direct script access allowed');



$sTable = 'tblwarehouse';

$aColumns = [
    'tblwarehouse.id as `id`',
    'tblcities.name as `cityname`',
    'tblwarehouse.name as `name`',
    'tblwarehouse.email_id_1 as `email_id_1`',
    'tblwarehouse.cont_no_1 as `cont_no_1`',
    'tblwarehouse.address as `address`'
];

$sIndexColumn = 'id';

$join = [
    'LEFT JOIN tblcities ON tblcities.`id` = '.'tblwarehouse.`city`',
];

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join);
$output = $result['output'];
$rResult = $result['rResult'];





foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $aRow['id'];
    
    $url = admin_url('settings?group=Warehouse&id=' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['name']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    $user_name_html .= ' | <a href="' . admin_url('Settings/deletewarehouse/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    
    $user_name_html .= '</div>';

    $row[] = $user_name_html;
    $row[] = $aRow['email_id_1'];
    $row[] = $aRow['cont_no_1'];
    $row[] = $aRow['address'];
    $row[] = $aRow['cityname'];

    

    $output['aaData'][] = $row;
}
