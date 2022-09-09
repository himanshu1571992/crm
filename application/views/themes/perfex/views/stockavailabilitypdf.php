<?php


$dimensions = $pdf->getPageDimensions();
$profor='Stock Details';
$pdf_logo_url = pdf_logo_url();


$table_data = json_decode($pdf_data['p_data']);

$prohead='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="left" width="50%"><img width="150" height="50" src="'.$pdf_logo_url.'"></td><td align="left" width="50%"><table style="padding:6px;"><thead style="padding:10px;"><tr style="background-color:' . get_option('pdf_table_heading_color') . '; color:#fff; padding:10px;"><th style="padding:8px;"><b>'.$profor.'</b></th><th style="padding:8px;"></th></tr></thead><tbody><tr><td>Warehouse :</td><td align="left"> '.$pdf_data['warehouse'].'</td></tr><tr><td>Service For :</td><td align="left"> '.$pdf_data['servicetype'].'</td></tr><tr><td>Date :</td><td align="left">'.date('d/m/Y H:i:s').'</td><td align="left">Service</td></tr></tbody></table></td></tr></table>';

$prohead .='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><thead style="padding:10px;margin-botom:5%;"><tr style=""><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left" ><b>From</b></th><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left"  ></th></tr></thead><tr><td align="left" width="100%">'.format_organization_info().'</td></tr></table>';

/*$prohead .='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><thead style="padding:10px;margin-botom:5%;"><tr style=""><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left" ><b>From</b></th><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left"  ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Added By</b></th></tr></thead><tr><td align="left" width="60%">'.format_organization_info().'</td><td align="left" width="40%;"><b style="color:black" class="company-name-formatted">Full Name</b><br> Email<br> Address<br> 0731</td></tr></table>';*/
$probody .='
	<table  width="100%" bgcolor="#fff" cellspacing="0" border="1" cellpadding="8" style="margin-top:25px;">
		<thead>
			<tr height="30" bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';">
				<th align="left" width="59%">Component Name</th>
				<th align="left" width="13%">Available Qty</th>
				<th align="left" width="13%">Required Qty</th>
				<th align="left" width="15%">Remaining Qty</th>
			</tr>
		</thead>
		<tbody class="ui-sortable">';



		if(!empty($table_data)){
			foreach ($table_data as  $value) {
				$probody .='<tr class="main" id="tr0" >
					<td width="59%" align="center">
						<div class="form-group" align="center">'.$value->name.'</div>
					</td>
					<td width="13%" align="center">
						<div class="form-group">'.$value->availableqty.'</div>
					</td>
					<td width="13%" align="center">
						<div class="form-group">'.$value->requiredqty.'</div>
					</td>
					<td width="15%" align="center">
						<div class="form-group">'.$value->remainingqty.'</div>
					</td>
				</tr>';	
			}
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