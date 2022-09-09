<?php
defined('BASEPATH') or exit('No direct script access allowed');

$sTable = 'tblstocktransfer';

$aColumns = [
    'tblstocktransfer.id as `id`',
    'tblstocktransfer.warehouse_id as `warehouse_id`',
    'tblstocktransfer.to_warehouse_id as `to_warehouse_id`',
    'tblstocktransfer.addedfrom as `addedfrom`',
    'tblstocktransfer.transferstockno as `transferstockno`',
    'tblstocktransfer.service_type as `service_type`',
    'tblstocktransfer.created_at as `created_at`'
];

$sIndexColumn = 'id';

$join = [
    'LEFT JOIN tbltransferstockapproval ON tblstocktransfer.`id`=tbltransferstockapproval.stocktransfer_id',
];
$get_staff_user_id=get_staff_user_id();
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join,['AND tblstocktransfer.addedfrom='.$get_staff_user_id.' OR tbltransferstockapproval.staffid='.get_staff_user_id()], [], 'GROUP BY tblstocktransfer.id');
//echo $this->ci->db->last_query();exit;
$output = $result['output'];
$rResult = $result['rResult'];


	foreach ($rResult as $aRow)
	{
		
		$get_from_warehousedata=$this->ci->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$aRow['warehouse_id']."'")->row_array();
		$fromwarehouse=$get_from_warehousedata['name'];
		$get_to_warehousedata=$this->ci->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$aRow['to_warehouse_id']."'")->row_array();
		$towarehouse=$get_to_warehousedata['name'];
		
		if($aRow['service_type']==1)
		{
			$service_type='Rent to Sale';
		}
		if($aRow['service_type']==2)
		{
			$service_type='Sale to Rent';
		}
		$i++;
		 $row = [];
    $row[] = $aRow['id'];
    
    //$url = admin_url('chalan/chalan/' . $aRow['id']);
    $url ='';

    $user_name_html = '<a href="' . $url . '">' . $aRow['transferstockno'] . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . admin_url('Stock/view/' . $aRow['id']) . '">' . _l('view') . ' |</a> ';
    $user_name_html .= ' <a href="' . admin_url('Stock/transferpdf/' . $aRow['id']) . '?output_type=I"  target="_blank">pdf</a>';
    $user_name_html .= ' | <a href="' . admin_url('Stock/deletetransferstock/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    
    $user_name_html .= '</div>';

    if($aRow['stock_for'] == 1){
        $stock_for = 'New';
    }else{
        $stock_for = 'Old';
    }

    $row[] = $user_name_html;
    $row[] = cc($service_type);
    $row[] = cc($stock_for);
    $row[] = cc($fromwarehouse);
    $row[] = cc($towarehouse);
$row[] = _dt($aRow['created_at']);
    $output['aaData'][] = $row;
		
	}
