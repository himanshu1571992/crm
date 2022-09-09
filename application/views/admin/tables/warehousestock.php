<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*$warehousecompstockdata=$this->ci->db->query("SELECT ef.name as servicetype ,tc.name as componenetname,tps.qty FROM `tblprostock` tps LEFT JOIN `tblcomponents` tc ON tc.id=tps.`pro_id` LEFT JOIN `tblwarehousestock` ws ON ws.id=tps.`warehouse_id` LEFT JOIN `tblenquiryformaster` ef on ef.id=ws.`service_type` WHERE tps.`is_pro`='0' AND  ws.`warehouse_id`='".$id."'")->result_array();
$warehouseprostockdata=$this->ci->db->query("SELECT ef.name as servicetype ,tp.name as componenetname,tps.qty FROM `tblprostock` tps LEFT JOIN `tblproducts` tp ON tp.id=tps.`pro_id` LEFT JOIN `tblwarehousestock` ws ON ws.id=tps.`warehouse_id` LEFT JOIN `tblenquiryformaster` ef on ef.id=ws.`service_type` WHERE tps.`is_pro`='1' AND  ws.`warehouse_id`='".$id."'")->result_array();
$warehousestockdata=array_merge($warehousecompstockdata,$warehouseprostockdata);*/

$warehousestockdata=$this->ci->db->query("SELECT * FROM `tblprowarehousestock` where warehousestockid = '".$id."' and status = 1")->result_array();
$wh_info = $this->ci->db->query("SELECT * FROM `tblwarehousestock` where id = '".$id."' ")->row();
$enquiryfor = $this->ci->db->query("SELECT * FROM `tblenquiryformaster` where id = '".$wh_info->service_type."' ")->row();

$output['iTotalRecords']= count($warehousestockdata);
$output['iTotalDisplayRecords']= count($warehousestockdata);
if(count($warehousestockdata)>0)
{
	$i;
	foreach ($warehousestockdata as $aRow)
	{$i++;
		$row = [];

		$product_info = $this->ci->db->query("SELECT * FROM `tblproducts` where id = '".$aRow['product_id']."' ")->row();
		$product_info = $this->ci->db->query("SELECT * FROM `tblproducts` where id = '".$aRow['product_id']."' ")->row();

		$row[] = $i;
		$row[] = $product_info->name.product_code($product_info->id);
		$row[] = $enquiryfor->name;
		$row[] = $aRow['qty'];
		//$row[] = $aRow['email_id'];
		//$row[] = _dt($aRow['created_at']);

		$output['aaData'][] = $row;
		
	}
}
else
{
	 $output['aaData']=array();
}