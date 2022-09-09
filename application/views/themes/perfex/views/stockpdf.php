<?php

$warehouse_stock_pro=$CI->db->query("SELECT tws.`created_at`,ws.name,tef.name as servicename,ts.firstname,ts.lastname,ts.email,ts.permenent_address,ts.phonenumber  FROM `tblwarehousestock` tws LEFT JOIN `tblwarehouse` ws ON tws.`warehouse_id`=ws.`id` LEFT JOIN `tblenquiryformaster` tef ON tef.`id`=tws.`service_type` LEFT JOIN `tblstaff` ts ON ts.staffid=tws.`addedfrom` WHERE tws.`id`='".$warehousestock->id."'")->row_array();
//echo"SELECT pws.is_pro,pws.hsn_code,pws.sac_code,pws.qty,pws.remarks,tc.name,tc.photo,tc.id FROM `tblprowarehousestock` pws LEFT JOIN `tblcomponents` tc ON tc.id=pws.`product_id` WHERE pws.`warehousestockid`='".$warehousestock->id."' AND pws.`is_pro`=0";exit;
/*$warehousecompstockdata=$CI->db->query("SELECT pws.hsn_code,pws.sac_code,pws.qty,pws.remarks,tc.name,tc.photo,tc.id FROM `tblprowarehousestock` pws LEFT JOIN `tblcomponents` tc ON tc.id=pws.`product_id` WHERE pws.`warehousestockid`='".$warehousestock->id."' ")->result_array();*/
$warehousestockdata=$CI->db->query("SELECT pws.hsn_code,pws.sac_code,pws.qty,pws.remarks,tc.name,tc.photo,tc.id FROM `tblprowarehousestock` pws LEFT JOIN `tblproducts` tc ON tc.id=pws.`product_id` WHERE pws.`warehousestockid`='".$warehousestock->id."'")->result_array();
/*$warehousestockdata=array_merge($warehousecompstockdata,$warehouseprostockdata);*/
$dimensions = $pdf->getPageDimensions();
$profor='Stock For Approval';
$pdf_logo_url = pdf_logo_url();
if($warehousestock->terms_and_conditions!=''){$terms_and_conditions=$warehousestock->terms_and_conditions;}else{$terms_and_conditions="1). Payment: 100% Advance<br>2). Freight(Demob) will be charged extra at actual.<br>3). Lead Time- 2-3 working days from the date of receipt of confirm order.<br>4). Any other charges other than mentioned if incurred, shall be charged at actual. Sub Total (I) 66,000.00<br>5). Unloading of Equipment/Material will not be in SCHACH'S scope. Freight(mob) At actual<br>6). One time free training/Installation of scaffold/machine shall be conducted by us Sub Total (II) 66,000.00<br>7). Security cheque (without date ) of material value will be required CGST 9% 5,940.00<br>before material dispatch. (Material Value - 7.4 lacs) SGST 9% 5,940.00<br>We hope our offer is in line with your requirement and we wait for your valued order, which shall receive our best and prompt attention.";}
$y            = $pdf->getY();
$warehousestock_date =  _d($warehousestock->created_at);
$open_till = '';
if(!empty($warehousestock->open_till)){
    $open_till = _l('proposal_open_till'). ': ' . _d($warehousestock->open_till) . '<br />';
}

$prohead='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="left" width="50%"><img src="'.$pdf_logo_url.'"></td><td align="left" width="50%"><table style="padding:6px;"><thead style="padding:10px;"><tr style="background-color:' . get_option('pdf_table_heading_color') . '; color:#fff; padding:10px;"><th style="padding:8px;"><b>'.$profor.'</b></th><th style="padding:8px;"></th></tr></thead><tbody><tr><td>Warehouse :</td><td align="left"># '.$warehouse_stock_pro['name'].'</td></tr><tr><td>Date :</td><td align="left">'.$warehouse_stock_pro['created_at'].'</td><td align="left">'.$$warehouse_stock_pro['servicename'].'</td></tr></tbody></table></td></tr></table>';
$prohead .='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><thead style="padding:10px;margin-botom:5%;"><tr style=""><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left" ><b>From</b></th><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left"  ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Added By</b></th></tr></thead><tr><td align="left" width="60%">'.format_organization_info().'</td><td align="left" width="40%;"><b style="color:black" class="company-name-formatted">'.$warehouse_stock_pro['firstname'].' '.$warehouse_stock_pro['lastname'].'</b><br> '.$warehouse_stock_pro['email'].'<br> '.$warehouse_stock_pro['permenent_address'].'<br> '.$warehouse_stock_pro['phonenumber'].'</td></tr></table>';
$probody .='
	<table  width="100%" bgcolor="#fff" cellspacing="0" border="1" cellpadding="8" style="margin-top:25px;">
		<thead>
			<tr height="30" bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';">
				<th align="left" width="20%">Image</th>
				<th align="left" width="25%">Componenet / Product</th>
				<th align="left" width="13%">HSN Code</th>
				<th align="left" width="13%">SAC Code</th>
				<th align="left" width="10%">Qty</th>
				<th align="left" width="19%">Remarks</th>
			</tr>
		</thead>
		<tbody class="ui-sortable">';
		foreach($warehousestockdata as $singlewarehousestockdata)
		{
			if($singlewarehousestockdata['is_pro']==1){if($singlewarehousestockdata['photo']!=''){$img=base_url('uploads/product')."/".$singlewarehousestockdata['id']."/".$singlewarehousestockdata['photo'];}else{$img=base_url('assets/images/no_image_available.jpeg');}}
			if($singlewarehousestockdata['is_pro']==0){if($singlewarehousestockdata['photo']!=''){$img=base_url('uploads/component')."/".$singlewarehousestockdata['id']."/".$singlewarehousestockdata['photo'];}else{$img=base_url('assets/images/no_image_available.jpeg');}}
			$probody .='<tr class="main" id="tr0" >
				<td width="20%"><img  src="'.$img.'" ></td>
				<td width="25%" align="center">
					<div class="form-group" align="center">'.$singlewarehousestockdata['name'].'</div>
				</td>
				<td width="13%" align="center">
					<div class="form-group">'.$singlewarehousestockdata['hsn_code'].'</div>
				</td>
				<td width="13%" align="center">
					<div class="form-group">'.$singlewarehousestockdata['sac_code'].'</div>
				</td>
				<td width="10%" align="center">
					<div class="form-group">'.$singlewarehousestockdata['qty'].'</div>
				</td>
				<td width="19%" align="center">
					<div class="form-group">'.$singlewarehousestockdata['remarks'].'</div>
				</td>
			</tr>';
		}
		$probody .='</tbody>
	</table>';
$html = <<<EOF

<div style="width:675px !important;">
$prohead

</div><div style="width:675px !important;margin-top:15%;">
$probody

</div>
EOF;
//echo $html;exit;


$pdf->writeHTML($html, true, false, false, false, '');
$pdf->Ln(8);