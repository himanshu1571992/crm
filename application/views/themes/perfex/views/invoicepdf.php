<?php

$check_invoice_rent_item = check_proposal_item($invoice->id,0,'invoice');
$check_invoice_sale_item = check_proposal_item($invoice->id,1,'invoice');

if($check_invoice_rent_item>=1){
  $type = 'rent';
}elseif($check_invoice_sale_item>=1){
  $type = 'sale';
}

//if($_GET['type']=='sale')
if($type=='sale')
{
	$othercharges=get_pro_invoice_othercharges($invoice->id,'1');
	$is_sale=1;
	$type='sale';
	$profor='Invoice For Sale';
	$subtotal=$invoice->salesubtotal;
}
//else if($_GET['type']=='rent')
else if($type=='rent')
{
	$othercharges=get_pro_invoice_othercharges($invoice->id,'0');	
	$is_sale=0;
	$type='rent';
	$profor='Invoice For Rent';
	$subtotal=$invoice->rentsubtotal;
}

$dimensions = $pdf->getPageDimensions();



/*$months_info = '';
if($type=='rent'){
  if(!empty($invoice->items)){
    if($invoice->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Invoice is for '.$invoice->items[0]['months'].' Month and '.$invoice->items[0]['days'].' Days </b>';
    }else{
       $months_info = '<br /><br /><b>Note :- The Invoice is for '.$invoice->items[0]['months'].' Month </b>';
    }
   
  }
}*/


$months_info = '';
if($type=='rent'){
  if(!empty($invoice->items)){
    
    if($invoice->items[0]['months'] > 0 && $invoice->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proposal is for '.$invoice->items[0]['months'].' Month and '.$invoice->items[0]['days'].' Days </b>';
    }elseif($invoice->items[0]['months'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proposal is for '.$invoice->items[0]['months'].' Month </b>';
    }elseif($invoice->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proposal is for '.$invoice->items[0]['days'].' Days </b>';
    }
   
  }
}


//For dicount show
$show_discount = 0;
if(!empty($invoice->items)){
  foreach ($invoice->items as $key => $value) {
      if($value['discount'] > 0){
        $show_discount = 1;
      }
  }

}





$info_right_column = '';
$info_left_column  = '';

$info_right_column .= '<span style="font-weight:bold;font-size:27px;">' . _l('invoice_pdf_heading') . '</span><br />';
$info_right_column .= '<b style="color:#4e4e4e;"># ' . $invoice_number . '</b>';
$info_right_column .= '<br/><b style="color:#4e4e4e;">' . _d($invoice->invoice_date) . '</b>';

if (get_option('show_status_on_pdf_ei') == 1) {
    $info_right_column .= '<br /><span style="color:rgb('.invoice_status_color_pdf($status).');text-transform:uppercase;">' . format_invoice_status($status, '', false) . '</span>';
}

if ($status != 2 && $status != 5 && get_option('show_pay_link_to_invoice_pdf') == 1
    && found_invoice_mode($payment_modes, $invoice->id, false)) {
    $info_right_column .= ' - <a style="color:#84c529;text-decoration:none;text-transform:uppercase;" href="' . site_url('invoice/' . $invoice->id . '/' . $invoice->hash) . '"><1b>' . _l('view_invoice_pdf_link_pay') . '</1b></a>';
}

// write the first column
$info_left_column .= pdf_logo_url();
$pdf->MultiCell(($dimensions['wk'] / 2) - $dimensions['lm'], 0, $info_left_column, 0, 'J', 0, 0, '', '', true, 0, true, true, 0);
// write the second column
$pdf->MultiCell(($dimensions['wk'] / 2) - $dimensions['rm'], 0, $info_right_column, 0, 'R', 0, 1, '', '', true, 0, true, false, 0);
$pdf->ln(10);

// Get Y position for the separation
$y            = $pdf->getY();
$organizaion_info = '<div style="color:#424242;">';

$organizaion_info .= format_organization_info();

$organizaion_info .= '</div>';

$organizaion_info .= '<div style="color:#424242;"><b>Bank Details </b> <br/> A/C No. - 8111580589 <br/> IFSC Code - KKBK0000649</div>';

$pdf->writeHTMLCell(($swap == '1' ? ($dimensions['wk']) - ($dimensions['lm'] * 2) : ($dimensions['wk'] / 2) - $dimensions['lm']), '', '', $y, $organizaion_info, 0, 0, false, true, ($swap == '1' ? 'R' : 'J'), true);

// Bill to
$invoice_info = '<b>' . _l('invoice_bill_to') . '</b>';
$invoice_info .= '<div style="color:#424242;">';
$invoice_info .= format_customer_info($invoice, 'invoice', 'billing');
$invoice_info .= '</div>';


$invoice_info .= get_invoice_shipto_data($invoice->id);



// ship to to
if ($invoice->include_shipping == 1 && $invoice->show_shipping_on_invoice == 1) {
    $invoice_info .= '<br /><b>' . _l('ship_to') . '</b>';
    $invoice_info .= '<div style="color:#424242;">';
    $invoice_info .= format_customer_info($invoice, 'invoice', 'shipping');
    $invoice_info .= '</div>';
}

$invoice_info .= '<br />'._l('invoice_data_date') . ' ' . _d($invoice->date).'<br />';

if (!empty($invoice->duedate)) {
    $invoice_info .= _l('invoice_data_duedate') . ' ' . _d($invoice->duedate).'<br />';
}

if ($invoice->sale_agent != 0 && get_option('show_sale_agent_on_invoices') == 1) {
    $invoice_info .= _l('sale_agent_string') . ': ' . get_staff_full_name($invoice->sale_agent).'<br />';
}

if ($invoice->project_id != 0 && get_option('show_project_on_invoice') == 1) {
    $invoice_info .= _l('project') . ': ' . get_project_name_by_id($invoice->project_id).'<br />';
}

/*foreach ($pdf_custom_fields as $field) {
    $value = get_custom_field_value($invoice->id, $field['id'], 'invoice');
    if ($value == '') {
        continue;
    }
    $invoice_info .= $field['name'] . ': ' . $value.'<br />';
}*/

$pdf->writeHTMLCell(($dimensions['wk'] / 2) - $dimensions['rm'], '', '', ($swap == '1' ? $y : ''), $invoice_info, 0, 1, false, true, ($swap == '1' ? 'J' : 'R'), true);

// The Table
$pdf->Ln(do_action('pdf_info_and_table_separator', 6));
$item_width = 38;

// If show item taxes is disabled in PDF we should increase the item width table heading
$item_width = get_option('show_tax_per_item') == 0 ? $item_width+15 : $item_width;

$custom_fields_items = get_items_custom_fields_for_table_html($invoice->id,'invoice');
// Calculate headings width, in case there are custom fields for items


$CI =& get_instance();
$item_info = $CI->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$invoice->id."' ")->row();
$type = '';
if(!empty($item_info)){
    if($item_info->is_sale == 0){
        $type = 'rent';
    }elseif($item_info->is_sale == 1){
        $type = 'sale';
    }
}

$total_headings = get_option('show_tax_per_item') == 1 ? 5 : 4;
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

$headings_width = (100-($item_width+7)) / $total_headings;






// Header
$qty_heading = _l('invoice_table_quantity_heading');
if ($invoice->show_quantity_as == 2) {
    $qty_heading = _l('invoice_table_hours_heading');
} elseif ($invoice->show_quantity_as == 3) {
    $qty_heading = _l('invoice_table_quantity_heading') . '/' . _l('invoice_table_hours_heading');
}

$tblhtml = '<table width="100%" bgcolor="#fff" cellspacing="0" cellpadding="8">';

$tblhtml .= '<tr height="30" bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';">';

$tblhtml .= '<th width="5%;" align="center">#</th>';
$tblhtml .= '<th width="'.$item_width.'%" align="left">' . _l('invoice_table_item_heading') . '</th>';

foreach ($custom_fields_items as $cf) {
    $tblhtml .= '<th width="'.$headings_width.'%" align="left">' . $cf['name'] . '</th>';
}

$tblhtml .= '<th width="'.$headings_width.'%" align="right">' . $qty_heading . '</th>';

/*if($type=='rent')
{
$tblhtml .= '<th width="'.$headings_width.'%" align="right">Months</th>';
}
*/
$tblhtml .= '<th width="'.$headings_width.'%" align="right">' . _l('invoice_table_rate_heading') . '</th>';

/*if (get_option('show_tax_per_item') == 1) {
    $tblhtml .= '<th width="'.$headings_width.'%" align="right">' . _l('invoice_table_tax_heading') . '</th>';
}*/


if($show_discount == 1){
   $tblhtml .= '<th width="'.$headings_width.'%" align="right">Discount</th>';
}

$tblhtml .= '<th width="'.$headings_width.'%" align="right">' . _l('invoice_table_amount_heading') . '</th>';
$tblhtml .= '</tr>';

// Items
$tblhtml .= '<tbody>';

$items_data = get_table_items_and_taxe($invoice->items, 'invoice',true,$is_sale);

//$tblhtml .= $items_data['html'];
$taxes = $items_data['taxes'];

$ttl_value = 0;

if(!empty($invoice->items)){
     $total_price = 0;
     foreach ($invoice->items as $key => $value) {
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
                <td class="dragger">'.$value['description'].'<br/>'.get_productfields_list('tblinvoiceproductfields',$invoice->id,$value['pro_id']).'</td>
                <td align="right">'.$qty.'</td>';

        /*if($type=='rent'){
         $tblhtml .=  '<td align="right">'.number_format($totalmonths, 2, '.', '').'</td>';
        }        
*/

        $tblhtml .=  '<td align="right">'.$rate.'</td>';

        if($show_discount == 1){
            $tblhtml .=  '<td align="right">'.$dis.'%<br></td>';
        }

         $tblhtml .=  '<td class="amount" align="right">'.number_format($final_price, 2, '.', '').'</td>
           </tr>';
        
     }
  }
    


$tblhtml .= '</tbody>';
$tblhtml .= '</table>';
$pdf->writeHTML($tblhtml, true, false, false, false, '');

$pdf->Ln(8);






$tbltotal .= '<table cellpadding="6" style="width:100%;" style="font-size:'.($font_size+4).'px">';

$final_amount = 0;
if(!empty($invoice->items)){                

     $tbltotal .= '<tr>
            <td align="right" width="85%"><strong>Sub Total</strong></td>
            <td align="right" width="15%">' . format_money($total_price,$invoice->symbol) . '</td>
        </tr>';

      
      $discount = 0;
      if(!empty($invoice->discount_percent > 0)){
         $discount = ($total_price*$invoice->discount_percent/100);
        
         $tbltotal .= '<tr>
            <td align="right" width="85%"><strong>Discount</strong></td>
            <td align="right" width="15%">-'.number_format($discount, 2, '.', '').'</td>
        </tr>';        
      }

      // For Excluding Other Charges Tax
      if($invoice->other_charges_tax == 2){
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

      if(!empty($invoice->tax_type == 1)){
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
        if($invoice->other_charges_tax == 1){
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


        $tbltotal .= '<tr style="background-color:#f0f0f0;">
    <td align="right" width="85%"><strong>' . _l('invoice_total') . '</strong></td>
    <td align="right" width="15%">'.number_format($final_amount, 2, '.', '').'</td>
</tr>';

if (count($invoice->payments) > 0 && get_option('show_total_paid_on_invoice') == 1) {
    $tbltotal .= '
    <tr>
        <td align="right" width="85%"><strong>' . _l('invoice_total_paid') . '</strong></td>
        <td align="right" width="15%">-' . format_money(sum_from_table('tblinvoicepaymentrecords', array(
        'field' => 'amount',
        'where' => array(
            'invoiceid' => $invoice->id,
        ),
    )), $invoice->symbol) . '</td>
    </tr>';
}

if (get_option('show_credits_applied_on_invoice') == 1 && $credits_applied = total_credits_applied_to_invoice($invoice->id)) {
    $tbltotal .= '
    <tr>
        <td align="right" width="85%"><strong>' . _l('applied_credits') . '</strong></td>
        <td align="right" width="15%">-' . format_money($credits_applied, $invoice->symbol) . '</td>
    </tr>';
}


$paid_amt = format_money(sum_from_table('tblinvoicepaymentrecords',array('field'=>'amount','where'=>array('invoiceid'=>$invoice->id))),$invoice->symbol);
$due_amt = ($final_amount-$paid_amt);
if (get_option('show_amount_due_on_invoice') == 1 && $invoice->status != 5) {
    $tbltotal .= '<tr style="background-color:#f0f0f0;">
       <td align="right" width="85%"><strong>' . _l('invoice_amount_due') . '</strong></td>
       <td align="right" width="15%">' . format_money($due_amt, $invoice->symbol) . '</td>
   </tr>';
}

$tbltotal .= '</table>';

      
}




$tbltotal .= '<br /><br /><br /><b>In Words: '.convert_number_to_words($invoice->total).' </b>';

$tbltotal .= $months_info;

$tbltotal .= '<br/><br/><b>Material Value :- '.number_format($ttl_value, 2, '.', '').' /-</b>';

$tbltotal .= '<br />';
$tbltotal .= '<tr><td align="left" width="100%" bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';"><b>Notes :</b></td></tr>
<tr style="padding:10px;"> <td align="left" width="100%"><br/><b>Terms & conditions :</b><br/>'.$invoice->terms_and_conditions.'</td></tr></table>';


$pdf->writeHTML($tbltotal, true, false, false, false, '');

/*if (get_option('total_to_words_enabled') == 1) {
    // Set the font bold
    $pdf->SetFont($font_name, 'B', $font_size);
    $pdf->Cell(0, 0, 'In Words' . ': ' . $CI->numberword->convert($invoice->total, $invoice->currency_name).' Only', 0, 1, 'C', 0, '', 0);
    // Set the font again to normal like the rest of the pdf
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->Ln(4);
}*/

if (count($invoice->payments) > 0 && get_option('show_transactions_on_invoice_pdf') == 1) {
    $pdf->Ln(4);
    $border = 'border-bottom-color:#000000;border-bottom-width:1px;border-bottom-style:solid; 1px solid black;';
    $pdf->SetFont($font_name, 'B', $font_size);
    $pdf->Cell(0, 0, _l('invoice_received_payments'), 0, 1, 'L', 0, '', 0);
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->Ln(4);
    $tblhtml = '<table width="100%" bgcolor="#fff" cellspacing="0" cellpadding="5" border="0">
        <tr height="20"  style="color:#000;border:1px solid #000;">
        <th width="25%;" style="' . $border . '">' . _l('invoice_payments_table_number_heading') . '</th>
        <th width="25%;" style="' . $border . '">' . _l('invoice_payments_table_mode_heading') . '</th>
        <th width="25%;" style="' . $border . '">' . _l('invoice_payments_table_date_heading') . '</th>
        <th width="25%;" style="' . $border . '">' . _l('invoice_payments_table_amount_heading') . '</th>
    </tr>';
    $tblhtml .= '<tbody>';
    foreach ($invoice->payments as $payment) {
        $payment_name = $payment['name'];
        if (!empty($payment['paymentmethod'])) {
            $payment_name .= ' - ' . $payment['paymentmethod'];
        }
        $tblhtml .= '
            <tr>
            <td>' . $payment['paymentid'] . '</td>
            <td>' . $payment_name . '</td>
            <td>' . _d($payment['date']) . '</td>
            <td>' . format_money($payment['amount'], $invoice->symbol) . '</td>
            </tr>
        ';
    }
    $tblhtml .= '</tbody>';
    $tblhtml .= '</table>';

    
    $pdf->writeHTML($tblhtml, true, false, false, false, '');
}

/*if (found_invoice_mode($payment_modes, $invoice->id, true, true)) {
    $pdf->Ln(4);
    $pdf->SetFont($font_name, 'B', $font_size);
    $pdf->Cell(0, 0, _l('invoice_html_offline_payment'), 0, 1, 'L', 0, '', 0);
    $pdf->SetFont($font_name, '', $font_size);

    foreach ($payment_modes as $mode) {
        if (is_numeric($mode['id'])) {
            if (!is_payment_mode_allowed_for_invoice($mode['id'], $invoice->id)) {
                continue;
            }
        }
        if (isset($mode['show_on_pdf']) && $mode['show_on_pdf'] == 1) {
            $pdf->Ln(1);
            $pdf->Cell(0, 0, $mode['name'], 0, 1, 'L', 0, '', 0);
            $pdf->Ln(2);
            $pdf->writeHTMLCell('', '', '', '', $mode['description'], 0, 1, false, true, 'L', true);
        }
    }
}

if (!empty($invoice->clientnote)) {
    $pdf->Ln(4);
    $pdf->SetFont($font_name, 'B', $font_size);
    $pdf->Cell(0, 0, _l('invoice_note'), 0, 1, 'L', 0, '', 0);
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->Ln(2);
    $pdf->writeHTMLCell('', '', '', '', $invoice->clientnote, 0, 1, false, true, 'L', true);
}

if (!empty($invoice->terms)) {
    $pdf->Ln(4);
    $pdf->SetFont($font_name, 'B', $font_size);
    $pdf->Cell(0, 0, _l('terms_and_conditions'), 0, 1, 'L', 0, '', 0);
    $pdf->SetFont($font_name, '', $font_size);
    $pdf->Ln(2);
    $pdf->writeHTMLCell('', '', '', '', $invoice->terms, 0, 1, false, true, 'L', true);
}*/
