<?php
defined('BASEPATH') or exit('No direct script access allowed');
$output['iTotalRecords']= count($bankdata);
$output['iTotalDisplayRecords']= count($bankdata);
if(count($bankdata)>0)
{
	foreach ($bankdata as $aRow)
	{
		$row = [];

		$row[] = $aRow['id'];
		
		$url = admin_url('vendors/vendor/'.$aRow['vendor_id'].'?group=bankdetails&id=' . $aRow['id']);

		$user_name_html = '<a href="' . $url . '">' . $aRow['name'] . '</a>';

		$user_name_html .= '<div class="row-options">';
		$user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
		$user_name_html .= ' | <a href="' . admin_url('Vendors/deletebank/' . $aRow['id'].'/'.$aRow['vendor_id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
		
		$user_name_html .= '</div>';

		$row[] = $user_name_html;
		$row[] = $aRow['branch'];
		$row[] = $aRow['phone_no'];
		$row[] = $aRow['email_id'];
		$row[] = _dt($aRow['created_at']);

		$output['aaData'][] = $row;
		
	}
}
else
{
	 $output['aaData']=array();
}