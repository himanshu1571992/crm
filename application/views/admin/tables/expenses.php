<?php

defined('BASEPATH') or exit('No direct script access allowed');
$aColumns = [
    'tblexpenses.id as id',
    'tblexpensescategories.name as category_name',
    'amount',
	'tblexpenses.addedfrom as addby',
    'expense_name',
    'file_name',
    'date',
    'tblprojects.name as project_name',
    get_sql_select_client_company(),
    'invoiceid',
    'reference_no',
    'paymentmode',
];
$join = [
    'LEFT JOIN tblclients ON tblclients.userid = tblexpenses.clientid',
    'JOIN tblexpensescategories ON tblexpensescategories.id = tblexpenses.category',
    'LEFT JOIN tblprojects ON tblprojects.id = tblexpenses.project_id',
    'LEFT JOIN tblfiles ON tblfiles.rel_id = tblexpenses.id AND rel_type="expense"',
    'LEFT JOIN tblcurrencies ON tblcurrencies.id = tblexpenses.currency',
];

$custom_fields = get_table_custom_fields('expenses');

foreach ($custom_fields as $key => $field) {
    $selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
    array_push($customFieldsColumns, $selectAs);
    array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
    array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $key . ' ON tblexpenses.id = ctable_' . $key . '.relid AND ctable_' . $key . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $key . '.fieldid=' . $field['id']);
}

$where  = [];
$filter = [];
include_once(APPPATH . 'views/admin/tables/includes/expenses_filter.php');


if ($clientid != '') {
    array_push($where, 'AND tblexpenses.clientid=' . $clientid);
}

//getting expenses ids
$expenses_ids = get_expenses_ids();

if (!has_permission('expenses', '', 'view')) {
   if(!empty($expenses_ids)){
	   array_push($where, 'AND tblexpenses.parent_id = 0 AND tblexpenses.id IN ('.$expenses_ids.') || tblexpenses.addedfrom=' . get_staff_user_id());
   }else{
	  array_push($where, 'AND tblexpenses.parent_id = 0 AND  tblexpenses.addedfrom=' . get_staff_user_id()); 
   }
   
}

//search only perent expense
array_push($where, 'AND tblexpenses.parent_id = 0');

/*print_r($where);
die;*/

$sIndexColumn = 'id';
$sTable       = 'tblexpenses';

$aColumns = do_action('expenses_table_sql_columns', $aColumns);

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
    @$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
    'category',
    'billable',
    'symbol',
    'tblexpenses.clientid',
    'tax',
    'tax2',
    'project_id',
]);
$output  = $result['output'];
$rResult = $result['rResult'];

$this->ci->load->model('payment_modes_model');

foreach ($rResult as $aRow) {
    $row = [];

    $row[] = $aRow['id'];

    $categoryOutput = '';

    if (is_numeric($clientid)) {
        $categoryOutput = '<a href="' . admin_url('expenses/list_expenses/' . $aRow['id']) . '">' . $aRow['category_name'] . '</a>';
    } else {
        $categoryOutput = '<a href="' . admin_url('expenses/list_expenses/' . $aRow['id']) . '" onclick="init_expense(' . $aRow['id'] . ');return false;">' . $aRow['category_name'] . '</a>';
    }

    if ($aRow['billable'] == 1) {
        if ($aRow['invoiceid'] == null) {
            $categoryOutput .= ' <p class="text-danger">' . _l('expense_list_unbilled') . '</p>';
        } else {
            if (total_rows('tblinvoices', [
                'id' => $aRow['invoiceid'],
                'status' => 2,
                ]) > 0) {
                $categoryOutput .= ' <p class="text-success">' . _l('expense_list_billed') . '</p>';
            } else {
                $categoryOutput .= ' <p class="text-success">' . _l('expense_list_invoice') . '</p>';
            }
        }
    }

    $categoryOutput .= '<div class="row-options">';


    //$categoryOutput .= '<a href="' . admin_url('expenses/list_expenses/' . $aRow['id']) . '" onclick="init_expense(' . $aRow['id'] . ');return false;">' . _l('view') . '</a>';

	if(get_expense_edit($aRow['id']) == 1){
		if (has_permission('expenses', '', 'edit')) {
        $categoryOutput .= ' <a href="' . admin_url('expenses/expense/' . $aRow['id']) . '">' . _l('edit') . '</a>';
		}

		if (has_permission('expenses', '', 'delete')) {
			$categoryOutput .= ' | <a href="' . admin_url('expenses/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
		}
	}
	
    

    $categoryOutput .= '</div>';
    $row[] = 'EXP-'.get_short($aRow['category_name']).'-'.number_series($aRow['id']);
    $row[] = $categoryOutput;

    //$total    = $aRow['amount'];
    $total    = total_expense_amount($aRow['id']);
    $tmpTotal = $total;

    if ($aRow['tax'] != 0) {
        $tax = get_tax_by_id($aRow['tax']);
        $total += ($total / 100 * $tax->taxrate);
    }
    if ($aRow['tax2'] != 0) {
        $tax = get_tax_by_id($aRow['tax2']);
        $total += ($tmpTotal / 100 * $tax->taxrate);
    }

    $row[] = format_money($total, $aRow['symbol']);

    $row[] = get_employee_fullname($aRow['addby']);
	
	

    $outputReceipt = '';

    if (!empty($aRow['file_name'])) {
        $outputReceipt = '<a href="' . site_url('download/file/expense/' . $aRow['id']) . '">' . $aRow['file_name'] . '</a>';
    }

    $row[] = $outputReceipt;

    $row[] = _d($aRow['date']);

    $row[] = '<a href="' . admin_url('projects/view/' . $aRow['project_id']) . '">' . $aRow['project_name'] . '</a>';

    $row[] = '<a href="' . admin_url('clients/client/' . $aRow['clientid']) . '">' . $aRow['company'] . '</a>';

    if ($aRow['invoiceid']) {
        $row[] = '<a href="' . admin_url('invoices/list_invoices/' . $aRow['invoiceid']) . '">' . format_invoice_number($aRow['invoiceid']) . '</a>';
    } else {
        $row[] = '';
    }

   // $row[] = $aRow['reference_no'];

    $paymentModeOutput = '';
    if ($aRow['paymentmode'] != '0' && !empty($aRow['paymentmode'])) {
        $payment_mode = $this->ci->payment_modes_model->get($aRow['paymentmode'], [], false, true);
        if ($payment_mode) {
            $paymentModeOutput = $payment_mode->name;
        }
    }
    $row[] = $paymentModeOutput;

    // Custom fields add values
    foreach ($customFieldsColumns as $customFieldColumn) {
        $row[] = (strpos($customFieldColumn, 'date_picker_') !== false ? _d($aRow[$customFieldColumn]) : $aRow[$customFieldColumn]);
    }

    $hook = do_action('expenses_table_row_data', [
        'output' => $row,
        'row'    => $aRow,
    ]);

    $row = $hook['output'];

    $output['aaData'][] = $row;
}
