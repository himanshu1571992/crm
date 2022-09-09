<?php
defined('BASEPATH') or exit('No direct script access allowed');


$output['iTotalRecords']= count($defaultsettingdata);
$output['iTotalDisplayRecords']= count($defaultsettingdata);
if(count($defaultsettingdata)>0)
{
	foreach ($defaultsettingdata as $aRow)
	{
		$row = [];

		$row[] = $aRow['id'];
		
		$url = admin_url('Defaultsetting/default_setting/'.$aRow['id']);

		$user_name_html = '<a href="' . $url . '">' . $aRow['category_name'] . '</a>';

		$user_name_html .= '<div class="row-options">';
		$user_name_html .= '<a href="'.$url.'">view</a>';
		if(check_permission_page(21,'delete') ){
		$user_name_html .= ' | <a href="'.admin_url('Defaultsetting/delete/'.$aRow['id']).'" class="text-danger _delete"> delete</a>';
		}
		$user_name_html .= '</div>';

		$row[] = $user_name_html;
		
		$checked = ($aRow['status'] == 1 ) ? 'checked' : '';
    
    // Toggle active/inactive customer
    $toggleActive = '<div class="onoffswitch">
        <input type="checkbox" data-switch-url="' . admin_url() . 'Defaultsetting/change_defaultsetting_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
        <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
    </div>';
		$row[] = $toggleActive;
		$row[] = _dt($aRow['created_at']);

		$output['aaData'][] = $row;
		
	}
}
else
{
	 $output['aaData']=array();
}