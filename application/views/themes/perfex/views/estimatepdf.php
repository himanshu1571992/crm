<?php

$check_estimate_rent_item=check_estimate_item($estimate->id,0);
$check_estimate_sale_item=check_estimate_item($estimate->id,1);

if($check_estimate_rent_item>=1){
  $type = 'rent';
}elseif($check_estimate_sale_item>=1){
  $type = 'sale';
}


//if($_GET['type']=='sale')
if($type=='sale')
{
	$othercharges=get_pro_estimate_othercharges($estimate->id,'1');
	$is_sale=1;
	$type='sale';
	$profor='Performance Invoice For Sale';
	$subtotal=$estimate->salesubtotal;
}
//else if($_GET['type']=='rent')
else if($type=='rent')
{
	$othercharges=get_pro_estimate_othercharges($estimate->id,'0');	
	$is_sale=0;
	$type='rent';
	$profor='Performance Invoice For Rent';
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


/*echo '<pre/>';
print_r($estimate->items);
die;*/

/*$months_info = '';
if($type=='rent'){
  if(!empty($estimate->items)){
    if($estimate->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proforma Invoice is for '.$estimate->items[0]['months'].' Month and '.$estimate->items[0]['days'].' Days </b>';
    }else{
       $months_info = '<br /><br /><b>Note :- The Proforma Invoice is for '.$estimate->items[0]['months'].' Month </b>';
    }
   
  }
}*/


$months_info = '';
if($type=='rent'){
  if(!empty($estimate->items)){
    
    if($estimate->items[0]['months'] > 0 && $estimate->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proforma Invoice is for '.$estimate->items[0]['months'].' Month and '.$estimate->items[0]['days'].' Days </b>';
    }elseif($estimate->items[0]['months'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proforma Invoice is for '.$estimate->items[0]['months'].' Month </b>';
    }elseif($estimate->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proforma Invoice is for '.$estimate->items[0]['days'].' Days </b>';
    }
   
  }
}

//For dicount show

$show_discount = 0;
if(!empty($estimate->items)){
  foreach ($estimate->items as $key => $value) {
      if($value['discount'] > 0){
        $show_discount = 1;
      }
  }

}



$dimensions = $pdf->getPageDimensions();

$info_right_column = '';
$info_left_column = '';

$info_right_column .= '<span style="font-weight:bold;font-size:27px;">Proforma Invoice</span><br />';
$info_right_column .= '<b style="color:#4e4e4e;"># ' . $estimate_number . '</b>';

if(get_option('show_status_on_pdf_ei') == 1){
    $info_right_column .= '<br /><span style="color:rgb('.estimate_status_color_pdf($status).');text-transform:uppercase;">' . format_estimate_status($status,'',false) . '</span>';
}

// write the first column
$info_left_column .= pdf_logo_url();
$pdf->MultiCell(($dimensions['wk'] / 2) - $dimensions['lm'], 0, $info_left_column, 0, 'J', 0, 0, '', '', true, 0, true, true, 0);
// write the second column
$pdf->MultiCell(($dimensions['wk'] / 2) - $dimensions['rm'], 0, $info_right_column, 0, 'R', 0, 1, '', '', true, 0, true, false, 0);
$pdf->ln(10);

// Get Y position for the separation
$y            = $pdf->getY();
$organization_info = '<div style="color:#424242;">';
$organization_info .= format_organization_info();
$organization_info .= '<br><b>Bank Details </b> <br/> A/C No. - 8111580589 <br/> IFSC Code - KKBK0000649'; 
$organization_info .= '</div>';

//$organization_info .= '<div style="color:#424242;"><b>Bank Details </b> <br/> A/C No. - 8111580589 <br/> IFSC Code - KKBK0000649</div>';

$pdf->writeHTMLCell(($swap == '1' ? ($dimensions['wk']) - ($dimensions['lm'] * 2) : ($dimensions['wk'] / 2) - $dimensions['lm']), '', '', $y, $organization_info, 0, 0, false, true, ($swap == '1' ? 'R' : 'J'), true);

// Estimate to
$estimate_info = '<b>' ._l('estimate_to') . '</b>';
$estimate_info .= '<div style="color:#424242;">';
$estimate_info .= format_customer_info($estimate, 'estimate', 'billing');
$estimate_info .= '</div>';

// ship to to
if($estimate->include_shipping == 1 && $estimate->show_shipping_on_estimate == 1){
    $estimate_info .= '<br /><b>' . _l('ship_to') . '</b>';
    $estimate_info .= '<div style="color:#424242;">';
    $estimate_info .= format_customer_info($estimate, 'estimate', 'shipping');
    $estimate_info .= '</div>';
}

$estimate_info .= '<br />'._l('estimate_data_date') . ': ' . _d($estimate->date).'<br />';

if (!empty($estimate->expirydate)) {
    $estimate_info .= _l('estimate_data_expiry_date') . ': ' . _d($estimate->expirydate) . '<br />';
}

if (!empty($estimate->reference_no)) {
    $estimate_info .= _l('reference_no') . ': ' . $estimate->reference_no. '<br />';
}

if($estimate->sale_agent != 0 && get_option('show_sale_agent_on_estimates') == 1){
    $estimate_info .= _l('sale_agent_string') . ': ' .  get_staff_full_name($estimate->sale_agent). '<br />';
}

if ($estimate->project_id != 0 && get_option('show_project_on_estimate') == 1) {
    $estimate_info .= _l('project') . ': ' . get_project_name_by_id($estimate->project_id). '<br />';
}

foreach($pdf_custom_fields as $field){
    $value = get_custom_field_value($estimate->id,$field['id'],'estimate');
    if($value == ''){continue;}
    $estimate_info .= $field['name'] . ': ' . $value. '<br />';
}

$pdf->writeHTMLCell(($dimensions['wk'] / 2) - $dimensions['rm'], '', '', ($swap == '1' ? $y : ''), $estimate_info, 0, 1, false, true, ($swap == '1' ? 'J' : 'R'), true);

// The Table
$pdf->Ln(do_action('pdf_info_and_table_separator', 6));
$item_width = 38;
// If show item taxes is disabled in PDF we should increase the item width table heading
$item_width = get_option('show_tax_per_item') == 0 ? $item_width+15 : $item_width;
$custom_fields_items = get_items_custom_fields_for_table_html($estimate->id,'estimate');

// Calculate headings width, in case there are custom fields for items
$total_headings = get_option('show_tax_per_item') == 1 ? 4 : 3;
$total_headings += count($custom_fields_items);

/*if($type == 'rent'){
  $total_headings = 5;
}else{
  $total_headings = 4;
}*/

$total_headings = 4;

if($show_discount == 0){
  $total_headings = $total_headings-1;
}

$headings_width = (100-($item_width+6)) / $total_headings;

$qty_heading = _l('estimate_table_quantity_heading');
if($estimate->show_quantity_as == 2){
    $qty_heading = _l('estimate_table_hours_heading');
} else if($estimate->show_quantity_as == 3){
    $qty_heading = _l('estimate_table_quantity_heading') .'/'._l('estimate_table_hours_heading');
}

// Header
$tblhtml = '<table width="100%" bgcolor="#fff" cellspacing="0" cellpadding="8">';

$tblhtml .= '<tr height="30" bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';">';

$tblhtml .= '<th width="5%;" align="center">#</th>';
$tblhtml .= '<th width="'.$item_width.'%" align="left">' . _l('estimate_table_item_heading') . '</th>';


$tblhtml .= '<th width="'.$headings_width.'%" align="right">' . $qty_heading . '</th>';
/*if($type=='rent')
{
$tblhtml .= '<th width="'.$headings_width.'%" align="right">Months</th>';
}*/
$tblhtml .= '<th width="'.$headings_width.'%" align="right">' . _l('estimate_table_rate_heading') . '</th>';

/*if (get_option('show_tax_per_item') == 1) {
    $tblhtml .= '<th width="'.$headings_width.'%" align="right">Discount</th>';
}*/

 if($show_discount == 1){
   $tblhtml .= '<th width="'.$headings_width.'%" align="right">Discount</th>';
}

$tblhtml .= '<th width="'.$headings_width.'%" align="right">' . _l('estimate_table_amount_heading') . '</th>';
$tblhtml .= '</tr>';

$tblhtml .= '<tbody>';

$items_data = get_table_items_and_taxe($estimate->items,'estimate',true,$is_sale);

//$tblhtml .= $items_data['html'];

$ttl_value = 0;
if(!empty($estimate->items)){
     $total_price = 0;
     foreach ($estimate->items as $key => $value) {
        $qty = $value['qty'];
        $rate = $value['rate'];
        $dis = $value['discount'];

        if($value['is_sale'] == 0){
           $totalmonths = ($value['months'] + ($value['days'] / 30));
           $price = ($rate * $qty * $totalmonths);
        }else{
           $price = ($rate * $qty);
        }

        $dis_price = ($price*$dis/100);

        $final_price = ($price - $dis_price);


        $total_price += $final_price;

        //getting material vlaue
        $ttl_value += get_material_value($value['pro_id'],$qty);

      
         $tblhtml .=  '<tr class="sortable" data-item-id="97">
                <td class="dragger item_no ui-sortable-handle" align="center">'.++$key.'</td>
                <td class="dragger">'.$value['description'].'<br/>'.get_productfields_list('tblestimateproductfields',$estimate->id,$value['pro_id']).'</td>
                <td align="right">'.$qty.'</td>';

        /*if($type=='rent'){
         $tblhtml .=  '<td align="right">'.$totalmonths.'</td>';
        } */               

        $tblhtml .=  '<td align="right">'.$rate.'</td>';

        if($show_discount == 1){
            $tblhtml .=  '<td align="right">'.$dis.'%<br></td>';
        }
        


        $tblhtml .=  '<td class="amount" align="right">'.number_format($final_price, 2, '.', '').'</td>
           </tr>';
        
     }
  }


$taxes = $items_data['taxes'];

$tblhtml .= '</tbody>';
$tblhtml .= '</table>';

$pdf->writeHTML($tblhtml, true, false, false, false, '');

$pdf->Ln(8);
$tbltotal = '';

$tbltotal .= '<table cellpadding="6" style="width:100%;" style="font-size:'.($font_size+4).'px">';

$final_amount = 0;
if(!empty($estimate->items)){                

     $tbltotal .= '<tr>
            <td align="right" width="85%"><strong>Sub Total</strong></td>
            <td align="right" width="15%">' . format_money($total_price,$estimate->symbol) . '</td>
        </tr>';

      
      $discount = 0;
      if(!empty($estimate->discount_percent > 0)){
         $discount = ($total_price*$estimate->discount_percent/100);
        
         $tbltotal .= '<tr>
            <td align="right" width="85%"><strong>Discount</strong></td>
            <td align="right" width="15%">-'.number_format($discount, 2, '.', '').'</td>
        </tr>';        
      }

      // For Excluding Other Charges Tax
      if($estimate->other_charges_tax == 2){
            if(!empty($othercharges)){
            foreach ($othercharges as $key => $value) {

              $total_price += $value['total_maount'];

              $tbltotal .= '<tr>
                              <td align="right" width="85%"><strong>'.$value['category_name'].'</strong></td>
                              <td align="right" width="15%">'.number_format($value['total_maount'], 2, '.', '').'</td>
                          </tr>';
           }
         }

      }

      $afr_dis_price = ($total_price - $discount);

      $final_discount_price = ($afr_dis_price*18/100);
      $final_amount = ($final_discount_price + $total_price - $discount);

      if(!empty($estimate->tax_type == 1)){
         $final_dis_price = ($afr_dis_price*9/100);

         $tbltotal .= '<tr>
            <td align="right" width="85%"><strong>SGST (9.00%)</strong></td>
            <td align="right" width="15%">'.number_format($final_dis_price, 2, '.', '').'</td>
        </tr>';  

        $tbltotal .= '<tr>
            <td align="right" width="85%"><strong>SGST (9.00%)</strong></td>
            <td align="right" width="15%">'.number_format($final_dis_price, 2, '.', '').'</td>
        </tr>';  

      }else{
         $final_dis_price = ($afr_dis_price*18/100);

         $tbltotal .= '<tr>
            <td align="right" width="85%"><strong>IGST (18.00%)</strong></td>
            <td align="right" width="15%">'.number_format($final_dis_price, 2, '.', '').'</td>
        </tr>';
      }


      //if($othercharges[0]['category_name']!=''){
      /*if(!empty($othercharges)){  
           foreach ($othercharges as $othercharge) { 
              if(!empty($othercharge['category_name'])){

                    $final_amount += $othercharge['total_maount'];

                    $tbltotal .= '<tr>
                        <td align="right" width="85%"><strong>'.$othercharge['category_name'].'</strong></td>
                        <td align="right" width="15%">'.number_format($othercharge['total_maount'], 2, '.', '').'</td>
                    </tr>';

                   ?>
                  
              <?php
              }
             
            }
        }*/

       // For Excluding Other Charges Tax
      if($estimate->other_charges_tax == 1){
       if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {

            $final_amount += $value['total_maount'];

            $tbltotal .= '<tr>
                            <td align="right" width="85%"><strong>'.$value['category_name'].'</strong></td>
                            <td align="right" width="15%">'.number_format($value['total_maount'], 2, '.', '').'</td>
                        </tr>';
         }
       }  
     }
          


      $tbltotal .= '<tr>
            <td align="right" width="85%"><strong>Total</strong></td>
            <td align="right" width="15%">'.number_format($final_amount, 2, '.', '').'</td>
        </tr>';  
      
}



$tbltotal .= '</table>';
//echo $tblhtml;
//echo $tbltotal;exit;

$tbltotal .= '<br /><br /><br /><b>In Words: '.convert_number_to_words($estimate->total).' </b>';

$tbltotal .= $months_info;
$tbltotal .= '<br/><br/><b>Material Value :- '.number_format($ttl_value, 2, '.', '').' /-</b>';

$tbltotal .= '<br />';
$tbltotal .= '<tr><td align="left" width="100%" bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';"><b>Notes :</b></td></tr>
<tr style="padding:10px;"> <td align="left" width="100%"><br/><b>Terms & conditions :</b><br/>'.$estimate->terms_and_conditions.'</td></tr></table>';



$pdf->writeHTML($tbltotal, true, false, false, false, '');

/*if(get_option('total_to_words_enabled') == 1){
     // Set the font bold
     $pdf->SetFont($font_name,'B',$font_size);
     $pdf->Cell(0, 0, _l('num_word').': '.$CI->numberword->convert(round($final_amount, 0),$estimate->currency_name), 0, 1, 'C', 0, '', 0);
     // Set the font again to normal like the rest of the pdf
     $pdf->SetFont($font_name,'',$font_size);
     $pdf->Ln(4);
}*/

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



