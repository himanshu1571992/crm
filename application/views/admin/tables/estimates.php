<?php

defined('BASEPATH') or exit('No direct script access allowed');

$project_id = $this->ci->input->post('project_id');

$aColumns = [
    'number',
    'total',
    'total_tax',
    'YEAR(date) as year',
    get_sql_select_client_company(),
    'tblprojects.name as project_name',
    '(SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblestimates.id and rel_type="estimate" ORDER by tag_order ASC) as tags',
    'date',
    'expirydate',
    'reference_no',
    'tblestimates.status',
    ];

$join = [
    'LEFT JOIN tblclients ON tblclients.userid = tblestimates.clientid',
    'LEFT JOIN tblcurrencies ON tblcurrencies.id = tblestimates.currency',
    'LEFT JOIN tblprojects ON tblprojects.id = tblestimates.project_id',
];

$sIndexColumn = 'id';
$sTable       = 'tblestimates';

$custom_fields = get_table_custom_fields('estimate');

foreach ($custom_fields as $key => $field) {
    $selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
    array_push($customFieldsColumns, $selectAs);
    array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $key . ' ON tblestimates.id = ctable_' . $key . '.relid AND ctable_' . $key . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $key . '.fieldid=' . $field['id']);
}

$where  = [];
$filter = [];

if ($this->ci->input->post('not_sent')) {
    array_push($filter, 'OR (sent= 0 AND tblestimates.status NOT IN (2,3,4))');
}
if ($this->ci->input->post('invoiced')) {
    array_push($filter, 'OR invoiceid IS NOT NULL');
}

if ($this->ci->input->post('not_invoiced')) {
    array_push($filter, 'OR invoiceid IS NULL');
}
$statuses  = $this->ci->estimates_model->get_statuses();
$statusIds = [];
foreach ($statuses as $status) {
    if ($this->ci->input->post('estimates_' . $status)) {
        array_push($statusIds, $status);
    }
}
if (count($statusIds) > 0) {
    array_push($filter, 'AND tblestimates.status IN (' . implode(', ', $statusIds) . ')');
}

$agents    = $this->ci->estimates_model->get_sale_agents();
$agentsIds = [];
foreach ($agents as $agent) {
    if ($this->ci->input->post('sale_agent_' . $agent['sale_agent'])) {
        array_push($agentsIds, $agent['sale_agent']);
    }
}
if (count($agentsIds) > 0) {
    array_push($filter, 'AND sale_agent IN (' . implode(', ', $agentsIds) . ')');
}

$years      = $this->ci->estimates_model->get_estimates_years();
$yearsArray = [];
foreach ($years as $year) {
    if ($this->ci->input->post('year_' . $year['year'])) {
        array_push($yearsArray, $year['year']);
    }
}
if (count($yearsArray) > 0) {
    array_push($filter, 'AND YEAR(date) IN (' . implode(', ', $yearsArray) . ')');
}

if (count($filter) > 0) {
    array_push($where, 'AND (' . prepare_dt_filter($filter) . ')');
}

if ($clientid != '') {
    array_push($where, 'AND tblestimates.clientid=' . $clientid);
}

if ($project_id) {
    array_push($where, 'AND project_id=' . $project_id);
}

array_push($where, 'AND year_id = '. financial_year());

/*if (!has_permission('estimates', '', 'view')) {
    $userWhere = 'AND ' . get_estimates_where_sql_for_staff(get_staff_user_id());
    array_push($where, $userWhere);
}*/
$aColumns = do_action('estimates_table_sql_columns', $aColumns);

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
    'tblestimates.id',
    'tblestimates.clientid',
    'tblestimates.invoiceid',
    'symbol',
    'project_id',
    'deleted_customer_name',
    'hash',
]);
$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    $numberOutput = '';
    // If is from client area table or projects area request
    if (is_numeric($clientid) || $project_id) {
        $numberOutput = '<a href="' . admin_url('estimates/list_estimates/' . $aRow['id']) . '" target="_blank">' . format_estimate_number($aRow['id']) . '</a>';
    } else {
        $numberOutput = '<a href="' . admin_url('estimates/list_estimates/' . $aRow['id']) . '" onclick="init_estimate(' . $aRow['id'] . '); return false;">' . format_estimate_number($aRow['id']) . '</a>';
    }

    $numberOutput .= '<div class="row-options">';
	$check_proposal_rent_item=check_proposal_item($aRow['id'],0,'estimate');
	$check_proposal_sale_item=check_proposal_item($aRow['id'],1,'estimate');
    if($check_proposal_rent_item>=1) $numberOutput .= '<a href="' . site_url('estimate/' . $aRow['id'] . '/' . $aRow['hash']) . '?type=rent" target="_blank">' . _l('rent_view') . '</a> | ';
    if($check_proposal_sale_item>=1) $numberOutput .= '<a href="' . site_url('estimate/' . $aRow['id'] . '/' . $aRow['hash']) . '?type=sale" target="_blank">' . _l('sale_view') . '</a>  | ';

    $numberOutput .= '<a href="' . site_url('estimate/' . $aRow['id'] . '/' . $aRow['hash']) . '?type=both" target="_blank">' . _l('view') . '</a>';
    if(check_permission_page(98,'edit')){
        $numberOutput .= ' | <a href="' . admin_url('estimates/performerinvoice/' . $aRow['id']) . '">' . _l('edit') . '</a>';
    }
    $numberOutput .= '</div>';

    $row[] = $numberOutput;

    $amount = format_money($aRow['total'], $aRow['symbol']);

    if ($aRow['invoiceid']) {
        $amount .= '<br /><span class="hide"> - </span><span class="text-success">' . _l('estimate_invoiced') . '</span>';
    }

    $row[] = $amount;

    $row[] = format_money($aRow['total_tax'], $aRow['symbol']);

    $row[] = $aRow['year'];

    $client_info = $this->ci->db->query("SELECT * FROM `tblclientbranch` where userid = '".$aRow['clientid']."' ")->row();

    if (empty($aRow['deleted_customer_name'])) {
        $row[] = '<a href="' . admin_url('clients/client/' . $aRow['clientid']) . '">' . $client_info->client_branch_name . '</a>';
    } else {
        $row[] = $aRow['deleted_customer_name'];
    }

    $row[] = '<a href="' . admin_url('projects/view/' . $aRow['project_id']) . '">' . $aRow['project_name'] . '</a>';

    $row[] = render_tags($aRow['tags']);

    $row[] = _d($aRow['date']);

    $row[] = _d($aRow['expirydate']);

    $row[] = $aRow['reference_no'];

    $row[] = format_estimate_status($aRow['tblestimates.status']);

    // Custom fields add values
    foreach ($customFieldsColumns as $customFieldColumn) {
        $row[] = (strpos($customFieldColumn, 'date_picker_') !== false ? _d($aRow[$customFieldColumn]) : $aRow[$customFieldColumn]);
    }

    $hook = do_action('estimates_table_row_data', [
        'output' => $row,
        'row'    => $aRow,
    ]);

    $row                = $hook['output'];
    $output['aaData'][] = $row;
}

echo json_encode($output);
die();
