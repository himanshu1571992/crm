<?php
defined('BASEPATH') or exit('No direct script access allowed');
$warehousestockdata=$this->ci->db->query("SELECT *,ws.id as stockid FROM `tblwarehousestock` ws LEFT JOIN `tblwarehouse` w ON ws.`warehouse_id`=w.`id` LEFT JOIN `tblstockapproval` sap ON sap.warehousestockid=ws.id Where (ws.`addedfrom`='".get_staff_user_id()."' OR sap.`staffid`='".get_staff_user_id()."') GROUP BY ws.`id` order by ws.id DESC")->result_array();
$output['iTotalRecords']= count($warehousestockdata);
$output['iTotalDisplayRecords']= count($warehousestockdata);
	if(count($warehousestockdata)>0)
	{
		$i=1;
		foreach ($warehousestockdata as $aRow)
		{
			
			$row = [];

			$row[] = $i++;
			$row[] = format_stock_number($aRow['id']);
			
			$url = admin_url('Stock/warehousestock?id=' . $aRow['stockid']);
			$stockurl = admin_url('Stock/addstock/' . $aRow['stockid']);
			$downloadpdfurl = admin_url('Stock/pdf/' . $aRow['stockid']);
			$uploadpdfurl = admin_url('Stock/stockpdf/' . $aRow['stockid']);
			$delstockurl = admin_url('Stock/delete/' . $aRow['stockid']);
			$user_name_html = '<a href="' . $url . '">' . $aRow['name'] . '</a>';
			$user_name_html .= '<div class="row-options">';
			$user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
			
			if($aRow['is_approved']!=1 & $aRow['addedfrom']==get_staff_user_id()){$user_name_html .= ' | <a href="' . $stockurl . '">' . _l('edit') . '</a>';
			$user_name_html .= ' | <a href="' . $delstockurl . '">' . _l('delete') . '</a>';}
			$user_name_html .= '| <a href="' . $downloadpdfurl . '">' . _l('download') . '</a>';
			$user_name_html .= ' | <a href="' . $uploadpdfurl . '">' . _l('upload') . '</a>';
			$user_name_html .= '</div>';

			
			 if($aRow['stock_for'] == 1){
		        $stock_for = 'New';
		    }else{
		        $stock_for = 'Old';
		    }

			$row[] = $user_name_html;
			$row[] = $stock_for;
			$row[] = $aRow['email_id_1'];
			$row[] = $aRow['address'];
			
			if($aRow['is_approved']==1){$apprpved='Approved';}else if($aRow['is_approved']==2){$apprpved='Stock Decline';}else{$apprpved='Not Approved yet';}
			$row[] = $apprpved;
			$output['aaData'][] = $row;
		}
	}
	else
	{
		 $output['aaData']=array();
	}
