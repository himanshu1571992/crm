<div class="col-md-12 page-pdf-html-logo">
    <?php 
	if($_GET['type']=='sale')
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'1');
		$is_sale=1;
		$type='sale';
		$profor='Performance Invoice For Sale';
		$subtotal=$estimate->salesubtotal;
	}
	else if($_GET['type']=='rent')
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'0');	
		$is_sale=0;
		$type='rent';
		$profor='Performance Invoice For Rent';
		$subtotal=$estimate->rentsubtotal;
	}
	else
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'2');	
		$is_sale=2;
		$type='sale';
		$profor='Performance Invoice For Rent & Sale';
		$subtotal=$estimate->salesubtotal+$estimate->rentsubtotal;
	}



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
          $months_info = '<br /><br /><b>Note :- The Proposal is for '.$estimate->items[0]['months'].' Month and '.$estimate->items[0]['days'].' Days </b>';
      }elseif($estimate->items[0]['months'] > 0){
          $months_info = '<br /><br /><b>Note :- The Proposal is for '.$estimate->items[0]['months'].' Month </b>';
      }elseif($estimate->items[0]['days'] > 0){
          $months_info = '<br /><br /><b>Note :- The Proposal is for '.$estimate->items[0]['days'].' Days </b>';
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


	//echo $is_sale;exit;
	get_company_logo('','pull-left'); ?>
    <?php if(is_client_logged_in() && has_contact_permission('estimates')){ ?>
        <a href="<?php echo site_url('clients/estimates/'); ?>" class="btn btn-default pull-right">
            <?php echo _l('client_go_to_dashboard'); ?>
        </a>
    <?php } ?>
</div>
<div class="clearfix"></div>
<div class="panel_s mtop20">
    <div class="panel-body">
        <div class="col-md-10 col-md-offset-1">
            <div class="row">
                <div class="col-md-6">
                    <div class="mtop10 display-block">
                        <?php echo format_estimate_status($estimate->status,'',true); ?>
                    </div>
                </div>
                <div class="col-md-6 text-right _buttons">
                   <div class="visible-xs">
                    <div class="mtop10"></div>
                </div>
                <?php
                // Is not accepted, declined and expired
                if ($estimate->status != 4 && $estimate->status != 3 && $estimate->status != 5) {
                    $can_be_accepted = true;
                    if($identity_confirmation_enabled == '0'){
                        echo form_open($this->uri->uri_string(),array('class'=>'pull-right mright10'));
                        echo form_hidden('estimate_action',4);
                        echo '<button type="submit" data-loading-text="'._l('wait_text').'" autocomplete="off" class="btn btn-success action-btn accept"><i class="fa fa-check"></i> '._l('clients_accept_estimate').'</button>';
                        echo form_close();
                    } else {
                        echo '<button type="button" id="accept_action" class="btn btn-success mright10 pull-right action-btn accept"><i class="fa fa-check"></i> '._l('clients_accept_estimate').'</button>';
                    }
                } else if($estimate->status == 3){
                    if (($estimate->expirydate >= date('Y-m-d') || !$estimate->expirydate) && $estimate->status != 5) {
                        $can_be_accepted = true;
                        if($identity_confirmation_enabled == '0'){
                            echo form_open($this->uri->uri_string(),array('class'=>'pull-right mright10'));
                            echo form_hidden('estimate_action',4);
                            echo '<button type="submit" data-loading-text="'._l('wait_text').'" autocomplete="off" class="btn btn-success action-btn accept"><i class="fa fa-check"></i> '._l('clients_accept_estimate').'</button>';
                            echo form_close();
                        } else {
                            echo '<button type="button" id="accept_action" class="btn btn-success mright10 pull-right action-btn accept"><i class="fa fa-check"></i> '._l('clients_accept_estimate').'</button>';
                        }
                    }
                }
                // Is not accepted, declined and expired
               if ($estimate->status != 4 && $estimate->status != 3 && $estimate->status != 5) {
                    echo form_open($this->uri->uri_string(),array('class'=>'pull-right mright10'));
                    echo form_hidden('estimate_action',3);
                    echo '<button type="submit" data-loading-text="'._l('wait_text').'" autocomplete="off" class="btn btn-default action-btn accept"><i class="fa fa-remove"></i> '._l('clients_decline_estimate').'</button>';
                    echo form_close();
                }
                ?>
                <?php echo form_open($this->uri->uri_string(),array('class'=>'pull-right')); ?>
                <button type="submit" name="estimatepdf" class="btn btn-default action-btn download mright10" value="estimatepdf">
                    <i class="fa fa-file-pdf-o"></i> <?php echo _l('clients_invoice_html_btn_download'); ?>
                </button>
                <?php echo form_close(); ?>
            </div>
        </div>
        <div class="row mtop40">
            <div class="col-md-6 col-sm-6">
                <h4 class="bold"><?php echo format_estimate_number($estimate->id); ?></h4>
                <address>
                    <?php echo format_organization_info(); ?>
                </address>
                <div style="color:#424242;"><b>Bank Details </b> <br/> A/C No. - 8111580589 <br/> IFSC Code - KKBK0000649</div>
            </div>
            <div class="col-sm-6 text-right">
                <span class="bold"><?php echo _l('estimate_to'); ?>:</span>
                <address>
                 <?php echo format_customer_info($estimate, 'estimate', 'billing'); ?>
             </address>
             <!-- shipping details -->
             <?php if($estimate->include_shipping == 1 && $estimate->show_shipping_on_estimate == 1){ ?>
             <span class="bold"><?php echo _l('ship_to'); ?>:</span>
             <address>
                <?php echo format_customer_info($estimate, 'estimate', 'shipping'); ?>
            </address>
            <?php } ?>
            <p class="no-mbot">
                <span class="bold">
                    <?php echo _l('estimate_data_date'); ?>
                </span>
                <?php echo _d($estimate->date); ?>
            </p>
            <?php if(!empty($estimate->expirydate)){ ?>
            <p class="no-mbot">
                <span class="bold"><?php echo _l('estimate_data_expiry_date'); ?></span>
                <?php echo _d($estimate->expirydate); ?>
            </p>
            <?php } ?>
            <?php if(!empty($estimate->reference_no)){ ?>
            <p class="no-mbot">
                <span class="bold"><?php echo _l('reference_no'); ?>:</span>
                <?php echo $estimate->reference_no; ?>
            </p>
            <?php } ?>
            <?php if($estimate->sale_agent != 0 && get_option('show_sale_agent_on_estimates') == 1){ ?>
            <p class="no-mbot">
                <span class="bold"><?php echo _l('sale_agent_string'); ?>:</span>
                <?php echo get_staff_full_name($estimate->sale_agent); ?>
            </p>
            <?php } ?>
            <?php if($estimate->project_id != 0 && get_option('show_project_on_estimate') == 1){ ?>
            <p class="no-mbot">
                <span class="bold"><?php echo _l('project'); ?>:</span>
                <?php echo get_project_name_by_id($estimate->project_id); ?>
            </p>
            <?php } ?>
            <?php $pdf_custom_fields = get_custom_fields('estimate',array('show_on_pdf'=>1,'show_on_client_portal'=>1));
            foreach($pdf_custom_fields as $field){
                $value = get_custom_field_value($estimate->id,$field['id'],'estimate');
                if($value == ''){continue;} ?>
                <p class="no-mbot">
                    <span class="bold"><?php echo $field['name']; ?>: </span>
                    <?php echo $value; ?>
                </p>
                <?php } ?>
            </div>
        </div>
        <div class="row">
 



        <div class="col-md-12">
    <div class="table-responsive">
        <table class="table items">
            <thead>
                 <tr>
                   <th align="left">#</th>
                   <th class="description" width="50%" align="left">Item</th>
                   <th align="right">Qty</th>
                    <?php
                    if($estimate->measurement == 2){
                     echo  '<th align="right">Weight (Kg)</th>';
                    }
                    ?>
                   <?php
                    /*if($type=='rent'){
                      echo '<th align="right">Months</th>';
                    }*/
                    ?>  
                   <th align="right">Rate</th>
                   <?php
                   if($show_discount == 1){
                      echo '<th align="right">Discount</th>';
                   }
                   ?>
                   
                   <th align="right">Amount</th>
               </tr>
            </thead>
            <tbody>

              <?php

              if(!empty($estimate->items)){
                 $total_price = 0;
                 foreach ($estimate->items as $key => $value) {
                    $qty = $value['qty'];
                    $weight = $value['weight'];
                    $rate = $value['rate'];
                    $dis = $value['discount'];

                    if($value['is_sale'] == 0){
                       $totalmonths = ($value['months'] + ($value['days'] / 30));
                       $price = ($rate * $qty * $totalmonths * $weight);
                    }else{
                       $price = ($rate * $qty * $weight);
                    }

                    $dis_price = ($price*$dis/100);

                    $final_price = ($price - $dis_price);


                    $total_price += $final_price;

                    ?>
                       <tr class="sortable" data-item-id="<?php echo $value['id']; ?>">
                            <td class="dragger item_no ui-sortable-handle" align="center"><?php echo ++$key; ?></td>
                            <td class="description" align="left;"><span style="font-size:px;"><strong><?php echo $value['description']; ?></strong></span></td>
                            <td align="right"><?php echo $qty; ?></td>
                             <?php
                              if($estimate->measurement == 2){
                                echo  '<td align="right">'.$weight.'</td>';
                               }
                            /*if($type=='rent'){
                              echo '<td align="right">'.number_format($totalmonths, 2, '.', '').'</td>';
                            }*/
                            ?>
                            <td align="right"><?php echo $rate; ?></td>
                            <?php
                             if($show_discount == 1){
                                echo '<td align="right">'.$dis.'%'.'<br></td>';
                             }
                            ?>
                            
                            <td class="amount" align="right"><?php echo number_format($final_price, 2, '.', ''); ?></td>
                       </tr>
                    <?php
                 }
              }
              ?>

               
           </tbody>
        </table>
    </div>
</div>


             <?php
             $final_amount = 0;
           if(!empty($estimate->items)){
              ?>
              <div class="col-md-6 col-md-offset-6">
                 <table class="table text-right">
                      <tbody>
                          <tr id="subtotal">
                              <td><span class="bold">Sub Total</span></td>
                              <td class="subtotal"><?php echo number_format($total_price, 2, '.', ''); ?></td>
                          </tr>

                          <?php
                          $discount = 0;
                          if(!empty($estimate->discount_percent > 0)){
                             $discount = ($total_price*$estimate->discount_percent/100);
                             ?>
                             <tr class="tax-area">
                                 <td><span class="bold">Discount</span></td>
                                 <td ><?php echo '-'.number_format($discount, 2, '.', ''); ?></td>
                             </tr>
                             <?php
                          }


                          // For Including Other Charges Tax
                          if($estimate->other_charges_tax == 2){
                              if(!empty($othercharges)){
                                foreach ($othercharges as $othercharge) { 
                                      $total_price += $othercharge['total_maount'];
                                }
                              } 


                               if($othercharges[0]['category_name']!='')
                                {
                                  foreach ($othercharges as $othercharge) { 
                                    if(!empty($othercharge['category_name'])){

                                          //$final_amount += $othercharge['total_maount'];

                                         ?>
                                         <tr class="tax-area">
                                              <td class="bold"><?php echo $othercharge['category_name']; ?></td>
                                              <td><?php echo number_format($othercharge['total_maount'], 2, '.', ''); ?></td>
                                          </tr>
                                    <?php
                                    }
                                   
                                  }

                                }

                          }



                          $afr_dis_price = ($total_price - $discount);

                          $final_discount_price = ($afr_dis_price*18/100);
                          $final_amount = ($final_discount_price + $total_price - $discount);

                          if(!empty($estimate->tax_type == 1)){
                             $final_dis_price = ($afr_dis_price*9/100);

                             ?>
                                <tr class="tax-area">
                                    <td class="bold">SGST (9.00%)</td>
                                    <td><?php echo number_format($final_dis_price, 2, '.', ''); ?></td>
                                </tr>

                                <tr class="tax-area">
                                    <td class="bold">CGST (9.00%)</td>
                                    <td><?php echo number_format($final_dis_price, 2, '.', ''); ?></td>
                                </tr>
                             <?php

                          }else{
                             $final_dis_price = ($afr_dis_price*18/100);
                             ?>
                                <tr class="tax-area">
                                    <td class="bold">IGST (18.00%)</td>
                                    <td><?php echo number_format($final_dis_price, 2, '.', ''); ?></td>
                                </tr>
                             <?php
                          }


	                        if($estimate->other_charges_tax == 1){
	                          if($othercharges[0]['category_name']!='')
	                          {
	                            foreach ($othercharges as $othercharge) { 
	                              if(!empty($othercharge['category_name'])){

	                                    $final_amount += $othercharge['total_maount'];

	                                   ?>
	                                   <tr class="tax-area">
	                                        <td class="bold"><?php echo $othercharge['category_name']; ?></td>
	                                        <td><?php echo number_format($othercharge['total_maount'], 2, '.', ''); ?></td>
	                                    </tr>
	                              <?php
	                              }
	                             
	                            }

	                          }

	                        }
                          ?>

                          <tr>
                              <td><span class="bold">Total</span></td>
                              <td class="total"><?php echo number_format($final_amount, 2, '.', ''); ?></td>
                          </tr>

                      </tbody>
                  </table>
              </div>

              <?php
           }
           ?>





        <?php
        if(get_option('total_to_words_enabled') == 1){ ?>
        <div class="col-md-12 text-center">
           <p class="bold"><?php echo  ' In Words : '.convert_number_to_words($final_amount); ?></p>
       </div>
       <?php } 
       echo $months_info;

       ?>
       <?php if(count($estimate->attachments) > 0 && $estimate->visible_attachments_to_customer_found == true){ ?>
       <div class="clearfix"></div>
       <div class="col-md-12"><hr />
        <p class="bold mbot15 font-medium"><?php echo _l('estimate_files'); ?></p>
    </div>
    <?php foreach($estimate->attachments as $attachment){
        // Do not show hidden attachments to customer
        if($attachment['visible_to_customer'] == 0){continue;}
        $attachment_url = site_url('download/file/sales_attachment/'.$attachment['attachment_key']);
        if(!empty($attachment['external'])){
            $attachment_url = $attachment['external_link'];
        }
        ?>
        <div class="col-md-12 mbot15">
            <div class="pull-left"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i></div>
            <a href="<?php echo $attachment_url; ?>"><?php echo $attachment['file_name']; ?></a>
        </div>
        <?php } ?>
        <?php } ?>
        <?php if(!empty($estimate->clientnote)){ ?>
        <div class="col-md-12">
            <b><?php echo _l('estimate_note'); ?></b><br /><br /><?php echo $estimate->clientnote; ?>
        </div>
        <?php } ?>
        <?php if(!empty($estimate->terms)){ ?>
        <div class="col-md-12">
            <hr />
            <b><?php echo _l('terms_and_conditions'); ?></b><br /><br /><?php echo $estimate->terms; ?>
        </div>
        <?php } ?>
    </div>
</div>
</div>
</div>
<?php
if($identity_confirmation_enabled == '1' && $can_be_accepted){
    get_template_part('identity_confirmation_form',array('formData'=>form_hidden('estimate_action',4)));
}
?>
