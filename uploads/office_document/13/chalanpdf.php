
<?php
$estimate_number=$estimate->chalanno;
$rr= format_customer_info($estimate, 'estimate', 'billing');
//echo"<pre>";print_r($estimate);exit;
if($estimate->service_type==2)
{
	$othercharges=get_pro_estimate_othercharges($estimate->id,'1');
	$is_sale=1;
	$type='sale';
	$profor='Challan For Sale';
	$subtotal=$estimate->salesubtotal;
}
else if($estimate->service_type==1)
{
	$othercharges=get_pro_estimate_othercharges($estimate->id,'0');	
	$is_sale=0;
	$type='rent';
	$profor='Challan For Rent';
	$subtotal=$estimate->rentsubtotal;
}
else
{
	$othercharges=get_pro_estimate_othercharges($estimate->id,'0');	
	$is_sale=2;
	$type='sale';
	$profor='Performance Invoice For Rent & Sale';
	$subtotal=$estimate->salesubtotal+$estimate->rentsubtotal;
}
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
$prohead='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="left" width="50%"><img src="'.$pdf_logo_url.'"></td><td align="left" width="50%"><table style="padding:6px;"><thead style="padding:10px;"><tr style="background-color:' . get_option('pdf_table_heading_color') . '; color:#fff; padding:10px;"><th style="padding:8px;"><b>'.$profor.'</b></th><th style="padding:8px;"></th></tr></thead><tbody><tr><td>Proposal No :</td><td align="left"># '.$number.'</td></tr><tr><td>Date :</td><td align="left">'.$proposal_date.'</td></tr></tbody></table></td></tr></table>';
// Header
$tblhtml = '<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="left" width="50%"><img src="'.$pdf_logo_url.'"></td><td align="left" width="50%"><table style="padding:6px;"><thead style="padding:10px;"><tr style="background-color:' . get_option('pdf_table_heading_color') . '; color:#fff; padding:10px;"><th style="padding:8px;"><b>'.$profor.'</b></th><th style="padding:8px;"></th></tr></thead><tbody><tr><td>Challan No :</td><td align="left"># '.$estimate_number.'</td></tr><tr><td>Date :</td><td align="left">'._d($estimate->datecreated).'</td></tr><tr><td>Work Order No</td><td>'.$estimate->work_no.'</td></tr><tr><td>Work Order Date</td><td>'. _d($estimate->workdate).'</td></tr></tbody></table></td></tr></table><table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><thead style="padding:10px;"><tr style=""><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left" ><b>From</b></th><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left"  ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To</b></th></tr></thead><tr><td align="left" width="60%">'.format_organization_info().'</td><td align="left" width="40%;">'.$rr.'</td></tr></table><br/><br/><br/><br/><br/><table width="100%"  style="border:1px solid black" bgcolor="#fff"  cellpadding="8">';

$tblhtml .= '<tr height="30"  bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';">';

$tblhtml .= '<th width="15%" align="left">Sr.No</th>';
$tblhtml .= '<th width="70%" align="left">Description</th>';
$tblhtml .= '<th width="15%" align="left">QTY</th>';
/*$tblhtml .= '<th width="15%" align="left"></th>';
$tblhtml .= '<th width="15%" align="left"></th>';
$tblhtml .= '<th width="15%" align="left"></th>';*/

$tblhtml .= '</tr>';

$tblhtml .= '<tbody>';


$items_data = chalan_details($estimate->items,$is_sale);
$tblhtml .= $items_data;
//$tblhtml .= $items_data['html'];
$taxes = $items_data['taxes'];

$tblhtml .= '</tbody>';
$tblhtml .= '</table>
<table width="100%"  cellpadding="8" border="1px" style="font-size:'.($font_size+4).'px"><tr ><td   style="background-color:yellow;color:red;font-weight:600;">Kindly Handle with care or be ready to bear the COST for damage..!!
</td></tr></table>
<table width="100%"  border="1px" cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="center">During Delivery: Date<br/><br/><br/><br/>Delivered By Schach Employee (Name)<br/><br/><br/><br/>Received By Client Employee<br/>(Signature, Name, Contact No)</td><td align="center">During Pickup: Date<br/><br/><br/><br/>Pickup By Schach Employee (Name)<br/><br/><br/><br/>Material Out By Client Employee<br/>(Signature, Name, Contact No)</td></tr></table>
<table cellpadding="8" border="1px" style="font-size:'.($font_size+4).'px"><tr><td align="center">We Assure you the best services from SCHACH Engg. Thanks</td></tr></table>';
//echo $tblhtml;exit;
$pdf->writeHTML($tblhtml, true, false, false, false, '');

$pdf->Ln(8);


if(get_option('total_to_words_enabled') == 1){
     // Set the font bold
     $pdf->SetFont($font_name,'B',$font_size);
     $pdf->Cell(0, 0, _l('num_word').': '.$CI->numberword->convert($estimate->total,$estimate->currency_name), 0, 1, 'C', 0, '', 0);
     // Set the font again to normal like the rest of the pdf
     $pdf->SetFont($font_name,'',$font_size);
     $pdf->Ln(4);
}

if (!empty($estimate->clientnote)) {
    $pdf->Ln(4);
    $pdf->SetFont($font_name,'B',$font_size);
    $pdf->Cell(0, 0, _l('estimate_note'), 0, 1, 'L', 0, '', 0);
    $pdf->SetFont($font_name,'',$font_size);
    $pdf->Ln(2);
    $pdf->writeHTMLCell('', '', '', '', $estimate->clientnote, 0, 1, false, true, 'L', true);
}

if (!empty($estimate->terms)) {
    $pdf->Ln(4);
    $pdf->SetFont($font_name,'B',$font_size);
    $pdf->Cell(0, 0, _l('terms_and_conditions'), 0, 1, 'L', 0, '', 0);
    $pdf->SetFont($font_name,'',$font_size);
    $pdf->Ln(2);
    $pdf->writeHTMLCell('', '', '', '', $estimate->terms, 0, 1, false, true, 'L', true);
}
