<?php

defined('BASEPATH') or exit('No direct script access allowed');

$hasPermissionDelete = has_permission('customers', '', 'delete');

$custom_fields = get_table_custom_fields('customers');

$aColumns = [
    '1',
    'tblclientbranch.addedfrom as addedfrom',
    'tblclientbranch.userid as userid',
    'client_branch_name',
    'CONCAT(firstname, " ", lastname) as contact_fullname',
    'tblclientbranch.email_id as email',
    'tblclientbranch.phone_no_1 as phonenumber',
    'tblclientbranch.active',
    '(SELECT GROUP_CONCAT(name ORDER BY name ASC) FROM tblcustomersgroups JOIN tblcustomergroups_in ON tblcustomergroups_in.groupid = tblcustomersgroups.id WHERE customer_id = tblclientbranch.userid LIMIT 1) as groups',
    'tblclientbranch.datecreated as datecreated',
    'tblclientbranch.followup as `followup`',
    'tblclientbranch.sales_parson as `sales_parson`'
    ];

$sIndexColumn = 'userid';
$sTable       = 'tblclientbranch';
$where        = [];
// Add blank where all filter can be stored
$filter = [];

$join = ['LEFT JOIN tblcontacts ON tblcontacts.userid=tblclientbranch.userid AND tblcontacts.is_primary=1'];

foreach ($custom_fields as $key => $field) {
    $selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
    array_push($customFieldsColumns,$selectAs);
    array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $key . ' ON tblclientbranch.userid = ctable_' . $key . '.relid AND ctable_' . $key . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $key . '.fieldid=' . $field['id']);
}
// Filter by custom groups
$groups   = $this->ci->clients_model->get_groups();
$groupIds = [];
foreach ($groups as $group) {
    if ($this->ci->input->post('customer_group_' . $group['id'])) {
        array_push($groupIds, $group['id']);
    }
}
if (count($groupIds) > 0) {
    array_push($filter, 'AND tblclientbranch.userid IN (SELECT customer_id FROM tblcustomergroups_in WHERE groupid IN (' . implode(', ', $groupIds) . '))');
}

$countries  = $this->ci->clients_model->get_clients_distinct_countries();
$countryIds = [];
foreach ($countries as $country) {
    if ($this->ci->input->post('country_' . $country['country_id'])) {
        array_push($countryIds, $country['country_id']);
    }
}
if (count($countryIds) > 0) {
    array_push($filter, 'AND country IN (' . implode(',', $countryIds) . ')');
}


$this->ci->load->model('invoices_model');
// Filter by invoices
$invoiceStatusIds = [];
foreach ($this->ci->invoices_model->get_statuses() as $status) {
    if ($this->ci->input->post('invoices_' . $status)) {
        array_push($invoiceStatusIds, $status);
    }
}
if (count($invoiceStatusIds) > 0) {
    array_push($filter, 'AND tblclientbranch.userid IN (SELECT clientid FROM tblinvoices WHERE status IN (' . implode(', ', $invoiceStatusIds) . '))');
}

// Filter by estimates
$estimateStatusIds = [];
$this->ci->load->model('estimates_model');
foreach ($this->ci->estimates_model->get_statuses() as $status) {
    if ($this->ci->input->post('estimates_' . $status)) {
        array_push($estimateStatusIds, $status);
    }
}
if (count($estimateStatusIds) > 0) {
    array_push($filter, 'AND tblclientbranch.userid IN (SELECT clientid FROM tblestimates WHERE status IN (' . implode(', ', $estimateStatusIds) . '))');
}

// Filter by projects
$projectStatusIds = [];
$this->ci->load->model('projects_model');
foreach ($this->ci->projects_model->get_project_statuses() as $status) {
    if ($this->ci->input->post('projects_' . $status['id'])) {
        array_push($projectStatusIds, $status['id']);
    }
}
if (count($projectStatusIds) > 0) {
    array_push($filter, 'AND tblclientbranch.userid IN (SELECT clientid FROM tblprojects WHERE status IN (' . implode(', ', $projectStatusIds) . '))');
}

// Filter by proposals
$proposalStatusIds = [];
$this->ci->load->model('proposals_model');
foreach ($this->ci->proposals_model->get_statuses() as $status) {
    if ($this->ci->input->post('proposals_' . $status)) {
        array_push($proposalStatusIds, $status);
    }
}
if (count($proposalStatusIds) > 0) {
    array_push($filter, 'AND tblclientbranch.userid IN (SELECT rel_id FROM tblproposals WHERE status IN (' . implode(', ', $proposalStatusIds) . ') AND rel_type="customer")');
}

// Filter by having contracts by type
$this->ci->load->model('contracts_model');
$contractTypesIds = [];
$contract_types   = $this->ci->contracts_model->get_contract_types();

foreach ($contract_types as $type) {
    if ($this->ci->input->post('contract_type_' . $type['id'])) {
        array_push($contractTypesIds, $type['id']);
    }
}
if (count($contractTypesIds) > 0) {
    array_push($filter, 'AND tblclientbranch.userid IN (SELECT client FROM tblcontracts WHERE contract_type IN (' . implode(', ', $contractTypesIds) . '))');
}

// Filter by proposals
$customAdminIds = [];
foreach ($this->ci->clients_model->get_customers_admin_unique_ids() as $cadmin) {
    if ($this->ci->input->post('responsible_admin_' . $cadmin['staff_id'])) {
        array_push($customAdminIds, $cadmin['staff_id']);
    }
}

if (count($customAdminIds) > 0) {
    array_push($filter, 'AND tblclientbranch.userid IN (SELECT customer_id FROM tblcustomeradmins WHERE staff_id IN (' . implode(', ', $customAdminIds) . '))');
}

if($this->ci->input->post('requires_registration_confirmation')) {
    array_push($filter,'AND tblclientbranch.registration_confirmed=0');
}

if (count($filter) > 0) {
    array_push($where, 'AND (' . prepare_dt_filter($filter) . ')');
}

/*if (!has_permission('customers', '', 'view')) {
    array_push($where, 'AND tblclientbranch.userid IN (SELECT customer_id FROM tblcustomeradmins WHERE staff_id=' . get_staff_user_id() . ')');
}*/

/*if ($this->ci->input->post('exclude_inactive')) {
    array_push($where, 'AND (tblclientbranch.active = 1 OR tblclientbranch.active=0 AND registration_confirmed = 0)');
}*/

if ($this->ci->input->post('my_customers')) {
    array_push($where, 'AND tblclientbranch.userid IN (SELECT customer_id FROM tblcustomeradmins WHERE staff_id=' . get_staff_user_id() . ')');
}
/* if login parson have sales person so assigned client only see him */
if (is_sales_person() == 1){
    array_push($where, 'AND FIND_IN_SET('.get_staff_user_id().', tblclientbranch.sales_parson)');
}
$aColumns = do_action('customers_table_sql_columns', $aColumns);

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}


array_push($where, ' GROUP BY tblclientbranch.userid');

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
    'tblcontacts.id as contact_id',
    'tblclientbranch.zip as zip',
    'registration_confirmed',
]);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    // Bulk actions
    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['userid'] . '"><label></label></div>';
    // User id
    $row[] = $aRow['userid'];
    $row[] = ($aRow['addedfrom'] > 0) ? get_employee_fullname($aRow['addedfrom']) : '--';
    

    // Company
    $company  = $aRow['client_branch_name'];
    $isPerson = false;

    if ($company == '') {
        $company  = _l('no_company_view_profile');
        $isPerson = true;
    }

    $url = admin_url('ClientBranch/branch/' . $aRow['userid']);

    if ($isPerson && $aRow['contact_id']) {
        $url .= '?contactid=' . $aRow['contact_id'];
    }

    $company = '<a href="' . $url . '">' . cc($company) . '</a>';

    $company .= '<div class="row-options">';
    $company .= '<a href="' . $url . '">' . _l('view') . '</a>';

    if($aRow['registration_confirmed'] == 0 && is_admin()) {
        $company .= ' | <a href="'.admin_url('clients/confirm_registration/'. $aRow['userid']).'" class="text-success bold">'._l('confirm_registration').'</a>';
    }
    if (!$isPerson) {
        $company .= ' | <a href="' . admin_url('ClientBranch/branch/' . $aRow['userid'] . '?group=contacts') . '">' . _l('customer_contacts') . '</a>';
    }
    if(check_permission_page(80,'delete') ){
        $company .= ' | <a href="' . admin_url('ClientBranch/delete/' . $aRow['userid']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }

    $company .= '</div>';

    $row[] = $company;

    // Primary contact
    $row[] = ($aRow['contact_id'] ? '<a href="' . admin_url('ClientBranch/branch/' . $aRow['userid'] . '?contactid=' . $aRow['contact_id']) . '" target="_blank">' . $aRow['contact_fullname'] . '</a>' : '');

    // Primary contact email
    $row[] = ($aRow['email'] ? '<a href="mailto:' . $aRow['email'] . '">' . $aRow['email'] . '</a>' : '');

    // Primary contact phone
    $row[] = ($aRow['phonenumber'] ? '<a href="tel:' . $aRow['phonenumber'] . '">' . $aRow['phonenumber'] . '</a>' : '');

    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch" data-toggle="tooltip" data-title="' . _l('customer_active_inactive_help') . '">
        <input type="checkbox"'.($aRow['registration_confirmed'] == 0 ? ' disabled' : '').' data-switch-url="' . admin_url() . 'clients/change_client_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['userid'] . '" data-id="' . $aRow['userid'] . '" ' . ($aRow['tblclientbranch.active'] == 1 ? 'checked' : '') . '>
        <label class="onoffswitch-label" for="' . $aRow['userid'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['tblclientbranch.active'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;

    // Customer groups parsing
    $groupsRow = '';
    if ($aRow['groups']) {
        $groups = explode(',', $aRow['groups']);
        foreach ($groups as $group) {
            $groupsRow .= '<span class="label label-default mleft5 inline-block customer-group-list pointer">' . $group . '</span>';
        }
    }

    //$row[] = $groupsRow;
    $checked = ($aRow['followup'] == 1 ) ? 'checked' : '';
    $followtoggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'client/change_branchfollowup_status" name="onoffswitch" class="onoffswitch-checkbox" id="f' . $aRow['userid'] . '" data-id="' . $aRow['userid'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="f' . $aRow['userid'] . '"></label>
    </div>';
    $row[] = $followtoggleActive;

    $row[] = _dt($aRow['datecreated']);

    /* This Sales Person Get and show */
    $sales_personlink = '<a href="javascript:void(0);"  onclick="show_sales_parson('.$aRow['userid'].');"><i class="fa fa-plus"></i> Assign</a>';
    if (!empty($aRow['sales_parson'])){
        $sales_person = '';
        $sales_personids = explode(',',$aRow['sales_parson']);
        foreach ($sales_personids as $key => $staff) {
            $name = '<span class="badge badge-info">'.get_employee_fullname($staff).'</span>';
            $sales_person .= $name;
        }
        if ($sales_person != ''){
            $sales_personlink = '<a href="javascript:void(0);"  onclick="show_sales_parson('.$aRow['userid'].');"> '.$sales_person.'</a>';
        }
    }
    
    $row[] = $sales_personlink;

    // Custom fields add values
    foreach ($customFieldsColumns as $customFieldColumn) {
        $row[] = (strpos($customFieldColumn, 'date_picker_') !== false ? _d($aRow[$customFieldColumn]) : $aRow[$customFieldColumn]);
    }

    $hook = do_action('customers_table_row_data', [
        'output' => $row,
        'row'    => $aRow,
    ]);

    $row = $hook['output'];

    $row['DT_RowClass'] = 'has-row-options';
    if ($aRow['registration_confirmed'] == 0) {
        $row['DT_RowClass'] .= ' alert-info requires-confirmation';
        $row['Data_Title']  = _l('customer_requires_registration_confirmation');
        $row['Data_Toggle'] = 'tooltip';
    }
    $output['aaData'][] = $row;
}
?>
