<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function proposals_pdf($proposal){
  $CI =& get_instance();

	$number = format_proposal_number($proposal->id);

	$to_info = get_proposal_to_array($proposal->id);

  $site_id = lead_site_id($proposal->rel_id);
	
	$shipto_info = get_ship_to_array($site_id);

  $lead_info = $CI->db->query("SELECT * FROM `tblleads` where id = '".$proposal->rel_id."' ")->row();


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
		$profor='Quotation For Sale';
		$discount_percent = $proposal->sale_discount_percent;
	}
	else if($type=='rent')
	{
		$othercharges=get_pro_othercharges($proposal->id,'0');  
		$profor='Quotation For Rent';
		$discount_percent = $proposal->rent_discount_percent;
	}


	//Getting the item list
	$proposal->items = get_proposal_items_list($proposal->id,$type);

  $billing_info = get_branch_details($proposal->billing_branch_id);  

	$months_info = '';
	if($type=='rent'){
	  if(!empty($proposal->items)){
		
		if($proposal->items[0]['months'] > 0 && $proposal->items[0]['days'] > 0){
			$months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Quotation is for '.$proposal->items[0]['months'].' Month and '.$proposal->items[0]['days'].' Days.</p>';
		}elseif($proposal->items[0]['months'] > 0){
			$months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Quotation is for '.$proposal->items[0]['months'].' Month Rental.</p>';
		}elseif($proposal->items[0]['days'] > 0){
			$months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Quotation is for '.$proposal->items[0]['days'].' Days Rental.</p>';
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

	if($proposal->terms_and_conditions!=''){$terms_and_conditions=$proposal->terms_and_conditions;}else{$terms_and_conditions="<p>1). Payment: 100% Advance</p><p>2). Freight(Demob) will be charged extra at actual.</p><p>3). Lead Time- 2-3 working days from the date of receipt of confirm order.</p><p>4). Any other charges other than mentioned if incurred, shall be charged at actual. Sub Total (I) 66,000.00</p><p>5). Unloading of Equipment/Material will not be in SCHACH'S scope. Freight(mob) At actual</p><p>6). One time free training/Installation of scaffold/machine shall be conducted by us Sub Total (II) 66,000.00</p><p>7). Security cheque (without date ) of material value will be required CGST 9% 5,940.00<br>before material dispatch. (Material Value - 7.4 lacs) SGST 9% 5,940.00 We hope our offer is in line with your requirement and we wait for your valued order, which shall receive our best and prompt attention.</p>";}		

  $company_info = get_company_details(); 	
  
	
  $html = '<html><title>QUOTATION</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  /*<h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>*/
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:60%;">
	  <img width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$billing_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
        <!--<p style="margin-bottom:0px;"><b>Email :</b> sales@schachengineers.com</p>
        <p style="margin-bottom:0px;"><b>Contact No. :</b> +91 9136119029</p>-->
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:40%;">
         <h2 class="name" style="font-family: Source Sans Pro, sans-serif;">'.$profor.'</h2>
        <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Quote :</b></td>
            <td> '.$number.'</td>
          </tr>
          
          <tr>
            <td><b>Date :</b></td>
            <td>'. _d($proposal->date).'</td>
          </tr>';

      if($proposal->status == 5){
          $html .= '<tr>
            <td><b>Status :</b></td>
            <td>'. format_proposal_status($proposal->status).'</td>
          </tr>';
      }
          
 
$to_data = '';

if(empty($to_info['address']) && !empty($to_info['state'])){
  $to_data .= $to_info['state'];
}else{
  $to_data .= $to_info['address'].', '.$to_info['state'];
}
if(!empty($to_info['city'])){
  $to_data = $to_data.', '.$to_info['city'];
}

  $html .= '</table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no"><b>Quotation To</b></th>
            <th class="no"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_data.'</p>
        <p><b>Contact Name :</b> '.$to_info['contact_name'].'</p>
        <p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>
        <p><b>Phone :</b> '.$to_info['phone'].'</p>
      </td>';
if($site_id > 0){

  $html .= '<td class="desc">
        <h3>'.$shipto_info['name'].'</h3>
        <p>'.$shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state'].'</p>
        <p><b>Zip :</b> '.$shipto_info['zip'].'</p>
      </td>';
}else{

  $shiptoaddress = '';

  if(!empty($lead_info->site_address)){
    $shiptoaddress .= $lead_info->site_address.', ';
  }

  if($lead_info->site_city_id > 0){
    $city = value_by_id('tblcities',$lead_info->site_city_id,'name');    
    $shiptoaddress .= $city.', ';  
  }

  if($lead_info->site_state_id > 0){
    $state = value_by_id('tblstates',$lead_info->site_state_id,'name');    
    $shiptoaddress .= $state.', ';  
  }

  


  $html .= '<td class="desc">';

    if(!empty($lead_info->site_location)){
      $html .= '<h3>'.$lead_info->site_location.'</h3>';
    } 

    if(!empty($shiptoaddress)){
      $html .= '<p>'.$shiptoaddress.'</p>';
    }

    if(!empty($lead_info->site_pincode)){
      $html .= '<p><b>Zip :</b> '.$lead_info->site_pincode.'</p>';
    }  
       
    $html .= '</td>';
}

  

  $html .= '</tr>
        </tbody>
    </table>
  
  <!--shipping Area End-->
  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="4%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="34%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;text-align:center;">QTY</th>
            <th width="6%" class="no" style="font-size:10px;font-weight:600;text-align:center;">UNIT</th>';
            if($proposal->measurement == 2){
              $html .= '<th class="no" style="font-size:10px;font-weight:600; text-align:center;">Weight(Kg)</th>';
            }
            $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;text-align:center;">RATE/UNIT</th>';
          
            if($show_discount == 1){
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;text-align:center;">DISCOUNT</th>';
            }   


            if($proposal->tax_type == 1 && $proposal->proposal_for == 1){
              $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
              $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
            }else{
              $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
            }
			
    $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>';
    $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">AMOUNT</th>
          </tr>
        </thead>
        <tbody class="main-table">';
		      
    $ttl_value = 0; 
    $ttl_rate = 0;
    $ttl_tax = 0;

    if(!empty($proposal->items)){
     $total_price = 0;
     foreach ($proposal->items as $key => $value) {
        $qty = $value['qty'];
        $rate = $value['rate'];
        $weight = $value['weight'];
        $dis = $value['discount'];
        if($proposal->proposal_for == 1){
          $prodtax = $value['prodtax'];
        }else{
          $prodtax = 0.1;
        }

        if($value['temp_product'] == 0){
          $isOtherCharge = value_by_id('tblproducts',$value['pro_id'],'isOtherCharge');
        }else{
          $isOtherCharge = 0;
        }        
        $show_qty = ($isOtherCharge == 0) ? $qty : '--';

        if($value['is_sale'] == 0){
           $totalmonths = ($value['months'] + ($value['days'] / 30));
           $price = ($rate * $qty * $totalmonths * $weight);
        }else{
           $price = ($rate * $qty * $weight);
        }

        if($value['rate_view'] > 0){
          $show_rate = $value['rate_view'];
        }else{
          $show_rate = $value['rate'];
        }

        $dis_price = ($price*$dis/100);

        $final_price = ($price - $dis_price);

        //Applying TAX after discount
        $tax_amt = ($final_price*$prodtax/100);
        $final_price = ($final_price+$tax_amt);

        $ttl_tax += $tax_amt; 

        $total_price += $final_price;
        $ttl_rate += ($show_rate*$qty);

        //getting material vlaue
        if($value['temp_product'] == 0){
           $ttl_value += get_material_value($value['pro_id'],$qty);
        }else{
          $pro_price = value_by_id('tbltemperoryproduct',$value['pro_id'],'price');
          $ttl_value += ($pro_price*$qty);
        }
        
        if($value['temp_product'] == 0){
            $unit_id = value_by_id_empty('tblproducts',$value['pro_id'],'unit_2');
        }else{
            $unit_id = value_by_id_empty('tbltemperoryproduct',$value['pro_id'],'unit');
        }
        
        $unit_name = ($isOtherCharge == 0) ? value_by_id('tblunitmaster',$unit_id,'name') : '--';
        
        $product_rmk = '';
        if(!empty($value['long_description'])){
           $product_rmk = '<p>'.$value['long_description'].'</p>';
        }
            
            $html .= '<tr>
            <td class="desc">'.++$key.'</td>';

            if($value['temp_product'] == 0){
              $html .= '<td class="desc"><h3>'.value_by_id('tblproducts',$value['pro_id'],'sub_name').'</h3>'.$product_rmk.get_productfields_list('tblproposalproductfields',$proposal->id,$value['pro_id']).'</td>';
            }else{
              $html .= '<td class="desc"><h3>'.value_by_id('tbltemperoryproduct',$value['pro_id'],'product_name').'</h3>'.$product_rmk.get_temp_productfields_list('tblproposalproductfields',$proposal->id,$value['pro_id']).'</td>';
            }
            

            $html .= '<td class="desc" style="text-align:center;">'.$show_qty.'</td>
            <td class="desc" style="text-align:center;">'.$unit_name.'</td>
            ';

            if($proposal->measurement == 2){
              $html .=  ' <td class="desc" style="text-align:center;">'.$weight.'</td>';
             }

            $html .= '<td class="desc text-right">'.$show_rate.'</td>';

            if($show_discount == 1){
              $html .=  ' <td class="desc text-right">'.$dis.'%</td>';
             }

             if($proposal->tax_type == 1 && $proposal->proposal_for == 1){
                $tax = ($prodtax/2);
                $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
                $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
             }else{                
                //$html .=  ' <td class="desc text-center">'.number_format(round($prodtax), 0, '.', '').'%</td>';
				//By Kapil on 24-11-2020
				$html .=  ' <td class="desc text-center">'.$prodtax.'%</td>';
             }

            $html .=  '<td class="desc text-right">'.number_format(round($tax_amt), 2, '.', '').'</td>';
            $html .=  '<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
           </tr>';

        }


    }
    $subColSpan = 1;
    $subColSpan_2 = 2;
    if($proposal->measurement == 2){
       $subColSpan += 1;
    }
    if($proposal->tax_type == 1 && $proposal->proposal_for == 1){
      $subColSpan_2 += 1;
    }
    if($show_discount == 1){
      $subColSpan_2 += 1;
    }

    $html .='<tr>
        <td  colspan="4"><b>SUBTOTAL</b></td>
        <td colspan="'.$subColSpan.'" >'.number_format(round($ttl_rate), 2, '.', '').'</td>
        <td colspan="'.$subColSpan_2.'" >'.number_format(round($ttl_tax), 2, '.', '').'</td>
        <td><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
      </tr>';    
      
    
    $html .= '</tbody>
      </table>
    
    <table border="0" cellspacing="0" cellpadding="0">';
	
    	$discount = 0;
      if(!empty($discount_percent > 0)){
         $discount = ($total_price*$discount_percent/100);
              
        $html .= '<tr>
            <td>Discount @ '.number_format($discount_percent).'%</td>
            <td>-'.number_format(round($discount), 2, '.', '').'</td>
          </tr>';    

        }  

        $othercharges_ttl = 0;
       if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

                $html .= '<tr>
                  <td>'.$value['category_name'].'</td>
                  <td>'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';             

           }

           if($proposal->other_charges_tax == 2){

                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                  if($proposal->tax_type == 1 && $proposal->proposal_for == 1){
                   $single_other_tax_amt = ($othercharges_ttl*9/100);

                  $html .= '<tr>
                              <td>CGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                            
                   $html .= '<tr>
                              <td>SGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                }else{
                   $html .= '<tr>
                              <td>IGST @ 18%</td>
                              <td>'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                            </tr>';   
                }    
           }

       }	  
	  
      $final_amount = ($total_price - $discount);    

 	
	
	$html .= '<tr>
				<td>GRAND TOTAL</td>
				<td>'.number_format(round($final_amount), 2, '.', '').'</td>
			  </tr>'; 

		
		  
    $html .= '</table>';
	
	$html .= '<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><b>Amount In Words :</b></td>
            <td><b>'.convert_number_to_words(round($final_amount),$proposal->currency).'</b></td>
          </tr></table>';
		  
	if($type=='rent'){
		$html .= '<div id="notices">
		<div>NOTICE : Any Damage/Lost of Components shall be charged from "'.$to_info['name'].'"</div>
			<p style="margin-bottom: 0; margin-top: 5px;">Material Value - '.number_format(round($ttl_value), 2, '.', '').'/-</p> <p style="margin-bottom: 0; margin-top: 5px;">'.$months_info.'</p>
		</div>';
	}		
	
    $html .= '<div class="notice">Terms & conditions : </div>
    
    <div class="termsList">'.$proposal->terms_and_conditions.'</div>
    
       
   <!--<table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:2px;">
        <tbody>
          <tr>
            <td class="desc" style="text-align:left;">
        <p><b>GSTIN :</b>  '.$company_info['gst'].'</p>
      </td>
        
       <td class="desc" style="text-align:center;">
        <p><b>MSME :</b> UP28B0011156</p>
      </td>
      
      <td style="text-align:right;"><b>CIN :</b>U51101UP2015PTC068937</td>
          </tr>
        </tbody>
    </table>-->

  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
        <tr>
         <td class="desc" style="text-align:center;">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
      <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
             </td>
      </tr>
        </tbody>
    </table>

  </body></html>';

  return $html;
}


function perfoma_infoice_pdf($estimate){
    $CI =& get_instance();

	$number = format_estimate_number($estimate->id);
	$to_info = get_estimate_to_array($estimate->id);
	$shipto_info = get_ship_to_array($estimate->site_id);
	

	$check_estimate_rent_item=check_estimate_item($estimate->id,0);
	$check_estimate_sale_item=check_estimate_item($estimate->id,1);

	if($check_estimate_rent_item>=1){
	  $type = 'rent';
	}elseif($check_estimate_sale_item>=1){
	  $type = 'sale';
	}

  $billing_info = get_branch_details($estimate->billing_branch_id);


	if($type=='sale')
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'1');
		$is_sale=1;
		$type='sale';
		$profor='PROFORMA INVOICE';
		$subtotal=$estimate->salesubtotal;
	}
	else if($type=='rent')
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'0'); 
		$is_sale=0;
		$type='rent';
		$profor='PROFORMA INVOICE';
		$subtotal=$estimate->rentsubtotal;
	}
	else
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'0'); 
		$is_sale=2;
		$type='sale';
		$profor='PROFORMA INVOICE';
		$subtotal=$estimate->salesubtotal+$estimate->rentsubtotal;
	}

  //Getting the item list
  $estimate->items = get_invoice_items_list($estimate->id,$type,'estimate');

	$months_info = '';
	if($type=='rent'){
	  if(!empty($estimate->items)){
	   
		if($estimate->items[0]['months'] > 0 && $estimate->items[0]['days'] > 0){
			$months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Proforma Invoice is for '.$estimate->items[0]['months'].' Month and '.$estimate->items[0]['days'].' Days.</p>';
		}elseif($estimate->items[0]['months'] > 0){
			$months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Proforma Invoice is for '.$estimate->items[0]['months'].' Month.</p>';
		}elseif($estimate->items[0]['days'] > 0){
			$months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Proforma Invoice is for '.$estimate->items[0]['days'].' Days.</p>';
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
	
	$company_info = get_company_details(); 
  $bank_info = bank_info($estimate->bank_id);

  $html = '<html><title>PROFORMA INVOICE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';

    /*
	<h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>
    */
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:60%;">
		<img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$billing_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:40%;">
         <h2 class="name">'.$profor.'</h2>
        <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Proforma Invoice:</b></td>
            <td> '.$number.'</td>
          </tr>';
          if(!empty($estimate->po_number)){
            $html .='<tr>
            <td><b>PO Number:</b></td>
            <td># '.$estimate->po_number.'</td>
          </tr>';
          }
          $html .='<tr>
            <td><b>Date :</b></td>
            <td>'. _d($estimate->date).'</td>
          </tr>';

            if($estimate->status == 6){
          $html .= '<tr>
            <td><b>Status :</b></td>
            <td>'. estimate_status_by_id($estimate->status).'</td>
          </tr>';
      }


  $html .= '</table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no"><b>Proforma Invoice To</b></th>
            <th class="no"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_info['address'].', '.$to_info['city'].', '.$to_info['state'].'</p>
        <p><b>GSTIN :</b> '.$to_info['gst'].'</p>
        <p><b>Contact Name :</b> '.$to_info['contact_name'].'</p>
        <p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>
        <p><b>Phone :</b> '.$to_info['phone'].'</p>
      </td>
       <td class="desc">
        <h3>'.$shipto_info['name'].'</h3>
        <p>'.$shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state'].'</p>
        <p><b>Landmark :</b> '.$shipto_info['landmark'].'</p>
        <p><b>Zip :</b> '.$shipto_info['zip'].'</p>
      </td>
          </tr>
        </tbody>
    </table>
  
  <!--shipping Area End-->
  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="7%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="35%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;text-align:center;">QTY</th>';
            if($estimate->measurement == 2){
              $html .= '<th class="no" style="font-size:10px;font-weight:600; text-align:center;">Weight(Kg)</th>';
            }
            $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;text-align:center;">RATE/UNIT</th>';
          
            if($show_discount == 1){
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;text-align:center;">Discount</th>';
            }   

            if($estimate->tax_type == 1 && $estimate->estimate_for == 1){
              $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
              $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
            }else{
              $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
            }

		 $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>';	
    $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">AMOUNT</th>
          </tr>
        </thead>
        <tbody class="main-table">';
		      
    $ttl_value = 0; 
    $ttl_rate = 0; 
	
    if(!empty($estimate->items)){
     $total_price = 0;
     foreach ($estimate->items as $key => $value) {
        $qty = $value['qty'];
        $rate = $value['rate'];
		    $weight = $value['weight'];
        $dis = $value['discount'];
        if($estimate->estimate_for == 1){
          $prodtax = $value['prodtax'];
        }else{
          $prodtax = 0.1;
        }

        if($value['is_sale'] == 0){
           $totalmonths = ($value['months'] + ($value['days'] / 30));
           $price = ($rate * $qty * $totalmonths * $weight);
        }else{
           $price = ($rate * $qty * $weight);
        }

        $dis_price = ($price*$dis/100);

        $final_price = ($price - $dis_price);

        //Applying TAX after discount
        $tax_amt = ($final_price*$prodtax/100);
        $final_price = ($final_price+$tax_amt);


        $total_price += $final_price;

        if($value['rate_view'] > 0){
          $show_rate = $value['rate_view'];
        }else{
          $show_rate = $value['rate'];
        }

        $isOtherCharge = value_by_id('tblproducts',$value['pro_id'],'isOtherCharge');
        $show_qty = ($isOtherCharge == 0) ? $qty : '--';
        $ttl_rate += ($show_rate*$qty);

        //getting material vlaue
        $ttl_value += get_material_value($value['pro_id'],$qty);

        $product_rmk = '';
        if(!empty($value['long_description'])){
           $product_rmk = '<p>'.$value['long_description'].'</p>';
        }
            
            $html .= '<tr>
            <td class="desc">'.++$key.'</td>
            <td class="desc"><h3>'.value_by_id('tblproducts',$value['pro_id'],'sub_name').'</h3>'.$product_rmk.get_productfields_list('tblestimateproductfields',$estimate->id,$value['pro_id']).'</td>';
			
			       if($estimate->measurement == 2){
              $html .=  ' <td class="desc" style="text-align:center;">'.$weight.'</td>';
             }
			
            $html .= '<td class="desc" style="text-align:center;">'.$show_qty.'</td>
            <td class="desc text-right">'.$show_rate.'</td>';

            if($show_discount == 1){
              $html .=  ' <td class="desc text-right">'.$dis.'%</td>';
            }

            if($estimate->tax_type == 1 && $estimate->estimate_for == 1){
                $tax = ($prodtax/2);
                $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
                $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
             }else{                
                $html .=  ' <td class="desc text-center">'.$prodtax.'%</td>';
             }

             $html .=  '<td class="desc text-right">'.number_format(round($tax_amt), 2, '.', '').'</td>';
            $html .=  '<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
           </tr>';

        }


    }    
    $subColSpan = 1;
    $subColSpan_2 = 3;
    if($estimate->measurement == 2){
       $subColSpan += 1;
    }
    if($estimate->tax_type == 1 && $estimate->estimate_for == 1){
      $subColSpan_2 += 1;
    }
    if($show_discount == 1){
      $subColSpan_2 += 1;
    }

    $html .='<tr>
        <td  colspan="3"><b>SUBTOTAL</b></td>
        <td colspan="'.$subColSpan.'" >'.number_format(round($ttl_rate), 2, '.', '').'</td>
        <td  colspan="'.$subColSpan_2.'"><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
      </tr>';  
    
    $html .= '</tbody>
      </table>
    
    <table border="0" cellspacing="0" cellpadding="0">';
	
	     $discount = 0;
      if(!empty($estimate->discount_percent > 0)){
         $discount = ($total_price*$estimate->discount_percent/100);
              
        $html .= '<tr>
            <td>Discount @ '.number_format($estimate->discount_percent).'%</td>
            <td>-'.number_format(round($discount), 2, '.', '').'</td>
          </tr>';    

        }  

	  
	  
    $othercharges_ttl = 0;
       if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

                $html .= '<tr>
                  <td>'.$value['category_name'].'</td>
                  <td>'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';             

           }

           if($estimate->other_charges_tax == 2){

                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                  if($estimate->tax_type == 1 && $estimate->estimate_for == 1){
                   $single_other_tax_amt = ($othercharges_ttl*9/100);

                  $html .= '<tr>
                              <td>CGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                            
                   $html .= '<tr>
                              <td>SGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                }else{
                   $html .= '<tr>
                              <td>IGST @ 18%</td>
                              <td>'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                            </tr>';   
                }    
           }

       }      
      
      $final_amount = ($total_price - $discount);  
	
	
	$html .= '<tr>
				<td>GRAND TOTAL</td>
				<td>'.number_format(round($final_amount), 2, '.', '').'</td>
			  </tr>'; 

		
		  
    $html .= '</table>';
	
	$html .= '<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><b>Amount In Words :</b></td>
            <td><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr>';
	if($type == 'rent'){	  
	$html .= '<tr>
            <td class="note" colspan="2">Kindly Handle with care or be ready to bear the COST for damage..!!</td> 
          </tr>';
	}	  
	$html .= '</table>';
		  
	if($type == 'rent'){
		$html .= '<div id="notices">
		<div>NOTICE : Any Damage/Lost of Components shall be charged from "'.$to_info['name'].'"</div>
    <p style="margin-bottom: 0; margin-top: 5px;">Material Value - '.number_format(round($ttl_value), 2, '.', '').'/-</p> <p style="margin-bottom: 0; margin-top: 5px;">'.$months_info.'</p>
   </div>';
	}
  
    
   $html .= '<div class="notice">Terms & conditions : </div>
    
    <div class="termsList">'.$estimate->terms_and_conditions.'</div>
    
     <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> Schach Engineers Pvt Ltd<br> '.$bank_info->name.'<br> A/c No - '.$bank_info->account_no.'<br> IFSC Code-'.$bank_info->ifsc_code.'<br> Branch - '.$bank_info->branch.'</p>
              
   <!--<table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:2px;">
        <tbody>
          <tr>
            <td class="desc" style="text-align:left;">
        <p><b>GSTIN :</b>  '.$company_info['gst'].'</p>
      </td>
        
       <td class="desc" style="text-align:center;">
        <p><b>MSME :</b> UP28B0011156</p>
      </td>
      
      <td style="text-align:right;"><b>CIN :</b>U51101UP2015PTC068937</td>
          </tr>
        </tbody>
    </table>-->
  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
         <tr>
           <td class="desc" style="text-align:center;">
            <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
          </td>
        </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
  
  </body></html>';

  return $html;
}


function infoice_pdf($invoice){
     $CI =& get_instance();

        $number = format_invoice_number($invoice->id);
        $to_info = get_invoice_to_array($invoice->id);
        //$shipto_info = invoice_ship_to_array($invoice->id);
        $shipto_info = get_ship_to_array($invoice->site_id);
        $person_info = invoice_contact_person($invoice->id);

        $check_invoice_rent_item = check_proposal_item($invoice->id,0,'invoice');
        $check_invoice_sale_item = check_proposal_item($invoice->id,1,'invoice');

        if($check_invoice_rent_item>=1){
          $type = 'rent';
        }elseif($check_invoice_sale_item>=1){
          $type = 'sale';
        }

        $billing_info = get_branch_details($invoice->billing_branch_id);

        //if($_GET['type']=='sale')
        if($type=='sale')
        {
            $othercharges=get_pro_invoice_othercharges($invoice->id,'1');
            $is_sale=1;
            $type='sale';
			      $inv_head = 'Sale Invoice';
            $profor='TAX Invoice';
            $subtotal=$invoice->salesubtotal;

            $po_date_head = 'PO Date';
            $po_number_head = 'PO Number';
        }
        //else if($_GET['type']=='rent')
        else if($type=='rent')
        {
            $othercharges=get_pro_invoice_othercharges($invoice->id,'0');   
            $is_sale=0;
            $type='rent';
		      	$inv_head = 'Rent Invoice';
            $profor='TAX Invoice';
            $subtotal=$invoice->rentsubtotal;

            $po_date_head = 'WO Date';
            $po_number_head = 'WO Number';
        }
        
        //Getting the item list
        $invoice->items = get_invoice_items_list($invoice->id,$type,'invoice');           

        $months_info = '';
        if($type=='rent'){
          if(!empty($invoice->items)){
           
            if($invoice->items[0]['months'] > 0 && $invoice->items[0]['days'] > 0){
                $months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Invoice is for '.$invoice->items[0]['months'].' Month and '.$invoice->items[0]['days'].' Days.</p>';
            }elseif($invoice->items[0]['months'] > 0){
                $months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Invoice is for '.$invoice->items[0]['months'].' Month.</p>';
            }elseif($invoice->items[0]['days'] > 0){
                $months_info = '<p style="margin-bottom: 0; margin-top: 5px;">The Invoice is for '.$invoice->items[0]['days'].' Days.</p>';
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

	 $company_info = get_company_details(); 
   $bank_info = bank_info($invoice->bank_id);

  $html = '<html><title>INVOICE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 15px;font-size:10px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:55%;">
		    <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin:0px;font-family: Source Sans Pro, sans-serif;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$billing_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:45%;">
         <h2 class="name" style="font-family: Source Sans Pro, sans-serif;">'.$profor.'</h2>
        <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>'.$inv_head.' :</b></td>
            <td> '.$number.'</td>
          </tr>
          
          <tr>
            <td><b>Invoice Date :</b></td>
            <td>'. _d($invoice->invoice_date).'</td>
          </tr>';
  if($type == 'rent'){

    $html .= '<tr>
                <td><b>Start Date :</b></td>
                <td>'. _d($invoice->date).'</td>
              </tr>

              <tr>
                <td><b>End Date :</b></td>
                <td>'. _d($invoice->duedate).'</td>
              </tr>';
  } 

  if(!empty($invoice->po_wo_number) && !empty($invoice->po_wo_date)){
      $html .= '<tr>
                <td style="color:#df2c2c;"><b>'.$po_number_head.' :</b></td>
                <td style="color:#df2c2c;">'.$invoice->po_wo_number.'</td>
              </tr>

              <tr>
                <td style="color:#df2c2c;"><b>'.$po_date_head.' :</b></td>
                <td style="color:#df2c2c;">'. _d($invoice->po_wo_date).'</td>
              </tr>';
  }

   if(!empty($invoice->vendor_code)){
      $html .= '<tr>
                <td style="color:#df2c2c;"><b>Vendor Code :</b></td>
                <td style="color:#df2c2c;">'.$invoice->vendor_code.'</td>
              </tr>';
  }


  $html .= '</table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no"><b>Invoice To</b></th>
            <th class="no"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_info['address'].', '.$to_info['city'].', '.$to_info['state'].'</p>';
        if(!empty($to_info['zip'])){
           $html .= '<p><b>Zip :</b> '.$to_info['zip'].'</p>';
        }
        if(!empty($to_info['gst'])){
           $html .= '<p><b>GSTIN :</b> '.$to_info['gst'].'</p>';
        }
        if(!empty($to_info['email'])){
          $html .= '<p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>';
        }
        /*if(!empty($to_info['phone'])){
          $html .= '<p><b>Phone :</b> '.$to_info['phone'].'</p>';
        }*/

        if(!empty($person_info['office_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['office_name'].', '.$person_info['office_number'].'</p>';
        }
       $html .= '</td>';
        
        
     /* $html .= '<td class="desc">
        <p>'.$shipto_info['address'].'</p>';
        if(!empty($shipto_info['city']) || !empty($shipto_info['state'])){
            $html .= '<p><b>'.$shipto_info['state'].', '.$shipto_info['city'].'</b></p>';
        }
        if(!empty($shipto_info['zip'])){
          $html .= '<p><b>IN, '.$shipto_info['zip'].'</b></p>';
        }
        if(!empty($person_info['site_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['site_name'].', '.$person_info['site_number'].'</p>';
        }
        
      $html .= '</td>';*/


    $html .= '<td class="desc">
        <h3>'.$shipto_info['name'].'</h3>
        <p>'.$shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state'].'</p>';

   if(!empty($shipto_info['landmark'])){
    $html .= '<p><b>Landmark :</b> '.$shipto_info['landmark'].'</p>';
   }    
   if(!empty($shipto_info['zip'])){
     $html .= '<p><b>Zip :</b> '.$shipto_info['zip'].'</p>';
   } 
   
    

    if(!empty($person_info['site_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['site_name'].', '.$person_info['site_number'].'</p>';
        }    

    $html .= '</td>';


     $html .= '</tr>
        </tbody>
    </table>
  
  <!--shipping Area End-->
  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="7%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="31%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;text-align:center;">QTY</th>';
      			if($invoice->measurement == 2){
      			  $html .= '<th class="no" style="font-size:10px;font-weight:600; text-align:center;">Weight (Kg)</th>';
      			}
      		  $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;text-align:center;">RATE/UNIT</th>';
      		
      		  if($show_discount == 1){
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;text-align:center;">Discount</th>';
            } 	

            if($invoice->tax_type == 1 && $invoice->invoice_for == 1){
              $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
              $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
            }else{
              $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
            }
		$html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>';	
    $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;text-align:center;">AMOUNT</th>
          </tr>
        </thead>
        <tbody class="main-table">';
		      
    $ttl_value = 0; 
    $ttl_rate = 0; 
    $ttl_taxamt = 0; 
	
    if(!empty($invoice->items)){
     $total_price = 0;
     foreach ($invoice->items as $key => $value) {
        $qty = $value['qty'];
        $rate = $value['rate'];
		    $weight = $value['weight'];
        $dis = $value['discount'];
        if($invoice->invoice_for == 1){
          $prodtax = round($value['prodtax']);
        }else{
          $prodtax = 0.1;
        }

        if($value['is_sale'] == 0){
           $totalmonths = ($value['months'] + ($value['days'] / 30));
           $price = ($rate * $qty * $totalmonths * $weight);
        }else{
           $price = ($rate * $qty * $weight);
        }

        $dis_price = ($price*$dis/100);

        $final_price = ($price - $dis_price);

        //Applying TAX after discount
        $tax_amt = ($final_price*$prodtax/100);
        $final_price = ($final_price+$tax_amt);


        $ttl_taxamt += $tax_amt;

        $total_price += $final_price;


        if($value['rate_view'] > 0){
          $show_rate = $value['rate_view'];
        }else{
          $show_rate = $value['rate'];
        }

        $isOtherCharge = value_by_id('tblproducts',$value['pro_id'],'isOtherCharge');
        $show_qty = ($isOtherCharge == 0) ? $qty : '--';
        $ttl_rate += ($show_rate*$qty);

        //getting material vlaue
        $ttl_value += get_material_value($value['pro_id'],$qty);

        $product_rmk = '';
        if(!empty($value['long_description'])){
           $product_rmk = '<p>'.$value['long_description'].'</p>';
        }
            
            $html .= '<tr>
            <td class="desc">'.++$key.'</td>
            <td class="desc"><h3>'.value_by_id('tblproducts',$value['pro_id'],'sub_name').'</h3>'.$product_rmk.get_productfields_list('tblinvoiceproductfields',$invoice->id,$value['pro_id']).'</td>
            <td class="desc" style="text-align:center;">'.$show_qty.'</td>';
			
			      if($invoice->measurement == 2){
              $html .=  ' <td class="desc" style="text-align:center;">'.$weight.'</td>';
            }
			 
            $html .=  '<td class="desc text-right">'.$show_rate.'</td>';

            if($show_discount == 1){
              $html .=  ' <td class="desc text-right">'.$dis.'%</td>';
            }

            if($invoice->tax_type == 1 && $invoice->invoice_for == 1){
                $tax = ($prodtax/2);
                $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
                $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
            }else{                
                $html .=  ' <td class="desc text-center">'.$prodtax.'%</td>';
            }

            $html .=  '<td class="desc text-right">'.number_format(round($tax_amt), 2, '.', '').'</td>';
            $html .=  '<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
           </tr>';

        }


    }    
    $subColSpan = 1;
    $subColSpan_2 = 2;
    if($invoice->measurement == 2){
       $subColSpan += 1;
    }
    if($invoice->tax_type == 1 && $invoice->invoice_for == 1){
      $subColSpan_2 += 1;
    }
    if($show_discount == 1){
      $subColSpan_2 += 1;
    }

    $html .='<tr>
        <td  colspan="3"><b>SUBTOTAL</b></td>
        <td colspan="'.$subColSpan.'" >'.number_format(round($ttl_rate), 2, '.', '').'</td>
        <td colspan="'.$subColSpan_2.'"><b>'.number_format(round($ttl_taxamt), 2, '.', '').'</b></td>
        <td ><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
      </tr>';   
    
    $html .= '</tbody>
      </table>
    
    <table border="0" cellspacing="0" cellpadding="0">';
	
	     $discount = 0;
      if(!empty($invoice->discount_percent > 0)){
         $discount = ($total_price*$invoice->discount_percent/100);
              
        $html .= '<tr>
            <td>Discount @ '.number_format($invoice->discount_percent).'%</td>
            <td>-'.number_format(round($discount), 2, '.', '').'</td>
          </tr>';    

        }  

        $othercharges_ttl = 0;
        if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

                $html .= '<tr>
                  <td>'.$value['category_name'].'</td>
                  <td>'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';             

           }

           if($invoice->other_charges_tax == 2){

                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                  if($invoice->tax_type == 1 && $invoice->invoice_for == 1){
                   $single_other_tax_amt = ($othercharges_ttl*9/100);

                  $html .= '<tr>
                              <td>CGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                            
                   $html .= '<tr>
                              <td>SGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                }else{
                   $html .= '<tr>
                              <td>IGST @ 18%</td>
                              <td>'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                            </tr>';   
                }    
           }

       }      
      
      $final_amount = ($total_price - $discount);
	
	
	$html .= '<tr>
				<td>GRAND TOTAL</td>
				<td>'.number_format(round($final_amount), 2, '.', '').'</td>
			  </tr>'; 

		
		  
    $html .= '</table>';
	
	$html .= '<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><b>Amount In Words :</b></td>
            <td><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr>';


   if($type=='rent'){
    
      $html .= '<tr>
            <td class="note" colspan="2">Kindly Handle with care or be ready to bear the COST for damage..!!</td> 
          </tr>';

   }     

  $html .= '</table>';


  if($type=='rent'){
    $html .= '<div id="notices">
    <div>NOTICE : Any Damage/Lost of Components shall be charged from "'.$to_info['name'].'"</div>
    <p style="margin-bottom: 0; margin-top: 5px;">Material Value - '.number_format(round($ttl_value), 2, '.', '').'/-</p> <p style="margin-bottom: 0; margin-top: 5px;">'.$months_info.'</p> <p style="margin-bottom: 0; margin-top: 5px;">Please dehire on said time or by default the invoice shall be raised for next month rental on '._d($invoice->duedate).'.</p><p style="margin-bottom: 0; margin-top: 5px;">For dehire, written mail intimation has to be given before one week prior.</p>
   </div>';
  }
    
  $html .= '<div class="notice">Terms & conditions : </div>
    
    <div class="termsList">'.$invoice->terms_and_conditions.'</div>
    
     <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> Schach Engineers Pvt Ltd<br> '.$bank_info->name.'<br> A/c No - '.$bank_info->account_no.'<br> IFSC Code-'.$bank_info->ifsc_code.'<br> Branch - '.$bank_info->branch.'</p>
          
  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>
    
   <!--<table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:2px;">
        <tbody>
          <tr>
            <td class="desc" style="text-align:left;">
        <p><b>GSTIN :</b>  '.$company_info['gst'].'</p>
      </td>
        
       <td class="desc" style="text-align:center;">
        <p><b>MSME :</b> UP28B0011156</p>
      </td>
      
      <td style="text-align:right;"><b>CIN :</b>U51101UP2015PTC068937</td>
          </tr>
        </tbody>
    </table>-->
  
  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
         <tr>
           <td class="desc" style="text-align:center;">
            <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
          </td>
        </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
  
  </body></html>';

  return $html;
}



function ctc_pdf($ctc_info,$name){
  $branch_info = get_company_info();
  $ttl_montly_hand = ($ctc_info['gross']-$ctc_info['pf']-$ctc_info['employee_esic']-$ctc_info['pt']);
  if($ctc_info['pt'] > 0){
    $pt_year = 2500;   
  }else{
    $pt_year = 0;
  }

  $y_gross = ($ctc_info['gross']*12);
  $y_pf = ($ctc_info['pf']*12);
  $y_esic = ($ctc_info['employee_esic']*12);

  $year_hand = ($y_gross-$y_pf-$y_esic-$pt_year);

  $y_gross = ($ctc_info['gross']*12);
  $y_pf = ($ctc_info['pf']*12);
  $y_esic = ($ctc_info['employee_esic']*12);

  $year_hand = ($y_gross-$y_pf-$y_esic-$pt_year);
  $html = '<table style="width: 100%; text-align: center;">
            
      <tr>
        <th style="text-align:center;">
        <h3>'.$branch_info[1]->value.'</h3>
          <h4>'.$branch_info[0]->value.'</h4>         
        </th>
      </tr>
        
    </table>

    
    
    <table style="width: 100%;">
    
      <tr>
        <td style="text-align:left; padding: 15px; width:50%;">
          <p><b>Computer Generated CTC Structure    </b><p>
          
        </td>
        
        <td style="text-align:right; padding: 15px; width:50%;">
          <p><b>Issue Date : '.date('d/m/Y').'</b></p>
          
        </td>
      </tr>
    
    </table>
    
    
    <table style="width: 100%; border:2px solid #111;margin-top: -2px;">
    
      <tr>
        <td style="text-align:left; padding: 15px; width:50%;">
          <p><b>Employee Name : '.$name.'</b></p>
        </td>
        
      </tr>
    
    </table> 
    
    <table style="width: 100%; border:2px solid #111;margin-top: -2px;">
      
      <tr>
        <td style="text-align:left; padding:8px; width:50%; border-right: 2px solid #111;">
          <h4><b style="border-bottom: 2px solid #111;">Cost To Company</b></h4>
          
          <table style="width:100%;">
            <tr>
              <td style="padding:5px; width:33%;"></td>
              <td style="padding:5px 0; width:25%; text-align: right;"><b>Monthly</b></td>
              <td style="padding:5px 0; width:25%; text-align: right;"><b>Annually</b></td>
            </tr>
            <tr>
              <td>Basic</td>
              <td style="text-align: right;">'.round($ctc_info['basic']).'</td>
              <td style="text-align: right;">'.round($ctc_info['basic'] * 12).'</td>
            </tr>
            

            <tr>
              <td>HRA</td>
              <td style="text-align: right;">'.round($ctc_info['hra']).'</td>
              <td style="text-align: right;">'.round($ctc_info['hra'] * 12).'</td>
            </tr>

            <tr>
              <td>Convence Allownce</td>
              <td style="text-align: right;">'.round($ctc_info['convenience']).'</td>
              <td style="text-align: right;">'.round($ctc_info['convenience'] * 12).'</td>
            </tr>
            

            <tr>
              <td>Medical Allownce</td>
              <td style="text-align: right;">'.round($ctc_info['medical']).'</td>
              <td style="text-align: right;">'.round($ctc_info['medical'] * 12).'</td>
            </tr>
            

            <tr>
              <td>Uniform Allownce</td>
              <td style="text-align: right;">'.round($ctc_info['uniform']).'</td>
              <td style="text-align: right;">'.round($ctc_info['uniform'] * 12).'</td>
            </tr>

            <tr>
              <td>Other Allownce</td>
              <td style="text-align: right;">'.round($ctc_info['other_allowance']).'</td>
              <td style="text-align: right;">'.round($ctc_info['other_allowance'] * 12).'</td>
            </tr>
            
            
          </table>
        </td>

        
        <td style="text-align:left; padding:8px; width:50%;">
          <h4><b style="border-bottom: 2px solid #111;">In Hand Salary</b></h4>
          
          <table style="width:100%;">
            <tr>
              <td style="padding:5px; width:40%;"></td>
              <td style="padding:5px 0; width:25%; text-align: right;"><b>Monthly</b></td>
              <td style="padding:5px 0; width:25%; text-align: right;"><b>Annually</b></td>
            </tr>
            <tr>
              <td>Gross Salary</td>
              <td style="text-align: right;">'.round($ctc_info['gross']).'</td>
              <td style="text-align: right;">'.round($ctc_info['gross'] * 12).'</td>
            </tr>

            <tr>
              <td>Employee PF</td>
              <td style="text-align: right;">'.round($ctc_info['pf']).'</td>
              <td style="text-align: right;">'.round($ctc_info['pf'] * 12).'</td>
            </tr>

            <tr>
              <td>Employee ESIC</td>
              <td style="text-align: right;">'.round($ctc_info['employee_esic']).'</td>
              <td style="text-align: right;">'.round($ctc_info['employee_esic'] * 12).'</td>
            </tr>

            <tr>
              <td>PT</td>
              <td style="text-align: right;">'.round($ctc_info['pt']).'</td>
              <td style="text-align: right;">'.$pt_year.'</td>
            </tr>


            
            
          </table>  
          
        </td>
      </tr>
      
    </table>          
    
    <table style="width:100%;border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="width:50%;border-right: 2px solid #111;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:50%"><b>Gross Salary </b></td>
              <td style="padding:10px; width:13%; text-align: right;"><b>'.round($ctc_info['gross']).'</b></td>
              <td style="padding:10px; width:13%; text-align: right;"><b>'.round($ctc_info['gross']*12).'</b></td>
            </tr>
          </table>
        </td>


        <td style="width:50%;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:40%"><b>In Hand</b></td>
              <td style="padding:10px; width:30%; text-align: right;"><b>'.round($ttl_montly_hand).'</b></td>
              <td style="padding:10px; width:30%; text-align: right;"><b>'.round($year_hand).'</b></td>
            </tr>
          </table>
        </td>
        
      </tr>
    </table>
    
    
    
    <table style="width:100%; border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="width:50%;border-right: 2px solid #111;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:40%">Employer PF</td>
              <td style="padding:10px; width:30%; text-align: right;">'.round($ctc_info['pf']).'</td>
              <td style="padding:10px; width:30%; text-align: right;">'.round($ctc_info['pf']*12).'</td>
            </tr>

            <tr>
              <td style="padding:10px; width:40%">Employer ESIC</td>
              <td style="padding:10px; width:30%; text-align: right;">'.round($ctc_info['esic']).'</td>
              <td style="padding:10px; width:30%; text-align: right;">'.round($ctc_info['esic']*12).'</td>
            </tr>
          </table>
        </td>
        
        <td style="width:50%;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:40%"></td>
              <td style="padding:10px; width:60%"></td>
            </tr>
          </table>
        </td>
        
      </tr>
    </table>


    <table style="width:100%;border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="width:50%;border-right: 2px solid #111;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:50%"><b>Monthly CTC </b></td>
              <td style="padding:10px; width:25%; text-align: right;"><b>'.round($ctc_info['monthly_ctc']).'</b></td>
              <td style="padding:10px; width:25%; text-align: right;"><b>'.round($ctc_info['monthly_ctc']*12).'</b></td>
            </tr>
          </table>
        </td>
        
        <td style="width:50%;">
          <table style="width:100%;">
            <!-- <tr>
              <td style="padding:10px; width:40%"></td>
              <td style="padding:10px; width:60%; text-align: right;">30</td>
            </tr> -->
          </table>
        </td>
        
      </tr>
    </table>


    <table style="width:100%; border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="width:50%;border-right: 2px solid #111;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:40%">Bonus</td>
              <td style="padding:10px; width:30%; text-align: right;">'.round($ctc_info['bonus']).'</td>
              <td style="padding:10px; width:30%; text-align: right;">'.round($ctc_info['gross']).'</td>
            </tr>

          
          </table>
        </td>
        
        <td style="width:50%;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:40%"></td>
              <td style="padding:10px; width:60%"></td>
            </tr>
          </table>
        </td>
        
      </tr>
    </table>

    <table style="width:100%;border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="width:50%;border-right: 2px solid #111;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:50%"><b>Final CTC </b></td>
              <td style="padding:10px; width:25%; text-align: right;"><b>'.round($ctc_info['final']).'</b></td>
              <td style="padding:10px; width:25%; text-align: right;"><b>'.round($ctc_info['final']*12).'</b></td>
            </tr>
          </table>
        </td>
        
        <td style="width:50%;">
          <table style="width:100%;">
            <!-- <tr>
              <td style="padding:10px; width:40%"></td>
              <td style="padding:10px; width:60%; text-align: right;">40</td>
            </tr> -->
          </table>
        </td>
        
      </tr>
    </table>




    <table style="width:100%; border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="padding:10px;">
          <b>Note</b> :- <small>Bonus is subject to completion of 1 year of employement </small>
        </td>
        
      </tr>
    </table>';

  return $html;
}


function ledger_pdf($data){
  $CI =& get_instance();
  
  $company_info = get_company_details(); 

  //$client_info = client_info($data['client_id']);
  $client_info = main_client_info($data['client_id']);

  $site_ids = explode(",",$data['site_ids']);
  $branch_str = $data['client_branch'];  
  $client_id = $data['client_id'];  
  $flow = $data['flow'];  
  $service_type = $data['service_type'];  

  if($service_type == 1){
      $ledger_for = 'Rental Ledger';
    }else{
      $ledger_for = 'Sales Ledger';
    }
  $allinvoice_ids = 0;
  $alldn_ids = 0;
  //$payment_debitnote = $CI->db->query("SELECT * FROM tbldebitnotepayment where clientid = '".$client_id."' and status = '1' order by date ".$flow." ")->result();

    $html ='<title>'.$ledger_for.'</title>
   <head>
      <style type="text/css">@page{margin:5px auto}@font-face{font-family:SourceSansPro;src:url(SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:28cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family:Arial,sans-serif;font-size:14px;font-family:SourceSansPro}table{width:100%}table th, table td{padding:5px 10px;font-size:10px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.2em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:14px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:14px;font-weight:600}.desc p{font-size:13px;margin-bottom:0;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:15px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:10px;font-size:18px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:15px}.note{text-align:center;background:#8f8f8f;color:#fff;margin:15px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style>
   </head>
   <body>
      <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
         <tr>
            <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:60%">
               <img width="150" height="50" src="uploads/company/logo.png">
            </td>
            <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:40%">
               <h1 class="name">'.$ledger_for.'</h1>
               <h2 class="name">'.$client_info->company.'</h2>
               

              <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
               <tr>
                    <td></td>
                    <td>
                     <p style="margin-bottom:0px;">'.$client_info->address.'</p>
                     <p style="margin-bottom:0px;"><b>GST Number :</b>'.$client_info->vat.'</p>
                    </td>
                  </tr>
              </table>
              <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
                 
                  <tr>
                     <td><b>Print Date :</b></td>
                     <td>'.date('d/m/Y').'</td>
                  </tr>
              </table>

            </td>
            
         </tr>
      </table>';
  

             $grand_bal = 0;
			 $grand_recevied = 0;
             $i = 0;
             $ttl_billing = 0;
             foreach ($site_ids as $s_id) {
              $i++;
              $site_info = $CI->db->query("SELECT * FROM tblsitemanager where id = '".$s_id."' ")->row();
              $parent_invoice = $CI->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' order by date ".$flow." ")->result();    

    if($service_type == 1){
      $width = '10%';
    }else{
      $width = '5%';
    }
	$col_span = 0;
		$html .='<div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;">'.$site_info->name.'</div>
      <table border="0" cellspacing="0" cellpadding="0">
         <thead>
            <tr>';

          if(!empty($data['printdata']['start_end_date']) && $service_type == 1){
            $html .='<th class="no">Start-End Date</th>';
			$col_span += 1;
          } 

          if(!empty($data['printdata']['inv_no'])){
            $html .='<th width="'.$width.'" class="no">Inv. Number</th>';
			$col_span += 1;
          }

          if(!empty($data['printdata']['inv_date'])){
            $html .='<th width="'.$width.'" class="no">Inv. Date</th>';
			$col_span += 1;
          } 

          if(!empty($data['printdata']['inv_amt'])){
            $html .='<th width="1%" class="no text-right">Inv. Amt</th>';
			$col_span += 1;
          }

          if(!empty($data['printdata']['ttl_recd'])){
            $html .='<th width="1%" class="no text-right">Total Recd</th>';
			$col_span += 1;
          }  

          if(!empty($data['printdata']['inv_recd'])){
            $html .='<th width="1%" class="no text-right">Received</th>';
			$col_span += 1;
          } 

          if(!empty($data['printdata']['tds'])){
            $html .='<th width="1%" class="no text-right">TDS</th>';
			$col_span += 1;
          } 

          if(!empty($data['printdata']['balance'])){
            $html .='<th width="1%" class="no text-right">Balance</th>';
			$col_span += 1;
          }
          

          if(!empty($data['printdata']['receipt_date'])){
             $html .='<th width="10%" class="no text-right">Receipt Date</th>';
			 $col_span += 1;
          } 

          if(!empty($data['printdata']['ref_details'])){
            $html .='<th class="no text-right">Ref Detail</th>';
			$col_span += 1;
          } 

          if(!empty($data['printdata']['contact_person'])){
            $html .='<th class="no text-right">Contact Person</th>';
			       $col_span += 1;
          }
  
        if(!empty($data['printdata']['due_days'])){
            $html .='<th width="7%" class="no text-right">Due Days</th>';
      $col_span += 1;
          }
          
    $html .='</tr>
         </thead>
         <tbody class="main-table">';

          $ttl_bal = 0;
          $ttl_tds = 0;
			$ttl_recv = 0;
			$ttl_amt = 0;
			$parent_ids = 0;
      
          if(!empty($parent_invoice)){
            foreach ($parent_invoice as $parent) {
				$parent_ids .= ','.$parent->id;
        $allinvoice_ids .= ','.$parent->id;
              $item_info = $CI->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$parent->id."' ")->row();
              $type = '--';
              if(!empty($item_info)){
                  if($item_info->is_sale == 0){
                      $type = 'Rent';
                  }elseif($item_info->is_sale == 1){
                      $type = 'Sale';
                  }
              }

              if($type == 'Rent'){
                $start_date = _d($parent->date);
                $due_date = _d($parent->duedate);
                
              }else{
                $start_date = '-';
                $due_date = '-';
              }
              $due_days= due_days($parent->payment_due_date);
              

              $received = invoice_received($parent->id);
              $received_tds = invoice_tds_received($parent->id);

              $bal_amt = ($parent->total - $received - $received_tds);

              $ttl_recv += $received;
              $ttl_tds += $received_tds;
              $ttl_amt += $parent->total;
              $ttl_bal += $bal_amt; 
              $grand_bal += $bal_amt;   

              $ttl_billing += $parent->total;

               //$payment_info = $CI->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '2' and  `invoiceid` = '".$parent->id."' order by id desc ")->result();

               $payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$parent->id."' and cp.status = 1 order by p.id asc ")->result();
               // IF there is only one recored of payment which is made by cheque and cheque is not clear
                if(count($payment_info) == 1){
                  if($payment_info[0]->payment_mode == 1 && $payment_info[0]->chaque_status != 1){
                    $payment_info = '';
                  }
                }

               //Getting site person
              $person_info = invoice_contact_person($parent->id);
              $site_name = (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--';

              if(!empty($payment_info)){
                $j = 0;
                foreach ($payment_info as  $r1) {

                  $to_see = ($r1->payment_mode == 1 && $r1->chaque_status != 1) ? '0' : '1';

                  if($to_see == 1){
                  $ref_no = value_by_id('tblclientpayment',$r1->pay_id,'reference_no');

                  $total = ($j == 0) ? $parent->total : '--';
                  $ttl_received = ($j == 0) ? $received : '--';
                  $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
                  $due_days = ($j == 0) ? $due_days : '--';
                  $pay_date = ($r1->amount > 0) ? _d($r1->date) : '--';
                  //$tds = ($r1->showInReconciliation == 2) ? $r1->tds_amt : '0.00';

                  $html .='<tr>';

                    if(!empty($data['printdata']['start_end_date']) && $service_type == 1){
                      $html .=' <td class="desc">'.$start_date.' - '.$due_date.'</td>'; 
                    } 

                    if(!empty($data['printdata']['inv_no'])){
                      $html .=' <td class="desc">'.$parent->number.'</td>';
                    }

                    if(!empty($data['printdata']['inv_date'])){
                      $html .=' <td class="desc">'._d($parent->invoice_date).'</td>';
                    } 

                    if(!empty($data['printdata']['inv_amt'])){
                      $html .=' <td class="desc text-right">'.$total.'</td>';
                    } 

                    if(!empty($data['printdata']['ttl_recd'])){
                      $html .=' <td class="desc text-right">'.$ttl_received.'</td>';
                    } 

                    if(!empty($data['printdata']['inv_recd'])){
                      $html .=' <td class="desc text-right">'.$r1->amount.'</td>';
                    } 
                   
                    if(!empty($data['printdata']['tds'])){
                      $html .=' <td class="desc text-right">'.$r1->paid_tds_amt.'</td>';
                    }

                    if(!empty($data['printdata']['balance'])){
                      $html .=' <td class="desc text-right">'.$bal.'</td>';
                    } 

                    
                    if(!empty($data['printdata']['receipt_date'])){
                      $html .=' <td class="desc text-right">'.$pay_date.'</td>';
                    } 

                    if(!empty($data['printdata']['ref_details'])){
                      $html .=' <td class="desc text-right">'.$ref_no.'</td>';
                    } 
                        
                    if(!empty($data['printdata']['contact_person'])){
                      $html .=' <td class="desc text-right">'.$site_name.'</td>';
                    }
                    if(!empty($data['printdata']['due_days'])){
                      $html .=' <td class="desc text-right">'.$due_days.'</td>';
                    }
                            
                    $html .='</tr>';

                    $j++;
                    }
                }
              }else{
                    $html .='<tr>';

                    if(!empty($data['printdata']['start_end_date']) && $service_type == 1){
                      $html .=' <td class="desc">'.$start_date.' - '.$due_date.'</td>'; 
                    } 

                    if(!empty($data['printdata']['inv_no'])){
                      $html .=' <td class="desc">'.$parent->number.'</td>';
                    }

                    if(!empty($data['printdata']['inv_date'])){
                      $html .=' <td class="desc">'._d($parent->invoice_date).'</td>';
                    } 

                    if(!empty($data['printdata']['inv_amt'])){
                      $html .=' <td class="desc text-right">'.$parent->total.'</td>';
                    } 

                    if(!empty($data['printdata']['ttl_recd'])){
                      $html .=' <td class="desc text-right">0.00</td>';
                    } 

                    if(!empty($data['printdata']['inv_recd'])){
                      $html .=' <td class="desc text-right">0.00</td>';
                    }
                   
                    if(!empty($data['printdata']['tds'])){
                      $html .=' <td class="desc text-right">0.00</td>';
                    }

                    if(!empty($data['printdata']['balance'])){
                      $html .=' <td class="desc text-right">'.number_format($bal_amt, 2, '.', '').'</td>';
                    } 

                    
                    if(!empty($data['printdata']['receipt_date'])){
                      $html .=' <td class="desc text-right">--</td>';
                    } 

                    if(!empty($data['printdata']['ref_details'])){
                      $html .=' <td class="desc text-right">--</td>';
                    } 
                    
                    if(!empty($data['printdata']['contact_person'])){
                      $html .=' <td class="desc text-right">'.$site_name.'</td>';
                    } 
                    if(!empty($data['printdata']['due_days'])){
                      $html .=' <td class="desc text-right">'.$due_days.'</td>';
                    } 
                            
                    $html .='</tr>';
              }
                        
				//Getting Child Invoice
				$child_invoice = $CI->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and status != '5' order by date ".$flow." ")->result();
				if(!empty($child_invoice)){
					foreach ($child_invoice as $child) {
            $allinvoice_ids .= ','.$child->id;
					$item_info = $CI->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$child->id."' ")->row();
					  $type = '--';
					  if(!empty($item_info)){
						  if($item_info->is_sale == 0){
							  $type = 'Rent';
						  }elseif($item_info->is_sale == 1){
							  $type = 'Sale';
						  }
					  }

					  if($type == 'Rent'){
						$start_date = _d($child->date);
						$due_date = _d($child->duedate);
            
					  }else{
						$start_date = '-';
						$due_date = '-';
					  }
            $due_days= due_days($child->payment_due_date);
					  

					  $received = invoice_received($child->id);
            $received_tds = invoice_tds_received($child->id);

					  $bal_amt = ($child->total - $received - $received_tds);

					  $ttl_recv += $received;
            $ttl_tds += $received_tds;
					  $ttl_amt += $child->total;
					  $ttl_bal += $bal_amt; 
					  $grand_bal += $bal_amt;  

            $ttl_billing += $child->total; 

					  //$payment_info = $CI->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '2' and `invoiceid` = '".$child->id."' order by id desc ")->result();
            $payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$child->id."' and cp.status = 1 order by p.id asc ")->result();

            // IF there is only one recored of payment which is made by cheque and cheque is not clear
            if(count($payment_info) == 1){
              if($payment_info[0]->payment_mode == 1 && $payment_info[0]->chaque_status != 1){
                $payment_info = '';
              }
            }

					  //Getting site person
					  $person_info = invoice_contact_person($child->id);
					  $site_name = (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--';

					  if(!empty($payment_info)){
						$j = 0;
						foreach ($payment_info as  $r1) {

              $to_see = ($r1->payment_mode == 1 && $r1->chaque_status != 1) ? '0' : '1';

              if($to_see == 1){
						  $ref_no = value_by_id('tblclientpayment',$r1->pay_id,'reference_no');

						  $total = ($j == 0) ? $child->total : '--';
              $ttl_received = ($j == 0) ? $received : '--';
						  $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
              $due_days = ($j == 0) ? $due_days : '--';
              $pay_date = ($r1->amount > 0) ? _d($r1->date) : '--';
              //$tds = ($r1->showInReconciliation == 2) ? $r1->tds_amt : '0.00';

						  $html .='<tr>';

							if(!empty($data['printdata']['start_end_date']) && $service_type == 1){
							  $html .=' <td class="desc">'.$start_date.' - '.$due_date.'</td>'; 
							} 

							if(!empty($data['printdata']['inv_no'])){
							  $html .=' <td class="desc">'.$child->number.'</td>';
							}

							if(!empty($data['printdata']['inv_date'])){
							  $html .=' <td class="desc">'._d($child->invoice_date).'</td>';
							} 

							if(!empty($data['printdata']['inv_amt'])){
							  $html .=' <td class="desc text-right">'.$total.'</td>';
							} 

              if(!empty($data['printdata']['ttl_recd'])){
                $html .=' <td class="desc text-right">'.$ttl_received.'</td>';
              }

							if(!empty($data['printdata']['inv_recd'])){
							  $html .=' <td class="desc text-right">'.$r1->amount.'</td>';
							} 
						   
              if(!empty($data['printdata']['tds'])){
                $html .=' <td class="desc text-right">'.$r1->paid_tds_amt.'</td>';
              }

							if(!empty($data['printdata']['balance'])){
							  $html .=' <td class="desc text-right">'.$bal.'</td>';
							} 
							

							if(!empty($data['printdata']['receipt_date'])){
							  $html .=' <td class="desc text-right">'.$pay_date.'</td>';
							} 

							if(!empty($data['printdata']['ref_details'])){
							  $html .=' <td class="desc text-right">'.$ref_no.'</td>';
							} 

							if(!empty($data['printdata']['contact_person'])){
							  $html .=' <td class="desc text-right">'.$site_name.'</td>';
							}
              if(!empty($data['printdata']['due_days'])){
                $html .=' <td class="desc text-right">'.$due_days.'</td>';
              } 
								
									
							$html .='</tr>';

							$j++;
              }
						}
					  }else{
							$html .='<tr>';

							if(!empty($data['printdata']['start_end_date']) && $service_type == 1){
							  $html .=' <td class="desc">'.$start_date.' - '.$due_date.'</td>'; 
							} 

							if(!empty($data['printdata']['inv_no'])){
							  $html .=' <td class="desc">'.$child->number.'</td>';
							}

							if(!empty($data['printdata']['inv_date'])){
							  $html .=' <td class="desc">'._d($child->invoice_date).'</td>';
							} 

							if(!empty($data['printdata']['inv_amt'])){
							  $html .=' <td class="desc text-right">'.$child->total.'</td>';
							} 

              if(!empty($data['printdata']['ttl_recd'])){
                $html .=' <td class="desc text-right">0.00</td>';
              } 

							if(!empty($data['printdata']['inv_recd'])){
							  $html .=' <td class="desc text-right">0.00</td>';
							} 

              if(!empty($data['printdata']['tds'])){
                $html .=' <td class="desc text-right">0.00</td>';
              }						   

							if(!empty($data['printdata']['balance'])){
							  $html .=' <td class="desc text-right">'.number_format($bal_amt, 2, '.', '').'</td>';
							} 


							if(!empty($data['printdata']['receipt_date'])){
							  $html .=' <td class="desc text-right">--</td>';
							} 

							if(!empty($data['printdata']['ref_details'])){
							  $html .=' <td class="desc text-right">--</td>';
							} 
							
							if(!empty($data['printdata']['contact_person'])){
							  $html .=' <td class="desc text-right">'.$site_name.'</td>';
							}
              if(!empty($data['printdata']['due_days'])){
                $html .=' <td class="desc text-right">'.$due_days.'</td>';
              } 
									
							$html .='</tr>';
					  }
						
					}
					$html .= '<tr><td colspan='.$col_span.'></td></tr>';
				}
            }
			
			//Getting Debit Notes againt parent invoice
            $debit_note_info = $CI->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by dabit_note_date ".$flow." ")->result();
              if(!empty($debit_note_info)){
                foreach ($debit_note_info as $debitnote) {

                  $alldn_ids .= ','.$debitnote->id;

					        $received = debitnote_received($debitnote->number);
                  $received_tds = debitnote_tds_received($debitnote->number);
                  $bal_amt = ($debitnote->totalamount - $received - $received_tds);

                  $ttl_recv += $received;
                  $ttl_tds += $received_tds;
                  $ttl_amt += $debitnote->totalamount;
                  $ttl_bal += $bal_amt; 
                  $grand_bal += $bal_amt; 

                  $ttl_billing += $debitnote->totalamount;

                 // $debitnote_payment = $CI->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '3' and `debitnote_no` = '".$debitnote->number."' order by id asc ")->result();

                  $debitnote_payment = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();

                  // IF there is only one recored of payment which is made by cheque and cheque is not clear
                  if(count($debitnote_payment) == 1){
                    if($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1){
                      $debitnote_payment = '';
                    }
                  }


                  if(!empty($debitnote_payment)){
                    $j = 0;
                    foreach ($debitnote_payment as  $r3) {

                      $to_see = ($r3->payment_mode == 1 && $r3->chaque_status != 1) ? '0' : '1';

                      if($to_see == 1){

						          $ref_no = value_by_id('tblclientpayment',$r3->pay_id,'reference_no');

        						  $total = ($j == 0) ? $debitnote->totalamount : '--';
                      $ttl_received = ($j == 0) ? $received : '--';
        						  $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
                      //$tds = ($r3->showInReconciliation == 2) ? $r3->tds_amt : '0.00';

        						  $html .='<tr>';

        							if(!empty($data['printdata']['start_end_date']) && $service_type == 1){
        							  $html .=' <td class="desc">DN</td>'; 
        							} 

        							if(!empty($data['printdata']['inv_no'])){
        							  $html .=' <td class="desc">'.$debitnote->number.'</td>';
        							}

        							if(!empty($data['printdata']['inv_date'])){
        							  $html .=' <td class="desc">'._d($debitnote->dabit_note_date).'</td>';
        							} 

        							if(!empty($data['printdata']['inv_amt'])){
        							  $html .=' <td class="desc text-right">'.$total.'</td>';
        							} 

                      if(!empty($data['printdata']['ttl_recd'])){
                        $html .=' <td class="desc text-right">'.$ttl_received.'</td>';
                      }

        							if(!empty($data['printdata']['inv_recd'])){
        							  $html .=' <td class="desc text-right">'.$r3->amount.'</td>';
        							} 

                      if(!empty($data['printdata']['tds'])){
                        $html .=' <td class="desc text-right">'.$r3->paid_tds_amt.'</td>';
                      }        						   

        							if(!empty($data['printdata']['balance'])){
        							  $html .=' <td class="desc text-right">'.$bal.'</td>';
        							} 


        							if(!empty($data['printdata']['receipt_date'])){
        							  $html .=' <td class="desc text-right">'._d($r3->date).'</td>';
        							} 

        							if(!empty($data['printdata']['ref_details'])){
        							  $html .=' <td class="desc text-right">'.$ref_no.'</td>';
        							} 

        							if(!empty($data['printdata']['contact_person'])){
        							  $html .=' <td class="desc text-right">--</td>';
        							}
                      if(!empty($data['printdata']['due_days'])){
                        $html .=' <td class="desc text-right">--</td>';
                      }
        								
        									
        							$html .='</tr>';

        							$j++;
                    }
						}
					  }else{
							$html .='<tr>';

							if(!empty($data['printdata']['start_end_date']) && $service_type == 1){
							  $html .=' <td class="desc">DN</td>'; 
							} 

							if(!empty($data['printdata']['inv_no'])){
							  $html .=' <td class="desc">'.$debitnote->number.'</td>';
							}

							if(!empty($data['printdata']['inv_date'])){
							  $html .=' <td class="desc">'._d($debitnote->dabit_note_date).'</td>';
							} 

							if(!empty($data['printdata']['inv_amt'])){
							  $html .=' <td class="desc text-right">'.$debitnote->totalamount.'</td>';
							} 

              if(!empty($data['printdata']['ttl_recd'])){
                $html .=' <td class="desc text-right">0.00</td>';
              }

							if(!empty($data['printdata']['inv_recd'])){
							  $html .=' <td class="desc text-right">0.00</td>';
							} 
						   

              if(!empty($data['printdata']['tds'])){
                $html .=' <td class="desc text-right">0.00</td>';
              } 

							if(!empty($data['printdata']['balance'])){
							  $html .=' <td class="desc text-right">'.number_format($bal_amt, 2, '.', '').'</td>';
							}

							if(!empty($data['printdata']['receipt_date'])){
							  $html .=' <td class="desc text-right">--</td>';
							} 

							if(!empty($data['printdata']['ref_details'])){
							  $html .=' <td class="desc text-right">--</td>';
							} 
							
							if(!empty($data['printdata']['contact_person'])){
							  $html .=' <td class="desc text-right">--</td>';
							}
              if(!empty($data['printdata']['due_days'])){
                $html .=' <td class="desc text-right">--</td>';
              }
									
							$html .='</tr>';
					  }
					 

					}
			   }
			   
			   
			//Getting Credit Notes againt parent invoice
            $credit_note_info = $CI->db->query("SELECT * FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by date ".$flow." ")->result();
              if(!empty($credit_note_info)){
                foreach ($credit_note_info as $creditnote) {

					        $ttl_recv += $creditnote->totalamount;

                  $ttl_bal -= $creditnote->totalamount;
                  $grand_bal -= $creditnote->totalamount;

                  $html .='<tr>';

                if(!empty($data['printdata']['start_end_date']) && $service_type == 1){
                  $html .=' <td class="desc">CN</td>'; 
                } 

                if(!empty($data['printdata']['inv_no'])){
                  $html .=' <td class="desc">'.$creditnote->number.'</td>';
                }

                if(!empty($data['printdata']['inv_date'])){
                  $html .=' <td class="desc">'._d($creditnote->date).'</td>';
                } 

                if(!empty($data['printdata']['inv_amt'])){
                  $html .=' <td class="desc text-right">0.00</td>';
                } 

                if(!empty($data['printdata']['ttl_recd'])){
                  $html .=' <td class="desc text-right">'.$creditnote->totalamount.'</td>';
                }

                if(!empty($data['printdata']['inv_recd'])){
                  $html .=' <td class="desc text-right">0.00</td>';
                } 
                 

                if(!empty($data['printdata']['balance'])){
                  $html .=' <td class="desc text-right">0.0</td>';
                } 

                if(!empty($data['printdata']['tds'])){
                  $html .=' <td class="desc text-right">0.00</td>';
                }

                if(!empty($data['printdata']['receipt_date'])){
                  $html .=' <td class="desc text-right">--</td>';
                } 

                if(!empty($data['printdata']['ref_details'])){
                  $html .=' <td class="desc text-right">--</td>';
                } 
                
                if(!empty($data['printdata']['contact_person'])){
                  $html .=' <td class="desc text-right">--</td>';
                }
                if(!empty($data['printdata']['due_days'])){
                  $html .=' <td class="desc text-right">--</td>';
                }
                    
                $html .='</tr>';
					 

					}
			   }
       }

     if($service_type == 1){
      $colspan = 3;
     }else{
      $colspan = 2;
     }
     $html .='</tbody>
     <tfoot>
         <tr>
            
            <td class="note" colspan="'.$colspan.'"><b>Total</b></td>
            <td class="note text-left"><b>'.number_format($ttl_amt, 2, '.', '').'</b></td>
            <td class="note text-left"><b>'.number_format($ttl_recv, 2, '.', '').'</b></td>                     
            <td class="note text-left"><b>'.number_format($ttl_recv, 2, '.', '').'</b></td>';
            if(!empty($data['printdata']['tds'])){
              $html .='<td class="note text-left">'.number_format($ttl_tds, 2, '.', '').'</td>';
            }
            $html .='<td class="note text-left"><b>'.number_format($ttl_bal, 2, '.', '').'</b></td>';
            

            if(!empty($data['printdata']['receipt_date'])){
              $html .='<td class="note text-left"></td>';
            } 

            if(!empty($data['printdata']['ref_details'])){
              $html .='<td class="note text-left"></td>';
            } 
            
            if(!empty($data['printdata']['contact_person'])){
              $html .='<td class="note text-left"></td>';
            }
            if(!empty($data['printdata']['due_days'])){
              $html .='<td class="note text-left"></td>';
            }
            
            $html .=' </tr>
     </tfoot>
      </table>
     
      <table border="0" cellspacing="0" cellpadding="0">
        
      </table>';
	  
	  $grand_recevied += ($ttl_recv + $ttl_tds);

    }

	//Payment Debit Notes
    $payment_debitnote = $CI->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$allinvoice_ids.") and i.invoice_id > 0 and i.type = 1 GROUP by dn.id ")->result();
    if(empty($payment_debitnote)){
      $payment_debitnote = $CI->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$alldn_ids.") and i.invoice_id > 0 and i.type = 2 GROUP by dn.id ")->result();
    }
	  if(!empty($payment_debitnote)){
            $ttl_tds = 0;
            $ttl_bal = 0;
            $ttl_recv = 0;
            $ttl_amt = 0;

       $html .= '<div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;">Delay in Payment</div>
       <table border="0" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th class="no">Details</th>
                <th width="10%" class="no">DN Number</th>
                <th width="10%" class="no">DN Date</th>
                <th width="1%" class="no text-right">Amount</th>
                <th width="1%" class="no text-right">Payment recd</th> 
                <th width="1%" class="no text-right">TDS</th>              
                <th width="1%" class="no text-right">Payment Balance</th>
                <th width="10%" class="no">Payment Receipt Date</th>
                <th class="no">Payment Ref Detail</th>
              </tr>
            </thead>
            <tbody>';


        foreach ($payment_debitnote as $debitnote) {
                                                      
                $received = debitnote_received($debitnote->number);
                $received_tds = debitnote_tds_received($debitnote->number);
                $bal_amt = ($debitnote->amount - $received - $received_tds);

                $ttl_recv += $received;
                $ttl_amt += $debitnote->amount;
                $ttl_bal += $bal_amt; 
                $grand_bal += $bal_amt; 

                $ttl_billing += $debitnote->amount;

                //$debitnote_payment = $CI->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '3' and `debitnote_no` = '".$debitnote->number."' order by id asc ")->result();

                $debitnote_payment = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();
                // IF there is only one recored of payment which is made by cheque and cheque is not clear
                if(count($debitnote_payment) == 1){
                  if($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1){
                    $debitnote_payment = '';
                  }
                }

                 $j = 0;
                 $total = ($j == 0) ? $debitnote->amount : '--';
                $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
                if(!empty($debitnote_payment)){
                 
                  foreach ($debitnote_payment as  $r4) {

                    $to_see = ($r4->payment_mode == 1 && $r4->chaque_status != 1) ? '0' : '1';
                    if($to_see == 1){
                    $ref_no = value_by_id('tblclientpayment',$r4->pay_id,'reference_no');
                    //$tds = ($r4->showInReconciliation == 2) ? $r4->tds_amt : '0.00';

                    $html .= '<tr>
                        <td class="desc text-right">DN</td>
                        <td class="desc text-right">'.$debitnote->number.'</td>
                        <td class="desc text-right">'._d($debitnote->date).'</td>
                        <td class="desc text-right">'.$total.'</td>
                        <td class="desc text-right">'.$r4->amount.'</td>
                        <td class="desc text-right">'.$r4->paid_tds_amt.'</td>
                        <td class="desc text-right">'.$bal.'</td>
                        <td class="desc text-right">'._d($r4->date).'</td>
                        <td class="desc text-right">'.$ref_no.'</td>

                     </tr>';
                     $j++;
                     }
                    }
                  }else{   
                  
                  $html .= '<tr>
                        <td class="desc text-right">DN</td>
                        <td class="desc text-right">'.$debitnote->number.'</td>
                        <td class="desc text-right">'._d($debitnote->date).'</td>
                        <td class="desc text-right">'.$total.'</td>
                        <td class="desc text-right">0.00</td>
                        <td class="desc text-right">--</td>
                        <td class="desc text-right">'.$bal.'</td>
                        <td class="desc text-right">--</td>
                        <td class="desc text-right">--</td>

                     </tr>';
                } 
          }
          $html .= ' <tfoot>
                 <tr>
                    
                    <td class="note" colspan="3"><b>Total</b></td>
                    <td class="note text-left"><b>'.number_format($ttl_amt, 2, '.', '').'</b></td>
                    <td class="note text-left"><b>'.number_format($ttl_recv, 2, '.', '').'</b></td>                     
                    <td class="note text-left"><b>'.number_format($ttl_tds, 2, '.', '').'</b></td>
                    <td class="note text-left"><b>'.number_format($ttl_bal, 2, '.', '').'</b></td>
                    <td class="note text-left"></td>
                    <td class="note text-left"></td>
                 </tr>
             </tfoot>
          </table>';                
		$grand_recevied += ($ttl_recv + $ttl_tds);
    }
    $onaccout_info = $CI->db->query("SELECT * FROM `tblclientpayment` where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ")->result();

    // IF there is only one recored of payment which is made by cheque and cheque is not clear
    if(count($onaccout_info) == 1){
      if($onaccout_info[0]->payment_mode == 1 && $onaccout_info[0]->chaque_status != 1){
        $onaccout_info = '';
      }
    }
    if(!empty($onaccout_info)){
        $html .= '<div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;">On Account Details</div>
       <table border="0" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th  width="20%" class="no">Sr. No.</th>
                <th width="25%" class="no">Date</th>
                <th width="25%" class="no">Reference No.</th>
                <th width="25%" class="no text-right">Amount</th>
              </tr>
            </thead>
            <tbody>';

        $ttl_onaccount = 0;
        foreach ($onaccout_info as $key => $on_acc) {

                $to_see = ($on_acc->payment_mode == 1 && $on_acc->chaque_status != 1) ? '0' : '1';

                if($to_see == 1){
                  $ttl_onaccount += $on_acc->ttl_amt;                                   
                  $html .= '<tr>
                        <td class="desc">'.++$key.'</td>
                        <td class="desc">'._d($on_acc->date).'</td>
                        <td class="desc">'.$on_acc->reference_no.'</td>
                        <td class="desc text-right">'.$on_acc->ttl_amt.'</td>

                     </tr>';
                 }
                
          }
          $html .= ' <tfoot>
                 <tr>
                    
                    <td class="note" colspan="3"><b>Total</b></td>
                    <td class="note text-right"><b>'.number_format($ttl_onaccount, 2, '.', '').'</b></td>
                 </tr>
             </tfoot>
          </table>';

    }
    

    //$onaccout_amt = $CI->db->query("SELECT COALESCE(SUM(ttl_amt),0) AS ttl_amount FROM `tblclientpayment`  where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' ")->row()->ttl_amount;
    $onaccout_amt = 0;
    $onaccout_amt_info = $CI->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ")->result();
    if(!empty($onaccout_amt_info)){
      foreach ($onaccout_amt_info as $on_am) {
        $to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
        if($to_see == 1){
          $onaccout_amt += $on_am->ttl_amt;
        }
      }
    }

    $waveoff_amt = $CI->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN (".$data['client_branch'].") and status = 1 and service_type = '".$service_type."' ")->row()->ttl_amount;
    $waveoff_info = $CI->db->query("SELECT * FROM `tblclientwaveoff`  where client_id IN (".$data['client_branch'].") and status = 1 and service_type = '".$service_type."' ")->result();

    $final_balance = (round($grand_bal) - round($onaccout_amt) - round($waveoff_amt));


  $html .='<table border="0" cellspacing="0" cellpadding="0">

         <tr>
            <td>Total Billing</td>
            <td>'.round($ttl_billing).'.00</td>
         </tr>
		 <tr>
            <td>Total Recevied</td>
            <td>'.round($grand_recevied).'.00</td>
         </tr>
         <tr>
            <td>Total Balance</td>
            <td>'.round($grand_bal).'.00</td>
         </tr>
         <tr>
            <td>Onaccount</td>
            <td>-'.round($onaccout_amt).'.00</td>
         </tr>';

  if(!empty($waveoff_info)){
    foreach ($waveoff_info as $wave_row) {
      $waveoff_title = (!empty($wave_row->remark)) ? $wave_row->remark : 'Waveoff';
      $waveoff_sign = ($wave_row->amount > 0) ? '-' : '+';
  $html .='<tr>
            <td>'.$waveoff_sign.' '.$waveoff_title.'</td>
            <td>'.round($wave_row->amount).'.00</td>
         </tr>';   
      }     
  }

  $html .='<tr>
            <td>Final Balance</td>
            <td>'.round($final_balance).'.00</td>
         </tr>
      </table>
     
      <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>
    
   <!--<table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:2px;">
        <tbody>
          <tr>
            <td class="desc" style="text-align:left;">
        <p><b>GSTIN :</b>  '.$company_info['gst'].'</p>
      </td>
        
       <td class="desc" style="text-align:center;">
        <p><b>MSME :</b> UP28B0011156</p>
      </td>
      
      <td style="text-align:right;"><b>CIN :</b>U51101UP2015PTC068937</td>
          </tr>
        </tbody>
    </table>-->
  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center;">
              <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
   </body>';

    return $html;

}




function challan_pdf($estimate){
	
	$CI =& get_instance();
  
  if($estimate->service_type == 2){
  $for = 'sale';  
	$profor='Challan - Sales';
	$po_date_head = 'PO Date';
  $po_number_head = 'PO Number';
  }else{
  $for = 'rent'; 
	$profor='Challan - Rental';
	$po_date_head = 'WO Date';
   $po_number_head = 'WO Number';
  }
  
  $estimate_info = $CI->db->query("SELECT * FROM `tblestimates` where  `id` = '".$estimate->rel_id."' ")->row();
  
  $to_info = get_estimate_to_array($estimate->rel_id);
  //$shipto_info = get_ship_to_array($estimate_info->site_id);
  $shipto_info = get_ship_to_array($estimate->site_id);
  
  $company_info = get_company_details(); 

  $challan_info = $CI->db->query("SELECT * FROM `tblchalanmst` where  `id` = '".$estimate->id."' ")->row();	

  $billing_info = get_branch_details($challan_info->billing_branch_id);
  
  $html = '<html><title>Challan PDF</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:10px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:10px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{font-family: Poppins, sans-serif;font-size:10px;}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#df2c2c;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:10px;background:#626F80;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:10px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:12px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
 
/*
<p>'.$company_info['address'].'</p>
        <p><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b> U51101UP2015PTC068937</p>
*/
  
 $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:55%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$billing_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:45%">
         <h2 class="name">'.$profor.'</h2>
        <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Challan  :</b></td>
            <td># '.$estimate->chalanno.'</td>
          </tr>
      
     
          
          <tr>
            <td><b>Date :</b></td>
            <td>'.date('d/m/Y',strtotime($estimate->challandate)).'</td>
          </tr>

          <tr>
            <td><b>'.$po_number_head.' :</b></td>
            <td>'.$estimate->work_no.'</td>
          </tr>

          <tr>
            <td><b>'.$po_date_head.' :</b></td>
            <td>'._d($estimate->workdate).'</td>
          </tr>
      
     
        </table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no" style="font-weight:600;font-family: Poppins, sans-serif;"><b>Challan To</b></th>
            <th class="no" style="font-weight:600;font-family: Poppins, sans-serif;"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$to_info['name'].'</h3><p>'.$to_info['address'].', '.$to_info['city'].', '.$to_info['state'].'</p>';
        if(!empty($to_info['gst'])){
          $html .= '<p><b>Zip :</b> '.$to_info['zip'].'</p>';
        }
        if(!empty($to_info['gst'])){
          $html .= '<p><b>GST NO :</b> '.$to_info['gst'].'</p>';
        }
        if(!empty($estimate->office_person)){
          $html .= '<p><b>Contact Person :</b> '.$estimate->office_person.', '.$estimate->office_person_number.'</p>';

        }

        
     $html .= '</td>
      <td class="desc">
      <h3>'.$shipto_info['name'].'</h3>
      <p>'.$shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state'].'</p>
      <p><b>Landmark :</b> '.$shipto_info['landmark'].'</p>
        <p><b>Zip :</b> '.$shipto_info['zip'].'</p>';

        if(!empty($estimate->site_person)){
          $html .= '<p><b>Contact Person :</b> '.$estimate->site_person.', '.$estimate->site_person_number.'</p>';
        }

         $html .= '</td>

          </tr>
      <!--<tr>
      <td class="desc">
        <p><b>CONTACT :</b> '.$to_info['phone'].'</p>
      </td>
	  <td></td>
      
      </tr>-->
        </tbody>
    </table>';

$product_data = json_decode($estimate->product_json);

    $html .= '<table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no" style="width:7%; font-size:10px;font-weight:600;">No.</th>
            <th class="no" style="width:80%; font-size:10px;font-weight:600;">Product Name</th>
            <th class="no" style="font-size:10px;font-weight:600;">QTY</th>
          </tr>
        </thead>
        <tbody class="main-table">';

        if(!empty($product_data)){
          $i = 1;
          $ttl_value = 0;
          foreach ($product_data as $key => $value) {

            $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
            if($isOtherCharge == 0){
              $ttl_value += get_material_value($value->product_id,$value->product_qty);
              $html .= '<tr>
                      <td class="desc">'.$i++.'</td>
                      <td class="desc"><p>'.value_by_id('tblproducts',$value->product_id,'sub_name').'</p></td>
                      <td class="desc">'.$value->product_qty.' '.get_product_units($value->product_id).'</td>
                    </tr>'; 
            }
             
          }
        }
   
   
$html .= '</tbody></table><br>';
  
$html .= '<table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no" style="font-size:10px;font-weight:600;">No.</th>
            <th class="no" style="font-size:10px;font-weight:600;">Bill Of Material</th>
            <th class="no" style="font-size:10px;font-weight:600;">Qty Deliverd</th>';
          if($for == 'rent'){
            $html .= '<th class="no" style="font-size:10px;font-weight:600;">Qty Pickup</th>
                      <th class="no" style="font-size:10px;font-weight:600;">Damage</th>';
          }            

$html .= '</tr>
        </thead>
        <tbody class="main-table">';
   

if(!empty($estimate->items)){
  $i = 1;
  
  foreach ($estimate->items as $key => $value) {
    
    $html .= '<tr>
            <td class="desc">'.$i++.'</td>
            <td class="desc"><p>'.value_by_id('tblproducts',$value['component_id'],'sub_name').'</p></td>
            <td class="desc">'.$value['deleverable_qty'].' '.get_product_units($value['component_id']).'</td>';

    if($for == 'rent'){
            $html .= '<td class="desc"> </td>
            <td class="desc"> </td>';
    }        
   
  $html .= '</tr>';  
  }
}
   
   
$html .= '</tbody><br><br>';
  
if($for == 'rent'){
  $html .= '<tfoot>
      <tr>
         <td class="desc text-center" colspan="5"><h3 style="margin:0;color:282929;">** Material Value - Rs. '.number_format(round($ttl_value), 2, '.', '').'/-</h3></td>
      </tr>
    </tfoot>';
}    

    
$html .= '</table><br>';

 if(!empty($estimate->note)){
    $html .= '<div class="notice">Note: </div>    
    <div class="termsList">'.$estimate->note.'</div><br>';
  }
 
if($for == 'sale'){
  $html .= '
    <div class="notice">Terms & conditions : </div>
    <div class="termsList">
  
  <table border="0" cellspacing="0" cellpadding="0">
    
    <tr>
            <td class="desc">'.$estimate->terms_and_conditions.'</td>
      
      <td class="desc text-center" rowspan="1" style="padding-top:60px;">
        Receiving of Site<br>
          (Signature, Name, Contact No)
      </td>
          </tr>
      
      <tr>
      <td class="desc text-center" colspan="2"><b>We Assure you the best services from SCHACH Engg. Thanks</b></td>
      </tr>
    
  </table><br>';

}else{
  $html .= '<div id="notices" style="margin-bottom:10px;">
                <div style="text-align: center;">Kindly Handle with care or be ready to bear the COST for damage..!!</div>
          </div>
          
      <table border="0" cellspacing="0" cellpadding="0">
        
        <tr>
            <td class="desc text-center" style="width:50%">
            <span style="text-align:center;">
                <h4>During Delivery: Date</h4>
                <br>
                <br>
                <p>Delivered By Schach Employee</p>
                <p>(Name)</p>
                <br>
                <br>
                <p>Received By Client Employee</p>
                <p>(Signature, Name, Contact No)</p>
             </span> 
          </td>
            <td class="desc text-center" style="width:50%">
            <span style="text-align:center;">
              <h4>During Pickup: Date</h4>
              <br>
              <br>
              <p>Pickup By Schach Employee</p>
              <p>(Name)</p>
              <br>
              <br>
              <p>Material Out By Client Employee</p>
              <p>(Signature, Name, Contact No)</p>
            </span> 
          </td>
              </tr>

          <tr>
          <td style="text-align:center;" class="desc text-center" colspan="2"><b>We Assure you the best services from SCHACH Engg. Thanks</b></td>
          </tr>
        
      </table>';

}
 
$html .= '</div>
  
              
   <!--<table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:2px;">
        <tbody>
          <tr>
            <td class="desc" style="text-align:left;">
        <p><b>GSTIN :</b>  '.$company_info['gst'].'</p>
      </td>
        
       <td class="desc" style="text-align:center;">
        <p><b>MSME :</b> UP28B0011156</p>
      </td>
      
      <td style="text-align:right;"><b>CIN :</b>U51101UP2015PTC068937</td>
          </tr>
        </tbody>
    </table>-->
  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
        <tr>
         <td class="desc" style="text-align:center;">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
  
  </body></html>';

  return $html;
}


function purchase_order_pdf($purchase){
  $CI =& get_instance();

  $number = 'PO-'.$purchase->number;
  $company_info = get_company_details();  
  $vendor_info = get_vendor_info($purchase->vendor_id);
  $warehouse_info = get_warehouse_info($purchase->warehouse_id);
  $tax_type = get_vendor_gst_type($purchase->vendor_id);
  $shipto_info = get_ship_to_array($purchase->site_id);


  $discount_percent = $purchase->finaldiscountpercentage;
  if($purchase->order_type == 1){
    $profor='PURCHASE ORDER';
  }else{
    $profor='WORK ORDER'; 
  }
  


  //Getting the item list
  $po_items = get_po_items_list($purchase->id);
  $othercharges= $CI->db->query("SELECT * FROM `tblpurchaseothercharges` where `proposalid`='".$purchase->id."' and category_name > 0 ")->result_array(); 


  
  
  $html = '<html><title>PURCHASE ORDER</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  /*<h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>*/

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%">
         <h2 class="name">'.$profor.'</h2>';

    if($purchase->revised_id > 0){
        $html .= '<h4 class="name" style="color:green;">Revised</h4>';
    }       
  

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>PO Number :</b></td>
            <td> '.$number.'</td>
          </tr>
          
          <tr>
            <td><b>PO Date :</b></td>
            <td>'. _d($purchase->date).'</td>
          </tr> 

        </table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no"><b>To</b></th>
            <th class="no"><b>Bill To</b></th>
            <th class="no"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$vendor_info['name'].'</h3>
        <p><b>Address :</b> '.$vendor_info['address'].', '.$vendor_info['city'].', '.$vendor_info['state'].'</p>
        <p><b>PAN No. :</b> '.$vendor_info['pan_no'].'</p>
        <p><b>GST No. :</b> '.$vendor_info['gst'].'</p>
        <p><b>Phone :</b> '.$vendor_info['phone'].'</p>
        <p style="text-transform:none;"><b>Email :</b> '.$vendor_info['email'].'</p>
        
      </td>';

      /*$contact_person = $CI->db->query("SELECT * FROM `tbloptions` where id = '403' ")->row();
      $contact_no = $CI->db->query("SELECT * FROM `tbloptions` where id = '34' ")->row();*/

      $branch_info = $CI->db->query("SELECT * FROM `tblcompanybranch` where id = '".$purchase->billing_branch_id."' ")->row();

      $html .= '<td class="desc">
        <h3>'.$company_info['company_name'].'</h3>
        <p><b>Address :</b> '.$branch_info->address.'</p>
        <p><b>PAN No. :</b> AAVCS4630C</p>  
        <p><b>GST No. :</b> '.$branch_info->gst_no.'</p>
        <p><b>Contact Person :</b> '.$branch_info->contact_person.'</p>
        <p><b>Contact No. :</b> '.$branch_info->phone_no_1.'</p>              
        <p style="text-transform:none;"><b>Email :</b> admin@schachengineers.com</p>
        
      </td>';

      if($purchase->source_type == 1){
        $html .= '<td class="desc">
          <h3>'.$company_info['company_name'].'</h3>
          <p><b>Address :</b> '.$warehouse_info['address'].'</p>
          <p><b>Contact Person :</b> '.$warehouse_info['cont_name'].'</p>
          <p><b>Contact No. :</b> '.$warehouse_info['phone'].'</p>
          
        </td>';
      }else{
        /*$html .= '<td class="desc">
            <h3>'.$company_info['company_name'].'</h3>
            <p><b>Address :</b> '.$warehouse_info['address'].'</p>
            <p><b>Contact Person :</b> '.$warehouse_info['cont_name'].'</p>
            <p><b>Contact No. :</b> '.$warehouse_info['phone'].'</p>
            
          </td>';*/

          $html .= '<td class="desc">
        <h3>'.$shipto_info['name'].'</h3>
        <p>'.$shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state'].'</p>
        <p><b>Landmark :</b> '.$shipto_info['landmark'].'</p>
        <p><b>Zip :</b> '.$shipto_info['zip'].'</p>';
      }
      



  

  $html .= '</tr>
        </tbody>
    </table>';

  if($purchase->confirm_by == 1){
    $html .= '<p style="margin-bottom: 5px; margin-top: 5px;">With reference to your quotation number <b><u>'.$purchase->reference_no.'</u></b> dated on <b><u>'.date('d M Y',strtotime($purchase->quotation_date)).',</u></b> we are pleased to place an order as per the details given below:</p>';
  }else{
    $html .= '<p style="margin-bottom: 5px; margin-top: 5px;">With reference to your Email dated on <b><u>'.date('d M Y',strtotime($purchase->quotation_date)).',</u></b> we are pleased to place an order as per the details given below:</p>';
  }
  

  $html .= '<!--shipping Area End-->
  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="5%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="25%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;">QTY</th>            
            <th width="6%" class="no" style="font-size:10px;font-weight:600;">UNIT</th>
            <th class="no text-right" style="font-size:10px;font-weight:600;">RATE</th>';

            if(!empty($tax_type == 1)){
              $html .= '<th class="no" style="font-size:10px;font-weight:600;">CGST</th>';
              $html .= '<th class="no" style="font-size:10px;font-weight:600;">SGST</th>';
            }else{
              $html .= '<th class="no" style="font-size:10px;font-weight:600;">IGST</th>';
            }

          $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>';
          $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">TOTAL</th>
          </tr>
        </thead>
        <tbody class="main-table">';
          
    $ttl_value = 0; 
  
    if(!empty($po_items)){
     $total_price = 0;
     $shown_total_price = 0;
     foreach ($po_items as $key => $value) {
        $qty = $value['qty'];
        $rate = $value['price'];

        $price = ($rate * $qty);


        //Applying TAX after discount
        if($purchase->tax_type == 2){
          $tax_amt = ($price*$value['prodtax']/100);
          $final_price = ($price+$tax_amt);
        }else{
          $final_price = $price;
        }
        



        $total_price += $final_price;

        if($value['hsn_code'] == 2){
          //$hsn_sac_code = value_by_id('tblproducts',$value['product_id'],'sac_code');
          
          $hsn_sac_code = $CI->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$value['product_id']."' ")->row()->field_value;
        }else{
          //$hsn_sac_code = value_by_id('tblproducts',$value['product_id'],'hsn_code');
          $hsn_sac_code = $CI->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$value['product_id']."' ")->row()->field_value;
          
        }
        if ($value["is_temp"] == 0){
            $unit_id = value_by_id_empty('tblproducts', $value['product_id'], 'unit_2');
            $product_name = value_by_id('tblproducts', $value['product_id'], 'sub_name');
            
            if($value['hsn_code'] == 2){
                //$hsn_sac_code = value_by_id('tblproducts',$value['product_id'],'sac_code');
                $hsn_sac_code = $CI->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$value['product_id']."' ")->row()->field_value;
              }else{
                //$hsn_sac_code = value_by_id('tblproducts',$value['product_id'],'hsn_code');
                $hsn_sac_code = $CI->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$value['product_id']."' ")->row()->field_value;
              }
        }else{
            $unit_id = value_by_id_empty('tbltemperoryproduct', $value['product_id'], 'unit');
            $product_name = $value["product_name"];
            if($value['hsn_code'] == 2){
                $hsn_sac_code = value_by_id('tbltemperoryproduct',$value['product_id'],'sac');
              }else{
                $hsn_sac_code = value_by_id('tbltemperoryproduct',$value['product_id'],'hsn');
              }
        }
        
        $remk = '';
        if(!empty($value['remark'])){
          $remk = '<p>'.$value['remark'].'</p>';
        }
            $html .= '<tr>
            <td class="desc">'.++$key.'</td>
            <td class="desc">'.$product_name.''.getPoVendorProductName($purchase->vendor_id,$value['product_id']).$remk.'<p>HSN/SAC : '.$hsn_sac_code.'</p></td>
            <td class="desc">'.$qty.'</td>         
            <td class="desc">'.value_by_id('tblunitmaster',$unit_id,'name').'</td>
            <td class="desc text-right">'.$rate.'</td>';

            if(!empty($tax_type == 1)){
                $tax = ($value['prodtax']/2);
                $html .=  ' <td width="7%" class="desc text-center">'.$tax.'%</td>';
                $html .=  ' <td width="7%" class="desc text-center">'.$tax.'%</td>';
             }else{                
                $html .=  ' <td width="8%" class="desc text-center">'.number_format(round($value['prodtax']), 0, '.', '').'%</td>';
             }
             $html .=  '<td class="desc text-right">'.number_format(round($tax_amt), 2, '.', '').'</td>';
             $html .='<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
           </tr>';

        }

    }    
      
    
    $html .= '</tbody>
      </table>
    
    <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="text-align:right">SUBTOTAL</td>
            <td style="text-align:right">'.number_format(round($total_price), 2, '.', '').'</td>
          </tr>';
  
      $discount = 0;
      if(!empty($discount_percent > 0)){
         $discount = ($total_price*$discount_percent/100);
              
        $html .= '<tr>
            <td style="text-align:right">Discount @ '.number_format($discount_percent).'%</td>
            <td style="text-align:right">-'.number_format(round($discount), 2, '.', '').'</td>
          </tr>';    

        }  

      $othercharges_ttl = 0;
        if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

                $html .= '<tr>
                  <td style="text-align:right">'.value_by_id('tblotherchargemaster',$value['category_name'],'category_name').'</td>
                  <td style="text-align:right">'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';             

           }

           if($purchase->other_charges_tax == 2){

                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                  if(!empty($tax_type == 1)){
                   $single_other_tax_amt = ($othercharges_ttl*9/100);

                  $html .= '<tr>
                              <td style="text-align:right">CGST @ 9%</td>
                              <td style="text-align:right">'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                            
                   $html .= '<tr>
                              <td style="text-align:right">SGST @ 9%</td>
                              <td style="text-align:right">'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                }else{
                   $html .= '<tr>
                              <td style="text-align:right">IGST @ 18%</td>
                              <td style="text-align:right">'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                            </tr>';   
                }    
           }

       }      
      
      $final_amount = ($total_price - $discount);  
  
  
  
  $html .= '<tr>
        <td style="text-align:right">GRAND TOTAL</td>
        <td style="text-align:right">'.number_format(round($final_amount), 2, '.', '').'</td>
        </tr>'; 

    
      
    $html .= '</table>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="text-align:right"><b>Amount In Words :</b></td>
            <td style="text-align:right"><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr></table>';
      
    

  if(!empty($purchase->specification)){
    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>    
    <div class="termsList">'.$purchase->specification.'</div>';
  }
  
  
    $html .= '<div class="notice">TERMS AND CONDITIONS : </div>';
    
    if(!empty($purchase->product_terms_and_conditions)){
        $html .= '<h4><u>Product Terms and Conditions:</u></h4><div class="termsList">'.$purchase->product_terms_and_conditions.'</div>';
    }

    $html .= '<h4><u>General Terms and Conditions:</u></h4><div class="termsList">'.$purchase->terms_and_conditions.'</div>
    
   
          
  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>
    
<table border="0" cellspacing="0" cellpadding="0">
        
        <tr>
                <td class="desc text-center" style="width:50%">
            
            <br>
            <h4>For '.$vendor_info['name'].'</h4>
            <br>
            <h4>Acceptance<br/> Date:</h4>
          </td>
           <td class="desc text-center" style="width:50%">
            
            <br>
            <h4>For '.$company_info['company_name'].'</h4>
            <br>
            <h4>Authorised Signatory</h4>
          </td>
              </tr>
          
          <!--<tr>
          <td class="desc text-center" colspan="2"><b>We Assure you the best services from SCHACH Engg. Thanks</b></td>
          </tr>-->
        
      </table>';
if($purchase->status == 1){
      $approve_info = get_po_approvers($purchase->id);
    $html .= '<div class="notice">Approved By: </div>
    
    <table border="0" cellspacing="0" cellpadding="0" >
        <thead>
          <tr>
            <th class="" style="font-size:10px;font-weight:600;">Approver</th>
            <th class="" style="font-size:10px;font-weight:600;">Approval Remark</th>
            <th class="" style="font-size:10px;font-weight:600;">Date/Time</th>
          </tr>
        </thead>
        <tbody class="main-table">';
        foreach ($approve_info as $ar) {
          $html .= '<tr>
            <td class="desc">'.get_employee_name($ar->staff_id).'</td>
            <td class="desc">'.$ar->remark.'</td>
            <td class="desc">'._d($ar->updated_at).'</td>
           </tr>';
        }
      $html .= '</tbody>
        </table>';         
      }

$html .=  '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center;">
              <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
  </body></html>';

  return $html;
}


function location_pdf($from_date,$to_date,$staff_id){
  $CI =& get_instance();

  $location = get_employee_locations($from_date,$to_date,$staff_id);

  $company_info = get_company_details(); 	
	
  $html = '<html><title>LIVE LOCATION</title><head><style type="text/css">@page{margin:5px auto}@font-face{font-family:SourceSansPro;src:url(SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family:Arial,sans-serif;font-size:14px;font-family:SourceSansPro}table{width:100%}table th, table td{padding:3px 20px;font-size:13px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.2em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:14px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:14px;font-weight:600}.desc p{font-size:13px;margin-bottom:0;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:15px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:10px;font-size:18px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:15px}.note{text-align:center;background:#df2c2c;color:#fff;margin:15px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  /*<h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>*/
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove">
	  <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        


      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove">
         <h2 class="name">Employee Live Location</h2>
        <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Name :</b></td>
            <td>'.get_employee_name($staff_id).'</td>
          </tr>
          
          <tr>
            <td><b>Date :</b></td>
            <td>'.$from_date.' To '.$to_date.'</td>
          </tr>';

  $html .= '</table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--Table Area-->
  
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="1%" class="no">NO.</th>
            <th width="25%" class="no">Title</th>
            <th  class="no">Location Name</th>
			      <th width="23%" class="no">Date</th>
          </tr>
        </thead>
        <tbody class="main-table">';
		      
    $ttl_value = 0; 
	
    if(!empty($location)){
     foreach ($location as $key => $value) {
        
          $title = (!empty($value->title)) ? $value->title : '--' ;

            $html .= '<tr>
            <td class="desc">'.++$key.'</td>
            <td class="desc">'.$title.'</td>
            <td class="desc">'.$value->location.'</td>
            <td class="desc">'._d($value->updated_at).'</td>
           </tr>';

        }
    }    
      
    
    $html .= '</tbody>
      </table>  
    
   
   
  </body></html>';

  return $html;
}


function requirement_pdf($item_list,$warehouse,$service_type){
  $CI =& get_instance();

  $profor='Requirement';

  
  $company_info = get_company_details(); 
  $billing_info = get_branch_details(1);  

  $html = '<html><title>Requirement</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 15px;font-size:10px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';

    /*
  <h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>
    */
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%;">
    <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">        <h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$billing_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%;">
         <h2 class="name">'.$profor.'</h2>
        <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Warehouse :</b></td>
            <td>'.$warehouse.'</td>
          </tr>
          <tr>
            <td><b>Service Type :</b></td>
            <td>'.$service_type.'</td>
          </tr>          
          <tr>
            <td><b>Date :</b></td>
            <td>'.date('Y-m-d').'</td>
          </tr>';


  $html .= '</table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="7%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="40%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;text-align:center;">AVAILABLE QTY</th>';
      
        
    $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">REQUIRED QTY</th>
          </tr>
        </thead>
        <tbody class="main-table">';
          
   
    if(!empty($item_list)){

     foreach ($item_list as $key => $value) {

            $required_qty = ($value->req_qty - $value->avail_qty);
            
            if($required_qty > 0){

              $html .= '<tr>
              <td class="desc">'.++$key.'</td>
              <td class="desc"><h3>'.value_by_id('tblproducts',$value->pro_id,'sub_name').'</h3></td>';

        
              $html .= '<td class="desc" style="text-align:center;">'.$value->avail_qty.'</td>
              <td class="desc text-right">'.number_format(round($required_qty), 2, '.', '').'</td>'; 

              $html .=  '</tr>';

            }
            

        }


    }    
      
    
    $html .= '</tbody>
      </table>';

      

    
   $html .= '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
         <tr>
           <td class="desc" style="text-align:center;">
            <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
          </td>
        </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
  
  </body></html>';

  return $html;
}


function debit_note_pdf($debit_info){
  $CI =& get_instance();

  $number = $debit_info->number;
  $company_info = get_company_details();  
  $to_info = get_debitnote_to_array($debit_info->clientid);
  $shipto_info = get_ship_to_array($debit_info->site_id);
  $person_info = debitnote_contact_person($debit_info->id);
  //$tax_type = get_client_gst_type($debit_info->clientid);
  $tax_type = $debit_info->tax_type;

  $billing_info = get_branch_details($debit_info->branch_id);
  $discount_percent = $debit_info->finaldiscountpercentage;
  $profor='Debit Note';

  //Getting the item list
  $po_items = get_debitnote_items_list($debit_info->id);
  $othercharges= $CI->db->query("SELECT * FROM `tbldebitnoteothercharges` where `proposalid`='".$debit_info->id."' and category_name > 0 ")->result_array(); 


  
  
  $html = '<html><title>DEBIT NOTE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  /*<h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>*/

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%">
         <h2 class="name">'.$profor.'</h2>';

  
  if($debit_info->debit_note_for == 1){
    $head_for = 'Ref Delivery';
    
  }elseif($debit_info->debit_note_for == 2){  
    $head_for = 'Ref Pickup';
    
  }elseif($debit_info->debit_note_for == 3){ 
    $head_for = 'Ref Overtime';
    
  }

  if($debit_info->challan_id > 0){
    $challan_number = value_by_id('tblchalanmst',$debit_info->challan_id,'chalanno');
  }else{  
    $challan_number = $debit_info->challan_number;
  } 

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Debit No :</b></td>
            <td> '.$number.'</td>
          </tr>
          
          <tr>
            <td><b>Date :</b></td>
            <td>'. _d($debit_info->dabit_note_date).'</td>
          </tr> 
        

        </table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no"><b>Debit To</b></th>
            <th class="no"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_info['address'].', '.$to_info['city'].', '.$to_info['state'].'</p>';
        if(!empty($to_info['gst'])){
           $html .= '<p><b>GSTIN :</b> '.$to_info['gst'].'</p>';
        }
        if(!empty($to_info['email'])){
          $html .= '<p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>';
        }
        if(!empty($to_info['phone'])){
          $html .= '<p><b>Phone :</b> '.$to_info['phone'].'</p>';
        }
        $html .= '<p><b>'.$head_for.'</b> - '._d($debit_info->delivery_pickup_date).' , <b>Ref Challan</b> :'.$challan_number;

        if(!empty($person_info['office_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['office_name'].', '.$person_info['office_number'].'</p>';
        }
       $html .= '</td>';
        


    $html .= '<td class="desc">
        <h3>'.$shipto_info['name'].'</h3>
        <p>'.$shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state'].'</p>
        <p><b>Landmark :</b> '.$shipto_info['landmark'].'</p>
        <p><b>Zip :</b> '.$shipto_info['zip'].'</p>';

    if(!empty($person_info['site_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['site_name'].', '.$person_info['site_number'].'</p>';
        }    

    $html .= '</td>';


     $html .= '</tr>
        </tbody>
    </table>';

  
  if($debit_info->qty_hours == 1){
    $qty_hours = 'Quantity';
  }else{
    $qty_hours = 'Hours';
  } 

  if($debit_info->debit_note_type == '1'){
      $html .= '  
           <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th width="5%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
              <th width="20%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
              <th class="no" style="font-size:10px;font-weight:600;">Status</th>
              <th class="no" style="font-size:10px;font-weight:600;">'.$qty_hours.'</th>
              <th class="no" style="font-size:10px;font-weight:600;">HSN</th>            
              <th class="no text-right" style="font-size:10px;font-weight:600;">RATE/UNIT</th>';

              if(!empty($tax_type == 1)){
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
              }else{
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
              }


              $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">AMOUNT</th>
            </tr>
          </thead>
          <tbody class="main-table">';

                
            
      $ttl_value = 0; 
      $ttl_rate = 0; 
    
      if(!empty($po_items)){
       $total_price = 0;
       foreach ($po_items as $key => $value) {
          
        if($value['other'] == 0){
          $qty = $value['qty'];
          $rate = $value['price'];
          $price = ($rate * $qty);
         // $total_price += $price;

          //Applying TAX after discount
          $tax_amt = ($price*$value['prodtax']/100);
          $final_price = ($price+$tax_amt);

          $total_price += $final_price;

          $ttl_rate += ($rate*$qty);
              
          $html .= '<tr>
          <td class="desc">'.++$key.'</td>
          <td class="desc"><h3>'.value_by_id('tblproducts',$value['product_id'],'sub_name').'</h3>'.get_productfields_list('tbldebitnoteproductfields',$debit_info->id,$value['product_id']).'</td>
          <td class="desc"><p>'.$value['status'].'</p></td>
          <td class="desc" style="text-align:center;">'.$qty.'</td>
          <td class="desc">'.get_hsn_code($value['product_id']).'</td>';
    
          $html .=  '<td class="desc text-right">'.$value['price'].'</td>';

          if(!empty($tax_type == 1)){
              $tax = ($value['prodtax']/2);
              $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
              $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
           }else{                
              $html .=  ' <td class="desc text-center">'.$value['prodtax'].'%</td>';
           }

          $html .=  '<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
          </tr>';
        }else{
          $qty = $value['qty'];
          $rate = $value['price'];
          $price = ($rate * $qty);
          //$total_price += $price;

          //Applying TAX after discount
          $tax_amt = ($price*$value['prodtax']/100);
          $final_price = ($price+$tax_amt);

          $total_price += $final_price;
          $ttl_rate += ($rate*$qty);
              
          $html .= '<tr>
          <td class="desc">'.++$key.'</td>
          <td class="desc"><h3>'.value_by_id('tblproducts',$value['product_id'],'sub_name').'</h3>'.get_productfields_list('tbldebitnoteproductfields',$debit_info->id,$value['product_id']).'</td>
          <td class="desc"><p>'.$value['status'].'</p></td>
          <td class="desc" style="text-align:center;">--</td>
          <td class="desc">--</td>';
    
          $html .=  '<td class="desc text-right">--</td>';

          if(!empty($tax_type == 1)){
              $tax = ($value['prodtax']/2);
              $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
              $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
           }else{                
              $html .=  ' <td class="desc text-center">'.$value['prodtax'].'%</td>';
           }

          $html .=  '<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
          </tr>';
        }
         

          }

      }    
       $subColSpan = 2;
      if(!empty($tax_type == 1)){
        $subColSpan += 1;
      }
      $html .='<tr>
          <td  colspan="5"><b>SUBTOTAL</b></td>
          <td>'.number_format(round($ttl_rate), 2, '.', '').'</td>
          <td  colspan="'.$subColSpan.'"><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
        </tr>';  
      
      $html .= '</tbody>
        </table>';
  }else{
    $html .= '  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;">SAC Code</th>
			<th class="no" style="font-size:10px;font-weight:600;">RATE</th>';

            if(!empty($tax_type == 1)){
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
              }else{
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
              }

        $html .='<th class="no text-right" style="font-size:10px;font-weight:600;">TOTAL AMOUNT</th>
          </tr>
        </thead>
        <tbody class="main-table">';
          
    $ttl_value = 0; 
  
    if(!empty($po_items)){
     $total_price = 0;
     foreach ($po_items as $key => $value) {
        
        $price = $value['price'];
        //$total_price += $price;
        //Applying TAX after discount
        $tax_amt = ($price*$value['prodtax']/100);
        $final_price = ($price+$tax_amt);

        $total_price += $final_price;
            
        $html .= '<tr>
        <td class="desc">'.++$key.'</td>
        <td class="desc"><p>'.$value['product_name'].'</p></td>
        <td class="desc"><p>'.$value['hsn_code'].'</p></td>
        <td class="desc"><p>'.$value['price'].'</p></td>';
       
        if(!empty($tax_type == 1)){
            $tax = ($value['prodtax']/2);
            $html .= '<td class="desc text-center">'.$tax.'%</td>';
            $html .= '<td class="desc text-center">'.$tax.'%</td>';
         }else{                
            $html .= '<td class="desc text-center">'.$value['prodtax'].'%</td>';
         }        

        $html .= '<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
        </tr>';
             

        }

    }   

    $subColSpan = 5;
      if(!empty($tax_type == 1)){
        $subColSpan += 1;
      }
      $html .='<tr>
            <td colspan="'.$subColSpan.'"><b>SUBTOTAL</b></td>
            <td><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
          </tr>';         
    
    $html .= '</tbody>
      </table>';
  }
  



    
    $html .= '<table border="0" cellspacing="0" cellpadding="0">';
  
      $discount = 0;
      if(!empty($discount_percent > 0)){
         $discount = ($total_price*$discount_percent/100);
              
        $html .= '<tr>
            <td>Discount @ '.number_format($discount_percent).'%</td>
            <td>-'.number_format(round($discount), 2, '.', '').'</td>
          </tr>';    

        }  

        $othercharges_ttl = 0;
        if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

                $html .= '<tr>
                  <td>'.value_by_id('tblotherchargemaster',$value['category_name'],'category_name').'</td>
                  <td>'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';             

           }

           if($debit_info->other_charges_tax == 2){

                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                  if(!empty($tax_type == 1)){
                   $single_other_tax_amt = ($othercharges_ttl*9/100);

                  $html .= '<tr>
                              <td>CGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                            
                   $html .= '<tr>
                              <td>SGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                }else{
                   $html .= '<tr>
                              <td>IGST @ 18%</td>
                              <td>'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                            </tr>';   
                }    
           }

      }      
      
      $final_amount = ($total_price - $discount);   
  
  $html .= '<tr>
        <td>GRAND TOTAL</td>
        <td>'.number_format(round($final_amount), 2, '.', '').'</td>
        </tr>'; 

    
      
    $html .= '</table>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><b>Amount In Words :</b></td>
            <td><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr></table>';
      
    

  if(!empty($debit_info->note)){
    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>    
    <div class="termsList">'.$debit_info->note.'</div>';
  }
  
  
    $html .= '<div class="notice">TERMS AND CONDITIONS : </div>
    
    <div class="termsList">'.$debit_info->terms_and_conditions.'</div>
    <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> Schach Engineers Pvt Ltd<br> Union Bank of India<br> A/c No - 582305010000140<br> IFSC Code-UBIN0558231<br> Branch - Borivali East</p>
          
  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>
    
 
  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
         <tr>
           <td class="desc" style="text-align:center;">
            <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
          </td>
        </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
   
      
  </body></html>';

  return $html;
}


function debit_notepayment_pdf($debit_info){
  $CI =& get_instance();

  $number = $debit_info->number;
  $company_info = get_company_details();  
  $to_info = get_debitnote_to_array($debit_info->clientid); 
  $person_info = debitnote_contact_person($debit_info->id);
  //$tax_type = get_client_gst_type($debit_info->clientid);
  $tax_type = $debit_info->tax_type;
  $invoicedata_info = $CI->db->query("SELECT * FROM tbldebitnotepaymentitems where debitnote_id = '".$debit_info->id."' and status = 1 ")->result();  
  $billing_info = get_branch_details($debit_info->branch_id);
  
  $profor='Debit Note';


  
  
  $html = '<html><title>DEBIT NOTE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  /*<h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>*/

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%">
         <h2 class="name">'.$profor.'</h2>';

  

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Debit No :</b></td>
            <td> '.$number.'</td>
          </tr>
          
          <tr>
            <td><b>Date :</b></td>
            <td>'. _d($debit_info->date).'</td>
          </tr> 

        </table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no"><b>Debit To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_info['address'].', '.$to_info['city'].', '.$to_info['state'].'</p>';
        if(!empty($to_info['gst'])){
           $html .= '<p><b>GSTIN :</b> '.$to_info['gst'].'</p>';
        }
        if(!empty($to_info['email'])){
          $html .= '<p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>';
        }
        if(!empty($to_info['phone'])){
          $html .= '<p><b>Phone :</b> '.$to_info['phone'].'</p>';
        }
        $html .= '<p><b>Ref :</b> Delay In Payment</p>';
        if(!empty($person_info['office_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['office_name'].', '.$person_info['office_number'].'</p>';
        }
       $html .= '</td>';
        


     $html .= '</tr>
        </tbody>
    </table>';

  

  $html .= '<!--shipping Area End-->
  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th class="no" style="font-size:10px;font-weight:600;">DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;">SAC Code</th>            
            <th class="no text-right" style="font-size:10px;font-weight:600;">Invoice Amount</th>
            <th class="no text-right" style="font-size:10px;font-weight:600;">Delay In Days</th>
            <th class="no text-right" style="font-size:10px;font-weight:600;">AMOUNT (INR)</th>
          </tr>
        </thead>
        <tbody class="main-table">';

    $ttl_amount = 0;  
    $ttl_finalamount = 0;  
    if(!empty($invoicedata_info)){
      foreach ($invoicedata_info as $key => $value) {
        $ttl_amount += $value->amount;  
        //$ttl_finalamount += $value->final_amount;

        if($value->type == 1){
          $number =  value_by_id('tblinvoices',$value->invoice_id,'number');
        }else{
          $number =  value_by_id('tbldebitnote',$value->invoice_id,'number');
        } 
         

        $html .= '<tr>
        <td class="desc">'.++$key.'</td>
        <td class="desc"><h3>Invoice No: '.$number.'</h3><h3>Due Date:'._d($value->due_date).'</h3></td>
        <td class="desc" style="text-align:center;">'.$debit_info->sac_code.'</td>
        <td class="desc" style="text-align:right;">'.$value->invoice_amount.'</td>
        <td class="desc" style="text-align:right;">'.$value->delay_days.'</td>
        <td class="desc" style="text-align:right;">'.$value->amount.'</td>';
        $html .=  '</tr>';    
      }
    }    
          
    
      
    
    $html .= '</tbody>
      </table>
    
    <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>SUBTOTAL</td>
            <td>'.number_format(round($ttl_amount), 2, '.', '').'</td>
          </tr>';
  

    
    $tax_amount = ($ttl_amount*18/100);
    $ttl_finalamount = ($tax_amount+$ttl_amount);
    if(!empty($tax_type == 1)){
      $tax = ($tax_amount/2);
      $html .= '<tr>
          <td>CGST @ 9%</td>
          <td>'.number_format($tax, 2, '.', '').'</td>
        </tr>';
        $html .= '<tr>
          <td>SGST @ 9%</td>
          <td>'.number_format($tax, 2, '.', '').'</td>
        </tr>';
    }else{
      $html .= '<tr>
          <td>IGST @ 18%</td>
          <td>'.number_format($tax_amount, 2, '.', '').'</td>
        </tr>';
    }

          


  
  
  $html .= '<tr>
        <td>GRAND TOTAL</td>
        <td>'.number_format(round($ttl_finalamount), 2, '.', '').'</td>
        </tr>'; 

    
      
    $html .= '</table>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><b>Amount In Words :</b></td>
            <td><b>'.convert_number_to_words(round($ttl_finalamount)).'</b></td>
          </tr></table>';
      
    

  if(!empty($debit_info->note)){
    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>    
    <div class="termsList">'.$debit_info->note.'</div>';
  }
  
  
    $html .= '<div class="notice">TERMS AND CONDITIONS : </div>
    
    <div class="termsList">'.$debit_info->terms_and_conditions.'</div>
    <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> Schach Engineers Pvt Ltd<br> Union Bank of India<br> A/c No - 582305010000140<br> IFSC Code-UBIN0558231<br> Branch - Borivali East</p>
          
  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>
    
 
  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
         <tr>
           <td class="desc" style="text-align:center;">
            <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
          </td>
        </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
   
      
  </body></html>';

  return $html;
}


function purchase_invoice_pdf($invoice_info){
  $CI =& get_instance();

  $number = $invoice_info->reference_number;
  $company_info = get_company_details();  
  $to_info = get_vendor_info($invoice_info->vendor_id); 
  $purchase_items = $CI->db->query("SELECT * FROM tblpurchaseinvoiceproduct where invoice_id = '".$invoice_info->id."' ")->result_array();  


  $tax_type = get_vendor_gst_type($invoice_info->vendor_id);


  $discount_percent = $invoice_info->finaldiscountpercentage;

  $othercharges= $CI->db->query("SELECT * FROM `tblpurchaseinvoiceothercharges` where `proposalid`='".$invoice_info->id."' and category_name > 0 ")->result_array(); 

  $profor='Purchase Invoice';


  
  
  $html = '<html><title>Purchase Invoice</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  /*<h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>*/

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%">
         <h2 class="name">'.$profor.'</h2>';

  
  $invoice_for = ($invoice_info->invoice_for == 1) ? 'Purchase Order' : 'Work Order';

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Reference No :</b></td>
            <td> '.$number.'</td>
          </tr>
          
          <tr>
            <td><b>Date :</b></td>
            <td>'. _d($invoice_info->date).'</td>
          </tr>
          <tr>
            <td><b>Invoice For :</b></td>
            <td>'.$invoice_for.'</td>
          </tr> 

        </table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no"><b>Invoice From</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_info['address'].'<br/> '.$to_info['city'].', '.$to_info['state'].'</p>';
        if(!empty($to_info['gst'])){
           $html .= '<p><b>GSTIN :</b> '.$to_info['gst'].'</p>';
        }
        if(!empty($to_info['email'])){
          $html .= '<p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>';
        }
        if(!empty($to_info['phone'])){
          $html .= '<p><b>Phone :</b> '.$to_info['phone'].'</p>';
        }
        if(!empty($person_info['office_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['office_name'].', '.$person_info['office_number'].'</p>';
        }
       $html .= '</td>';
        


     $html .= '</tr>
        </tbody>
    </table>';

  

  $html .= '<!--shipping Area End-->
  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="7%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="30%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th width="10%" class="no" style="font-size:10px;font-weight:600;">Quantity</th>      
            <th class="no text-right" style="font-size:10px;font-weight:600;">RATE/UNIT</th>';
        if(!empty($tax_type == 1)){
            $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
            $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
          }else{
            $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
          }  

          $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>
          <th class="no text-right" style="font-size:10px;font-weight:600;">TOTAL AMOUNT</th>
          </tr>
        </thead>
        <tbody class="main-table">';
          
    $ttl_value = 0; 
  
    if(!empty($purchase_items)){
     $total_price = 0;
     foreach ($purchase_items as $key => $value) {
        
        $prodtax = $value['prodtax'];
        $qty = $value['qty'];
        $rate = $value['price'];
        $price = ($rate * $qty);
        //$total_price += $price;

        $tax_amt = ($price*$prodtax/100);

        $final_price = ($price+$tax_amt);
        $total_price += $final_price;
            
        $html .= '<tr>
        <td class="desc">'.++$key.'</td>
        <td class="desc"><h3>'.value_by_id('tblproducts',$value['product_id'],'sub_name').'</h3></td>
        <td class="desc" style="text-align:center;">'.$qty.'</td>';
  
        $html .=  '<td class="desc text-right">'.$value['price'].'</td>';

        if(!empty($tax_type == 1)){
            $tax = ($prodtax/2);
            $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
            $html .=  ' <td class="desc text-center">'.$tax.'%</td>';
         }else{                
            $html .=  ' <td class="desc text-center">'.$prodtax.'%</td>';
         }

         $html .=  '<td class="desc text-right">'.number_format(round($tax_amt), 2, '.', '').'</td>';

        $html .=  '<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
        </tr>';

        }

    }     
          
    
  $html .= '</tbody>
      </table>
    
    <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>SUBTOTAL</td>
            <td>'.number_format(round($total_price), 2, '.', '').'</td>
          </tr>';
  
      $discount = 0;
      if(!empty($discount_percent > 0)){
         $discount = ($total_price*$discount_percent/100);
              
        $html .= '<tr>
            <td>Discount @ '.number_format(round($discount_percent)).'%</td>
            <td>-'.number_format(round($discount), 2, '.', '').'</td>
          </tr>';    

        }  


          $final_amount = ($total_price - $discount);

   // For Excluding Other Charges Tax
     /* if($invoice_info->other_charges_tax == 2){
            if(!empty($othercharges)){
            foreach ($othercharges as $key => $value) {

              $total_price += $value['total_maount'];

                $html .= '<tr>
                  <td>'.value_by_id('tblotherchargemaster',$value['category_name'],'category_name').'</td>
                  <td>'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';             

           }
         }

      }*/
    
    
    /*$afr_dis_price = ($total_price - $discount);

        
        $final_discount_price = ($afr_dis_price*18/100);

          $final_amount = ($final_discount_price + $total_price - $discount);*/


          /*if(!empty($tax_type == 1)){
             $final_dis_price = ($afr_dis_price*9/100);

            $html .= '<tr>
                        <td>CGST @ 9%</td>
                        <td>'.number_format(round($final_dis_price), 2, '.', '').'</td>
                      </tr>';  
                      
             $html .= '<tr>
                        <td>SGST @ 9%</td>
                        <td>'.number_format(round($final_dis_price), 2, '.', '').'</td>
                      </tr>';           

          }else{
             $final_dis_price = ($afr_dis_price*18/100);

             $html .= '<tr>
                        <td>IGST @ 18%</td>
                        <td>'.number_format(round($final_dis_price), 2, '.', '').'</td>
                      </tr>';   
          } */

         



    /*if($invoice_info->other_charges_tax == 1){
       if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {

            $final_amount += $value['total_maount'];


            $html .= '<tr>
                    <td>'.value_by_id('tblotherchargemaster',$value['category_name'],'category_name').'</td>
                    <td>'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                  </tr>';             
         }
       }  
    }*/  
  
  
  
  $html .= '<tr>
        <td>GRAND TOTAL</td>
        <td>'.number_format(round($final_amount), 2, '.', '').'</td>
        </tr>'; 

    
      
    $html .= '</table>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><b>Amount In Words :</b></td>
            <td><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr></table>';
      
    

  if(!empty($invoice_info->note)){
    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>    
    <div class="termsList">'.$invoice_info->note.'</div>';
  }
  
  
    $html .= '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
         <tr>
           <td class="desc" style="text-align:center;">
            <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
          </td>
        </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
   
      
  </body></html>';

  return $html;
}

function product_sales_pdf($item_list,$year_id,$service_type){
  $CI =& get_instance();

  $profor='Product Sales Report';

  
  $company_info = get_company_details(); 
  $billing_info = get_branch_details(1);  

  $html = '<html><title>Requirement</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';

   if($service_type == 1){
        $service_type_name = 'Rent';
    }elseif($service_type == 2){
        $service_type_name = 'Sale';
    }else{
        $service_type_name = 'Rent & Sale';
    }

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:60%;">
    <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$billing_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:40%;">
         <h2 class="name">'.$profor.'</h2>
        <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Financial Year :</b></td>
            <td>'.value_by_id('tblfinancialyear',$year_id,'name').'</td>
          </tr>
          <tr>
            <td><b>Service Type :</b></td>
            <td>'.$service_type_name.'</td>
          </tr>          
          <tr>
            <td><b>Date :</b></td>
            <td>'.date('Y-m-d').'</td>
          </tr>';


  $html .= '</table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="7%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="40%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;text-align:right;">SALES QTY</th>
          </tr>
        </thead>
        <tbody class="main-table">';
      
   
    if(!empty($item_list)){
      $i = 1;
     foreach ($item_list as $value) {

            $sale_qty = get_product_sales_quantity($year_id,$service_type,$value->id);
            
            if($sale_qty > 0){

              $html .= '<tr>
              <td class="desc">'.$i.'</td>
              <td class="desc"><h3>'.$value->sub_name.'</h3></td>';
        
              $html .= '<td class="desc text-right">'.number_format(round($sale_qty), 2, '.', '').'</td>'; 

              $html .=  '</tr>';
              $i++;

            }
            

        }


    }    
      
    
    $html .= '</tbody>
      </table>';

      

    
   $html .= '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
         <tr>
           <td class="desc" style="text-align:center;">
            <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
          </td>
        </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
  
  </body></html>';

  return $html;
}


function creditnote_pdf($debit_info){
  $CI =& get_instance();

  $number = $debit_info->number;
  $company_info = get_company_details();  
  $to_info = get_debitnote_to_array($debit_info->clientid);
  $shipto_info = get_ship_to_array($debit_info->site_id);
  $person_info = creditnote_contact_person($debit_info->id);
  //$tax_type = get_client_gst_type($debit_info->clientid);
  $tax_type = $debit_info->tax_type;


  $discount_percent = $debit_info->finaldiscountpercentage;
  $profor='Credit Note';

  //Getting the item list
  $po_items = get_creditnote_items_list($debit_info->id);
  $othercharges= $CI->db->query("SELECT * FROM `tblcreditnoteothercharges` where `proposalid`='".$debit_info->id."' and category_name > 0 ")->result_array(); 

  $show_days = 0;
  if(!empty($po_items)){
      foreach ($po_items as $item) {
          if($item['days'] > 1){
              $show_days = 1;
          }
      }
  }


  
  
  $html = '<html><title>CREDIT NOTE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  /*<h3 style="margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
        <p><b>CIN Number :</b>U51101UP2015PTC068937</p>*/

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>GST Number :</b> '.$company_info['gst'].'</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%">
         <h2 class="name">'.$profor.'</h2>';

  

  $invoice_number = $debit_info->invoice_numbers; 

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Credit No :</b></td>
            <td> '.$number.'</td>
          </tr>
          
          <tr>
            <td><b>Date :</b></td>
            <td>'. _d($debit_info->date).'</td>
          </tr> 
        

        </table>
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no"><b>Credit To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_info['address'].', '.$to_info['city'].', '.$to_info['state'].'</p>';
        if(!empty($to_info['gst'])){
           $html .= '<p><b>GSTIN :</b> '.$to_info['gst'].'</p>';
        }
        if(!empty($to_info['email'])){
          $html .= '<p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>';
        }
        if(!empty($to_info['phone'])){
          $html .= '<p><b>Phone :</b> '.$to_info['phone'].'</p>';
        }
        $html .= '<p> <b>Invoice Number</b> :'.$invoice_number;

        if(!empty($person_info['office_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['office_name'].', '.$person_info['office_number'].'</p>';
        }
       $html .= '</td>';
        


    /*$html .= '<td class="desc">
        <h3>'.$shipto_info['name'].'</h3>
        <p>'.$shipto_info['address'].', '.$shipto_info['state'].', '.$shipto_info['city'].'</p>
        <p><b>Landmark :</b> '.$shipto_info['landmark'].'</p>
        <p><b>Zip :</b> '.$shipto_info['zip'].'</p>';*/

    /*if(!empty($person_info['site_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['site_name'].', '.$person_info['site_number'].'</p>';
        }    

    $html .= '</td>';*/


     $html .= '</tr>
        </tbody>
    </table>';

  
  if($debit_info->qty_hours == 1){
    $qty_hours = 'Quantity';
  }else{
    $qty_hours = 'Hours';
  } 

  if($debit_info->sac_hsn == 1){
    $sac_hsn = 'SAC';
  }else{
    $sac_hsn = 'HSN';
  } 

  $html .= '  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no" width="5%" style="font-size:10px;font-weight:600;">NO.</th>
            <th class="no" width="28%" style="font-size:10px;font-weight:600;">ITEM Details</th>
            <th class="no" style="font-size:10px;font-weight:600;">'.$sac_hsn.'</th>            
            <th class="no" width="7%" style="font-size:10px;font-weight:600;">'.$qty_hours.'</th>';
            if($show_days == 1){
               $html .= '<th width="5%" class="no" style="font-size:10px;font-weight:600;">Days</th>';
            }
            
            $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">Rate</th>';

            if(!empty($tax_type == 1)){
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
              }else{
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
              }

        $html .='<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>
                  <th class="no text-right" style="font-size:10px;font-weight:600;">TOTAL</th>
          </tr>
        </thead>
        <tbody class="main-table">';
          
    $ttl_value = 0; 
    $ttl_rate = 0;
    $ttl_taxamt = 0; 
  
    if(!empty($po_items)){
     $total_price = 0;
     foreach ($po_items as $key => $value) {
        
        $price = ($value['price']*$value['qty']*$value['days']);
        //$total_price += $price;
        //Applying TAX after discount
        $tax_amt = ($price*$value['prodtax']/100);
        $final_price = ($price+$tax_amt);

        $ttl_rate += $price;
        $ttl_taxamt += $tax_amt;

        $total_price += $final_price;
            
        $html .= '<tr>
        <td class="desc">'.++$key.'</td>
        <td class="desc"><p>'.$value['product_name'].'</p></td>
        <td class="desc"><p>'.$value['hsn_code'].'</p></td>
        
        <td class="desc"><p>'.$value['qty'].'</p></td>';

        if($show_days == 1){
           $html .= '<td class="desc"><p>'.$value['days'].'</p></td>';
        }       
        $html .= '<td class="desc text-right"><p>'.$value['price'].'</p></td>';
       
        if(!empty($tax_type == 1)){
            $tax = ($value['prodtax']/2);
            $html .= '<td class="desc text-center">'.$tax.'%</td>';
            $html .= '<td class="desc text-center">'.$tax.'%</td>';
         }else{                
            $html .= '<td class="desc text-center">'.$value['prodtax'].'%</td>';
         }        

        $html .=  '<td class="desc text-right">'.number_format(round($tax_amt), 2, '.', '').'</td>';
        $html .= '<td class="desc text-right">'.number_format(round($final_price), 2, '.', '').'</td>
        </tr>';
             

        }

    } 


     $mainColSpan = 4;
     $subColSpan = 2;
     if($show_days == 1){
        $mainColSpan += 1;
     }
      if(!empty($tax_type == 1)){
        $subColSpan += 1;
      }

      $html .='<tr>
          <td  colspan="'.$mainColSpan.'"><b>SUBTOTAL</b></td>
          <td>'.number_format(round($ttl_rate), 2, '.', '').'</td>
          <td colspan="'.$subColSpan.'"><b>'.number_format(round($ttl_taxamt), 2, '.', '').'</b></td>
          <td ><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
        </tr>';          
    
    $html .= '</tbody>
      </table>';
  



    
    $html .= '<table border="0" cellspacing="0" cellpadding="0">';
  
      $discount = 0;
      if(!empty($discount_percent > 0)){
         $discount = ($total_price*$discount_percent/100);
              
        $html .= '<tr>
            <td>Discount @ '.number_format($discount_percent).'%</td>
            <td>-'.number_format(round($discount), 2, '.', '').'</td>
          </tr>';    

        }  

        $othercharges_ttl = 0;
        if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

                $html .= '<tr>
                  <td>'.value_by_id('tblotherchargemaster',$value['category_name'],'category_name').'</td>
                  <td>'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';             

           }

           if($debit_info->other_charges_tax == 2){

                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                  if(!empty($tax_type == 1)){
                   $single_other_tax_amt = ($othercharges_ttl*9/100);

                  $html .= '<tr>
                              <td>CGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                            
                   $html .= '<tr>
                              <td>SGST @ 9%</td>
                              <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';  
                }else{
                   $html .= '<tr>
                              <td>IGST @ 18%</td>
                              <td>'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                            </tr>';   
                }    
           }

      }      
      
      $final_amount = ($total_price - $discount);   
  
  $html .= '<tr>
        <td>GRAND TOTAL</td>
        <td>'.number_format(round($final_amount), 2, '.', '').'</td>
        </tr>'; 

    
      
    $html .= '</table>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><b>Amount In Words :</b></td>
            <td><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr></table>';
      
    

  if(!empty($debit_info->note)){
    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>    
    <div class="termsList">'.$debit_info->note.'</div>';
  }
  
  
    $html .= '<div class="notice">TERMS AND CONDITIONS : </div>
    
    <div class="termsList">'.$debit_info->terms_and_conditions.'</div>
    <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> Schach Engineers Pvt Ltd<br> Union Bank of India<br> A/c No - 582305010000140<br> IFSC Code-UBIN0558231<br> Branch - Borivali East</p>
          
  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>
    
 
  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
         <tr>
           <td class="desc" style="text-align:center;">
            <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
          </td>
        </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
   
      
  </body></html>';

  return $html;
}

function new_pdf(){
  $html = '<html><title>QUOTATION</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">Quotation For Rent</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <h2>NTurm Engineers Ltd.</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Quote :</b> # 0001/QT-RT/20-21</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Date :</b> # 17/07/2020</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Quote :</b> # 0001/QT-RT/20-21</p>
      </td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
      </td>
    </tr>
  </table>
  <!--Header Section End-->

  
  <!--shipping Area-->
  
  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no" style="text-align:center;"><b>Bill To</b></th>
            <th class="no" style="text-align:center;"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
      <td class="desc" style="background:#fff;border:1px solid #eee; text-align:center;">
        <h3>SMD</h3>
        <p>Madhya Pradesh, Mumbai</p>
        <p><b>Contact Name :</b> Vishal Bhav</p>
        <p style="text-transform:none;"><b>Email :</b> Mustafa.bohra@schachengineers.com</p>
        <p><b>Phone :</b> 8286263372</p>
      </td>
      <td class="desc" style="background:#fff;border:1px solid #eee;text-align:center;">
        <h3>VODAFONE LTD</h3>
        <p>Sarkhej Gandhinagar Highway off, Corporate Road,Prahlad Nagar, Ahmedabad, Gujrat, Gujarat, Ahmedabad</p>
        <p><b>Zip :</b> 380015</p>
      </td>
      </tr>
        </tbody>
    </table>
  
  <!--shipping Area End-->
  
  <!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="4%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="34%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;text-align:center;">QTY</th>
            <th class="no text-right" style="font-size:10px;font-weight:600;text-align:center;">RATE/UNIT</th>
            <th width="8%" class="no" style="font-size:10px;font-weight:600;text-align:center;">DISCOUNT</th>
            <th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>
            <th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>
            <th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>
            <th class="no text-right" style="font-size:10px;font-weight:600;">AMOUNT</th>
          </tr>
        </thead>
        <tbody class="main-table">
        <tr>
            <td class="desc" style="background:#fff; border:1px solid #eee;">1</td>
            <td class="desc" style="background:#fff; border:1px solid #eee;"><h3>Claw Die (6063)</h3><p><b style="color:#000;">HSN Code :</b> 76042100</p></td>
            <td class="desc" style="text-align:center; background:#fff; border:1px solid #eee;">15.00</td>
            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">200000.00</td> 
            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">0%</td> 
            <td class="desc text-center" style="background:#fff; border:1px solid #eee;">9%</td> 
            <td class="desc text-center" style="background:#fff; border:1px solid #eee;">9%</td>
            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">810000.00</td>
            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">5310000.00</td>
        </tr>
        <tr>
            <td class="desc" style="background:#fff; border:1px solid #eee;">2</td>
            <td class="desc" style="background:#fff; border:1px solid #eee;"><h3>VLD1330 - Ladder Step (100*35*2)</h3><p><b style="color:#000;">HSN Code :</b> 76042100</p></td>
            <td class="desc" style="text-align:center;background:#fff; border:1px solid #eee;">10.00</td>
            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">1200.00</td> 
            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">5%</td> 
            <td class="desc text-center" style="background:#fff; border:1px solid #eee;">9%</td> 
            <td class="desc text-center" style="background:#fff; border:1px solid #eee;">9%</td>
            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">2052.00</td>
            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">13452.00</td>
        </tr>
          <tr>
          <td></td>
            <td colspan="2" style="text-align:left;"><b>SUBTOTAL</b></td>
            <td>225000</td>
            <td colspan="4"><b>812025.00</b></td>
            <td><b>5323452.00</b></td>
          </tr>

         <tr>
          <td></td>
            <td style="text-align:left;"><b>Discount @ 10%</b></td>
            <td colspan="7"><b>-532345.00</b></td>
          </tr>

          <tr>
          <td></td>
            <td style="text-align:left;"><b>GRAND TOTAL</b></td>
            <td colspan="7"><b>4791107.00</b></td>
          </tr>

         <tr>
          <td></td>
            <td colspan="1" style="text-align:left;"><b>Amount In Words :</b></td>
            <td colspan="7"><b>Forty Seven Lakhs Ninety One Thousands One Hundred Seven  Rupees Only/-</b></td>
          </tr>

           </tbody>
      </table>

    <div id="notices">

    <div style="background:#eeeeee; padding:8px; margin-top:8px;">NOTICE : Any Damage/Lost of Components shall be charged from "SMD"</div>

      <p style="margin-bottom: 0; margin-top: 5px;">Material Value - 0.00/-</p> <p style="margin-bottom: 0; margin-top: 5px;"><p style="margin-bottom: 0; margin-top: 5px;">The Quotation is for 1 Month and 15 Days.</p></p>
    </div>

    <div class="notice" style="text-align:center;">Terms & conditions</div>
    
    <div class="termsList">01). Payment: 100% advance along with work order.<br>02). Freight (Mob & Demob) will be charged extra at actual.<br>03). The Installation will charge extra at actual.<br>04). Lead Time- 2-3 working days from the date of receipt of confirm order.<br>05). Any other charges other than mentioned if incurred, shall be charged at actual.<br>06). Loading and Unloading of Material at client site will not be in SCHACH scope.<br>07). If there is any Mathadi charges then it will be taken care by the client.<br>08). Material Value cheque (Without Date) will be required before material dispatch.<br>09). If and when the delay in payments occurs, 24% interest will be charged and the debit note will be raised and payable accordingly.<br>10). If there is any damage found in a material at the time of return, we reserve rights to raise a debit note against the same, which shall be<br>completely payable.<br>11). All the terms of SOP will be applicable.</div>
       
   <!--<table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:2px;">
        <tbody>
          <tr>
            <td class="desc" style="text-align:left;">
        <p><b>GSTIN :</b>  27AAVCS4630C1Z7</p>
      </td>
        
       <td class="desc" style="text-align:center;">
        <p><b>MSME :</b> UP28B0011156</p>
      </td>
      
      <td style="text-align:right;"><b>CIN :</b>U51101UP2015PTC068937</td>
          </tr>
        </tbody>
    </table>-->

  
  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:100px;">
        <tbody>
        <tr>
          <td class="desc">
            <h3>Head Office : Mumbai</h3>
            <p>16&18 Nadeem Industrial Estate, Chinchoti, Naigaon (east), Vasai, Palghar - 401201 <br/>Palghar, Maharashtra, IN - 401201</p>
          </td>
          <td class="desc">
            <h3>Registered Office : Noida</h3>
            <p>16&18 Nadeem Industrial Estate, Chinchoti, Naigaon (east), Vasai, Palghar - 401201 <br/>Palghar, Maharashtra, IN - 401201</p>
          </td>
        </tr>

        <tr>
         <td class="desc" style="text-align:center;" colspan="2">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
      <tr>
            <td class="desc" colspan="2" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
             </td>
      </tr>
        </tbody>
    </table>

  </body></html>';
  return $html;
}

function test_pdf(){
  $html = '<!DOCTYPE html>
<html>
<head>
  <title>Print Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
  <style type="text/css">
      @page{margin:15px};
      td p{
        font-size: 11px;
      }
      td{font-size: 11px;}
  </style>
</head>
<body style="font-family: \'Nunito\', sans-serif;">
  <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; margin: auto;">
    <tr>
      <td style="text-align:center;">
        <img src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" class="logo">
        <p style="margin-top: 0; margin-bottom:0px; font-size: 20px; font-family: \'Nunito\', sans-serif; text-decoration: underline; font-weight: 900;">VENDOR REGISTRTION FORM</p>
      </td>
    </tr>
    <tr>
      <td>
        <h3 style="font-family: \'Nunito\', sans-serif; font-size: 16px;font-weight: 900;margin: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Business Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;" colspan="2">
              <p style="margin:0;">Name of Vendor :- <b>Mustafa Bhora Mustafa Bhora</b></p>
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Contact Number :- <b>+91-8959129744</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Email Id :- <b>mustafabhora@gmail.com</b></p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Address Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="border: 1px solid #d7d7d7;">
              <h4 style="margin:0;padding: 5px; text-decoration: underline;">Office Address Details</h4>
              <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                <tr>
                  <td style="padding:2px 5px;" colspan="2">
                    <p style="margin:0;">Office Address :- <b>Tea Board, Regional Office,511/I, Kallolickal Building,Peermade P.O., Idukki, Kerala - 685 531</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">State :- <b>Maharashtra</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">City :- <b>Mumbai</b></p>
                  </td>
                </tr>
              </table>
            </td>
            <td style="border: 1px solid #d7d7d7;">
              <h4 style="margin:0;padding: 5px; text-decoration: underline;">Work Address Details</h4>
              <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                <tr>
                  <td style="padding:2px 5px;" colspan="2">
                    <p style="margin:0;">Office Address :- <b>Tea Board, Regional Office,511/I, Kallolickal Building,Peermade P.O., Idukki, Kerala - 685 531</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">State :- <b>Maharashtra</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">City :- <b>Mumbai</b></p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Email</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Number</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Designation</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">Kapil Patidar Kapil Patidar</td>
              <td style="padding: 5px; border: 1px solid #ccc;">kapilpatidarsing@gmail.com</td>
              <td style="padding: 5px; border: 1px solid #ccc;">+91-8959129744</td>
              <td style="padding: 5px; border: 1px solid #ccc;">sales manager</td>
            </tr>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">Kapil Patidar Kapil Patidar</td>
              <td style="padding: 5px; border: 1px solid #ccc;">kapilpatidarsing@gmail.com</td>
              <td style="padding: 5px; border: 1px solid #ccc;">+91-8959129744</td>
              <td style="padding: 5px; border: 1px solid #ccc;">sales manager</td>
            </tr>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">Kapil Patidar Kapil Patidar</td>
              <td style="padding: 5px; border: 1px solid #ccc;">kapilpatidarsing@gmail.com</td>
              <td style="padding: 5px; border: 1px solid #ccc;">+91-8959129744</td>
              <td style="padding: 5px; border: 1px solid #ccc;">sales manager</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Statutory Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Business Type :- <b>Lorem Ipsum is simply dummy text</b></p>
            </td>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Business Activity :- <b>Lorem Ipsum is simply</b></p>
            </td>
          </tr>
          <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Year of comencement :- <b>2020</b></p>
            </td>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">PAN Number :- <b>deep800a2</b></p>
            </td>
          </tr>
          <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">GST Number :- <b>22AAAAA0000A1Z5</b></p>
            </td>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">MSME Number :- <b>12356895236</b></p>
            </td>
          </tr>
          <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">IEC Number :- <b>22AAAAA0000A1Z5</b></p>
            </td>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">CIN Number :- <b>12356895236</b></p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Financial Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Financial Year</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">TurnOver Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">2019-2020</td>
              <td style="padding: 5px; border: 1px solid #ccc;">50000000</td>
            </tr>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">2019-2020</td>
              <td style="padding: 5px; border: 1px solid #ccc;">50000000</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Customer Reference</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="width:25%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name of Customer</th>
              <th style="width:25%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Contact Person</th>
              <th style="width:15%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Contact Number</th>
              <th style="width:35%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Address</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">Kapil Patidar Kapil Patidar</td>
              <td style="padding: 5px; border: 1px solid #ccc;">Kapil Patidar</td>
              <td style="padding: 5px; border: 1px solid #ccc;">+91-8959129744</td>
              <td style="padding: 5px; border: 1px solid #ccc;">Regional Office,511/I, Kallolickal Building,Peermade P.O., Idukki, Kerala - 685 531</td>
            </tr>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">Kapil Patidar Kapil Patidar</td>
              <td style="padding: 5px; border: 1px solid #ccc;">Kapil Patidar</td>
              <td style="padding: 5px; border: 1px solid #ccc;">+91-8959129744</td>
              <td style="padding: 5px; border: 1px solid #ccc;">Regional Office,511/I, Kallolickal Building,Peermade P.O., Idukki, Kerala - 685 531</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Product Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name of Product</th>
              <th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Quality Certification</th>
              <th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Product Specification</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">Lorem Ipsum </td>
              <td style="padding: 5px; border: 1px solid #ccc;">simply dummy text of the printing</td>
              <td style="padding: 5px; border: 1px solid #ccc;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
            </tr>
            <tr>
              <td style="padding: 5px; border: 1px solid #ccc;">Lorem Ipsum </td>
              <td style="padding: 5px; border: 1px solid #ccc;">simply dummy text of the printing</td>
              <td style="padding: 5px; border: 1px solid #ccc;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Bank Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Name of Bank :- <b>Bank of India</b></p>
            </td>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Address :- <b>Lorem Ipsum is simply Lorem Ipsum is simply Lorem Ipsum is simply</b></p>
            </td>
          </tr>
          <tr>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Type of Account :- <b>Saving</b></p>
            </td>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Account Number :- <b>1234567891234567</b></p>
            </td>
          </tr>
          <tr>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">IFC Code :- <b>BKDI0008</b></p>
            </td>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">MICR Code :- <b>12356895236</b></p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Acknowledgement of Bank</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; border: 1px solid #ccc;">
          <tr>
            <td style="padding:0px; text-align: center;">
              <p style="font-size:15px;margin-bottom:0;">This is to confirm that all the above information furnished by us is true. </p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Name :-</b> Mustafa Bohra</p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Designation :-</b> sales manager</p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Date :-</b> 21-08-2020</p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Place :-</b> Indore M.P.</p>
            </td>
          </tr>

          <tr>
            <td style="padding:5px;">
              <p style="text-align: right;">
                <b>Signature of Authorized Person</b>
              </p>
            </td>
          </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 30px; width: 100%; border: 1px solid #ccc;">
          <tr>
            <td style="padding:0px; text-align: center;">
              <p style="font-size:15px; margin-bottom:0;"><b>FOR SCHACH USE ONLY.</b></p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Vendor Approved By :-</b> </p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Date of Approval :-</b> 21-08-2020</p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Approval Remark :-</b> </p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Vendor Reference :-</b> </p>
            </td>
          </tr>

          <tr>
            <td style="padding:5px;">
              <p style="text-align: right;">
                <b>Signature of Purchase Manager</b>
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size:18px;margin-bottom: 5px; font-weight:900;">INSTRUCTIONS</h3>
        <p style="margin-bottom: 3px; margin-top: 0;font-size: 12px;">01. (*) Mandatory Fields.</p>
        <p style="margin-bottom: 3px; margin-top: 0;font-size: 12px;">02. Hand written form will not be acceptable. </p>
        <p style="margin-bottom: 3px; margin-top: 0;font-size: 12px;">03. All the pages of Registration form should duly signed by the authorized person along with the stamp.</p>
        <p style="margin-bottom: 3px; margin-top: 0;font-size: 12px;">04. Bank Details should be verified by the respective Bank.</p>

        <p style="text-align: center;font-weight:700;font-size: 10px;">IN CASE OF ANY QUERY RELATED TO FILLING FORM PLEASE CONTCT US ON +91-7304997369 OR ON ADMIN@SCHACHENGINEERS.COM </p>
      </td>
    </tr>

  </table>
</body>
</html>';
  return $html;
}


function registeredvendor_pdf($id){

$CI =& get_instance();
$registeredvendor = $CI->db->query("SELECT * FROM `tblregisteredvendor` where id = '".$id."' ")->row();

$state_info = $CI->db->query("SELECT * FROM `tblstates` where id = '".$registeredvendor->office_state."'")->row();
$city_info = $CI->db->query("SELECT * FROM `tblcities` where id = '".$registeredvendor->office_city."'")->row();
$work_state = $CI->db->query("SELECT * FROM `tblstates` where id = '".$registeredvendor->work_state."'")->row();
$work_city = $CI->db->query("SELECT * FROM `tblcities` where id = '".$registeredvendor->work_city."'")->row();


$vendorcontact = $CI->db->query("SELECT * FROM `tblregisteredvendorcontact` where registeredvendor_id = '".$id."' ")->result();
 
$vendorcustomer = $CI->db->query("SELECT * FROM `tblregisteredvendorcustomer` where registeredvendor_id = '".$id."' ")->result();

$vendorfinancial = $CI->db->query("SELECT * FROM `tblregisteredvendorfinancials` where registeredvendor_id = '".$id."' ")->result();

$vendorproduct = $CI->db->query("SELECT * FROM `tblregisteredvendorproduct` where registeredvendor_id = '".$id."' ")->result();

  $html = '<!DOCTYPE html>
<html>
<head>
  <title>Print Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
  <style type="text/css">
      @page{margin:15px};
      td p{
        font-size: 11px;
      }
      td{font-size: 11px;}
  </style>
</head>
<body style="font-family: \'Nunito\', sans-serif;">
  <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; margin: auto;">
    <tr>
      <td style="text-align:center;">
        <img src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" class="logo">
        <p style="margin-top: 0; margin-bottom:0px; font-size: 20px; font-family: \'Nunito\', sans-serif; text-decoration: underline; font-weight: 900;">VENDOR REGISTRTION FORM</p>
      </td>
    </tr>
    <tr>
      <td>
        <h3 style="font-family: \'Nunito\', sans-serif; font-size: 16px;font-weight: 900;margin: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Business Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;" colspan="2">
              <p style="margin:0;">Name of Vendor :- <b>'.$registeredvendor->vendor_name.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Contact Number :- <b>'.$registeredvendor->contact_no.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Email Id :- <b>'.$registeredvendor->email_id.'</b></p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Address Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="border: 1px solid #d7d7d7;">
              <h4 style="margin:0;padding: 5px; text-decoration: underline;">Office Address Details</h4>
              <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                <tr>
                  <td style="padding:2px 5px;" colspan="2">
                    <p style="margin:0;">Office Address :- <b>'.$registeredvendor->office_address.'</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">State :- <b>'.$state_info->name.'</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">City :- <b>'.$city_info->name.'</b></p>
                  </td>
                </tr>
              </table>
            </td>
            <td style="border: 1px solid #d7d7d7;">
              <h4 style="margin:0;padding: 5px; text-decoration: underline;">Work Address Details</h4>
              <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                <tr>
                  <td style="padding:2px 5px;" colspan="2">
                    <p style="margin:0;">Office Address :- <b>'.$registeredvendor->work_address.'</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">State :- <b>'.$work_state->name.'</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">City :- <b>'.$work_city->name.'</b></p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>';
    if(empty($vendorcontact))
         {
       $html .='<td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
         </td>
         <tr>
          <td style="border: 1px solid #ccc;text-align:center;padding: 5px;">No Records</td>
         </tr>';
         }
         else
         {
            $html .='<td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Email</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Number</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Designation</th>
            </tr>
          </thead>
          <tbody>';
          foreach ($vendorcontact as $key => $value) {
  
            $html .='<tr>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->contactperson_name.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->contactperson_email.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->contactperson_no.'</td>';
               $designation_info = $CI->db->query("SELECT * FROM `tbldesignation` where id = '".$value->designation_id."' ")->row();
              $html .='<td style="padding: 5px; border: 1px solid #ccc;">'.$designation_info->designation.'</td>
            </tr>';
            }
          $html .='</tbody>
        </table>
      </td>';
         }
      
    $html .='</tr>

    <tr>
      <td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Statutory Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">';
              $business_info = $CI->db->query("SELECT * FROM `tblbusinesstype` where id = '".$registeredvendor->business_type."' ")->row();
              $html .='<p style="margin:0;">Business Type :- <b>'.$business_info->name.'</b></p>
            </td>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Business Activity :- <b>'.$registeredvendor->business_activity.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Year of comencement :- <b>'.$registeredvendor->comencement_year.'</b></p>
            </td>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">PAN Number :- <b>'.$registeredvendor->pan_no.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">GST Number :- <b>'.$registeredvendor->gst_no.'</b></p>
            </td>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">MSME Number :- <b>'.$registeredvendor->msme_no.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">IEC Number :- <b>'.$registeredvendor->iec_no.'</b></p>
            </td>
            <td style="padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">CIN Number :- <b>'.$registeredvendor->cin_no.'</b></p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>';
    if(empty($vendorfinancial))
         {
       $html .='<td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Financial Details</h3>
         </td>
         <tr>
          <td style="border: 1px solid #ccc;text-align:center;padding: 5px;">No Records</td>
         </tr>';
         }
         else
         {
        $html .='<td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Financial Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Financial Year</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">TurnOver Details</th>
            </tr>
          </thead>
          <tbody>';
           foreach ($vendorfinancial as $key => $value) {
            $html .='<tr>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->financial_year.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->turnover_details.'</td>
            </tr>';
          }
          $html .='</tbody>
        </table>
      </td>';
    }
    $html .='</tr>

    <tr>';
    if(empty($vendorcustomer))
         {
       $html .='<td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Customer Reference</h3>
         </td>
         <tr>
          <td style="border: 1px solid #ccc;text-align:center;padding: 5px;">No Records</td>
         </tr>';
         }
         else
         {
        $html .='<td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Customer Reference</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="width:25%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name of Customer</th>
              <th style="width:25%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Contact Person</th>
              <th style="width:15%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Contact Number</th>
              <th style="width:35%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Address</th>
            </tr>
          </thead>
          <tbody>';
           foreach ($vendorcustomer as $key => $value) {
            $html .='<tr>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->customer_name.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->customercontact_person.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->customercontact_no.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->customer_address.'</td>
            </tr>';
            }
          $html .='</tbody>
        </table>
      </td>';
    }
    $html .='</tr>

    <tr>';
    if(empty($vendorproduct))
         {
       $html .='<td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Product Details</h3>
         </td>
         <tr>
          <td style="border: 1px solid #ccc;text-align:center;padding: 5px;">No Records</td>
         </tr>';
         }
         else
         {
        $html .='<td>
        <h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Product Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Name of Product</th>
              <th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Quality Certification</th>
              <th style="width:33%; text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Product Specification</th>
            </tr>
          </thead>
          <tbody>';
             foreach ($vendorproduct as $key => $value) {
           $html .=  '<tr>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->product_name.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->quality_certification.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->product_specification.'</td>
            </tr>';
             }
          $html .= '</tbody>
        </table>
      </td>';
    }
    $html .='</tr>

    <tr>
      <td>
        <h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Bank Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Name of Bank :- <b>'.$registeredvendor->bank_name.'</b></p>
            </td>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Address :- <b>'.$registeredvendor->bank_address.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Type of Account :- <b>'.$registeredvendor->account_type.'</b></p>
            </td>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Account Number :- <b>'.$registeredvendor->account_no.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">IFC Code :- <b>'.$registeredvendor->ifc_code.'</b></p>
            </td>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">MICR Code :- <b>'.$registeredvendor->micr_code.'</b></p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Acknowledgement of Bank</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; border: 1px solid #ccc;">
          <tr>
            <td style="padding:0px; text-align: center;">
              <p style="font-size:15px;margin-bottom:0;">This is to confirm that all the above information furnished by us is true. </p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Name :-</b>'.$registeredvendor->vendor_name.'</p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Date :-</b> '._d($registeredvendor->created_at).'</p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Place :-</b>'.$city_info->name.', '.$state_info->name.'</p>
            </td>
          </tr>

          <tr>
            <td style="padding:5px;">
              <p style="text-align: right;">
                <b>Signature of Authorized Person</b>
              </p>
            </td>
          </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 30px; width: 100%; border: 1px solid #ccc;">
          <tr>
            <td style="padding:0px; text-align: center;">
              <p style="font-size:15px; margin-bottom:0;"><b>FOR SCHACH USE ONLY.</b></p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Vendor Approved By :-</b> </p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Date of Approval :-</b> </p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Approval Remark :-</b> </p>
            </td>
          </tr>
          <tr>
            <td style="padding:1px 5px;">
              <p style="margin:0;"><b>Vendor Reference :-</b> </p>
            </td>
          </tr>

          <tr>
            <td style="padding:5px;">
              <p style="text-align: right;">
                <b>Signature of Purchase Manager</b>
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size:18px;margin-bottom: 5px; font-weight:900;">INSTRUCTIONS</h3>
        <p style="margin-bottom: 3px; margin-top: 0;font-size: 12px;">01). (*) Mandatory Fields.</p>
        <p style="margin-bottom: 3px; margin-top: 0;font-size: 12px;">02). Hand written form will not be acceptable. </p>
        <p style="margin-bottom: 3px; margin-top: 0;font-size: 12px;">03). All the pages of Registration form should duly signed by the authorized person along with the stamp.</p>
        <p style="margin-bottom: 3px; margin-top: 0;font-size: 12px;">04). Bank Details should be verified by the respective Bank.</p>

        <p style="text-align: center;font-weight:700;font-size: 10px;">IN CASE OF ANY QUERY RELATED TO FILLING FORM PLEASE CONTCT US ON +91-7304997369 OR ON ADMIN@SCHACHENGINEERS.COM </p>
      </td>
    </tr>

  </table>
</body>
</html>';
  return $html;
}

//gopal 
function registeredemployee_pdf($id){

$CI =& get_instance();
$registeredemployee = $CI->db->query("SELECT * FROM `tblregisteredstaff` where staffid = '".$id."' ")->row();

$relationshipemployee = $CI->db->query("SELECT * FROM `tbldesignation` where id = '".$registeredemployee->designation_id."' ")->row();

$state_info = $CI->db->query("SELECT * FROM `tblstates` where id = '".$registeredemployee->permenent_state."'")->row();

$city_info = $CI->db->query("SELECT * FROM `tblcities` where id = '".$registeredemployee->permenent_city."'")->row();

$work_state = $CI->db->query("SELECT * FROM `tblstates` where id = '".$registeredemployee->residential_state."'")->row();

$work_city = $CI->db->query("SELECT * FROM `tblcities` where id = '".$registeredemployee->residential_city."'")->row();


$employeecontact = $CI->db->query("SELECT * FROM `tblregistrationstafffamily` where staff_id = '".$id."' ")->result();

if($registeredemployee->gender==1){
  $gender='Male';

}else{
 $gender='Female';
}

if($registeredemployee->epf_esicdeduct_id==1){
  $epf_esicdeduct_id='Yes';

}else{
 $epf_esicdeduct_id='No';
}
if($registeredemployee->probationperiod_id==1){
  $probationperiod_id='Yes';

}else{
 $probationperiod_id='No';
}
if($registeredemployee->workingbasis_id==1){
  $workingbasis_id='Daily Basis';

}else{
 $workingbasis_id='Monthly Basis';
}

 $dep_id = $registeredemployee->department_id;
 $deps_data = $CI->db->query('SELECT name FROM tbldepartmentsmaster WHERE id = '.$dep_id.'')->row();
 $department_name = (!empty($deps_data)) ? $deps_data->name : "n/a";     
 
 $superior_id = $registeredemployee->superior_id;
 $superior_data = $CI->db->query('SELECT firstname FROM tblstaff WHERE staffid = '.$superior_id.'')->row();
 $superior_name = (!empty($superior_data)) ? cc($superior_data->firstname) : "n/a";

$html = '<!DOCTYPE html>
<html>
<head>
  <title>Print Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
  <style type="text/css">
      @page{margin:15px};
      td p{
        font-size: 11px;
      }
      td{font-size: 11px;}
  </style>
</head>
<body style="font-family: \'Nunito\', sans-serif;">
  <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; margin: auto;">
    <tr>
      <td style="text-align:center;">

      <img src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" width=200 height="auto" class="logo">
        <p style="margin-top: 0; margin-bottom:0px; font-size: 20px; font-family: \'Nunito\', sans-serif; text-decoration: underline; font-weight: 900;">EMPLOYEE REGISTRTION FORM</p>
      </td>
    </tr>
    <tr>
      <td>
        <h3 style="font-family: \'Nunito\', sans-serif; font-size: 16px;font-weight: 900;margin: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Employee Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Name of Employee :- <b>'.cc($registeredemployee->employee_name).'</b></p>
            </td>
          
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Contact Number :- <b>'.$registeredemployee->contact_no.'</b></p>
            </td>
            </tr>
            <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Email Id :- <b>'.$registeredemployee->email.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Date of Birth :- <b>'._d($registeredemployee->birth_date).'</b></p>
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Gender :- <b>'.$gender.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
            
              <p style="margin:0;">Designation :- <b>'.cc($relationshipemployee->designation).'</b></p>
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Adhaar Card No. :- <b>'.$registeredemployee->adhar_no.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Pan Card No. :- <b>'.$registeredemployee->pan_card_no.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Old EPF No. :- <b>'.$registeredemployee->epf_no.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Old ESIC No. :- <b>'.$registeredemployee->esic_no.'</b></p>
            </td>
          </tr>
           <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">ESIC and EPF Deduction :- <b>'.$epf_esicdeduct_id.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Approved Probation Period :- <b>'.$probationperiod_id.'</b></p>
            </td>
          </tr>
           <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Working :- <b>'.$workingbasis_id.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Gross Salary :- <b>'.$registeredemployee->gross_salary.'</b></p>
            </td>
          </tr>
           <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Net Salary :- <b>'.$registeredemployee->net_salary.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Interviewers Name :- <b>'.$registeredemployee->interviewername.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Department :- <b>'.$department_name.'</b></p>
            </td>
            <td style="border: 1px solid #d7d7d7; padding:5px;">
              <p style="margin:0;">Superior Name :- <b>'.$superior_name.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="border: 1px solid #d7d7d7; padding:2px;">
            <p style="margin:0;">Interviewers Remark :- <b>'.$registeredemployee->interviewerremark.'</b></p></td>
            <td style="border: 1px solid #d7d7d7; padding:2px;"><td><p style="margin:0;">&nbsp;</p></td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Address Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            <td style="border: 1px solid #d7d7d7;">
              <h4 style="margin:0;padding: 5px; text-decoration: underline;">Permenant Address Details</h4>
              <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                <tr>
                  <td style="padding:2px 5px;" colspan="2">
                    <p style="margin:0;">Permenant Address :- <b>'.cc($registeredemployee->permenent_address).'</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">State :- <b>'.cc($state_info->name).'</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">City :- <b>'.cc($city_info->name).'</b></p>
                  </td>
                </tr>
              </table>
            </td>
            <td style="border: 1px solid #d7d7d7;">
              <h4 style="margin:0;padding: 5px; text-decoration: underline;">Residential Address Details</h4>
              <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                <tr>
                  <td style="padding:2px 5px;" colspan="2">
                    <p style="margin:0;">Residential Address :- <b>'.cc($registeredemployee->residential_address).'</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">State :- <b>'.cc($work_state->name).'</b></p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:2px 5px;">
                    <p style="margin:0;">City :- <b>'.cc($work_city->name).'</b></p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>';
    if(empty($employeecontact))
         {
       $html .='<td>
         <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
         </td>
         <tr>
          <td style="border: 1px solid #ccc;text-align:center;padding: 5px;">No Records</td>
         </tr>';
         }
         else
         {
            $html .='<td>
        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <thead>
            <tr>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Full Name</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Adhaar Card No</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Contact No</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Date of Birth</th>
              <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Relatioship</th>
            </tr>
          </thead>
          <tbody>';
          foreach ($employeecontact as $key => $value) {
  
            $html .='<tr>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->full_name.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->adhar_no.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'.$value->contact_no.'</td>
              <td style="padding: 5px; border: 1px solid #ccc;">'._d($value->date_of_birth).'</td>';
               $relationship_info = $CI->db->query("SELECT * FROM `tblregistrationstaffrelationshiptype` where id = '".$value->relationship_id."' ")->row();
              $html .='<td style="padding: 5px; border: 1px solid #ccc;">'.$relationship_info ->relationship.'</td>
            </tr>';
            }
          $html .='</tbody>
        </table>
      </td>';
         }
      
   
    $html .='</tr>

    <tr>
      <td>
        <h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Bank Details</h3>
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
          <tr>
            
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">Account Number :- <b>'.$registeredemployee->account_no.'</b></p>
            </td>
          </tr>
          <tr>
            <td style="width:50%; padding: 5px; border: 1px solid #ccc;">
              <p style="margin:0;">IFC Code :- <b>'.$registeredemployee->ifc_code.'</b></p>
            </td>
            
          </tr>
        </table>
      </td>
    </tr>

  </table>
</body>
</html>';
  return $html;
}


//end gopal


function salary_pdf($salary_info,$staff_info){
  $CI =& get_instance();
  $branch_info = get_company_info();
  
  if($staff_info->payment_mode == 1){
    $payment_mode = 'Salary Bank A/c';

  }elseif($staff_info->payment_mode == 2){
    $payment_mode = 'Other Bank A/c';

  }elseif($staff_info->payment_mode == 3){
    $payment_mode = 'Cash Salary';

  }else{
    $payment_mode = '--';

  }

  if($salary_info->half_days != 0){ 
    $half_days =',+'.$salary_info->half_days.'half day';

  }else{
    $half_days ='';
  }

  if($salary_info->net_salary > 0){ 
    $net_salary= convert_number_to_words(round($salary_info->net_salary));

  }else{ 
    $net_salary= '--'; 

  }

    $paid_day = ($salary_info->paid_leave + $salary_info->present_days);

    $month_days = cal_days_in_month(CAL_GREGORIAN,$salary_info->month,$salary_info->year);

    $total_d = ($salary_info->loan+$salary_info->advance+$salary_info->expense+$salary_info->pf_amt+$salary_info->esic_amt+$salary_info->pt_amt+$salary_info->tds_amt);

    $total_e = ($salary_info->bacis_salary+$salary_info->ta_amt+$salary_info->medical_amt+$salary_info->hra_amt+$salary_info->uniform_amt+$salary_info->other_amt+$salary_info->overtime_amt+$salary_info->arrear_amt);
     

    $html = '<head>

<style type="text/css">
  
  @page{
    margin:0px auto;
  }
  
  #wrapper{
   
    
    margin:auto;
    width:740px;
   
  }
  
  .print-wrapper{
    padding:15px;
    font-family:  sans-serif;
  }
  
  </style>
  
</head>
<body>
    <div id="wrapper">
    
              <table style="width: 100%; text-align: center;">


          <tr>
           <th style="text-align:center;">
        <h3>'.$branch_info[1]->value.'</h3>
          <h4 style="position:relative;margin-top:-13px;">'.$branch_info[0]->value.'</h4>         
        </th>
      </tr>
    </table>
    <table style="width: 100%;">
    <tr>
        <td style="text-align:left; padding-top:14px; width:50%; margin-top: 5px;">
          <p style="position:relative;margin-top:-15px;"><b>Pay slip cum Time card for the month of '.get_month($salary_info->month).',  '.$salary_info->year.'</b></p>
          <p  style="position:relative;margin-top:-15px;"><b>Payment Mode :'.$payment_mode.'</b></p>
          <p  style="position:relative;margin-top:-15px;"><b>Account No.  :'.$staff_info->account_no.'</b></p>
        <td style="text-align:right; padding-top:14px; width:50%;">
          <p  style="position:relative;margin-top:-15px;"><b>Issue Date : '.date('d/m/Y',strtotime($salary_info->create_at)).'</b></p>
          <p  style="position:relative;margin-top:-15px;"><b>Paid Days :'.$salary_info->present_days.'</b></p>
        </td>
      </tr>
    </table>
    <table style="width: 100%; border:2px solid #111; margin-top: 5px;">
    <tr>
        <td style="text-align:left; padding-top:14px; width:50%;">
          <p style="position:relative;margin-top:-15px;"><b>Employee ID :'.$staff_info->employee_id.'</b></p>
          <p style="position:relative;margin-top:-15px;"><b>Employee Name :'.$staff_info->firstname.'</b></p>
          <p style="position:relative;margin-top:-15px;"><b>Father/Husband Name :'.$staff_info->father_husband_name.'</b></p>
          <p style="position:relative;margin-top:-15px;"><b>Date Of Joining :'.date('d-M-Y',strtotime($staff_info->joining_date)).'</b></p>
        </td>
        <td style="text-align:right; padding-top:14px;  width:50%;">
          <p style="position:relative;margin-top:-15px;"><b>Designation :'.get_designation($staff_info->designation_id).'</b></p>
          <p style="position:relative;margin-top:-15px;"><b>Pan Card No. :'.$staff_info->pan_card_no.'</b></p>
          <p style="position:relative;margin-top:-15px;"><b>E.P.F. No. :'.$staff_info->epf_no.'</b></p>
          <p style="position:relative;margin-top:-15px;"><b>ESIC No. : '.$staff_info->epic_no.'</b></p>
        </td>
      </tr>
    </table>
    <table style="width: 100%; border:2px solid #111;margin-top: -2px;">
      <tr>
        <td style="width:50%;">
          <table style="width: 100%;">
            <tr>
              <td style="text-align:left; padding: 15px;">
                <h4><b style="border-bottom: 2px solid #111;">Monthly Details</b></h4>
              </td>
            </tr>
            </table>
          </td>

       <td style="width:50%;">
          <table style="width: 100%;">
            <tr>
              <td style="text-align:left; padding: 15px;">
                <table style="width:100%;">
                  <tr>
                    <td><b>Month Days</b></td>
                    <td><b>Paid Days</b></td>
                    <td><b>Present Days</b></td>
                    <td><b>Paid Leave</b></td>
                    <td><b>Leave</b></td>
                  </tr>
                  <tr>
                    <td>'.$salary_info->month_day.'</td>
                    <td>'.$paid_day.'</td>
                    <td>'.$salary_info->present_days.'   '.$half_days.'</td>
                    <td>'.$salary_info->paid_leave.'</td>
                    <td>'.$salary_info->leave.'</td>
                  </tr>
                </table>  
              </td>
            </tr>
            </table>
        </td>
      </tr>
    </table>
    <table style="width: 100%; border:2px solid #111;margin-top: -2px;">
      <tr>
        <td style="text-align:left; padding:8px; width:50%; border-right: 2px solid #111;">
          <h4><b style="border-bottom: 2px solid #111;">Earnings</b></h4>
          <table style="width:100%;">
            <tr>
              <td style="padding:5px; width:33%;"></td>
              <td style="padding:5px 0; width:50%; text-align: right;"><b>Current Month</b></td>
            </tr>
            <tr>
              <td>BASIC</td>
              <td style="text-align: right;">'.$salary_info->bacis_salary.'</td>
            </tr>
            <tr>
              <td>'.salary_deduction_name(4).'</td>
              <td style="text-align: right;"> '.$salary_info->ta_amt.'</td>
            </tr>
            <tr>
              <td>'.salary_deduction_name(5).'</td>
              <td style="text-align: right;">'.$salary_info->medical_amt.'</td>
            </tr>
            <tr>
              <td>'.salary_deduction_name(6).'</td>
              <td style="text-align: right;"> '.$salary_info->hra_amt.'</td>
            </tr>
            
            <tr>
              <td>'.salary_deduction_name(7).'</td>
              <td style="text-align: right;"> '.$salary_info->uniform_amt.'</td>
            </tr>
            
            <tr>
              <td>'.salary_deduction_name(8).'</td>
              <td style="text-align: right;">'.$salary_info->other_amt.'</td>
            </tr>
            
            <tr>
              <td>Over Time</td>
              <td style="text-align: right;">'.$salary_info->overtime_amt.'</td>
            </tr>

            <tr>
              <td>Arrear</td>
              <td style="text-align: right;"> '.$salary_info->arrear_amt.'</td>
            </tr>
          </table>
        </td>
        
        <td style="text-align:left; padding:8px; width:50%;">
          <h4><b style="border-bottom: 2px solid #111;">Deductions</b></h4>
          
          <table style="width:100%;">
            <tr>
              <td style="padding:5px; width:40%;"></td>
              <td style="padding:5px 0; width:50%; text-align: right;"><b>Current Month</b></td>
            </tr>
            <tr>
              <td>Loan</td>
              <td style="text-align: right;">'.$salary_info->loan.'</td>
            </tr>
            <tr>
              <td>Advance</td>
              <td style="text-align: right;">'.$salary_info->advance.'</td>
            </tr>
            <tr>
              <td>Expense</td>
              <td style="text-align: right;">'.$salary_info->expense.'</td>
            </tr>
            
            <tr>
              <td>'.salary_deduction_name(1).'</td>
              <td style="text-align: right;">'.$salary_info->pf_amt.'</td>
            </tr>
            
            <tr>
              <td>'.salary_deduction_name(2).'</td>
              <td style="text-align: right;">'.$salary_info->esic_amt.'</td>
            </tr>
            
            <tr>
              <td>'.salary_deduction_name(3).'</td>
              <td style="text-align: right;">'.$salary_info->pt_amt.'</td>
            </tr>
            
            <tr>
              <td>TDS</td>
              <td style="text-align: right;">'.$salary_info->tds_amt.'</td>
            </tr>
            
          </table>  
          
        </td>
      </tr>
      
    </table>
    <table style="width:100%;border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="width:50%;border-right: 2px solid #111;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:50%"><b>TOTAL</b></td>
              <td style="padding:10px; width:50%; text-align: right;">'.number_format($total_e,2).'</td>
            </tr>
          </table>
        </td>
        
        <td style="width:50%;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:40%"></td>
              <td style="padding:10px; width:60%; text-align: right;">'.number_format($total_d,2).'</td>
            </tr>
          </table>
        </td>
        
      </tr>
    </table>
    
    <table style="width:100%; border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="width:50%;border-right: 2px solid #111;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:50%"><b>Net Pay</b></td>
              <td style="padding:10px; width:60%; text-align: right;"><b>'.$salary_info->net_salary.'</b></td>
            </tr>
          </table>
        </td>
        
        <td style="width:50%;">
          <table style="width:100%;">
            <tr>
              <td style="padding:10px; width:40%"></td>
              <td style="padding:10px; width:60%"></td>
            </tr>
          </table>
        </td>
        
      </tr>
    </table>
    
    <table style="width:100%; border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="padding:10px;">
          <b>'.$net_salary.'</b>
        </td>
        
      </tr>
    </table>

    <table style="width:100%; border:2px solid #111; margin-top: -2px;">
      <tr>
      
        <td style="padding:10px;">
          <b>Note</b> :- <small>This is computer generated, hence signature not required</small>
        </td>
        
      </tr>
    </table>
  
    </div>
             
    </div>
</div>
</body>

</html>';         

  return $html;
}

function staff_allotitems_pdf($staff_info){
  $CI =& get_instance();
  
  $company_info = get_company_details();  
  $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
  $department = $CI->db->query("SELECT `name` FROM tbldepartmentsmaster WHERE id ='".$staff_info->department_id."'")->row();
  $department_name = (!empty($department)) ? $department->name : "";

  $html = '<html><title>Asset Handover Form</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%">
         <h2 class="name">Asset Handover Form</h2>';

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
          <tr>
            <td><b>Name of Employee  :</b></td>
            <td> '.  get_employee_fullname($staff_info->staffid).'</td>
          </tr>
          
          <tr>
            <td><b>Employee Code No :</b></td>
            <td>'.$employee_code .'</td>
          </tr> 
          <tr>
            <td><b>Employee Contact Details :</b></td>
            <td>'. $staff_info->phonenumber.'</td>
          </tr> 
          <tr>
            <td><b>Department :</b></td>
            <td>'. $department_name.'</td>
          </tr> 

        </table>
      </td>
    </tr>
  </table>';
  
  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;"><b>Instructions: </b> Please find below details for the assets handed over to you to support you in carrying out your</p>';
  
  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;"><b>Assets handed over:</b></p>';
  
  $html .= '<!--Table Area-->
  
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="5%" class="no" style="font-size:10px;font-weight:600;">No.</th>
            <th width="40%" class="no" style="font-size:10px;font-weight:600;">Asset Name </th>
            <th width="40%" class="no" style="font-size:10px;font-weight:600;">Asset Description</th>
            <th class="no" style="font-size:10px;font-weight:600;">Quantity</th>            
            <!--<th width="40%" class="no" style="font-size:10px;font-weight:600;">Remarks</th>-->
          </tr>
        </thead>
        <tbody class="main-table">';
          
    $ttl_value = 0; 
    
    $items = $CI->db->query("SELECT * FROM tblstaffitemsdetails WHERE staff_id = '".$staff_info->staffid."' AND remark=1 AND receive_status=1 AND status=1")->result();
    if(!empty($items)){
     $total_price = 0;
     $shown_total_price = 0;
     foreach ($items as $key => $value) {
        
            $html .= '<tr>
            <td class="desc">'.++$key.'</td>
            <td class="desc">'.  value_by_id("tblproducts", $value->item_id, "name").'</p></td>
            <td class="desc">'.$value->description.'</p></td>
            <td class="desc">1</td>         
            <!--<td class="desc">'.$value->receive_remark.'</td>-->
           </tr>';
        }
    }    
      
    $html .= '</tbody>
      </table>
          
            <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>';
    $html .= '<div >Authorized signature: <br>(Approver )</div><br><br><br>'
            . '<div>I hereby acknowledge that I have received the above mentioned assets .I understand that this assets belongs
to the company and I hereby assure that I will take care of the assets of the company to the best possible
extent.</div><br><br><br>
<div >Employee signature: <br><br><br>________________</div>


<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
        <tr>
         <td class="desc" style="text-align:center;">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
      <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
             </td>
      </tr>
        </tbody>
    </table>
</body></html>';

  return $html;
}


function staff_exprience_certificate($staff_info, $format){
  $CI =& get_instance();
  
  $company_info = get_company_details();  
  $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
  $designation_name = value_by_id("tbldesignation", $staff_info->designation_id, "designation");

  $html = '<html><title>Experience Certificate</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%">
         <br><br><br><br><br>
         <p><b>Date:- </b> '.date("d-M-Y").'</p>';

  $html .= '</td>
    </tr>
  </table>';
    $html .= '<u><h2 style="text-align:center;" class="name">Experience Certificate</h2></u>';
    
    $splvars = array("{employee_name}" => get_employee_fullname($staff_info->staffid), "{from_date}" => date("d-M-Y", strtotime($staff_info->joining_date)), "{to_date}" => date("d-M-Y", strtotime($staff_info->relieving_date)), "{designation}" => $designation_name);
    $contect = strtr($format->content, $splvars);
  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;">'.$contect.'</p>';
//  
//  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;"><b>Assets handed over:</b></p>';
          
    $html .= '<div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>';
    $html .= '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
        <tr>
         <td class="desc" style="text-align:center;">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
      <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
             </td>
      </tr>
        </tbody>
    </table>
</body></html>';

  return $html;
}

function staff_intent_letter($staff_info, $format){
  $CI =& get_instance();
// echo "<pre>";
// print_r($staff_info);exit;
  $company_info = get_company_details();  
  $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
  $designation_name = value_by_id("tbldesignation", $staff_info->designation_id, "designation");

  $branch = $CI->db->query("SELECT GROUP_CONCAT(`comp_branch_name`) as name FROM tblcompanybranch WHERE id IN (".$staff_info->branch_id.")")->row();
  $comp_branch_name = (!empty($branch)) ? $branch->name : "";
  $html = '<html><title>Letter of Intent</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
      </td>
      <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:30%">
         <br><br><br><br><br>
         <p><b>Date:- </b> '.date("d-M-Y").'</p>';

  $html .= '</td>
    </tr>
  </table>';
    $html .= '<p style="text-align:left;"><b>Name: </b>'.get_employee_fullname($staff_info->staffid).'</p>';
    $html .= '<p style="text-align:left;"><b>Address: </b>'.$staff_info->permenent_address.'</p>';
    $html .= '<u><h2 style="text-align:center;" class="name">Letter of Intent</h2></u>';
    
    $splvars = array("{brance}" => $comp_branch_name, "{designation}" => $designation_name);
    $contect = strtr($format->content, $splvars);
  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;">'.$contect.'</p>';
//  
//  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;"><b>Assets handed over:</b></p>';
          
    $html .= '<div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>';
    $html .= '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
        <tr>
         <td class="desc" style="text-align:center;">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
      <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
             </td>
      </tr>
        </tbody>
    </table>
</body></html>';

  return $html;
}

function staff_joining_letter($staff_info, $format){
  $CI =& get_instance();
// echo "<pre>";
// print_r($staff_info);exit;
  $company_info = get_company_details();  
  $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
  $designation_name = value_by_id("tbldesignation", $staff_info->designation_id, "designation");

  $branch = $CI->db->query("SELECT GROUP_CONCAT(`comp_branch_name`) as name FROM tblcompanybranch WHERE id IN (".$staff_info->branch_id.")")->row();
  $comp_branch_name = (!empty($branch)) ? $branch->name : "";
  $html = '<html><title>Joining Letter</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
      </td>
    </tr>
  </table>';
  $html .= '<u><h2 style="text-align:center;" class="name">Private and Confidential</h2></u>';
    $html .= '<p style="text-align:left;"><b>To: </b></p>';
    $html .= '<p style="text-align:left;"><b>Name: </b>'.get_employee_fullname($staff_info->staffid).'</p>';
    $html .= '<p style="text-align:left;"><b>Address: </b>'.$staff_info->permenent_address.'</p>';
    $html .= '<p style="text-align:left;"><b>Date: </b>'.date("d-M-Y").'</p>';
    $html .= '<u><h2 style="text-align:center;" class="name">Letter of Intent</h2></u>';
    
    $splvars = array("{employee_name}" => get_employee_fullname($staff_info->staffid), "{date}" => date("d-M-Y"), "{joining_date}" => date("d-M-Y", strtotime($staff_info->joining_date)), "{salary}" => $staff_info->monthly_salary." /-", "{designation}" => $designation_name);
    $contect = strtr($format->content, $splvars);
  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;">'.$contect.'</p>';
//  
//  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;"><b>Assets handed over:</b></p>';
          
    $html .= '<div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 20px;margin-bottom: 10px;"> </div>';
    $html .= '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
        <tr>
         <td class="desc" style="text-align:center;">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
      <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
             </td>
      </tr>
        </tbody>
    </table>
</body></html>';

  return $html;
}


function staff_relieving_letter($staff_info, $format){
  $CI =& get_instance();
// echo "<pre>";
// print_r($staff_info);exit;
  $company_info = get_company_details();  
  $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
  $designation_name = value_by_id("tbldesignation", $staff_info->designation_id, "designation");

  $html = '<html><title>Relieving Letter</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
      </td>
    </tr>
  </table>';
    $html .= '<u><h2 style="text-align:center;" class="name">Relieving letter</h2></u>';
    
    $splvars = array("{employee_name}" => get_employee_fullname($staff_info->staffid), "{date}" => date("d-M-Y"), "{relieving_date}" => date("d-M-Y", strtotime($staff_info->relieving_date)), "{designation}" => $designation_name);
    $contect = strtr($format->content, $splvars);
  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;">'.$contect.'</p>';
//  
//  $html .= '<p style="margin-bottom: 5px; margin-top: 5px;"><b>Assets handed over:</b></p>';
          
    $html .= '<div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 20px;margin-bottom: 10px;"> </div>';
    $html .= '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
        <tr>
         <td class="desc" style="text-align:center;">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
      <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
             </td>
      </tr>
        </tbody>
    </table>
</body></html>';

  return $html;
}
function hr_policy($staff_info){
  $CI =& get_instance();
// echo "<pre>";
// print_r($staff_info);exit;
  $company_info = get_company_details();  
  $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
  $designation_name = value_by_id("tbldesignation", $staff_info->designation_id, "designation");

  $branch = $CI->db->query("SELECT GROUP_CONCAT(`comp_branch_name`) as name FROM tblcompanybranch WHERE id IN (".$staff_info->branch_id.")")->row();
  $comp_branch_name = (!empty($branch)) ? $branch->name : "";
  $html = '<html><title>HR Policy</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:13px;background:#626F80}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:8px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';
  
  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
    <tr>
      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
      </td>
    </tr>
  </table>';
    $html .= '<u><h2 style="text-align:center; margin-top:20%" class="name">HR- POLICY</h2></u><br><br><br><br><br><br><br><br><br>';
    $html .= '<div><h3 style="text-align:center;">Prepared By: Preeti</h3><h3 style="text-align:center;">Authorized By: Abhishek Singh</h3><div>';
    
    
//    $html .= '<div style="margin-top:200px"><table border="0" cellspacing="0" cellpadding="0" class="mb-15">
//    <tr>
//      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
//        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
//        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
//        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
//        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
//        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
//      </td>
//    </tr>
//  </table></div>';
    $html .= '<u><h3 style="text-align:center; margin-top:430px;" class="name">Table of Content</h3></u>';
    
    $html .= '<div style="margin-bottom: 350px;"><table border="0" cellspacing="0" cellpadding="0">
                <tbody class="main-table">';
            $html .= '<tr><td class="desc">1</td><td class="desc">Appointment</td><td class="desc">3</td></tr>';
            $html .= '<tr><td class="desc">2</td><td class="desc">Attendance</td><td class="desc">4</td></tr>';
            $html .= '<tr><td class="desc">3</td><td class="desc">Office Timing</td><td class="desc">4</td></tr>';
            $html .= '<tr><td class="desc">4</td><td class="desc">Leave</td><td class="desc">5</td></tr>';
            $html .= '<tr><td class="desc">5</td><td class="desc">Causal /Earned Leave</td><td class="desc">5</td></tr>';
            $html .= '<tr><td class="desc">6</td><td class="desc">Sick Leave</td><td class="desc">5</td></tr>';
            $html .= '<tr><td class="desc">7</td><td class="desc">Compensatory Off</td><td class="desc">6</td></tr>';
            $html .= '<tr><td class="desc">8</td><td class="desc">On Exit</td><td class="desc">7</td></tr>';
            $html .= '<tr><td class="desc">9</td><td class="desc">Other HR Policies</td><td class="desc">8</td></tr>';
            $html .= '<tr><td class="desc">10</td><td class="desc">Facility Using Policy</td><td class="desc">8</td></tr>';
      
    $html .= '</tbody>
      </table></div>';
    
//    $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
//    <tr>
//      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
//        <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
//        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
//        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
//        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
//        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
//      </td>
//    </tr>
//  </table>';
    $html .= '<div style="margin-bottom: 80px;">';
    $html .= '<h3 style="text-align:left;" class="name">1. Appointments:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li> All letter of intent will be issued with the salary/ company policy/ general office rules.</li>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"> For experienced: Previous company relieving letter/Experience letter.</li>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"> Pre appointment conditions: All employees, on issue of an offer letter, will be required to fill a job application form, amongst other things, information about the immediate past managers details will have to be furnished, while providing us the right to call the manager and/or the person who you were directly reporting to for verification..</li>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"> Obviously this will not apply to fresher’s Proof of previous salary drawn will need to be furnished as discussed during the interview</li>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"> Applicant would be required to furnish the required proof during the interview before joining.</li>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"> A personal data sheet of each employee will be filled in the below format by the employee &amp; handed over to HR.</li>';
    $html .= '</div>';
    
    $html .= '<div style="margin-bottom: 300px;"><table border="0" cellspacing="0" style="border: 2px solid #dddddd;" cellpadding="0">
                <thead><tr><th colspan="2"><p style="text-align:center;font-size:20px;">Personal Detail Sheet</p></th></thead>
                <tbody class="main-table">';
                
    $html .= '<tr><th class="desc">Full Name</th><td class="desc">'.get_employee_fullname($staff_info->staffid).'</td></tr>';
    $html .= '<tr><th class="desc">Father/Husband</th><td class="desc">'.$staff_info->father_husband_name.'</td></tr>';
    $html .= '<tr><th class="desc">Date of Birth</th><td class="desc">'.date("d-M-Y", strtotime($staff_info->birth_date)).'</td></tr>';
    $html .= '<tr><th class="desc">Address</th><td class="desc">'.$staff_info->permenent_address.'</td></tr>';
    $html .= '<tr><th class="desc">City</th><td class="desc">'.value_by_id("tblcities", $staff_info->permenent_city, "name").'</td></tr>';
    $html .= '<tr><th class="desc">State</th><td class="desc">'.value_by_id("tblstates", $staff_info->permenent_state, "name").'</td></tr>';
    $html .= '<tr><th class="desc">Country</th><td class="desc">India</td></tr>';
    $html .= '<tr><th class="desc">Mobile Number</th><td class="desc">'.$staff_info->phonenumber.'</td></tr>';
    $html .= '<tr><th class="desc">PAN Number</th><td class="desc">'.$staff_info->pan_card_no.'</td></tr>';
    $html .= '</tbody></table></div><br>';
//    
//    
//    $html .= '<table border="0" cellspacing="0" style="margin-top:100%" cellpadding="0" class="mb-15">
//    <tr>
//      <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:70%">
//        <img style="margin-bottom:10px;" width="150" height="50" src="'.  site_url() .'uploads/company/logo.png">
//        <h3 style="margin-top:0; margin-bottom:0px;">'.$company_info['company_name'].'</h3>
//        <p style="margin-bottom:0px;">'.$company_info['address'].'</p>
//        <p style="margin-bottom:0px;"><b>Company Contact Email :</b> admin@schachengineers.com</p>
//        <p style="margin-bottom:0px;"><b>Company Contact No. :</b> +91-7304997369</p>
//      </td>
//    </tr>
//  </table>';
   
    $html .= '<div style="page-break-before: always;"><h3 style="text-align:left;" class="name">2. Attendance:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;">'
            . '<li> All employees are essentially required to log in and log out on internal ERP when they come in as well as when they are leaving.</li>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"> <b style="font-size:12px;">Office Timings:</b><ul><li>Office Timings: 09.00 am to 7.00 pm.</li><li>Lunch Time: 30 minutes from 1 to 1.30 pm or 1.30 to 2 pm</li></ul></li>';
    $html .= '</ul></div>';
    
    
    $html .= '<div><h3 style="text-align:left; margin-top:2%;" class="name">3. Leave:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li><h3> Leave is classified under: </h3></li>';
    $html .= '<ul><li>Casual Leave</li><li>Sick leave</li><li>Earned leave</li></ul>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"><h3> Leave Entitlement: </h3></h3></li>';
    $html .= '<ul><li>During the probation period employee will not be entitled to any kind of leave expect sick leave (on pro rata basis), therefore be understood that leave availed of by you, if any, and will be without pay.</li>'
            . '<li>Employees are not entitled for any kind of leave during probation. After probation, employees are entitled for 6 days SL and 6 days CL and 15 Earned leave. Unutilized CL cannot be carried over to the next calendar year.</li>'
            . '<li>Unutilized Sick leave can be carried over to the next calendar year, up to a maximum of 3 years and thereafter it lapses.</li>'
            . '<li>Closing balance of sick leave as at the end of December each year will be the opening balance as on 1st January every year.</li>'
            . '<li>Employees are eligible for leaves post completion of the probation period i.e. only on being confirmed.</li>'
            . '<li>Earned leave can be carry forward &amp; maximum leaves that can be accumulated are 30 days.</li>'
            . '<li>Leave encashment will be paid on unutilized earned leave.</li>'
            . '<li>If the employee takes more than three days sick leave at a time then he/she will be required to submit a doctor’s certificate.</li></ul>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"><h3> Permission for availing leave: </h3></h3></li>';
    $html .= '<ul><li>Employees are requested to apply for leave one month or at least 15 days in advance through ERP/email to HR and Reporting Manager.</li>'
            . '<li>Once after taking approval from your Reporting head you need to confirm leave to HR/Admin so that it will be accounted in the leave records</li>'
            . '<li>In case unplanned leave then, absence will be treated as loss of pay.</li></ul>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"><h3> Permission to leave early: </h3></h3></li>';
    $html .= '<ul><li>Permission should be sought from the concerned departmental head for leaving early for genuine cases only and informed to the Manager /HR</li></ul>';
    $html .= '<li style="margin-bottom: 5px; margin-top: 5px;"><h3> Compensatory off: </h3></h3></li>';
    $html .= '<ul><li>Such Employees who have worked on all general holidays &amp; public holidays due to project work load before a particular project will be entitled to compensatory off on completion of the project.</li>'
            . '<li>Employees working on holidays or offs will have to inform Admin to make necessary arrangements.</li></ul></ul></div>';
    
//    
    $html .= '<div style="page-break-before: always;"><h3 style="text-align:left; margin-top:2%;" class="name">4. On Exit:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li> If the employee decides to leave the organization by resigning his /her position. He / She should give the written/email resignation letter.</li>'
            . '<li>Employee should serve the notice period which is one month after the resignation (accepted date by the management). Enforcing the option of the notice period is entirely up to the management.</li>'
            . '<li>During the Notice period the employee should prepare the handover documents which give the complete detail on the activities handled by the employee. The handover document should be given to management and the immediate manager (in-charge).</li>'
            . '<li>On satisfactory completion of handover / notice period, the reliving letter &amp; settlement if any will be given to the employee by the management.</li>'
            . '<li>If an employee is terminated due to performance below expectations or for any other digression of office policies or due to any other reason that the management feels that dismissal is warranted, employee can be asked to leave immediately. Dues, if any, will be settled only after satisfactory handover of responsibilities, files, documents etc to the
employee nominated by management. Under the termination procedure the employee may or may not be paid severance pay in lieu depending on the circumstances under which the employee has been terminated. Employee payables like, salary, Incentives, Bonus, etc will be on hold from the day employee put down her/his papers.</li>
<li>Full &amp; final settlement will be paid as per regular salary dates/discretion of management or 45 days from the last date of service or whichever is later.</li></ul></div>';
//    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">5. Other HR Policies:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li><h3>Disciplinary Policy:</h3>'
            . '<ul><li>Employees to reach office on time.</li>'
            . '<li>Work station to be kept clean &amp; tidy.</li>'
            . '<li>Office rules &amp; systems set in place to be followed.</li>'
            . '<li>All information and data bank are the exclusive property of the management. Tampering with the same or copying it for use other than for official office use will amount to criminal conspiracy and the management has every right to initiate criminal proceeding against such employee. Further deleting or altering such data without specific permission from the management and /or with malicious intent, will be treated sternly as a criminal act.</li>'
            . '</ul></li><li><h3>Late coming policy: </h3><ul><li>Grace time of 15 minutes is permitted for late coming, this privilege is accorded only for establish able contingencies. The facility will not be available as an option for employees but will only be a discretionary privilege.</li>'
            . '<li>Grace time of 15 minutes is permitted for late coming, for two days in a month after that as half day loss of pay for the month.</li></ul></li>'
            . '</ul>';
     $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li><h3>Contact information:</h3>'
            . '<ul><li>You will keep the company informed of your postal address, telephone number, fax, e-mail or any other means for communication including changes that may occur during the period of your appointment.</li></ul></li></ul>';
//    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">6. Salary Details:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>The details of your salary are strictly private and confidential and should not be disclosed to others. For any clarification, please do get in touch with your HR Representative.</li></ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">7. Other HR Policies:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><h3> 7.1 Disciplinary Policy:</h3>'
            . '<ul><li>Employees to reach office on time.</li>'
            . '<li>Work station to be kept clean &amp; tidy.</li>'
            . '<li>Office rules &amp; systems set in place to be followed.</li>'
            . '<li>All information and data bank are the exclusive property of the management. Tampering with the same or copying it for use other than for official office use will amount to criminal conspiracy and the management has every right to initiate criminal proceeding against such employee. Further deleting or altering such data without specific permission from the management and /or with malicious intent, will be treated sternly as a criminal act</li></ul></ul>';
    
    $html .= '<h3 style="text-align:left; page-break-before: always; margin-top:2%;" class="name">8. ID Cards:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Employees are requested mandatorily to wear ID cards in office premises. Loss of card may be immediately reported to HR &amp; employee will be charged fine of Rs100/-for loss of card.</li></ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">9. Dress Code:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>You are required to be dressed in Business Formals on weekdays (Monday to Thursday) and Business Informal is permitted only on Friday/Saturday.</li>'
            . '<li><h4>Gentlemen:</h4> To be dressed in full/half sleeved (In-shirt), Full Trousers and Leather Shoes (Black r Brown)</li>'
            . '<li><h4>Ladies:</h4> Sarees/Salwar Kameez/Business Suit.</li></ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">10. Salary Review:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Changes in remuneration will depend solely on performance and contribution to the organization .Remuneration will be subject to review after one year of service. However company may review the compensation before that in case of exceptional performance cases.</li>'
            . '<li>You will not be entitled to any other payment or benefit from the company expect those incurred in connection with your official duties as may be authorized by the company for which actual reimbursement will be made after acceptance of the reporting manager / accounts</li>'
            . '<li>Remuneration shall be paid by bank transfer before end of the second week of the month.</li>'
            . '<li>Your salary is completely personal and confidential information. You should discuss it only with your manager or with your Human Resource.</li>'
            . '<li>Your salary/benefit related details are confidential and you are advised to avoid revealing/discussing the same. You are also advised not to indulge in matters pertaining to the salary of others in the company.</li>'
            . '</ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">11. Change of roles /responsibilities /work structure and work locations</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Based on company requirement, our roles /responsibilities, work structure, work location may be changed from time to time as per prevailing guidelines.</li></ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">12. Exclusivity:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Your position is a whole time employment with the company and you shall devote yourself exclusively to the business of the company. You will not take up any other work for remuneration or work on advisory capacity or be interested directly or indirectly in any other trade or business during the employment with the company without permission in writing from the management.</li></ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">13. Facility Using Policy:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li><h4>Newspaper:</h4><ul><li>Employees are not permitted to read newspapers in the reception area. If required, take them to you seat and read only during lunch/tea break. Please return and keep the newspapers back on the table neatly</li></ul></li>'
            . '<li><h4>Reception:</h4><ul><li>Reception is for visitors only. Do not sit or hold conversation in this area.</li></ul></li></ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">14. Office Assistants:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Office assistants are a common resource. Refrain from approaching them directly for personal use. Any request to send them out must be made to the Admin/HR Head.</li></ul>';
    
    $html .= '<h3 style="text-align:left; page-break-before: always; margin-top:2%;" class="name">15. Couriers &amp; Postage:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>All outgoing couriers / postage to be approved by the Department Head</li>'
            . '<li>Forms to be filled by the person sending the courier / post and mailed to HR Office through Office Assistant for consolidation.</li>'
            . '<li>Courier pick up time is 5.00 pm from the front Office and ensure it is ready by 4.45 pm.</li>'
            . '</ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">16. Office Vehicle:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>All employees will be eligible to use the office vehicle only under authorization by the Reporting &amp; on approval by Head. Vehicle will be assigned once such clearance is available based on availability of vehicle. The HR/Admin manger will assign the vehicle.</li>'
            . '<li>Office Vehicle should be used only for :<ul><li>Client meetings</li><li>Business meetings</li><li>Heavy materials should not be transported</li></ul></li>'
            . '</ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">17. Travel:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Booking details (tickets) will be given to the applicants by the concerned person.</li>'
            . '<li>All travel settlements to be made by 15th to 20th of following month.</li>'
            . '</ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">18. General:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Maintain Client Relationship</li>'
            . '<li>Contribute to organizational Growth</li>'
            . '<li>Manage work in a team based environment</li>'
            . '<li>Continuously enhance your and team members skills and knowledge.</li>'
            . '<li>Keep your work stations clean.</li>'
            . '<li>Use electricity/water scrupulously, by turning off the switch/tap if found being wasted.</li>'
            . '<li>Do not waste paper and other stationery items.</li>'
            . '<li>Keep the wash room clean.</li>'
            . '<li>Any suggestions for betterment of the office is always welcome and can be made to the HR/Admin.</li>'
            . '<li>All employees are to naturally consider themselves loyal and hardworking in their respective divisions.</li>'
            . '</ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">19. Travel Allowances Conveyance:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Marketing Executives are entitled for conveyance. Conveyance expense (towards travel on company work) will be reimbursed after Reporting Manager approval &amp; then submitted to accounts department by 15 th of following month.</li>'
            . '</ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">20. Insurance:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Medical insurance worth INR 300000 coverage after completing 18 months service with the company.</li>'
            . '</ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">21. Award:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Star performer of the month and half yearly incentive program for the performers.</li>'
            . '</ul>';
    
    $html .= '<h3 style="text-align:left; margin-top:2%;" class="name">22. Revision of policies:</h3>';
    $html .= '<ul style="margin-bottom: 5px; margin-top: 5px;"><li>Company policies are expected to change over time and your employment will be governed by the revised /new policies.</li>'
            . '</ul>';
    
    $html .= '<div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 20px;margin-bottom: 10px;"> </div>';
    $html .= '<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:50px;">
        <tbody>
        <tr>
         <td class="desc" style="text-align:center;">
          <h3 style="margin-bottom:0">Registered Office : Noida -  <span style="color:#000; font-weight:500;">G 401, AVJ Heights, Sector Zeta 1, Greater Noida - 201301</span></h3>
        </td>
      </tr>
      <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : UP28B0011156</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U51101UP2015PTC068937</span> <a href="mailto:info@schachengineers.com" style="color:#fff; margin-right:10px;text-transform:none;">info@schachengineers.com</a> +91(0)- 8450-912-880 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.schachengineers.com/">www.schachengineers.com</a></p>
             </td>
      </tr>
        </tbody>
    </table>';
$html .= '</body></html>';

  return $html;
}