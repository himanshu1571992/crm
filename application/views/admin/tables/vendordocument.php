<?php
defined('BASEPATH') or exit('No direct script access allowed');
$output['iTotalRecords']= count($docdata);
$output['iTotalDisplayRecords']= count($docdata);
if(count($docdata)>0)
{
	foreach ($docdata as $aRow) {
		$row = [];

		$row[] = $aRow['id'];
		
		$url = admin_url('vendors/vendor/'.$aRow['vendor_id'].'?group=documents&id=' . $aRow['id']);

		$user_name_html = '<a href="' . $url . '"> Doc-' . $aRow['id'] . '</a>';

		$user_name_html .= '<div class="row-options">';
		$user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
		$user_name_html .= ' | <a href="' . admin_url('Vendors/deletedocument/' . $aRow['id'].'/'.$aRow['vendor_id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
		
		$user_name_html .= '</div>';
		$row[] =$user_name_html;
		$pancard = base_url('assets/images/no_image_available.jpeg');
		if($aRow['pancard'] != "") {
			$pancard = base_url('uploads/document/pancard') . "/" . $aRow['id'] . "/" . $aRow['pancard'];
		}
		
		$row[] = '<img src="' . $pancard . '" class="image-responsive" style="height: 100px; width : 100px;" alt="pan card" />';
		$cancel_cheque = base_url('assets/images/no_image_available.jpeg');
		if($aRow['cancel_cheque'] != "") {
			$cancel_cheque = base_url('uploads/document/cancel_cheque') . "/" . $aRow['id'] . "/" . $aRow['cancel_cheque'];
		}
		
		$row[] = '<img src="' . $cancel_cheque . '" class="image-responsive" style="height: 100px; width : 100px;" alt="Cancel Cheque" />';
		$gst_reg_doc = base_url('assets/images/no_image_available.jpeg');
		if($aRow['gst_reg_doc'] != "") {
			$gst_reg_doc = base_url('uploads/document/gst_doc') . "/" . $aRow['id'] . "/" . $aRow['gst_reg_doc'];
		}
		
		$row[] = '<img src="' . $gst_reg_doc . '" class="image-responsive" style="height: 100px; width : 100px;" alt="GST Regestration Document" />';
		$row[] = _dt($aRow['created_at']);

		$output['aaData'][] = $row;
		
	}
}
else
{
	 $output['aaData']=array();
}
