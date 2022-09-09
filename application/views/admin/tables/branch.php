<?php

defined('BASEPATH') or exit('No direct script access allowed');



$sTable = 'tblcompanybranch';

$aColumns = [
    'tblcompanybranch.id as `id`',
    'tblcities.name as `cityname`',
    'tblcompanybranch.comp_branch_name as `comp_branch_name`',
    'tblcompanybranch.email_id as `email_id`',
    'tblcompanybranch.phone_no_1 as `phone_no_1`',
    'tblcompanybranch.address as `address`'
];

$sIndexColumn = 'id';

$join = [
    'LEFT JOIN tblcities ON tblcities.`id` = '.'tblcompanybranch.`city`',
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
    
    $url = admin_url('settings?group=branch&id=' . $aRow['id']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['comp_branch_name']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    $user_name_html .= ' | <a href="' . admin_url('Settings/deletecompbranch/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    
    $user_name_html .= '</div>';

    $row[] = $user_name_html;
    $row[] = $aRow['email_id'];
    $row[] = $aRow['phone_no_1'];
    $row[] = $aRow['address'];
    $row[] = $aRow['cityname'];

    

    $output['aaData'][] = $row;
}
