<?php

defined('BASEPATH') or exit('No direct script access allowed');



$sTable = 'tblclients';

$aColumns = [
    'tblclients.userid as `userid`',
    'tblclientbranch.client_id as `client_id`',
    'tblclients.location as `location`',
    'tblclients.company as `companyname`',
    'tblclients.email_id as `email_id`',
    'tblclients.phone_no_1 as `phone_no_1`',
    'tblclients.followup as `followup`'
];

$sIndexColumn = 'userid';

$join = [
    'LEFT JOIN tblclientbranch ON tblclientbranch.`userid` = '.'tblclients.`client_branch_id`',
];

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join);
$output = $result['output'];
$rResult = $result['rResult'];





foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $aRow['userid'];
    
    $url = admin_url('client/client/' . $aRow['userid']);

    $user_name_html = '<a href="' . $url . '">' . cc($aRow['companyname']) . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
    if(check_permission_page(79,'delete') ){
    $user_name_html .= ' | <a href="' . admin_url('client/delete/' . $aRow['userid']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    $user_name_html .= '</div>';


    // Toggle active/inactive customer

    $checked = ($aRow['followup'] == 1 ) ? 'checked' : '';
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'client/change_followup_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['userid'] . '" data-id="' . $aRow['userid'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['userid'] . '"></label>
    </div>';

    $row[] = $user_name_html;
    $row[] = $aRow['location'];
    $row[] = $aRow['email_id'];
    $row[] = $aRow['phone_no_1'];
    $row[] = $toggleActive;

    

    $output['aaData'][] = $row;
}
