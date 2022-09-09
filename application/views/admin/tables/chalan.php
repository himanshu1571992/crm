<?php
defined('BASEPATH') or exit('No direct script access allowed');
if($estimate_id!='')
{
	$warehousestockdata=$this->ci->db->query("SELECT cm.id,cm.chalanno,cm.addedfrom,cm.datecreated FROM `tblchalanmst` cm LEFT JOIN tblchallanapproval ca ON cm.`id`=ca.challan_id WHERE cm.rel_id='".$estimate_id."' AND (cm.`addedfrom`='".get_staff_user_id()."' OR ca.staff_id='".get_staff_user_id()."') GROUP BY cm.id")->result_array();
}
else
{
	//$warehousestockdata=$this->ci->db->query("SELECT cm.id,cm.chalanno,cm.addedfrom,cm.datecreated FROM `tblchalanmst` cm LEFT JOIN tblchallanapproval ca ON cm.`id`=ca.challan_id WHERE (cm.`addedfrom`='".get_staff_user_id()."' OR ca.staff_id='".get_staff_user_id()."') GROUP BY cm.id")->result_array();

    $warehousestockdata=$this->ci->db->query("SELECT cm.id,cm.chalanno,cm.addedfrom,cm.datecreated FROM `tblchalanmst` cm LEFT JOIN tblchallanapproval ca ON cm.`id`=ca.challan_id  LEFT JOIN tblchalandetailsmst cc ON cm.`id`=cc.chalan_id WHERE (cm.`addedfrom`='".get_staff_user_id()."' OR ca.staff_id='".get_staff_user_id()."') and cc.pending_qty > 0 GROUP BY cm.id")->result_array();
}
	$output['iTotalRecords']= count($warehousestockdata);
$output['iTotalDisplayRecords']= count($warehousestockdata);
if(count($warehousestockdata)>0)
{
	$i;
	foreach ($warehousestockdata as $aRow)
	{$i++;
		 $row = [];

    // Bulk actions
//    $row[] = '<div class="checkbox"><input type="checkbox" value="' . $aRow['id'] . '"><label></label></div>';

    // #
    $row[] = $aRow['id'];
    
    //$url = admin_url('chalan/chalan/' . $aRow['id']);
    $url ='';

    $user_name_html = '<a href="' . $url . '">' . $aRow['chalanno'] . '</a>';

    $user_name_html .= '<div class="row-options">';
    $user_name_html .= '<a href="' . admin_url('chalan/Edit/' . $aRow['id']) . '">Update</a> ';
   // $user_name_html .= '| <a href="' . admin_url('Chalan/pdf/' . $aRow['id']) . '?output_type=I&type=rent"  target="_blank">pdf</a>';
    if(check_permission_page(100,'delete')){
    $user_name_html .= ' | <a href="' . admin_url('chalan/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    }
    $user_name_html .= '</div>';

    $row[] = $user_name_html;



    $checked = ($aRow['flag'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'chalan/change_chalan_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';

    // For exporting
    $toggleActive .= '<span class="hide">' . ($aRow['flag'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

    $row[] = $toggleActive;
    
    // date added
    $row[] = _dt($aRow['datecreated']);

    $output['aaData'][] = $row;
		
	}
}
else
{
	 $output['aaData']=array();
}