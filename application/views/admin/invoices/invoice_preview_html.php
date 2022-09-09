    <?php
	if($_GET['type']=='sale')
	{
		$othercharges=get_pro_invoice_othercharges($invoice->id,'1');
		$is_sale=1;
		$type='sale';
		$profor='Invoice For Sale';
		$subtotal=$invoice->salesubtotal;
	}
	else if($_GET['type']=='rent')
	{
		$othercharges=get_pro_invoice_othercharges($invoice->id,'0');	
		$is_sale=0;
		$type='rent';
		$profor='Invoice For Rent';
		$subtotal=$invoice->rentsubtotal;
	}
	else
	{
		$othercharges=get_pro_invoice_othercharges($invoice->id,2);	
		$is_sale=2;
		$type='sale';
		$profor='Invoice For Rent & Sale';
		$subtotal=$invoice->salesubtotal+$invoice->rentsubtotal;
	}
	
    if($invoice->status == 6){ ?>
    <div class="alert alert-info">
      <?php echo _l('invoice_draft_status_info'); ?>
   </div>
   <?php } ?>
  <div id="invoice-preview">
   <div class="row">
      <?php
      if($invoice->recurring > 0 || $invoice->is_recurring_from != NULL) {
        $recurring_invoice = $invoice;
        $next_recurring_date_compare = to_sql_date($recurring_invoice->date);
        if($recurring_invoice->last_recurring_date){
         $next_recurring_date_compare = $recurring_invoice->last_recurring_date;
      }
      if($invoice->is_recurring_from != NULL){
         $recurring_invoice = $this->invoices_model->get($invoice->is_recurring_from);
         $next_recurring_date_compare = $recurring_invoice->last_recurring_date;
      }
      if ($recurring_invoice->custom_recurring == 0) {
        $recurring_invoice->recurring_type = 'MONTH';
     }
     $next_date = date('Y-m-d', strtotime('+' . $recurring_invoice->recurring . ' ' . strtoupper($recurring_invoice->recurring_type),strtotime($next_recurring_date_compare)));
     ?>
     <div class="col-md-12">
      <div class="mbot10">
         <?php if($invoice->is_recurring_from == null && $recurring_invoice->cycles > 0 && $recurring_invoice->cycles == $recurring_invoice->total_cycles) { ?>
         <div class="alert alert-info no-mbot">
            <?php echo _l('recurring_has_ended', _l('invoice_lowercase')); ?>
         </div>
         <?php } else { ?>

         <span class="label label-default padding-5">
            <?php if($invoice->status == 6){
               echo '<i class="fa fa-exclamation-circle fa-fw text-warning" data-toggle="tooltip" title="'._l('recurring_invoice_draft_notice').'"></i>';
            } ?>
            <?php echo _l('cycles_remaining'); ?>:
            <b>
               <?php if($recurring_invoice->cycles == 0){
                  echo _l('cycles_infinity');
               } else {
                  echo $recurring_invoice->cycles - $recurring_invoice->total_cycles;
               } ?>
            </b>
         </span>
         <?php } ?>
         <?php if($recurring_invoice->cycles == 0 || $recurring_invoice->cycles != $recurring_invoice->total_cycles){ ?>
         <?php echo '<span class="label label-default padding-5 mleft5"><i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-title="'._l('recurring_recreate_hour_notice',_l('invoice')).'"></i> ' . _l('next_invoice_date','<b>'._d($next_date).'</b>') .'</span>'; ?>
         <?php } ?>
      </div>
      <?php if($invoice->is_recurring_from != NULL){ ?>
      <?php echo '<p class="text-muted mtop15">'._l('invoice_recurring_from','<a href="'.admin_url('invoices/list_invoices/'.$invoice->is_recurring_from).'" onclick="init_invoice('.$invoice->is_recurring_from.');return false;">'.format_invoice_number($invoice->is_recurring_from).'</a></p>'); ?>
      <?php } ?>
   </div>
   <div class="clearfix"></div>
   <hr class="hr-10" />
   <?php } ?>
   <?php if($invoice->project_id != 0){ ?>
   <div class="col-md-12">
      <h4 class="font-medium mtop15 mbot20"><?php echo _l('related_to_project',array(
         _l('invoice_lowercase'),
         _l('project_lowercase'),
         '<a href="'.admin_url('projects/view/'.$invoice->project_id).'" target="_blank">' . $invoice->project_data->name . '</a>',
         )); ?></h4>
      </div>
      <?php } ?>
      <div class="col-md-6 col-sm-6">
         <h4 class="bold">
            <?php
            $tags = get_tags_in($invoice->id,'invoice');
            if(count($tags) > 0){
               echo '<i class="fa fa-tag" aria-hidden="true" data-toggle="tooltip" data-title="'.implode(', ',$tags).'"></i>';
            }
            ?>
            <a href="<?php echo admin_url('invoices/invoice/'.$invoice->id); ?>">
               <span id="invoice-number">
                  <?php echo format_invoice_number($invoice->id); ?>
               </span>
            </a>
         </h4>
         <address>
            <?php echo format_organization_info(); ?>
         </address>
      </div>
      <div class="col-sm-6 text-right">
         <span class="bold"><?php echo _l('invoice_bill_to'); ?>:</span>
         <address>
            <?php echo format_customer_info($invoice, 'invoice', 'billing', true); ?>
         </address>
         <?php if($invoice->include_shipping == 1 && $invoice->show_shipping_on_invoice == 1){ ?>
         <span class="bold"><?php echo _l('ship_to'); ?>:</span>
         <address>
            <?php echo format_customer_info($invoice, 'invoice', 'shipping'); ?>
         </address>
         <?php } ?>
        
         <?php if($invoice->sale_agent != 0 && get_option('show_sale_agent_on_invoices') == 1){ ?>
         <p class="no-mbot">
            <span class="bold"><?php echo _l('sale_agent_string'); ?>: </span>
            <?php echo get_staff_full_name($invoice->sale_agent); ?>
         </p>
         <?php } ?>
         <?php if($invoice->project_id != 0 && get_option('show_project_on_invoice') == 1){ ?>
         <p class="no-mbot">
            <span class="bold"><?php echo _l('project'); ?>:</span>
            <?php echo get_project_name_by_id($invoice->project_id); ?>
         </p>
         <?php } ?>
         <?php $pdf_custom_fields = get_custom_fields('invoice',array('show_on_pdf'=>1));
         foreach($pdf_custom_fields as $field){
          $value = get_custom_field_value($invoice->id,$field['id'],'invoice');
          if($value == ''){continue;} ?>
          <p class="no-mbot">
            <span class="bold"><?php echo $field['name']; ?>: </span>
            <?php echo $value; ?>
         </p>
         <?php } ?>
      </div>
   </div>

<?php
   $item_info = $this->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$invoice->id."' ")->row();

    $type = '';
    if(!empty($item_info)){
        if($item_info->is_sale == 0){
            $type = 'rent';
        }elseif($item_info->is_sale == 1){
            $type = 'sale';
        }
    }
?>

   <!-- <div class="row">
      <div class="col-md-12">
         <div class="table-responsive">
            <table class="table items invoice-items-preview">
               <thead>
                   <tr>
                        <th align="center">#</th>
                        <th class="description" align="left">Item</th>
                        <th align="right">Qty</th>
                        <?php
                        if($type=='rent'){
                          echo '<th align="right">Months</th>';
                        }
                        ?>                
                        <th align="right">Rate</th>
                        <th align="right">Discount</th>
                        <th align="right">Amount</th>
                    </tr>
             </thead>
           

            <tbody>
                              <?php
                             

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

                                  ?>

                                  <tr class="sortable" data-item-id="<?php echo $value['id']; ?>">
                                      <td class="dragger item_no ui-sortable-handle" align="center"><?php echo ++$key; ?></td>
                                      <td class="description" align="left;"><span style="font-size:px;"><strong><?php echo $value['description']; ?></strong></span></td>
                                      <td align="right"><?php echo $qty; ?></td>
                                      <?php
                                      if($type=='rent'){
                                        echo '<td align="right">'.number_format($totalmonths, 2, '.', '').'</td>';
                                      }
                                      ?>
                                      <td align="right"><?php echo $rate; ?></td>
                                      <td align="right"><?php echo $dis.'%'; ?><br></td>
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
   <div class="col-md-4 col-md-offset-8">
      <table class="table text-right">
         <tbody>
            

                        <tr id="subtotal">
                        <td><span class="bold">Sub Total</span>
                        </td>
                        <td class="subtotal"><?php echo number_format($total_price, 2, '.', ''); ?></td>
                    </tr>


                     <?php
                          $discount = 0;
                          if(!empty($invoice->discount_percent > 0)){
                             $discount = ($total_price*$invoice->discount_percent/100);
                             ?>
                             <tr class="tax-area">
                                 <td><span class="bold">Discount</span></td>
                                 <td ><?php echo '-'.number_format($discount, 2, '.', ''); ?></td>
                             </tr>
                             <?php
                          }



                          $afr_dis_price = ($total_price - $discount);

                          $final_discount_price = ($afr_dis_price*18/100);
                          $final_amount = ($final_discount_price + $total_price - $discount);

                          if(!empty($invoice->tax_type == 1)){
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



                          ?>

                          <tr>
                              <td><span class="bold">Total</span></td>
                              <td class="total"><?php echo number_format($final_amount, 2, '.', ''); ?></td>
                          </tr>



`
                        <?php 

                        $paid_amt = format_money(sum_from_table('tblinvoicepaymentrecords',array('field'=>'amount','where'=>array('invoiceid'=>$invoice->id))),$invoice->symbol);
                        $due_amt = ($final_amount-$paid_amt);

                        if(count($invoice->payments) > 0 && get_option('show_total_paid_on_invoice') == 1){ ?>
                        <tr>
                            <td><span class="bold"><?php echo _l('invoice_total_paid'); ?></span></td>
                            <td>
                                <?php echo '-' . format_money(sum_from_table('tblinvoicepaymentrecords',array('field'=>'amount','where'=>array('invoiceid'=>$invoice->id))),$invoice->symbol); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if(get_option('show_credits_applied_on_invoice') == 1 && $credits_applied = total_credits_applied_to_invoice($invoice->id)){ ?>
                            <tr>
                               <td><span class="bold"><?php echo _l('applied_credits'); ?></span></td>
                               <td>
                                <?php echo '-' . format_money($credits_applied,$invoice->symbol); ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if(get_option('show_amount_due_on_invoice') == 1 && $invoice->status != 5) { ?>
                       
                        <tr>
                            <td><span class="<?php if($due_amt > 0){echo 'text-danger ';} ?>bold"><?php echo _l('invoice_amount_due'); ?></span></td>
                            <td>
                                <span class="<?php if($due_amt > 0){echo 'text-danger';} ?>">
                                    <?php echo format_money($due_amt,$invoice->symbol); ?>
                                </span>
                            </td>
                        </tr>
                        <?php } ?>


         </tbody>
         </table>
      </div>
   </div> -->
   <?php if(count($invoice->attachments) > 0){ ?>
   <div class="clearfix"></div>
   <hr />
   <p class="bold text-muted"><?php echo _l('invoice_files'); ?></p>
   <?php foreach($invoice->attachments as $attachment){
      $attachment_url = site_url('download/file/sales_attachment/'.$attachment['attachment_key']);
      if(!empty($attachment['external'])){
        $attachment_url = $attachment['external_link'];
     }
     ?>
     <div class="mbot15 row inline-block full-width" data-attachment-id="<?php echo $attachment['id']; ?>">
      <div class="col-md-8">
         <div class="pull-left"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i></div>
         <a href="<?php echo $attachment_url; ?>" target="_blank"><?php echo $attachment['file_name']; ?></a>
         <br />
         <small class="text-muted"> <?php echo $attachment['filetype']; ?></small>
      </div>
      <div class="col-md-4 text-right">
         <?php if($attachment['visible_to_customer'] == 0){
            $icon = 'fa-toggle-off';
            $tooltip = _l('show_to_customer');
         } else {
            $icon = 'fa-toggle-on';
            $tooltip = _l('hide_from_customer');
         }
         ?>
         <a href="#" data-toggle="tooltip" onclick="toggle_file_visibility(<?php echo $attachment['id']; ?>,<?php echo $invoice->id; ?>,this); return false;" data-title="<?php echo $tooltip; ?>"><i class="fa <?php echo $icon; ?>" aria-hidden="true"></i></a>
         <?php if($attachment['staffid'] == get_staff_user_id() || is_admin()){ ?>
         <a href="#" class="text-danger" onclick="delete_invoice_attachment(<?php echo $attachment['id']; ?>); return false;"><i class="fa fa-times"></i></a>
         <?php } ?>
      </div>
   </div>
   <?php } ?>
   <?php } ?>
   <hr />
   <?php if($invoice->clientnote != ''){ ?>
   <div class="col-md-12 row mtop15">
      <p class="bold text-muted"><?php echo _l('invoice_note'); ?></p>
      <p><?php echo $invoice->clientnote; ?></p>
   </div>
   <?php } ?>
   <?php if($invoice->terms != ''){ ?>
   <div class="col-md-12 row mtop15">
      <p class="bold text-muted"><?php echo _l('terms_and_conditions'); ?></p>
      <p><?php echo $invoice->terms; ?></p>
   </div>
   <?php } ?>
</div>
