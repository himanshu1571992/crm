<?php

//echo format_proposal_info($proposal,'pdf');exit;
//echo"<pre>";print_r($proposal);exit;
$dimensions = $pdf->getPageDimensions();

$check_proposal_rent_item = check_proposal_item($proposal->id,0,'proposal');
$check_proposal_sale_item = check_proposal_item($proposal->id,1,'proposal');



if(!empty($_GET['type'])){
  $type = $_GET['type'];  
}else{
  if($check_proposal_rent_item>=1){
    $type = 'rent';
  }elseif($check_proposal_sale_item>=1){
    $type = 'sale';
  }
}



if($type=='sale')
{
	$othercharges=get_pro_othercharges($proposal->id,'1');
	$profor='Proposal For Sale';
  $discount_percent = $proposal->sale_discount_percent;
}
else if($type=='rent')
{
	$othercharges=get_pro_othercharges($proposal->id,'0');	
	$profor='Proposal For Rent';
  $discount_percent = $proposal->rent_discount_percent;
}

//Getting the item list
$proposal->items = get_proposal_items_list($proposal->id,$type);


$months_info = '';
if($type=='rent'){
  if(!empty($proposal->items)){
    
    if($proposal->items[0]['months'] > 0 && $proposal->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proposal is for '.$proposal->items[0]['months'].' Month and '.$proposal->items[0]['days'].' Days </b>';
    }elseif($proposal->items[0]['months'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proposal is for '.$proposal->items[0]['months'].' Month </b>';
    }elseif($proposal->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proposal is for '.$proposal->items[0]['days'].' Days </b>';
    }
   
  }
}


//For dicount show

$show_discount = 0;
if(!empty($proposal->items)){
  foreach ($proposal->items as $key => $value) {
      if($value['discount'] > 0){
        $show_discount = 1;
      }
  }

}


//Getting status
if($proposal->status == 1){
  $status = 'Open';
}elseif($proposal->status == 2){
  $status = 'Decline';
}elseif($proposal->status == 3){
  $status = 'Accepted';
}elseif($proposal->status == 4){
  $status = 'Send';
}elseif($proposal->status == 5){
  $status = 'Revised';
}else{
  $status = '';
}



$pdf_logo_url = pdf_logo_url();


//echo format_proposal_info($proposal,'pdf');


//$pdf->writeHTMLCell(($dimensions['wk'] - ($dimensions['rm'] + $dimensions['lm'])), '', '', '', $pdf_logo_url, 0, 1, false, true, 'L', true);
if($proposal->terms_and_conditions!=''){$terms_and_conditions=$proposal->terms_and_conditions;}else{$terms_and_conditions="1). Payment: 100% Advance<br>2). Freight(Demob) will be charged extra at actual.<br>3). Lead Time- 2-3 working days from the date of receipt of confirm order.<br>4). Any other charges other than mentioned if incurred, shall be charged at actual. Sub Total (I) 66,000.00<br>5). Unloading of Equipment/Material will not be in SCHACH'S scope. Freight(mob) At actual<br>6). One time free training/Installation of scaffold/machine shall be conducted by us Sub Total (II) 66,000.00<br>7). Security cheque (without date ) of material value will be required CGST 9% 5,940.00<br>before material dispatch. (Material Value - 7.4 lacs) SGST 9% 5,940.00<br>We hope our offer is in line with your requirement and we wait for your valued order, which shall receive our best and prompt attention.";}
//$pdf->ln(4);
// Get Y position for the separation
$y            = $pdf->getY();

//$subject=$proposal->subject;
$proposal_date = _l('proposal_date') . ': ' . _d($proposal->date);
$open_till = '';
if(!empty($proposal->open_till)){
    $open_till = _l('proposal_open_till'). ': ' . _d($proposal->open_till) . '<br />';
}

$prohead='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="left" width="50%"><img src="'.$pdf_logo_url.'"></td><td align="left" width="50%"><table style="padding:6px;"><thead style="padding:10px;"><tr style="background-color:' . get_option('pdf_table_heading_color') . '; color:#fff; padding:10px;"><th style="padding:8px;"><b>'.$profor.'</b></th><th style="padding:8px;"><b>'.$status.'</b></th></tr></thead><tbody><tr><td>Proposal No :</td><td align="left"># '.$number.'</td></tr><tr><td>Date :</td><td align="left">'.$proposal_date.'</td></tr></tbody></table></td></tr></table>';
//<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><tr><td align="left"><b style="font-size:15px;"> Quotation No :# '.$number.'</b><br/><span style="font-size:15px;">Subject : '.$proposal->subject.'</span></td><td align="right"><br/><span style="font-size:15px;">'.$proposal_date.'</span><br/><span style="font-size:15px;">'.$open_till.'</span><br/></td></tr></table>
$dd='<table width="100%"  cellpadding="8" style="font-size:'.($font_size+4).'px"><thead style="padding:10px;"><tr style=""><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left" ><b>From</b></th><th style="padding:8px;background-color:' . get_option('pdf_table_heading_color') . '; color:#fff;" align="left"  ><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To</b></th></tr></thead><tr><td align="left" width="60%">'.format_organization_info().'</td><td align="left" width="40%;">'.get_proposal_to_data($proposal->id).'</td></tr></table>';




$html = <<<EOF

<div style="width:675px !important;">
$prohead

</div><div style="width:675px !important;">
$dd

</div>
EOF;



$item_width = 38;
// If show item taxes is disabled in PDF we should increase the item width table heading
$item_width = get_option('show_tax_per_item') == 0 ? $item_width+15 : $item_width;
$custom_fields_items = get_items_custom_fields_for_table_html($proposal->id,'proposal');
$yy= $CI->db->query("SELECT fieldname FROM `tblproposalproductfields` WHERE `proposalid`='".$proposal->id."'")->result_array();
$fieldname=array_column($yy,'fieldname');
// Calculate headings width, in case there are custom fields for items
$total_headings = get_option('show_tax_per_item') == 1 ? 4 : 3;
$total_headings += count($custom_fields_items);
if($type=='rent') {$headings_width = (100-($item_width+6)) / $total_headings; }else {$headings_width = (100-($item_width+6)) / $total_headings;}
if(in_array('photo',$fieldname)){
if($type=='rent') $headings_width = '10'; else $headings_width = '12';
}
else
{
	
  if($type=='rent') $headings_width = '14'; else $headings_width = '14';
}
if(in_array('photo',$fieldname)){
if($type=='rent') $footer_head_width = '93'; else $footer_head_width = '91';
}
else
{
	if($type=='rent') $footer_head_width = '91'; else $footer_head_width = '85';
}
if(in_array('photo',$fieldname)){
if($type=='rent') $footers_width = '103'; else $footers_width = '103';
}
else
{
if($type=='rent') $footers_width = '103'; else $footers_width = '99';	
}
// The same language keys from estimates are used here
$qty_heading = _l('estimate_table_quantity_heading');
if($proposal->show_quantity_as == 2){
    $qty_heading = _l('estimate_table_hours_heading');
} else if($proposal->show_quantity_as == 3){
    $qty_heading = _l('estimate_table_quantity_heading') .'/'._l('estimate_table_hours_heading');
}

if($show_discount == 0){
  $headings_width = $headings_width+5;
}


// Header
$items_html = '<table width="100%" bgcolor="#fff" cellspacing="0" cellpadding="8">';

$items_html .= '<tr height="30" bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';">';

$items_html .= '<th width="5%;" align="center">No.</th>';
if(in_array('photo',$fieldname)){$items_html .= '<th width="'.$headings_width.'%" align="center">Image</th>';}

$items_html .= '<th width="'.$item_width.'%" align="left">' . _l('estimate_table_item_heading') . '</th>';


foreach ($custom_fields_items as $cf) {
    $items_html .= '<th width="'.$headings_width.'%" align="left">' . $cf['name'] . '</th>';
}

$items_html .= '<th width="'.$headings_width.'%" align="right">' . $qty_heading . '</th>';
/*if($type=='rent')
{
$items_html .= '<th width="'.$headings_width.'%" align="right">Months</th>';
}*/
$items_html .= '<th width="'.$headings_width.'%" align="right">' . _l('estimate_table_rate_heading') . '</th>';

/*if (get_option('show_tax_per_item') == 1) {
    $items_html .= '<th width="'.$headings_width.'%" align="right">' . _l('estimate_table_tax_heading') . '</th>';
}*/

if($show_discount == 1){
  $items_html .= '<th width="'.$headings_width.'%" align="right">Discount</th>';
}


$items_html .= '<th width="'.$headings_width.'%" align="right">' . _l('estimate_table_amount_heading') . '</th>';
$items_html .= '</tr>';

$items_html .= '<tbody>';

$items_data = get_table_items_and_taxes($proposal->items,'proposal','',$type);
$taxes = $items_data['taxes'];
//$items_html .= $items_data['html'];



$ttl_value = 0;


if(!empty($proposal->items)){
     $total_price = 0;
     foreach ($proposal->items as $key => $value) {
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

      
        $items_html .=  '<tr class="sortable" data-item-id="97">
                <td class="dragger item_no ui-sortable-handle" align="center">'.++$key.'</td>
                <td class="dragger">'.$value['description'].'<br/>'.get_productfields_list('tblproposalproductfields',$proposal->id,$value['pro_id']).'</td>
                <td align="right">'.$qty.'</td>';

    		/*if($type=='rent'){
    		 $items_html .=  '<td align="right">'.number_format($totalmonths, 2, '.', '').'</td>';
    		}*/        


        $items_html .=  '<td align="right">'.$rate.'</td>';


        if($show_discount == 1){
              $items_html .=  ' <td align="right">'.$dis.'%<br></td>';
        }
                
        $items_html .=  '<td class="amount" align="right">'.number_format($final_price, 2, '.', '').'</td>
           </tr>';
        
     }
  }
	


$items_html .= '</tbody>';
$items_html .= '</table>';
//$items_html .= '<br /><br />';
$items_html .= '';


$items_html .= '<table cellpadding="6" style="width:100%;" style="font-size:'.($font_size+4).'px">';

$final_amount = 0;
if(!empty($proposal->items)){                

     $items_html .= '<tr>
            <td align="right" width="85%"><strong>Sub Total</strong></td>
            <td align="right" width="15%">' . format_money($total_price,$proposal->symbol) . '</td>
        </tr>';

      
      $discount = 0;
      if(!empty($discount_percent > 0)){
         $discount = ($total_price*$discount_percent/100);
        
         $items_html .= '<tr>
            <td align="right" width="85%"><strong>Discount</strong></td>
            <td align="right" width="15%">-'.number_format($discount, 2, '.', '').'</td>
        </tr>';        
      }


      // For Excluding Other Charges Tax
      if($proposal->other_charges_tax == 2){
            if(!empty($othercharges)){
            foreach ($othercharges as $key => $value) {

              $total_price += $value['total_maount'];

              $items_html .= '<tr>
                              <td align="right" width="85%"><strong>'.$value['category_name'].'</strong></td>
                              <td align="right" width="15%">'.number_format($value['total_maount'], 2, '.', '').'</td>
                          </tr>';
           }
         }

      }



      $afr_dis_price = ($total_price - $discount);

      $final_discount_price = ($afr_dis_price*18/100);
      $final_amount = ($final_discount_price + $total_price - $discount);

      if(!empty($proposal->tax_type == 1)){
         $final_dis_price = ($afr_dis_price*9/100);

         $items_html .= '<tr>
            <td align="right" width="85%"><strong>SGST (9.00%)</strong></td>
            <td align="right" width="15%">'.number_format($final_dis_price, 2, '.', '').'</td>
        </tr>';  

        $items_html .= '<tr>
            <td align="right" width="85%"><strong>SGST (9.00%)</strong></td>
            <td align="right" width="15%">'.number_format($final_dis_price, 2, '.', '').'</td>
        </tr>';  

      }else{
         $final_dis_price = ($afr_dis_price*18/100);

         $items_html .= '<tr>
            <td align="right" width="85%"><strong>IGST (18.00%)</strong></td>
            <td align="right" width="15%">'.number_format($final_dis_price, 2, '.', '').'</td>
        </tr>';
      }


      // For Excluding Other Charges Tax
      if($proposal->other_charges_tax == 1){
       if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {

            $final_amount += $value['total_maount'];

            $items_html .= '<tr>
                            <td align="right" width="85%"><strong>'.$value['category_name'].'</strong></td>
                            <td align="right" width="15%">'.number_format($value['total_maount'], 2, '.', '').'</td>
                        </tr>';
         }
       }  
     }
       

      $items_html .= '<tr>
            <td align="right" width="85%"><strong>Total</strong></td>
            <td align="right" width="15%">'.number_format($final_amount, 2, '.', '').'</td>
        </tr>';  
      
}


$items_html .= '<br /><br /><br /><b>In Words : '.convert_number_to_words($final_amount).' </b>';

$items_html .= $months_info;


$items_html .= '<br/><br/><b>Material Value :- '.number_format($ttl_value, 2, '.', '').' /-</b>';

$items_html .= '<br /><br /><br />';
$items_html .= '<table width="'.$footers_width.'%" cellspacing="0" cellpadding="8" style="font-size:'.($font_size+4).'px">';
$items_html .= '<tr><td align="left" width="100%" bgcolor="' . get_option('pdf_table_heading_color') . '" style="color:' . get_option('pdf_table_heading_text_color') . ';"><b>Notes :</b></td></tr>
<tr style="padding:10px;"> <td align="left" width="100%"><br/><b>Terms & conditions :</b><br/>'.$terms_and_conditions.'</td></tr></table>';
//echo $items_html;exit;

$proposal->content = str_replace('{proposal_items}', $items_html, $proposal->content);

// Get the proposals css
// Theese lines should aways at the end of the document left side. Dont indent these lines
$html .= <<<EOF

<div style="width:675px !important;">
$proposal->content
</div>
EOF;

$pdf->writeHTML($html, true, false, true, false, '');
