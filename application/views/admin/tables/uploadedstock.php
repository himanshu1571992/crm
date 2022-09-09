<?php
defined('BASEPATH') or exit('No direct script access allowed');
$warehousestockdata=$this->ci->db->query("SELECT ts.firstname,ts.lastname,twsp.id,twsp.warehousestockid,twsp.created_at,twsp.pdf,twsp.addedfrom FROM `tblwarehousestockpdf` twsp LEFT JOIN `tblstaff` ts ON ts.`staffid`=twsp.`addedfrom` WHERE `warehousestockid`='".$id."'")->result_array();
$output['iTotalRecords']= count($warehousestockdata);
$output['iTotalDisplayRecords']= count($warehousestockdata);
if(count($warehousestockdata)>0)
{
	$i;
	foreach ($warehousestockdata as $aRow)
	{$i++;
		$row = [];
		$url = admin_url('../uploads/Stock/'.$aRow['id'].'/'.$aRow['pdf']);
		$delstockurl = admin_url('Stock/deletepdf/' . $aRow['warehousestockid'].'/' . $aRow['id']);
		$row[] = $i;
		$row[] = format_stock_number($aRow['warehousestockid']);
		$row[] = $aRow['firstname'].' '.$aRow['firstname'];
		$user_name_html = '<a target="_blank" href="' . $url . '"><img src="'.admin_url('../uploads/Stock/pdficon.png').'" class="image-responsive" style="height: 100px; width : 100px;"></a>';
		$user_name_html .= '<br/><a target="_blank" href="' . $url . '">' . _l('view') . '</a>';
		if($aRow['addedfrom']==get_staff_user_id())
		{
			$user_name_html .= ' | <a href="' . $delstockurl . '">' . _l('delete') . '</a>';
		}
		$row[] = $user_name_html;
		$row[] = _dt($aRow['created_at']);;
		$output['aaData'][] = $row;
		
	}
}
else
{
	 $output['aaData']=array();
}