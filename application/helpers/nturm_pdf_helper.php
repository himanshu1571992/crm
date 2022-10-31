<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function nturm_proposals_pdf($proposal){
	$CI =& get_instance();

	$number = format_proposal_number($proposal->id);

	$to_info = get_proposal_to_array($proposal->id);

	$site_id = lead_site_id($proposal->rel_id);

	$shipto_info = get_ship_to_array($site_id);

	$lead_info = $CI->db->query("SELECT * FROM `tblleads` where id = '".$proposal->rel_id."' ")->row();

	$to_data = '';

	if(empty($to_info['address']) && !empty($to_info['state'])){
	  $to_data .= $to_info['state'];
	}else{
	  $to_data .= $to_info['address'].', '.$to_info['state'];
	}
	if(!empty($to_info['city'])){
	  $to_data = $to_data.', '.$to_info['city'];
	}

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
			$months_info = 'The Quotation is for '.$proposal->items[0]['months'].' Month and '.$proposal->items[0]['days'].' Days';
		}elseif($proposal->items[0]['months'] > 0){
			$months_info = 'The Quotation is for '.$proposal->items[0]['months'].' Month';
		}elseif($proposal->items[0]['days'] > 0){
			$months_info = 'The Quotation is for '.$proposal->items[0]['days'].' Days.';
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
	$company_info = get_company_details();
  $html = '<html><title>QUOTATION</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">'.$profor.'</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <h2>'.$company_info['company_name'].'</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Quote :</b> # '.$number.'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Date :</b> '. _d($proposal->date).'</p>';

        if($proposal->status == 5){
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Status :</b> '. format_proposal_status($proposal->status).'</p>';
        }


      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
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
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_data.'</p>
        <p><b>Contact Name :</b> '.$to_info['contact_name'].'</p>
        <p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>
        <p><b>Phone :</b> '.$to_info['phone'].'</p>
      </td>';

      if($site_id > 0){

  $html .= '<td class="desc" style="background:#fff;border:1px solid #eee;text-align:center;">
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

	  $html .= '<td class="desc" style="background:#fff;border:1px solid #eee;text-align:center;">';
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

      $html .='</tr>
        </tbody>
    </table>

  <!--shipping Area End-->

  <!--Table Area-->

         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="4%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
            <th width="34%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;text-align:center;">QTY</th>';
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

         if(!empty($proposal->items)){
		     $total_price = 0;
		     $ttl_tax = 0;
		     $ttl_rate = 0;
		     $ttl_value = 0;
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

		        $isOtherCharge = value_by_id('tblproducts',$value['pro_id'],'isOtherCharge');
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



		        $total_price += $final_price;

		        $ttl_tax += $tax_amt;
		        $ttl_rate += ($show_rate*$qty);


		        //getting material vlaue
		        $ttl_value += get_material_value($value['pro_id'],$qty);



		            $html .= '<tr>
		            <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
		            <td class="desc" style="background:#fff; border:1px solid #eee;"><h3>'.$value['description'].'</h3>'.get_productfields_list('tblproposalproductfields',$proposal->id,$value['pro_id']).'</td>
		            <td class="desc" style="text-align:center; background:#fff; border:1px solid #eee;">'.$show_qty.'</td>
		            ';

		            if($proposal->measurement == 2){
		              $html .=  ' <td class="desc" style="text-align:center; background:#fff; border:1px solid #eee;">'.$weight.'</td>';
		             }

		            $html .= '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.$show_rate.'</td>';

		            if($show_discount == 1){
		              $html .=  ' <td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.$dis.'%</td>';
		             }

		             if($proposal->tax_type == 1 && $proposal->proposal_for == 1){
		                $tax = ($prodtax/2);
		                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
		                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
		             }else{
		                //$html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.number_format(round($prodtax), 0, '.', '').'%</td>';
		                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$prodtax.'%</td>';
		             }

		            $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($tax_amt), 2, '.', '').'</td>';
		            $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($final_price), 2, '.', '').'</td>
		           </tr>';

		        }


		    }

		$subColSpan = ($proposal->measurement == 2) ? '3' : '2';
		$colSpan = 2;
		$mainColSpan = 5;


		if($show_discount == 1){
			$colSpan += 1;
			$mainColSpan += 1;
		}
	    if($proposal->tax_type == 1 && $proposal->proposal_for == 1){
	    	$colSpan += 1;
	    	$mainColSpan += 1;
	    }
	    if($proposal->measurement == 2){
			$mainColSpan += 1;
		}

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="'.$subColSpan.'" style="text-align:left; background: #F7EF79;"><b>SUBTOTAL</b></td>
            <td style="background: #F7EF79;">'.number_format(round($ttl_rate), 2, '.', '').'</td>
            <td style="background: #F7EF79;" colspan="'.$colSpan.'"><b>'.number_format(round($ttl_tax), 2, '.', '').'</b></td>
            <td style="background: #F7EF79;" ><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
          </tr>';

        $discount = 0;
	    if(!empty($discount_percent > 0)){
	         $discount = ($total_price*$discount_percent/100);

	        $html .='<tr>
	          <td style="background: #F7EF79;"></td>
	            <td style="text-align:left; background: #F7EF79;"><b>Discount @ '.number_format($discount_percent).'%</b></td>
	            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>-'.number_format(round($discount), 2, '.', '').'</b></td>
	          </tr>';

	    }

	    $final_amount = ($total_price - $discount);

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>GRAND TOTAL</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.number_format(round($final_amount), 2, '.', '').'</b></td>
          </tr>

         <tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>Amount In Words :</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.convert_number_to_words(round($final_amount),$proposal->currency).'</b></td>
          </tr>

           </tbody>
      </table>';

     if($type=='rent'){
    	$html .= '<div style="text-align:center; background: #F7EF79;">NOTICE : Any Damage/Lost of Components shall be charged from "'.$to_info['name'].'"</div>';
    }
    $html .='<div class="notice" style="text-align:center; color: #FFC80B;">Terms & conditions</div>';



    $html .='<div class="termsList">';
    if($type=='rent'){
    	$html .= '01). Material Value - '.number_format(round($ttl_value), 2, '.', '').'/- <br>02). '.$months_info.'<br> ';
    	//$html .= ''.$proposal->terms_and_conditions.'';
    }
    $html .= ''.$proposal->terms_and_conditions.'';
    $html .='</div>




  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>



  </body></html>';
  return $html;
}


function nturm_perfoma_infoice_pdf($estimate){
	$CI =& get_instance();

	$number = format_estimate_number($estimate->id);
	$to_info = get_estimate_to_array($estimate->id);
	$shipto_info = get_ship_to_array($estimate->site_id);


	$to_data = '';

	if(empty($to_info['address']) && !empty($to_info['state'])){
	  $to_data .= $to_info['state'];
	}else{
	  $to_data .= $to_info['address'].', '.$to_info['state'];
	}
	if(!empty($to_info['city'])){
	  $to_data = $to_data.', '.$to_info['city'];
	}


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
			$months_info = 'The Proforma Invoice is for '.$estimate->items[0]['months'].' Month and '.$estimate->items[0]['days'].' Days.';
		}elseif($estimate->items[0]['months'] > 0){
			$months_info = 'The Proforma Invoice is for '.$estimate->items[0]['months'].' Month.';
		}elseif($estimate->items[0]['days'] > 0){
			$months_info = 'The Proforma Invoice is for '.$estimate->items[0]['days'].' Days.';
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

  $html = '<html><title>PROFORMA INVOICE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">'.$profor.'</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <h2>'.$company_info['company_name'].'</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Proforma Invoice :</b> # '.$number.'</p>';
        if(!empty($estimate->po_number)){
        	$html .= '<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>PO Number :</b> # '.$estimate->po_number.'</p>';
        }
        $html .= '<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Date :</b> '. _d($estimate->date).'</p>';

        if($estimate->status == 6){
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Status :</b> '. estimate_status_by_id($estimate->status).'</p>';
        }


      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
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
        <h3>'.$to_info['name'].'</h3>
        <p>'.$to_data.'</p>
        <p><b>GSTIN :</b> '.$to_info['gst'].'</p>
        <p><b>Contact Name :</b> '.$to_info['contact_name'].'</p>
        <p style="text-transform:none;"><b>Email :</b> '.$to_info['email'].'</p>
        <p><b>Phone :</b> '.$to_info['phone'].'</p>
      </td>
      	<td class="desc" style="background:#fff;border:1px solid #eee; text-align:center;">
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

        if(!empty($estimate->items)){
	     $ttl_value = 0;
	     $total_price = 0;
	     $ttl_tax = 0;
	     $ttl_rate = 0;
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

	        $ttl_tax += $tax_amt;

	        if($value['is_sale'] == 0){
	        	$totalmonths = ($value['months'] + ($value['days'] / 30));
	        	$ttl_rate += ($show_rate*$qty*$totalmonths);
	        }else{
	        	$ttl_rate += ($show_rate*$qty);
	        }


	        $isOtherCharge = value_by_id('tblproducts',$value['pro_id'],'isOtherCharge');
	        $show_qty = ($isOtherCharge == 0) ? $qty : '--';

	        //getting material vlaue
	        $ttl_value += get_material_value($value['pro_id'],$qty);

	            $html .= '<tr>
	            <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
	            <td class="desc" style="background:#fff; border:1px solid #eee;"><h3>'.$value['description'].'</h3>'.get_productfields_list('tblestimateproductfields',$estimate->id,$value['pro_id']).'</td>';

				if($estimate->measurement == 2){
	              $html .=  ' <td class="desc" style="text-align:center; background:#fff; border:1px solid #eee;">'.$weight.'</td>';
	            }

	            $html .= '<td class="desc" style="text-align:center; background:#fff; border:1px solid #eee;">'.$show_qty.'</td>
	            <td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.$show_rate.'</td>';

	            if($show_discount == 1){
	              $html .=  ' <td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.$dis.'%</td>';
	            }

	            if($estimate->tax_type == 1 && $estimate->estimate_for == 1){
	                $tax = ($prodtax/2);
	                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
	                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
	             }else{
	                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.number_format(round($prodtax), 0, '.', '').'%</td>';
	             }

	             $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($tax_amt), 2, '.', '').'</td>';
	            $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($final_price), 2, '.', '').'</td>
	           </tr>';

	        }


	    }

		$subColSpan = ($estimate->measurement == 2) ? '3' : '2';
		$colSpan = 2;
		$mainColSpan = 5;


		if($show_discount == 1){
			$colSpan += 1;
			$mainColSpan += 1;
		}
	    if($estimate->tax_type == 1 && $estimate->estimate_for == 1){
	    	$colSpan += 1;
	    	$mainColSpan += 1;
	    }
	    if($estimate->measurement == 2){
			$mainColSpan += 1;
		}

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="'.$subColSpan.'" style="text-align:left; background: #F7EF79;"><b>SUBTOTAL</b></td>
            <td style="background: #F7EF79;">'.number_format(round($ttl_rate), 2, '.', '').'</td>
            <td style="background: #F7EF79;" colspan="'.$colSpan.'"><b>'.number_format(round($ttl_tax), 2, '.', '').'</b></td>
            <td style="background: #F7EF79;"><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
          </tr>';

        $discount = 0;
	    if(!empty($estimate->discount_percent > 0)){
	         $discount = ($total_price*$estimate->discount_percent/100);

	        $html .='<tr>
	          <td style="background: #F7EF79;"></td>
	            <td style="text-align:left; background: #F7EF79;"><b>Discount @ '.number_format($estimate->discount_percent).'%</b></td>
	            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>-'.number_format(round($discount), 2, '.', '').'</b></td>
	          </tr>';

	    }

	    $final_amount = ($total_price - $discount);

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>GRAND TOTAL</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.number_format(round($final_amount), 2, '.', '').'</b></td>
          </tr>

         <tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>Amount In Words :</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr>

           </tbody>
      </table>';


	if($type=='rent'){
    	$html .= '<div style="text-align:center; background: #F7EF79;">NOTICE : Any Damage/Lost of Components shall be charged from "'.$to_info['name'].'"</div>';
    }

    $html .='<div class="notice" style="text-align:center; color: #FFC80B;">Terms & conditions</div>

    <div class="termsList">';
    if($type=='rent'){
    	$html .= '01). Material Value - '.number_format(round($ttl_value), 2, '.', '').'/- <br>02). '.$months_info.'<br> ';

    }
    $html .= ''.$estimate->terms_and_conditions.'';
    $html .='</div>

  <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> nTurm Engineers Ltd.<br> AU Small Finance Bank A/c No-2121234134271504<br> IFSC Code-AUBL0002341</p>

  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>


  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>

  </body></html>';
  return $html;
}

function nturm_infoice_pdf($invoice){
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
            $months_info = 'The Invoice is for '.$invoice->items[0]['months'].' Month and '.$invoice->items[0]['days'].' Days.';
        }elseif($invoice->items[0]['months'] > 0){
            $months_info = 'The Invoice is for '.$invoice->items[0]['months'].' Month.';
        }elseif($invoice->items[0]['days'] > 0){
            $months_info = 'The Invoice is for '.$invoice->items[0]['days'].' Days.';
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

  $html = '<html><title>INVOICE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">'.$profor.'</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>'.$inv_head.' :</b> # '.$number.'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Invoice Date :</b> '. _d($invoice->invoice_date).'</p>';

        if($type == 'rent'){
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Start Date :</b> '. _d($invoice->date).'</p>';
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>End Date :</b> '. _d($invoice->duedate).'</p>';
        }

        if(!empty($invoice->po_wo_number) && !empty($invoice->po_wo_date)){
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>'.$po_number_head.' :</b> '.$invoice->po_wo_number.'</p>';
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>'.$po_date_head.' :</b> '._d($invoice->po_wo_date).'</p>';
        }

        if(!empty($invoice->vendor_code)){
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Vendor Code :</b> '. $invoice->vendor_code.'</p>';
        }


      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
        <h2>'.$company_info['company_name'].'</h2>
        <p style="margin-bottom:0px;">'.$billing_info['address'].'</p>
        <p style="margin-bottom:0px;"><span style="font-size: 9;">GST Number :</span> '.$billing_info['gst'].'</p>
      </td>
    </tr>
  </table>
  <!--Header Section End-->


  <!--shipping Area-->

  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no" style="text-align:left;"><b>Bill To</b></th>
            <th class="no" style="text-align:left;"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
      <td class="desc" style="background:#fff;border:1px solid #eee; text-align:left;">
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
        if(!empty($person_info['office_name'])){
          $html .= '<p><b>Contact Person :</b> '.$person_info['office_name'].', '.$person_info['office_number'].'</p>';
        }
       $html .= '</td>';

      	$html .= '<td class="desc" style="background:#fff;border:1px solid #eee; text-align:left;">
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
            <th width="35%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;text-align:center;">QTY</th>';
      			if($invoice->measurement == 2){
      			  $html .= '<th class="no" style="font-size:10px;font-weight:600; text-align:center;">Weight (Kg)</th>';
      			}
      		  $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;text-align:center;">RATE/UNIT</th>';

      		  if($show_discount == 1){
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;text-align:center;">Discount</th>';
            }

            if($invoice->tax_type == 1 && $invoice->invoice_for == 1){
              $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
              $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
            }else{
              $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
            }
			$html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>';
			$html .= '<th class="no text-right" style="font-size:10px;font-weight:600;text-align:center;">AMOUNT</th>
          </tr>
        </thead>
        <tbody class="main-table">';

        $ttl_value = 0;

    if(!empty($invoice->items)){
	     $total_price = 0;
	     $ttl_tax = 0;
	     $ttl_rate = 0;
	     foreach ($invoice->items as $key => $value) {
			$qty = $value['qty'];
			$rate = $value['rate'];
			$weight = $value['weight'];
	        $dis = $value['discount'];
	        if($invoice->invoice_for == 1){
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

	        $ttl_tax += $tax_amt;
		    $ttl_rate += ($show_rate*$qty);

	        $isOtherCharge = value_by_id('tblproducts',$value['pro_id'],'isOtherCharge');
	        $show_qty = ($isOtherCharge == 0) ? $qty : '--';

	        //getting material vlaue
	        $ttl_value += get_material_value($value['pro_id'],$qty);

	            $html .= '<tr>
	            <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
	            <td class="desc" style="background:#fff; border:1px solid #eee;"><h3>'.$value['description'].'</h3>'.get_productfields_list('tblinvoiceproductfields',$invoice->id,$value['pro_id']).'</td>
	            <td class="desc" style="text-align:center; background:#fff; border:1px solid #eee;">'.$show_qty.'</td>';

				      if($invoice->measurement == 2){
	              $html .=  ' <td class="desc" style="text-align:center; background:#fff; border:1px solid #eee;">'.$weight.'</td>';
	            }

	            $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.$show_rate.'</td>';

	            if($show_discount == 1){
	              $html .=  ' <td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.$dis.'%</td>';
	            }

	            if($invoice->tax_type == 1 && $invoice->invoice_for == 1){
	                $tax = ($prodtax/2);
	                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
	                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
	            }else{
	                $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$prodtax.'%</td>';
	            }

	            $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($tax_amt), 2, '.', '').'</td>';
	            $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($final_price), 2, '.', '').'</td>
	           </tr>';
	        }

	    }

		$subColSpan = ($invoice->measurement == 2) ? '3' : '2';
		$colSpan = 2;
		$mainColSpan = 5;


		if($show_discount == 1){
			$colSpan += 1;
			$mainColSpan += 1;
		}
	    if($invoice->tax_type == 1 && $invoice->invoice_for == 1){
	    	$colSpan += 1;
	    	$mainColSpan += 1;
	    }
	    if($invoice->measurement == 2){
			$mainColSpan += 1;
		}

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="'.$subColSpan.'" style="text-align:left; background: #F7EF79;"><b>SUBTOTAL</b></td>
            <td style="background: #F7EF79;">'.number_format(round($ttl_rate), 2, '.', '').'</td>
            <td style="background: #F7EF79;" colspan="'.$colSpan.'"><b>'.number_format(round($ttl_tax), 2, '.', '').'</b></td>
            <td style="background: #F7EF79;"><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
          </tr>';

        $discount = 0;
	    if(!empty($invoice->discount_percent > 0)){
	         $discount = ($total_price*$invoice->discount_percent/100);

	        $html .='<tr>
	          <td style="background: #F7EF79;"></td>
	            <td style="text-align:left; background: #F7EF79;"><b>Discount @ '.number_format($invoice->discount_percent).'%</b></td>
	            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>-'.number_format(round($discount), 2, '.', '').'</b></td>
	          </tr>';

	    }


      /* this code use for calculate charges of tcs */ 
      $ttltcs_charges = 0;
      $tcs_charges_data = $CI->db->query("SELECT `tcs_amount` FROM tblinvoicetcscharges WHERE `invoice_id`= '".$invoice->id."' ")->row();
      if (!empty($tcs_charges_data)){
        $html .= '<tr>
                    <td style="background: #F7EF79;"></td>
                    <td style="text-align:left; background: #F7EF79;"><b>TCS CHARGES</b></td>
                    <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.number_format($tcs_charges_data->tcs_amount, 2).'</b></td>
                  </tr>';
        $ttltcs_charges = $tcs_charges_data->tcs_amount;
      }

      $final_amount = ($total_price - $discount) + $ttltcs_charges;

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>GRAND TOTAL</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.number_format(round($final_amount), 2, '.', '').'</b></td>
          </tr>

         <tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>Amount In Words :</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr>

           </tbody>
      </table>';
    if($type=='rent'){
    	$html .= '<div style="text-align:center; background: #F7EF79;">NOTICE : Any Damage/Lost of Components shall be charged from "'.$to_info['name'].'"</div>';
    }


    $html .='<div class="notice" style="text-align:center; color: #FFC80B;">Terms & conditions</div>

    <div class="termsList">';
    if($type=='rent'){
    	$html .= '01). Material Value - '.number_format(round($ttl_value), 2, '.', '').'/- <br>02). '.$months_info.'<br>03). Please dehire on said time or by default the invoice shall be raised for next month rental on '._d($invoice->duedate).' <br>04). For dehire, written mail intimation has to be given before one week prior.<br>';

    }
    $html .= ''.$invoice->terms_and_conditions.'';
    $html .='</div>

    <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> nTurm Engineers Ltd.<br> '.$bank_info->name.' A/c No-'.$bank_info->account_no.'<br> IFSC Code-'.$bank_info->ifsc_code.'<br> Branch - '.$bank_info->branch.'</p>

  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>




  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>

  </body></html>';
  return $html;
}


function nturm_ledger_pdf($data){
  $CI =& get_instance();

  $company_info = get_company_details();

  //$client_info = client_info($data['client_id']);
  $client_info = main_client_info($data['client_id']);

  $site_ids = explode(",",$data['site_ids']);
  $branch_str = $data['client_branch'];
  $client_id = $data['client_id'];
  $flow = $data['flow'];
  $service_type = $data['service_type'];
  $year_id = $data['year_id'];

   /* this code use for get multiple client outstanding amount */
   $vendordata = $CI->db->query("SELECT GROUP_CONCAT(vendor_id) as vendor_ids FROM `tblclientbranch` WHERE `userid` IN (".$branch_str.") ")->row();
   $vendorids_str = (!empty($vendordata)) ? $vendordata->vendor_ids : 0;
   $vendor_outstanding_amount = get_vendor_ledger_amount($vendorids_str);
   
  if($service_type == 1){
      $ledger_for = 'Rental Ledger';
    }else{
      $ledger_for = 'Sales Ledger';
    }
  $allinvoice_ids = 0;
  $alldn_ids = 0;
  //$payment_debitnote = $CI->db->query("SELECT * FROM tbldebitnotepayment where clientid = '".$client_id."' and status = '1' order by date ".$flow." ")->result();

    $html ='<title>LEDGER</title>
   <head>
      <style type="text/css">@page{margin:5px auto}@font-face{font-family:SourceSansPro;src:url(SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:28cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family:Arial,sans-serif;font-size:14px;font-family:SourceSansPro}table{width:100%}table th, table td{padding:5px 10px;font-size:10px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.2em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#000;font-size:14px;background:#ffc80a}table .desc{text-align:left}.desc h3{font-size:14px;font-weight:600}.desc p{font-size:13px;margin-bottom:0;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:15px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:10px;font-size:18px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:15px}.note{text-align:center;background:#FFFACD;color:#000;margin:15px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style>
   </head>
   <body>
   <table border="0" cellspacing="0" cellpadding="0" class="mb-15">

    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">

        <h2 style="color:red;">'.$ledger_for.'</h2>
        <h2>'.$client_info->company.'</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Address :</b>'.$client_info->address.'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>GST Number :</b>'.$client_info->vat.'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Print Date :</b>'.date('d/m/Y').'</p>';


      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
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
              if (!empty($year_id) && $year_id != ''){
                $parent_invoice = $CI->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' and year_id = '".$year_id."' order by date ".$flow." ")->result();
              }else{
                $parent_invoice = $CI->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' order by date ".$flow." ")->result();
              }

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
               $payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$parent->id."' and cp.status = 1 order by p.id asc ")->result();

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

                  $receipt_date = _d($r1->date);
                  if($r1->payment_mode == 1 && $r1->chaque_status == 1 && !empty($r1->chaque_clear_date)){
                    $receipt_date = _d($r1->chaque_clear_date);
                  }

                  $total = ($j == 0) ? $parent->total : '--';
                  $ttl_received = ($j == 0) ? $received : '--';
                  $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
                  $due_days = ($j == 0) ? $due_days : '--';
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
                      $html .=' <td class="desc text-right">'.$receipt_date.'</td>';
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
				if (!empty($year_id)){
          $child_invoice = $CI->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and year_id = '".$year_id."' and status != '5' order by date ".$flow." ")->result();
        }else{
          $child_invoice = $CI->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and status != '5' order by date ".$flow." ")->result();
        }
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

					 // $payment_info = $CI->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '2' and `invoiceid` = '".$child->id."' order by id desc ")->result();
					  $payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$child->id."' and cp.status = 1 order by p.id asc ")->result();

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

						  $receipt_date = _d($r1->date);
		                  if($r1->payment_mode == 1 && $r1->chaque_status == 1 && !empty($r1->chaque_clear_date)){
		                    $receipt_date = _d($r1->chaque_clear_date);
		                  }

						  $total = ($j == 0) ? $child->total : '--';
						  $ttl_received = ($j == 0) ? $received : '--';
									  $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
						  $due_days = ($j == 0) ? $due_days : '--';
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
							  $html .=' <td class="desc text-right">'.$receipt_date.'</td>';
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
							$lastChildInvoiceId = $child->id;
							$j++;
							}else{
								if($child->id != $lastChildInvoiceId){
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
								$lastChildInvoiceId = $child->id;
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
            if (!empty($year_id)){
               $debit_note_info = $CI->db->query("SELECT * FROM tbldebitnote where invoice_id > '0' and clientid IN (".$branch_str.") and year_id = '".$year_id."' and status = '1' order by dabit_note_date ".$flow." ")->result();
            }else{
              $debit_note_info = $CI->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by dabit_note_date ".$flow." ")->result();
            }
            // $debit_note_info = $CI->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by dabit_note_date ".$flow." ")->result();
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

                  //$debitnote_payment = $CI->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '3' and `debitnote_no` = '".$debitnote->number."' order by id asc ")->result();

                  $debitnote_payment = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();

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

						          $receipt_date = _d($r3->date);
			                      if($r3->payment_mode == 1 && $r3->chaque_status == 1 && !empty($r3->chaque_clear_date)){
			                        $receipt_date = _d($r3->chaque_clear_date);
			                      }

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
        							  $html .=' <td class="desc text-right">'.$receipt_date.'</td>';
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
              if (!empty($year_id)){
                $credit_note_info = $CI->db->query("SELECT * FROM tblcreditnote where  invoice_id > '0' and clientid IN (".$branch_str.") and status = '1' and year_id = '".$year_id."' order by date ".$flow." ")->result();
              }else{
                $credit_note_info = $CI->db->query("SELECT * FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by date ".$flow." ")->result();
              }
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
	  $financialyearwhere = (!empty($year_id)) ? 'and dn.year_id='.$year_id : '';
    $payment_debitnote = $CI->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$allinvoice_ids.") and i.invoice_id > 0 and i.type = 1 and dn.status > 0 ".$financialyearwhere." GROUP by dn.id ")->result();
    if(empty($payment_debitnote)){
      $payment_debitnote = $CI->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$alldn_ids.") and i.invoice_id > 0 and i.type = 2 and dn.status > 0 ".$financialyearwhere." GROUP by dn.id ")->result();
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
                <th class="no" >Details</th>
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

                $debitnote_payment = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();
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
                    $receipt_date = _d($r4->date);
                    if($r4->payment_mode == 1 && $r4->chaque_status == 1 && !empty($r4->chaque_clear_date)){
                      $receipt_date = _d($r4->chaque_clear_date);
                    }

                    $html .= '<tr>
                        <td class="desc text-left">DN</td>
                        <td class="desc text-right">'.$debitnote->number.'</td>
                        <td class="desc text-right">'._d($debitnote->date).'</td>
                        <td class="desc text-right">'.$total.'</td>
                        <td class="desc text-right">'.$r4->amount.'</td>
                        <td class="desc text-right">'.$r4->paid_tds_amt.'</td>
                        <td class="desc text-right">'.$bal.'</td>
                        <td class="desc text-right">'.$receipt_date.'</td>
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
    $ondatefilter = '';
    if (!empty($year_id)){
      $from_date = value_by_id("tblfinancialyear", $year_id, "from_date");
      $to_date = value_by_id("tblfinancialyear", $year_id, "to_date");
      $ondatefilter = 'and date BETWEEN '.$from_date.' and '.$to_date;
    }
    $onaccout_info = $CI->db->query("SELECT * FROM `tblclientpayment` where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ".$ondatefilter." ")->result();
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
    $datefilter = $refubddatefilter = $createdatefilter = '';
    if (!empty($year_id)){
      $from_date = value_by_id("tblfinancialyear", $year_id, "from_date");
      $to_date = value_by_id("tblfinancialyear", $year_id, "to_date");
      $datefilter = 'and date BETWEEN '.$from_date.' and '.$to_date;
      $refubddatefilter = 'and r.date BETWEEN '.$from_date.' and '.$to_date;
      $createdatefilter = 'and created_date BETWEEN '.$from_date.' and '.$to_date;
    }
    //$onaccout_amt = $CI->db->query("SELECT COALESCE(SUM(ttl_amt),0) AS ttl_amount FROM `tblclientpayment`  where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' ")->row()->ttl_amount;
    $onaccout_amt = 0;
    $onaccout_amt_info = $CI->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ".$datefilter."")->result();
    if(!empty($onaccout_amt_info)){
      foreach ($onaccout_amt_info as $on_am) {
        $to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
        if($to_see == 1){
          $onaccout_amt += $on_am->ttl_amt;
        }
      }
    }

    $waveoff_amt = $CI->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN (".$data['client_branch'].") and status = 1 and service_type = '".$service_type."' ".$createdatefilter." ")->row()->ttl_amount;
    $waveoff_info = $CI->db->query("SELECT * FROM `tblclientwaveoff`  where client_id IN (".$data['client_branch'].") and status = 1 and service_type = '".$service_type."' ".$createdatefilter." ")->result();
    $clientrefund_amt = $CI->db->query("SELECT COALESCE(SUM(r.amount),0) AS ttl_amount from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where client_id IN (".$data['client_branch'].") and pd.utr_no != '' and service_type = '".$service_type."' ".$refubddatefilter." order by r.id desc")->row()->ttl_amount;

    $final_balance = (round($grand_bal) - round($onaccout_amt) - round($waveoff_amt) + round($clientrefund_amt) - $vendor_outstanding_amount);


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

	if ($clientrefund_amt > 0){
			$html .= '<tr>
				 <td>Client Refund</td>
				 <td>'.round($clientrefund_amt).'.00</td>
			</tr>';
	}

  if ($vendor_outstanding_amount > 0){
    $html .= '<tr>
                <td>- Vendor Outstanding</td>
                <td>'.$vendor_outstanding_amount.'.00</td>
            </tr>';
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

  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>
   </body>';

    return $html;

}

function nturm_debit_note_pdf($debit_info){
	$CI =& get_instance();

  $number = $debit_info->number;
  $company_info = get_company_details();
  $to_info = get_debitnote_to_array($debit_info->clientid);
  $shipto_info = get_ship_to_array($debit_info->site_id);
  $person_info = debitnote_contact_person($debit_info->id,'debitnote');
  //$tax_type = get_client_gst_type($debit_info->clientid);
  $tax_type = $debit_info->tax_type;
  $billing_info = get_branch_details($debit_info->branch_id);

  $discount_percent = $debit_info->finaldiscountpercentage;
  $profor='Debit Note';

  //Getting the item list
  $po_items = get_debitnote_items_list($debit_info->id);
  $othercharges= $CI->db->query("SELECT * FROM `tbldebitnoteothercharges` where `proposalid`='".$debit_info->id."' and category_name > 0 ")->result_array();

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

  $html = '<html><title>DEBIT NOTE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">'.$profor.'</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <h2>'.$company_info['company_name'].'</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Debit No :</b> # '.$number.'</p>';
        $html .= '<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Date :</b> '. _d($debit_info->dabit_note_date).'</p>';


      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
      </td>
    </tr>
  </table>
  <!--Header Section End-->


  <!--shipping Area-->

  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no" style="text-align:center;"><b>Debit To</b></th>
            <th class="no" style="text-align:center;"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
      <td class="desc" style="background:#fff;border:1px solid #eee; text-align:center;">
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

      	$html .= '<td class="desc" style="background:#fff;border:1px solid #eee; text-align:center;">
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
     $ttl_tax = 0;
	    $ttl_rate = 0;
	    if($debit_info->debit_note_type == '1'){
      $html .= '
           <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th width="3%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
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


              $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>
              <th class="no text-right" style="font-size:10px;font-weight:600;">AMOUNT</th>
            </tr>
          </thead>
          <tbody class="main-table">';



      $ttl_value = 0;

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

          $ttl_tax += $tax_amt;
		    //$ttl_rate += $rate;
		    $ttl_rate += ($rate * $qty);

          $total_price += $final_price;

          $html .= '<tr>
          <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
          <td class="desc" style="background:#fff; border:1px solid #eee;"><h3>'.value_by_id('tblproducts',$value['product_id'],'sub_name').'</h3>'.get_productfields_list('tbldebitnoteproductfields',$debit_info->id,$value['product_id']).'</td>
          <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['status'].'</p></td>
          <td class="desc" style="background:#fff; border:1px solid #eee; text-align:center;">'.$qty.'</td>
          <td class="desc" style="background:#fff; border:1px solid #eee;">'.$value['hsn_code'].'</td>';

          $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.$value['price'].'</td>';

          if(!empty($tax_type == 1)){
              $tax = ($value['prodtax']/2);
              $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
              $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
           }else{
              $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$value['prodtax'].'%</td>';
           }
           $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($tax_amt), 2, '.', '').'</td>';
          $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;"">'.number_format(round($final_price), 2, '.', '').'</td>
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

          $ttl_tax += $tax_amt;

          $html .= '<tr>
          <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
          <td class="desc" style="background:#fff; border:1px solid #eee;"><h3>'.value_by_id('tblproducts',$value['product_id'],'sub_name').'</h3>'.get_productfields_list('tbldebitnoteproductfields',$debit_info->id,$value['product_id']).'</td>
          <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['status'].'</p></td>
          <td class="desc" style="background:#fff; border:1px solid #eee; text-align:center;">--</td>
          <td class="desc" style="background:#fff; border:1px solid #eee;">--</td>';

          $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">--</td>';

          if(!empty($tax_type == 1)){
              $tax = ($value['prodtax']/2);
              $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
              $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
           }else{
              $html .=  ' <td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$value['prodtax'].'%</td>';
           }
           $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($tax_amt), 2, '.', '').'</td>';
          $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($final_price), 2, '.', '').'</td>
          </tr>';
        }


          }

      }

		$colSpan = 2;
		$mainColSpan = 7;

	    if(!empty($tax_type == 1)){
	    	$colSpan += 1;
	    	$mainColSpan += 1;
	    }

		$html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="4" style="text-align:left; background: #F7EF79;"><b>SUBTOTAL</b></td>
            <td style="background: #F7EF79;">'.$ttl_rate.'</td>
            <td style="background: #F7EF79;" colspan="'.$colSpan.'"><b>'.number_format(round($ttl_tax), 2, '.', '').'</b></td>
            <td style="background: #F7EF79;"><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
          </tr>';


      $final_amount = ($total_price);

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>GRAND TOTAL</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.number_format(round($final_amount), 2, '.', '').'</b></td>
          </tr>

         <tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>Amount In Words :</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr>

           </tbody>
      </table>';
  }else{
    $html .= '
         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no" width="5%" style="font-size:10px;font-weight:600;">NO.</th>
            <th class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
            <th class="no" style="font-size:10px;font-weight:600;">SAC Code</th>';

            if(!empty($tax_type == 1)){
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
              }else{
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
              }

        $html .='<th class="no text-right" style="font-size:10px;font-weight:600;">TAX AMT</th>
        <th class="no text-right" style="font-size:10px;font-weight:600;">TOTAL AMOUNT</th>
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
         $ttl_tax += $tax_amt;
        $total_price += $final_price;

        $html .= '<tr>
        <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
        <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['product_name'].'</p></td>
        <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['hsn_code'].'</p></td>';

        if(!empty($tax_type == 1)){
            $tax = ($value['prodtax']/2);
            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
         }else{
            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$value['prodtax'].'%</td>';
         }
         $html .=  '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($tax_amt), 2, '.', '').'</td>';
        $html .= '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($final_price), 2, '.', '').'</td>
        </tr>';


        }

    }

    $colSpan = 2;
	$mainColSpan = 4;

	    if(!empty($tax_type == 1)){
	    	$colSpan += 1;
	    	$mainColSpan += 1;
	    }
		$html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="2" style="text-align:left; background: #F7EF79;"><b>SUBTOTAL</b></td>
            <td style="background: #F7EF79;" colspan="'.$colSpan.'"><b>'.number_format(round($ttl_tax), 2, '.', '').'</b></td>
            <td style="background: #F7EF79;"><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
          </tr>';


      $final_amount = ($total_price);

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>GRAND TOTAL</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.number_format(round($final_amount), 2, '.', '').'</b></td>
          </tr>

         <tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>Amount In Words :</b></td>
            <td style="background: #F7EF79;" colspan="'.$mainColSpan.'"><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr>

           </tbody>
      </table>';
  }




	 if(!empty($debit_info->note)){
    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>
    <div class="termsList">'.$debit_info->note.'</div>';
  }


    $html .='<div class="notice" style="text-align:center; color: #FFC80B;">Terms & conditions</div>

    <div class="termsList">'.$debit_info->terms_and_conditions.'</div>

  <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> nTurm Engineers Ltd.<br> AU Small Finance Bank A/c No-2121234134271504<br> IFSC Code-AUBL0002341</p>

  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>


 <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>

  </body></html>';
  return $html;
}


function nturm_debit_notepayment_pdf($debit_info){
	$CI =& get_instance();

  $number = $debit_info->number;
  $company_info = get_company_details();
  $to_info = get_debitnote_to_array($debit_info->clientid);
  $person_info = debitnote_contact_person($debit_info->id,'debitnotepayment');
  //$tax_type = get_client_gst_type($debit_info->clientid);
  $tax_type = $debit_info->tax_type;
  $invoicedata_info = $CI->db->query("SELECT * FROM tbldebitnotepaymentitems where debitnote_id = '".$debit_info->id."' and status = 1 ")->result();

  $billing_info = get_branch_details($debit_info->branch_id);

  $profor='Debit Note';

  $html = '<html><title>DEBIT NOTE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">'.$profor.'</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <h2>'.$company_info['company_name'].'</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>GST Number :</b> '.$billing_info['gst'].'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Debit No :</b> # '.$number.'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Date :</b> '. _d($debit_info->date).'</p>';

      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
      </td>
    </tr>
  </table>
  <!--Header Section End-->


  <!--shipping Area-->

  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no" style="text-align:left;"><b>Debit To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc" style="background:#fff;border:1px solid #eee;text-align:left;">
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
    </table>

  <!--shipping Area End-->

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
	        <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
	        <td class="desc" style="background:#fff; border:1px solid #eee;"><h3>Invoice No: '.$number.'</h3><h3>Due Date:'._d($value->due_date).'</h3></td>
	        <td class="desc" style="background:#fff; border:1px solid #eee; text-align:center;">'.$debit_info->sac_code.'</td>
	        <td class="desc" style="background:#fff; border:1px solid #eee; text-align:right;">'.$value->invoice_amount.'</td>
	        <td class="desc" style="background:#fff; border:1px solid #eee; text-align:right;">'.$value->delay_days.'</td>
	        <td class="desc" style="background:#fff; border:1px solid #eee; text-align:right;">'.$value->amount.'</td>';
	        $html .=  '</tr>';
	      }
	    }

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="4" style="text-align:left; background: #F7EF79;"><b>SUBTOTAL</b></td>
            <td style="background: #F7EF79;" ><b>'.number_format(round($ttl_amount), 2, '.', '').'</b></td>
          </tr>';
          $tax_amount = ($ttl_amount*18/100);
          $ttl_finalamount = ($tax_amount+$ttl_amount);

        if($tax_type == 1){
        	$tax = ($tax_amount/2);
        	 $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="4" style="text-align:left; background: #F7EF79;"><b>CGST @ 9%</b></td>
            <td style="background: #F7EF79;" ><b>'.number_format($tax, 2, '.', '').'</b></td>
          </tr>';
           $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="4" style="text-align:left; background: #F7EF79;"><b>SGST @ 9%</b></td>
            <td style="background: #F7EF79;" ><b>'.number_format($tax, 2, '.', '').'</b></td>
          </tr>';
        }else{
        	 $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="4" style="text-align:left; background: #F7EF79;"><b>IGST @ 18%</b></td>
            <td style="background: #F7EF79;" ><b>'.number_format($tax_amount, 2, '.', '').'</b></td>
          </tr>';
        }


        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="4" style="text-align:left; background: #F7EF79;"><b>GRAND TOTAL</b></td>
            <td style="background: #F7EF79;" ><b>'.number_format(round($ttl_finalamount), 2, '.', '').'</b></td>
          </tr>';

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td colspan="4" style="text-align:left; background: #F7EF79;"><b>Amount In Words</b></td>
            <td style="background: #F7EF79;" ><b>'.convert_number_to_words(round($ttl_finalamount)).'</b></td>
          </tr>';

        $html .='</tbody>
      </table>';


      if(!empty($debit_info->note)){
    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>
    <div class="termsList">'.$debit_info->note.'</div>';
  }

  $html .='<div class="notice" style="text-align:center; color: #FFC80B;">Terms & conditions</div>


    <div class="termsList">'.$debit_info->terms_and_conditions.'</div>




  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>



  </body></html>';
  return $html;
}


function nturm_creditnote_pdf($debit_info){
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

  $invoice_number = $debit_info->invoice_numbers;
  $html = '<html><title>CREDIT NOTE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">'.$profor.'</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <h2>'.$company_info['company_name'].'</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Credit No :</b> # '.$number.'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Date :</b> '. _d($debit_info->date).'</p>';

        if($proposal->status == 5){
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Status :</b> '. format_proposal_status($proposal->status).'</p>';
        }


      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
      </td>
    </tr>
  </table>
  <!--Header Section End-->


  <!--shipping Area-->

  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no" style="text-align:left;"><b>Credit To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
      <td class="desc" style="background:#fff;border:1px solid #eee; text-align:left;">
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



      $html .='</tr>
        </tbody>
    </table>

  <!--shipping Area End-->

  <!--Table Area-->

         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no" width="7%" style="font-size:10px;font-weight:600;">NO.</th>
            <th class="no" width="30%" style="font-size:10px;font-weight:600;">ITEM Details</th>
            <th class="no" style="font-size:10px;font-weight:600;">'.$sac_hsn.'</th>
            <th class="no" style="font-size:10px;font-weight:600;">'.$qty_hours.'</th>';
            if($show_days == 1){
               $html .= '<th class="no" style="font-size:10px;font-weight:600;">Days</th>';
            }

            $html .= '<th class="no" style="font-size:10px;font-weight:600;">Rate</th>';

            if(!empty($tax_type == 1)){
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
              }else{
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
              }

        $html .='<th class="no text-right" style="font-size:10px;font-weight:600;">TOTAL</th>
          </tr>
        </thead>
        <tbody class="main-table">';
         $ttl_value = 0;
         if(!empty($po_items)){
	     $total_price = 0;
	     foreach ($po_items as $key => $value) {

	        $price = ($value['price']*$value['qty']*$value['days']);
	        //$total_price += $price;
	        //Applying TAX after discount
	        $tax_amt = ($price*$value['prodtax']/100);
	        $final_price = ($price+$tax_amt);

	        $total_price += $final_price;

	        $html .= '<tr>
	        <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
	        <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['product_name'].'</p></td>
	        <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['hsn_code'].'</p></td>

	        <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['qty'].'</p></td>';

	        if($show_days == 1){
	           $html .= '<td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['days'].'</p></td>';
	        }
	        $html .= '<td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['price'].'</p></td>';

	        if(!empty($tax_type == 1)){
	            $tax = ($value['prodtax']/2);
	            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
	            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
	         }else{
	            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$value['prodtax'].'%</td>';
	         }

	        $html .= '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($final_price), 2, '.', '').'</td>
	        </tr>';


	        }

	    }

		$colSpan = 5;


		if($show_days == 1){
			$colSpan += 1;
		}
	    if(!empty($tax_type == 1)){
	    	$colSpan += 1;
	    }

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>SUBTOTAL</b></td>
            <td colspan="'.$colSpan.'" style="background: #F7EF79;" ><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
          </tr>';

         $discount = 0;
	    if(!empty($discount_percent > 0)){
	        $discount = ($total_price*$discount_percent/100);

	        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>Discount @ '.number_format($discount_percent).'%</b></td>
            <td colspan="'.$colSpan.'" style="background: #F7EF79;" ><b>*'.number_format(round($discount), 2, '.', '').'</b></td>
          </tr>';

	    }


	    $othercharges_ttl = 0;
        if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

                $html .= '<tr>
                	<td style="background: #F7EF79;"></td>
                  <td style="text-align:left; background: #F7EF79;">'.value_by_id('tblotherchargemaster',$value['category_name'],'category_name').'</td>
                  <td colspan="'.$colSpan.'" style="background: #F7EF79;">'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';

           }

           if($debit_info->other_charges_tax == 2){

                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                  if(!empty($tax_type == 1)){
                   $single_other_tax_amt = ($othercharges_ttl*9/100);

                  $html .= '<tr>
                  				<td style="background: #F7EF79;"></td>
                              <td style="text-align:left; background: #F7EF79;">CGST @ 9%</td>
                              <td colspan="'.$colSpan.'" style="background: #F7EF79;">'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';

                   $html .= '<tr>
                   				<td style="background: #F7EF79;"></td>
                              <td style="text-align:left; background: #F7EF79;">SGST @ 9%</td>
                              <td colspan="'.$colSpan.'" style="background: #F7EF79;">'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';
                }else{
                   $html .= '<tr>
                   <td style="background: #F7EF79;"></td>
                              <td  style="text-align:left; background: #F7EF79;">IGST @ 18%</td>
                              <td colspan="'.$colSpan.'" style="background: #F7EF79;">'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                            </tr>';
                }
           }

      }

      $final_amount = ($total_price - $discount);










	    $final_amount = ($total_price - $discount);

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td   style="text-align:left; background: #F7EF79;"><b>GRAND TOTAL</b></td>
            <td colspan="'.$colSpan.'" style="background: #F7EF79;"><b>'.number_format(round($final_amount), 2, '.', '').'</b></td>
          </tr>

         <tr>
          <td style="background: #F7EF79;"></td>
            <td   style="text-align:left; background: #F7EF79;"><b>Amount In Words :</b></td>
            <td colspan="'.$colSpan.'" style="background: #F7EF79;"><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr>

           </tbody>
      </table>';

      if(!empty($debit_info->note)){
	    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>
	    <div class="termsList">'.$debit_info->note.'</div>';
	  }

    $html .='<div class="notice" style="text-align:center; color: #FFC80B;">Terms & conditions</div>

    <div class="termsList">'.$debit_info->terms_and_conditions.'</div>

  <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> nTurm Engineers Ltd.<br> AU Small Finance Bank A/c No-2121234134271504<br> IFSC Code-AUBL0002341</p>

  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>


  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>



  </body></html>';
  return $html;
}


function nturm_purchase_creditnote_pdf($debit_info){
  $CI =& get_instance();

  $number = $debit_info->number;
  $company_info = get_company_details();
  $to_info = get_vendor_info($debit_info->vendor_id);

  $tax_type = $debit_info->tax_type;


  //$discount_percent = $debit_info->finaldiscountpercentage;
  $profor='Purchase Credit Note';

  //Getting the item list
  $po_items = get_purchase_creditnote_items_list($debit_info->id);
  $othercharges= $CI->db->query("SELECT * FROM `tblcreditnoteothercharges` where `proposalid`='".$debit_info->id."' and category_name > 0 ")->result_array();

  $show_days = 0;
  if(!empty($po_items)){
      foreach ($po_items as $item) {
          if($item['days'] > 1){
              $show_days = 1;
          }
      }
  }

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

  $invoice_number = $debit_info->invoice_numbers;
  $html = '<html><title>PURCHASE CREDIT NOTE</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">'.$profor.'</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <h2>'.$company_info['company_name'].'</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Credit No :</b> # '.$number.'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Date :</b> '. _d($debit_info->date).'</p>';

       /* if($proposal->status == 5){
        	$html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Status :</b> '. format_proposal_status($proposal->status).'</p>';
        }*/


      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
      </td>
    </tr>
  </table>
  <!--Header Section End-->


  <!--shipping Area-->

  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no" style="text-align:left;"><b>Credit To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
      <td class="desc" style="background:#fff;border:1px solid #eee; text-align:left;">
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


       $html .= '</td>';



      $html .='</tr>
        </tbody>
    </table>

  <!--shipping Area End-->

  <!--Table Area-->

         <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no" width="7%" style="font-size:10px;font-weight:600;">NO.</th>
            <th class="no" width="30%" style="font-size:10px;font-weight:600;">ITEM Details</th>
            <th class="no" style="font-size:10px;font-weight:600;">'.$sac_hsn.'</th>
            <th class="no" style="font-size:10px;font-weight:600;">'.$qty_hours.'</th>';
            if($show_days == 1){
               $html .= '<th class="no" style="font-size:10px;font-weight:600;">Days</th>';
            }

            $html .= '<th class="no" style="font-size:10px;font-weight:600;">Rate</th>';

            if(!empty($tax_type == 1)){
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
                $html .= '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
              }else{
                $html .= '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
              }

        $html .='<th class="no text-right" style="font-size:10px;font-weight:600;">TOTAL</th>
          </tr>
        </thead>
        <tbody class="main-table">';
         $ttl_value = 0;
         if(!empty($po_items)){
	     $total_price = 0;
	     foreach ($po_items as $key => $value) {

	        $price = ($value['price']*$value['qty']*$value['days']);
	        //$total_price += $price;
	        //Applying TAX after discount
	        $tax_amt = ($price*$value['prodtax']/100);
	        $final_price = ($price+$tax_amt);

	        $total_price += $final_price;

	        $html .= '<tr>
	        <td class="desc" style="background:#fff; border:1px solid #eee;">'.++$key.'</td>
	        <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['product_name'].'</p></td>
	        <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['hsn_code'].'</p></td>

	        <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['qty'].'</p></td>';

	        if($show_days == 1){
	           $html .= '<td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['days'].'</p></td>';
	        }
	        $html .= '<td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.$value['price'].'</p></td>';

	        if(!empty($tax_type == 1)){
	            $tax = ($value['prodtax']/2);
	            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
	            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$tax.'%</td>';
	         }else{
	            $html .= '<td class="desc text-center" style="background:#fff; border:1px solid #eee;">'.$value['prodtax'].'%</td>';
	         }

	        $html .= '<td class="desc text-right" style="background:#fff; border:1px solid #eee;">'.number_format(round($final_price), 2, '.', '').'</td>
	        </tr>';


	        }

	    }

		$colSpan = 5;


		if($show_days == 1){
			$colSpan += 1;
		}
	    if(!empty($tax_type == 1)){
	    	$colSpan += 1;
	    }

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>SUBTOTAL</b></td>
            <td colspan="'.$colSpan.'" style="background: #F7EF79;" ><b>'.number_format(round($total_price), 2, '.', '').'</b></td>
          </tr>';

         $discount = 0;
	    /*if(!empty($discount_percent > 0)){
	        $discount = ($total_price*$discount_percent/100);

	        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td style="text-align:left; background: #F7EF79;"><b>Discount @ '.number_format($discount_percent).'%</b></td>
            <td colspan="'.$colSpan.'" style="background: #F7EF79;" ><b>*'.number_format(round($discount), 2, '.', '').'</b></td>
          </tr>';

	    }*/


	    $othercharges_ttl = 0;
        if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

                $html .= '<tr>
                	<td style="background: #F7EF79;"></td>
                  <td style="text-align:left; background: #F7EF79;">'.value_by_id('tblotherchargemaster',$value['category_name'],'category_name').'</td>
                  <td colspan="'.$colSpan.'" style="background: #F7EF79;">'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                </tr>';

           }

           if($debit_info->other_charges_tax == 2){

                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                  if(!empty($tax_type == 1)){
                   $single_other_tax_amt = ($othercharges_ttl*9/100);

                  $html .= '<tr>
                  				<td style="background: #F7EF79;"></td>
                              <td style="text-align:left; background: #F7EF79;">CGST @ 9%</td>
                              <td colspan="'.$colSpan.'" style="background: #F7EF79;">'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';

                   $html .= '<tr>
                   				<td style="background: #F7EF79;"></td>
                              <td style="text-align:left; background: #F7EF79;">SGST @ 9%</td>
                              <td colspan="'.$colSpan.'" style="background: #F7EF79;">'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                            </tr>';
                }else{
                   $html .= '<tr>
                   <td style="background: #F7EF79;"></td>
                              <td  style="text-align:left; background: #F7EF79;">IGST @ 18%</td>
                              <td colspan="'.$colSpan.'" style="background: #F7EF79;">'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                            </tr>';
                }
           }

      }

      $final_amount = ($total_price - $discount);



	    $final_amount = ($total_price - $discount);

        $html .='<tr>
          <td style="background: #F7EF79;"></td>
            <td   style="text-align:left; background: #F7EF79;"><b>GRAND TOTAL</b></td>
            <td colspan="'.$colSpan.'" style="background: #F7EF79;"><b>'.number_format(round($final_amount), 2, '.', '').'</b></td>
          </tr>

         <tr>
          <td style="background: #F7EF79;"></td>
            <td   style="text-align:left; background: #F7EF79;"><b>Amount In Words :</b></td>
            <td colspan="'.$colSpan.'" style="background: #F7EF79;"><b>'.convert_number_to_words(round($final_amount)).'</b></td>
          </tr>

           </tbody>
      </table>';

      if(!empty($debit_info->note)){
	    $html .= '<div class="notice">NOTES/SPECIAL REMARKS: </div>
	    <div class="termsList">'.$debit_info->note.'</div>';
	  }

    $html .='<div class="notice" style="text-align:center; color: #FFC80B;">Terms & conditions</div>

    <div class="termsList">'.$debit_info->terms_and_conditions.'</div>

  <div class="notice">Bank A/C</div>
      <p style="line-height:12px; font-size: 12px; margin-top: 5px;"> nTurm Engineers Ltd.<br> AU Small Finance Bank A/c No-2121234134271504<br> IFSC Code-AUBL0002341</p>

  <div style="text-align:center;font-weight:800;color: #000;font-size:18px;margin-top: 15px;margin-bottom: 10px;"> </div>


  <table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>



  </body></html>';
  return $html;
}


function nturm_purchase_order_pdf($purchase){
  $CI =& get_instance();

  //$number = 'PO-'.$purchase->number;
  $number = (is_numeric($purchase->number)) ? 'PO-'.$purchase->number : $purchase->number;
  $company_info = get_company_details();
  $vendor_info = get_vendor_info($purchase->vendor_id);
  $warehouse_info = get_warehouse_info($purchase->warehouse_id);
  $tax_type = get_vendor_gst_type($purchase->vendor_id);
  $shipto_info = get_ship_to_array($purchase->site_id);


  $discount_percent = $purchase->finaldiscountpercentage;
  if($purchase->order_type == 1){
    $profor='PURCHASE ORDER (SEPL/PUR/05)';
    $number_title = 'PO Number';
    $date_title = 'PO Date';
  }else{
    $profor='WORK ORDER (SEPL/PUR/05)';
    $number_title = 'WO Number';
    $date_title = 'WO Date';
  }


  $vendor_contact_number = (!empty($purchase->vendor_contact_number)) ? $purchase->vendor_contact_number : $vendor_info['phone'];
  $vendor_contact_person = (!empty($purchase->vendor_contact_person)) ? $purchase->vendor_contact_person : $vendor_info['contact_person'];
  
 

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
            <td><b>'.$number_title.' :</b></td>
            <td> '.$number.'</td>
          </tr>

          <tr>
            <td><b>'.$date_title.' :</b></td>
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
            <th class="no"><b>Bill To</b></th>';
          if($purchase->order_type == 1){

            $html .='<th class="no"><b>Ship To</b></th>';
          }
          $html .='</tr>
        </thead>
        <tbody>
          <tr>
            <td class="desc">
        <h3>'.$vendor_info['name'].'</h3>
        <p><b>Address :</b> '.$vendor_info['address'].', '.$vendor_info['city'].', '.$vendor_info['state'].'</p>
        <p><b>PAN No. :</b> '.$vendor_info['pan_no'].'</p>
        <p><b>GST No. :</b> '.$vendor_info['gst'].'</p>
        <p><b>Phone :</b> '.$vendor_contact_number.'</p>';
          if (!empty($vendor_contact_person)){
            $html .='<p style="text-transform:none;"><b>Contact Person :</b> '.$vendor_contact_person.'</p>';
          }
       $html .='<p style="text-transform:none;"><b>Email :</b> '.$vendor_info['email'].'</p>

      </td>';

      /*$contact_person = $CI->db->query("SELECT * FROM `tbloptions` where id = '403' ")->row();
      $contact_no = $CI->db->query("SELECT * FROM `tbloptions` where id = '34' ")->row();*/

      $branch_info = $CI->db->query("SELECT * FROM `tblcompanybranch` where id = '".$purchase->billing_branch_id."' ")->row();
      $billing_contact_name = (!empty($purchase->billing_contact_name)) ? $purchase->billing_contact_name : $branch_info->contact_person;
      $billing_contact_number = (!empty($purchase->billing_contact_number)) ? $purchase->billing_contact_number : $branch_info->phone_no_1;
      $billing_contact_email = (!empty($purchase->billing_contact_email)) ? $purchase->billing_contact_email : 'admin@schachengineers.com';
    
      $html .= '<td class="desc">
        <h3>'.$company_info['company_name'].'</h3>
        <p><b>Address :</b> '.$branch_info->address.'</p>
        <p><b>PAN No. :</b> AAVCS4630C</p>
        <p><b>GST No. :</b> '.$branch_info->gst_no.'</p>';
        if (!empty($billing_contact_number)){
          $html .='<p><b>Contact Person :</b> '.$billing_contact_name.'</p>';
        }
        if (!empty($billing_contact_number)){
          $html .='<p><b>Contact No. :</b> '.$billing_contact_number.'</p>';
        }
        if (!empty($billing_contact_email)){
          $html .='<p style="text-transform:none;"><b>Email :</b> '.$billing_contact_email.'</p>';
        }
     $html .='</td>';

      if($purchase->order_type == 1){

        if($purchase->source_type == 1){
          $html .= '<td class="desc">
            <h3>'.$company_info['company_name'].'</h3>
            <p><b>Address :</b> '.$warehouse_info['address'].'</p>
            <p><b>Contact Person :</b> '.$warehouse_info['cont_name'].'</p>
            <p><b>Contact No. :</b> '.$warehouse_info['phone'].'</p>

          </td>';
        }else{
            $html .= '<td class="desc">
          <h3>'.$shipto_info['name'].'</h3>
          <p>'.$shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state'].'</p>
          <p><b>Landmark :</b> '.$shipto_info['landmark'].'</p>
          <p><b>Zip :</b> '.$shipto_info['zip'].'</p>';
        }

      }



//For dicount show
$show_discount = 0;
if(!empty($po_items)){
  foreach ($po_items as $key => $value) {
      if($value['discount'] > 0){
        $show_discount = 1;
      }
  }

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
            if ($show_discount == '1'){  
              $html .= '<th class="no text-right" style="font-size:10px;font-weight:600;">DISCOUNT</th>';
            } 

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
     $ttl_rate = 0;
     $ttl_taxamt = 0;
     $shown_total_price = 0;
     $ttl_qty = 0;
     $final_unit = '';
     $ttl_discount = 0;
     foreach ($po_items as $key => $value) {
        $qty = $value['qty'];
        $rate = $value['price'];

        $price = ($rate * $qty);
        $discount_amt = $price - (($price * $value['discount']) / 100);
        $ttl_rate += $price;
        $ttl_discount += $discount_amt;

        //Applying TAX after discount
        if($purchase->tax_type == 2){
          $tax_amt = ($discount_amt*$value['prodtax']/100);
          $final_price = ($discount_amt+$tax_amt);
          $ttl_taxamt += $tax_amt;
        }else{
          $final_price = $discount_amt;
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
            $unit_id = ($value['unit_id'] > 0) ? $value['unit_id'] : value_by_id_empty('tblproducts', $value['product_id'], 'unit_2');
            $product_name = value_by_id('tblproducts', $value['product_id'], 'sub_name');

            if($value['hsn_code'] == 2){
                //$hsn_sac_code = value_by_id('tblproducts',$value['product_id'],'sac_code');
                $hsn_sac_code = $CI->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$value['product_id']."' ")->row()->field_value;
              }else{
                //$hsn_sac_code = value_by_id('tblproducts',$value['product_id'],'hsn_code');
                $hsn_sac_code = $CI->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$value['product_id']."' ")->row()->field_value;
              }
            $isOtherCharge = value_by_id('tblproducts',$value['product_id'],'isOtherCharge');
        }else{
            $unit_id = ($value['unit_id'] > 0) ? $value['unit_id'] : value_by_id_empty('tbltemperoryproduct', $value['product_id'], 'unit');
            $product_name = $value["product_name"];
            if($value['hsn_code'] == 2){
                $hsn_sac_code = value_by_id('tbltemperoryproduct',$value['product_id'],'sac');
              }else{
                $hsn_sac_code = value_by_id('tbltemperoryproduct',$value['product_id'],'hsn');
              }
            $isOtherCharge = 0;
        }

        $ttl_qty += ($isOtherCharge == 0) ? $qty : 0;
        $show_qty = ($isOtherCharge == 0) ? $qty : '--';
        $show_unit = ($isOtherCharge == 0) ? value_by_id('tblunitmaster',$unit_id,'name') : '--';
        if ($key == 0 && $isOtherCharge == 0){
          $final_unit = $show_unit;
        }
        $remk = '';
        if(!empty($value['remark'])){
          $remk = '<p>'.$value['remark'].'</p>';
        }
            $html .= '<tr>
            <td class="desc">'.++$key.'</td>
            <td class="desc">'.$product_name.''.getPoVendorProductName($purchase->vendor_id,$value['product_id']).$remk.'<p>HSN/SAC : '.$hsn_sac_code.'</p></td>
            <td class="desc">'.$show_qty.'</td>
            <td class="desc">'.$show_unit.'</td>
            <td class="desc text-right">'.$rate.'</td>';
            
            if ($show_discount == '1'){  
              $html .= '<td class="desc text-right">'.$value['discount'].'%</td>';
            } 
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

    $colspan = 2;
    if(!empty($tax_type == 1)){
      $colspan = 3;
    }
    $html .= '<tr>
            <td  colspan="2" style="text-align:right">SUBTOTAL</td>
            <td  style="text-align:left">'.number_format($ttl_qty, 2, '.', '').' '.$final_unit.'</td>
            <td  style="text-align:right"></td>
            <td  style="text-align:right">'.number_format(($ttl_rate), 2, '.', '').'</td>';
            if ($show_discount == '1'){  
              $html .= '<td  style="text-align:right"></td>';
            }
            $html .= '<td colspan="'.$colspan.'" style="text-align:right">'.number_format(round($ttl_taxamt), 2, '.', '').'</td>
            <td  style="text-align:right">'.number_format(round($total_price), 2, '.', '').'</td>
          </tr>';


    $html .= '</tbody>
      </table>

    <table border="0" cellspacing="0" cellpadding="0">';
          /*$html .= '<tr>
            <td  style="text-align:right">SUBTOTAL</td>
            <td style="text-align:right">'.number_format(round($total_price), 2, '.', '').'</td>
          </tr>';*/

      $discount = 0;
      if(!empty($discount_percent > 0)){
         $discount = ($total_price*$discount_percent/100);

        $html .= '<tr>
            <td style="text-align:right">Discount @ '.number_format($discount_percent).'%</td>
            <td style="text-align:right">-'.number_format($discount, 2, '.', '').'</td>
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

      if ($purchase->roundoff_amount != '0.00'){
        $final_amount = $final_amount + $purchase->roundoff_amount;
        $html .= '<tr>
              <td style="text-align:right">Roundoff Amount</td>
              <td style="text-align:right">'.number_format($purchase->roundoff_amount, 2, '.', '').'</td>
              </tr>';
      }

  $html .= '<tr>
        <td style="text-align:right">GRAND TOTAL</td>
        <td style="text-align:right">'.number_format($final_amount, 2, '.', '').'</td>
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

    $html .= '<h4><u>General Terms and Conditions:</u></h4><div class="termsList">'.getAllTermsConditions($purchase->id, "purchase_order").'</div>



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


function nturm_challan_pdf($estimate){
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
  $shipto_info = get_ship_to_array($estimate->site_id);
  $company_info = get_company_details();
  $challan_info = $CI->db->query("SELECT * FROM `tblchalanmst` where  `id` = '".$estimate->id."' ")->row();
  $billing_info = get_branch_details($challan_info->billing_branch_id);
  $product_data = json_decode($estimate->product_json);

  $html = '<html><title>Challan PDF</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:12px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:2px 8px;font-size:9.5px;background:#FFF;text-align:left;border-bottom:1px solid #FFF}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#000;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#010101;font-size:13px;background:#ffc80a;padding:5px;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:14px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:11px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:14px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>
  <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
   <tr>
    <td style="text-align:center; background:#ffc80a;" colspan="2"><h2 style="font-family: Source Sans Pro, sans-serif; margin:2px 0;">'.$profor.'</h2></td>
   </tr>
    <tr>
      <td class="align-left bg-transparent padding-remove" style="width:35%;">
        <h2>'.$company_info['company_name'].'</h2>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Challan :</b> # '.$estimate->chalanno.'</p>
        <p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>Date :</b> '. _d($estimate->challandate).'</p>';
        $html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>'.$po_number_head.' :</b> '. $estimate->work_no.'</p>';
        $html .='<p style="margin-bottom:1px;font-size:11px; border:1px solid #eee; padding:3px;"><b>'.$po_date_head.' :</b> '. _d($estimate->workdate).'</p>';


      $html .='</td>
      <td id="company" class="bg-transparent padding-remove" style="width:65%; text-align:right;">
        <img width="200" src="uploads/company/logo.png">
      </td>
    </tr>
  </table>
  <!--Header Section End-->


  <!--shipping Area-->

  <table border="0" cellspacing="0" cellpadding="0" class="fromToTable mb-15">
        <thead>
          <tr>
            <th class="no" style="text-align:center;"><b>Challan To</b></th>
            <th class="no" style="text-align:center;"><b>Ship To</b></th>
          </tr>
        </thead>
        <tbody>
          <tr>
      <td class="desc" style="background:#fff;border:1px solid #eee; text-align:center;">
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
      <td class="desc" style="background:#fff;border:1px solid #eee; text-align:center;">
      <h3>'.$shipto_info['name'].'</h3>
      <p>'.$shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state'].'</p>
      <p><b>Landmark :</b> '.$shipto_info['landmark'].'</p>
        <p><b>Zip :</b> '.$shipto_info['zip'].'</p>';

        if(!empty($estimate->site_person)){
          $html .= '<p><b>Contact Person :</b> '.$estimate->site_person.', '.$estimate->site_person_number.'</p>';
        }



      $html .='</td></tr>
        </tbody>
    </table>

  <!--shipping Area End-->

  <!--Table Area-->

         <table border="0" cellspacing="0" cellpadding="0">
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
                      <td class="desc" style="background:#fff; border:1px solid #eee;">'.$i++.'</td>
                      <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.value_by_id('tblproducts',$value->product_id,'sub_name').'</p></td>
                      <td class="desc" style="background:#fff; border:1px solid #eee;">'.$value->product_qty.' '.get_product_units($value->product_id).'</td>
                    </tr>';
            }

          }
        }



        $html .='</tbody>
      </table><br>';


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
		            <td class="desc" style="background:#fff; border:1px solid #eee;">'.$i++.'</td>
		            <td class="desc" style="background:#fff; border:1px solid #eee;"><p>'.value_by_id('tblproducts',$value['component_id'],'sub_name').'</p></td>
		            <td class="desc" style="background:#fff; border:1px solid #eee;">'.$value['deleverable_qty'].' '.get_product_units($value['component_id']).'</td>';

		    if($for == 'rent'){
		            $html .= '<td class="desc" style="background:#fff; border:1px solid #eee;"> </td>
		            <td class="desc" style="background:#fff; border:1px solid #eee;"> </td>';
		    }

		  $html .= '</tr>';
		  }
		}



        $html .='</tbody>
      </table><br>';

     if($for=='rent'){
    	$html .= '<div style="text-align:center; background: #F7EF79;">** Material Value - Rs. '.number_format(round($ttl_value), 2, '.', '').'/-</div>';
    }

     if(!empty($estimate->note)){
	    $html .= '<div class="notice">Note: </div>
	    <div class="termsList">'.$estimate->note.'</div><br>';
	 }

   if($for == 'sale'){
  $html .= '
    <div class="notice" style="text-align:center; color: #FFC80B;">Terms & conditions : </div>
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
      <td class="desc text-center" colspan="2"><b>We Assure you the best services from Nturm Engineers. Thanks</b></td>
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
                <p>Delivered By Nturm Employee</p>
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
              <p>Pickup By Nturm Employee</p>
              <p>(Name)</p>
              <br>
              <br>
              <p>Material Out By Client Employee</p>
              <p>(Signature, Name, Contact No)</p>
            </span>
          </td>
              </tr>

          <tr>
          <td style="text-align:center;" class="desc text-center" colspan="2"><b>We Assure you the best services from nTurm Engineers LTD. Thanks</b></td>
          </tr>

      </table>';

}



  $html .='<table border="0" cellspacing="0" cellpadding="0" style="position:absolute;bottom:70px;">
        <tbody>
          <tr>
             <td class="desc" style="text-align:center; background: #F7EF79;">
              <h3 style="margin-bottom:0">Office :   <span style="color:#000; font-weight:500;">105/3,Mantappa, Hennagara Cross, Hosur Main Road, Bommasandara, Bengaluru - 560099 <br> Registered Office: 1602 Sugee Heights, M.M.M Road, Mulund West, Mumbai - 400080</span></h3>
            </td>
          </tr>
          <tr>
            <td class="desc" style="text-align: center; color: #fff; background: #282929; font-size: 12px;">
            <p><span style="color:#fff; margin-right:10px;text-transform:none;">MSME : MH19A0014882</span><span style="color:#fff; margin-right:10px;text-transform:none;">CIN :U29304MH2017PLC298412</span> <a href="info@nturm.com" style="color:#fff; margin-right:10px;text-transform:none;">info@nturm.com</a> +91(0)- 9920-9920-32 <a style="color:#fff; margin-left:10px;text-transform:none;" href="http://www.nturm.com/">www.nturm.com</a></p>
      </td>
      </tr>
        </tbody>
    </table>



  </body></html>';
  return $html;
}

function nturm_production_plan_pdf($estimate){

  $CI = & get_instance();

  $profor = 'Production Plan';
  if ($estimate->service_type == 2) {
      $for = 'sale';
      $po_date_head = 'PO Date';
      $po_number_head = 'PO Number';
  } else {
      $for = 'rent';
      $po_date_head = 'WO Date';
      $po_number_head = 'WO Number';
  }

  $estimate_info = $CI->db->query("SELECT * FROM `tblestimates` where  `id` = '" . $estimate->rel_id . "' ")->row();
  $check_production = $CI->db->query("SELECT * from tblchalanproductionplan where id = '".$estimate->production_plan_id."' ")->row();

  $to_info = get_estimate_to_array($estimate->rel_id);
  //$shipto_info = get_ship_to_array($estimate_info->site_id);
  $shipto_info = get_ship_to_array($estimate->site_id);

  $company_info = get_company_details();

  if ($check_production->ref_type == '2'){
    $billing_info = get_branch_details($estimate->billing_branch_id);
    $challan_no = 'PC-' . str_pad($estimate->id, 5, '0', STR_PAD_LEFT);
    $challan_date = $estimate->date;
  }else{
    $challan_info = $CI->db->query("SELECT * FROM `tblchalanmst` where  `id` = '" . $estimate->id . "' ")->row();
    $billing_info = get_branch_details($challan_info->billing_branch_id);
    $challan_no = $estimate->chalanno;
    $challan_date = $estimate->challandate;
  }

  

  $department = ($check_production->department == 1) ? "Aluminium" : "MS";

  $html = '<html><title>Challan Production Plan PDF</title><head><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet"><style type="text/css">@page{margin:20px auto}@font-face{font-family:SourceSansPro;src:url(uploads/SourceSansPro-Regular.ttf)}.clearfix:after{content:"";display:table;clear:both}a{color:#0087C3;text-decoration:none}body{position:relative;width:18cm;height:29.7cm;margin:0 auto;color:#555;background:#FFF;font-family: Source Sans Pro, sans-serif;font-size:10px;font-family: Source Sans Pro, sans-serif;text-transform:capitalize;  overflow-wrap: break-word; word-wrap:break-word;}table{width:100%}table th, table td{padding:5px 10px;font-size:10px;background:#EEE;text-align:left;border-bottom:1px solid #FFF}table th{font-family: Poppins, sans-serif;font-size:10px;}table th{white-space:nowrap;font-weight:normal}table td{text-align:right}table td h3{color:#df2c2c;font-size:1.1em;font-weight:600;margin:0;margin-bottom:5px}p{margin:0 0 5px 0}table .no{color:#fff;font-size:10px;background:#626F80;}table .desc{text-align:left}.desc h3{font-size:10px;font-weight:600}.desc p{font-size:10px;margin-bottom:0;line-height:11px;}table .unit{background:#DDD}#company{text-align:right}#company .name{text-transform:uppercase;margin:0;margin-bottom:5px;color:#df2c2c;font-weight:600}.align-left{text-align:left}.text-right{text-align:right !important}.vertical-align-top{vertical-align:top}.bg-transparent{background:transparent}.mb-15{margin-bottom:10px}.main-table td{vertical-align:top}#notices{padding-left:6px; }#notices div{font-weight:600;font-size:10px;letter-spacing:1px;color:#df2c2c}.notice{margin-top:8px;font-size:12px;font-weight:600;color:#282929;line-height:30px;border-bottom:1px solid #282929;letter-spacing:0.5px}.fromToTable td{vertical-align:top}.termsList{margin-top:8px;font-size:11px;text-transform: none;}.note{text-align:center;background:#df2c2c;color:#fff;margin:10px 0;}.padding-remove{padding:7px 0px}.fromToTable tr th{width:50%;}</style></head><body>';

  /*
    <p>'.$company_info['address'].'</p>
    <p><b>GST Number :</b> '.$company_info['gst'].'</p>
    <p><b>CIN Number :</b> U51101UP2015PTC068937</p>
   */

  $html .= '<table border="0" cellspacing="0" cellpadding="0" class="mb-15">
  <tr>
    <td class="align-left vertical-align-top bg-transparent padding-remove" style="width:55%">
      <img style="margin-bottom:10px;" width="150" height="50" src="uploads/company/logo.png">
      <h3 style="margin-bottom:0px;">' . $company_info['company_name'] . '</h3>
      <p style="margin-bottom:0px;">' . $billing_info['address'] . '</p>
      <p style="margin-bottom:0px;"><b>GST Number :</b> ' . $billing_info['gst'] . '</p>
    </td>


    <td id="company" class="vertical-align-top bg-transparent padding-remove" style="width:45%">
       <h2 class="name">' . $profor . '</h2>
      <table border="0" cellspacing="0" cellpadding="0" class="proposal-table">
        <tr>
          <td><b>Reference No :</b></td>
          <td># ' . $challan_no . '</td>
        </tr>
        <tr>
          <td><b>Date :</b></td>
          <td>' . date('d/m/Y', strtotime($challan_date)) . '</td>
        </tr>

        <tr>
          <td><b>' . $po_number_head . ' :</b></td>
          <td>' . $estimate->work_no . '</td>
        </tr>

        <tr>
          <td><b>' . $po_date_head . ' :</b></td>
          <td>' . _d($estimate->workdate) . '</td>
        </tr>

        <tr>
          <td><b>Department :</b></td>
          <td>' . $department . '</td>
        </tr>
        <tr>
          <td><b>Assigned Person :</b></td>
          <td>' . get_employee_name($check_production->assigned_to) . '</td>
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
      <h3>' . $to_info['name'] . '</h3><p>' . $to_info['address'] . ', ' . $to_info['city'] . ', ' . $to_info['state'] . '</p>';
  if (!empty($to_info['gst'])) {
      $html .= '<p><b>Zip :</b> ' . $to_info['zip'] . '</p>';
  }
  if (!empty($to_info['gst'])) {
      $html .= '<p><b>GST NO :</b> ' . $to_info['gst'] . '</p>';
  }
  if (!empty($estimate->office_person)) {
      $html .= '<p><b>Contact Person :</b> ' . $estimate->office_person . ', ' . $estimate->office_person_number . '</p>';
  }

  $shipaddress = "";
  if (!empty($shipto_info['address'])){
      $shipaddress .= $shipto_info['address'];
  }
  if (!empty($shipto_info['city'])){
      $shipaddress .= $shipto_info['city'].',';
  }
  if (!empty($shipto_info['state'])){
      $shipaddress .= $shipto_info['state'];
  }
  
  $html .= '</td>
    <td class="desc">
    <h3>' . $shipto_info['name'] . '</h3>
    <p>' . $shipaddress . '</p>';
    if (!empty($shipto_info['landmark'])){
        $html .= '<p><b>Landmark :</b> ' . $shipto_info['landmark'] . '</p>';
    }
    if (!empty($shipto_info['zip'])){
      $html .= '<p><b>Zip :</b> ' . $shipto_info['zip'] . '</p>';
    }
    

  if (!empty($estimate->site_person)) {
      $html .= '<p><b>Contact Person :</b> ' . $estimate->site_person . ', ' . $estimate->site_person_number . '</p>';
  }

  $html .= '</td>

        </tr>
    <!--<tr>
    <td class="desc">
      <p><b>CONTACT :</b> ' . $to_info['phone'] . '</p>
    </td>
        <td></td>

    </tr>-->
      </tbody>
  </table>';

  if ($check_production->ref_type == '2'){
    $product_data = $CI->db->query("SELECT `product_id`,`qty` as `product_qty` FROM tblproformachalandetails WHERE proformachalan_id = '".$estimate->id."' AND `type`='1' ")->result();
    $component_data = $CI->db->query("SELECT `product_id` as `component_id`,`qty` as `deleverable_qty` FROM tblproformachalandetails WHERE proformachalan_id = '".$estimate->id."' AND `type`='2' ")->result_array();
  }else{
    $product_data = json_decode($estimate->product_json);
    $component_data = $estimate->items;
  }

  $html .= '<table border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="no" style="width:7%; font-size:10px;font-weight:600;">No.</th>
          <th class="no" style="width:80%; font-size:10px;font-weight:600;">Product Name</th>
          <th class="no" style="font-size:10px;font-weight:600;">QTY</th>
        </tr>
      </thead>
      <tbody class="main-table">';

  if (!empty($product_data)) {
      $i = 1;
      $ttl_value = 0;
      foreach ($product_data as $key => $value) {

          $isOtherCharge = value_by_id('tblproducts', $value->product_id, 'isOtherCharge');
          if ($isOtherCharge == 0) {
              $ttl_value += get_material_value($value->product_id, $value->product_qty);
              $html .= '<tr>
                    <td class="desc">' . $i++ . '</td>
                    <td class="desc"><p>' . value_by_id('tblproducts', $value->product_id, 'name') . '</p></td>
                    <td class="desc">' . $value->product_qty . ' ' . get_product_units($value->product_id) . '</td>
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
          <th class="no" style="font-size:10px;font-weight:600;">Quantity</th>';
          if ($check_production->ref_type != '2'){
              $html .= '<th class="no" style="font-size:10px;font-weight:600;">Remark <small>(for production plan)</small></th>';
          }
$html .= '</tr></thead>
      <tbody class="main-table">';


  if (!empty($component_data)) {
      $i = 1;

      foreach ($component_data as $key => $value) {

          $html .= '<tr>
          <td class="desc">' . $i++ . '</td>
          <td class="desc"><p>' . value_by_id('tblproducts', $value['component_id'], 'name') . '</p></td>
          <td class="desc">' . $value['deleverable_qty'] . ' ' . get_product_units($value['component_id']) . '</td>';
          if ($check_production->ref_type != '2'){
             $html .= '<td class="desc">' . cc($value['remark']) . '</td>';
          }
          $html .= '</tr>';
      }
  }


  $html .= '</tbody><br><br>';

  if ($for == 'rent') {
      $html .= '<tfoot>
    <tr>
       <td class="desc text-center" colspan="6"><h3 style="margin:0;color:282929;">** Material Value - Rs. ' . number_format(round($ttl_value), 2, '.', '') . '/-</h3></td>
    </tr>
  </tfoot>';
  }


  $html .= '</table><br>';



  if (!empty($check_production->note)) {
      $html .= '<div class="notice">Note: </div> <style>
          .termsList table tbody tr td {
              text-align: left;
          }
      </style>
  <div class="termsList">' . $check_production->note . '</div><br>';
  }

  if (!empty($check_production->added_by)) {

      $html .= '

    <table border="0" cellspacing="0" cellpadding="0">

      <tr>
          <td class="desc" colspan="2"><b>Prepared By : '.  get_staff_info($check_production->added_by)->firstname.'</b></td>
      </tr>

    </table>';
  }

  $html .= '</div>


 <!--<table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:2px;">
      <tbody>
        <tr>
          <td class="desc" style="text-align:left;">
      <p><b>GSTIN :</b>  ' . $company_info['gst'] . '</p>
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
