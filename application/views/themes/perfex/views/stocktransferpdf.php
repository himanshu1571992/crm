
<?php

//echo"<pre>";print_r($estimate);
//echo $estimate_number=$estimate['stock_transfer']['transferstockno'];exit;
$rr= format_customer_info($estimate, 'estimate', 'billing');
$type=$estimate['service_type'];
$fromwarehouse=$estimate['fromwarehouse'];
$towarehouse=$estimate['towarehouse'];
$transferstockno=$estimate['stock_transfer']['transferstockno'];
$created_at=$estimate['stock_transfer']['created_at'];
//echo"<pre>";print_r($estimate);exit;

//echo $subtotal;exit;

$dimensions = $pdf->getPageDimensions();



// Get Y position for the separation
$y            = $pdf->getY();





// The Table
$pdf->Ln(do_action('pdf_info_and_table_separator', 6));
$item_width = 38;
// If show item taxes is disabled in PDF we should increase the item width table heading
$item_width = get_option('show_tax_per_item') == 0 ? $item_width+15 : $item_width;
$custom_fields_items = get_items_custom_fields_for_table_html($estimate->id,'estimate');

// Calculate headings width, in case there are custom fields for items
$total_headings = get_option('show_tax_per_item') == 1 ? 4 : 3;
$total_headings += count($custom_fields_items);
//$headings_width = (100-($item_width+6)) / $total_headings;
$headings_width =20;
$qty_heading = _l('estimate_table_quantity_heading');
if($estimate->show_quantity_as == 2){
    $qty_heading = _l('estimate_table_hours_heading');
} else if($estimate->show_quantity_as == 3){
    $qty_heading = _l('estimate_table_quantity_heading') .'/'._l('estimate_table_hours_heading');
}
$pdf_logo_url=pdf_logo_url();
$prohead='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="left" width="50%"><img src="'.$pdf_logo_url.'"></td><td align="left" width="50%"><table style="padding:6px;"><thead style="padding:10px;"><tr style="background-color:' . get_option('pdf_table_heading_color') . '; color:#fff; padding:10px;"><th style="padding:8px;"><b>'.$type.'</b></th><th style="padding:8px;"></th></tr></thead><tbody><tr><td>Proposal No :</td><td align="left"># '.$number.'</td></tr><tr><td>Date :</td><td align="left">'.$proposal_date.'</td></tr></tbody></table></td></tr></table>';
// Header
$tblhtml = '<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="left" width="50%"><img src="'.$pdf_logo_url.'"></td><td align="left" width="50%"><table style="padding:6px;"><thead style="padding:10px;"><tr style="background-color:' . get_option('pdf_table_heading_color') . '; color:#fff; padding:10px;"><th style="padding:8px;"><b>'.$type.'</b></th><th style="padding:8px;"></th></tr></thead><tbody><tr><td>Transfer Stock No :</td><td align="left"># '.$transferstockno.'</td></tr><tr><td>Date :</td><td align="left">'._d($created_at).'</td></tr><tr><td>Transfer To :</td><td>'.$towarehouse.'</td></tr><tr><td>Transfer From :</td><td>'.$fromwarehouse.'</td></tr></tbody></table></td></tr></table><br/><br/><br/><br/><br/><table width="100%"  style="border:1px solid black" bgcolor="#fff"  cellpadding="8">';

$tblhtml .= '<tr height="30"  bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';">';

$tblhtml .= '<th width="'.$headings_width.'%" align="left">Sr.No</th>';
$tblhtml .= '<th width="'.$headings_width.'%" align="left">Component Name</th>';
$tblhtml .= '<th width="15%" align="left">Deliverable Quantity</th>';
$tblhtml .= '<th width="15%" align="left"></th>';
$tblhtml .= '<th width="15%" align="left"></th>';
$tblhtml .= '<th width="15%" align="left"></th>';

$tblhtml .= '</tr>';

$tblhtml .= '<tbody>';


$items_data = transferstock_details($estimate['stock_transfer_det']);
$tblhtml .= $items_data;
//$tblhtml .= $items_data['html'];

$tblhtml .= '</tbody>';
$tblhtml .= '</table>
<table width="100%"  cellpadding="8" border="1px" style="font-size:'.($font_size+4).'px"><tr ><td width="55%"  style="background-color:yellow;color:red;font-weight:600;">Kindly Handle with care or be ready to bear the COST for damage..!!
</td><td width="15%" ></td><td width="15%"></td><td width="15%"></td></tr></table>
<table width="100%"  border="1px" cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="center">During Delivery: Date<br/><br/><br/><br/>Delivered By Schach Employee (Name)<br/><br/><br/><br/>Received By Client Employee<br/>(Signature, Name, Contact No)</td><td align="center">During Pickup: Date<br/><br/><br/><br/>Pickup By Schach Employee (Name)<br/><br/><br/><br/>Material Out By Client Employee<br/>(Signature, Name, Contact No)</td></tr></table>
<table cellpadding="8" border="1px" style="font-size:'.($font_size+4).'px"><tr><td align="center">We Assure you the best services from SCHACH Engg. Thanks</td></tr></table>';
//echo $tblhtml;exit;
$pdf->writeHTML($tblhtml, true, false, false, false, '');

$pdf->Ln(8);



