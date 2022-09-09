<?php echo form_hidden('_attachment_sale_id',$estimate->id); ?>
<?php echo form_hidden('_attachment_sale_type','estimate');
$checkproposal=$this->db->query("SELECT * FROM `tblestimates` WHERE `addedfrom`='".get_staff_user_id()."' AND `id`='".$estimate->id."'")->result_array();
$proposalapproval=$this->db->query("SELECT * FROM `tblestimatestaffapproval` WHERE `lead_id`='".$estimate->id."'")->row_array();
$othercharges=get_pro_estimate_othercharges($estimate->id,'2');
?>

<div class="col-md-12 no-padding">
   <div class="panel_s">
      <div class="panel-body">
         <div class="horizontal-scrollable-tabs preview-tabs-top">
            <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
            <div class="horizontal-tabs">
               <ul class="nav nav-tabs nav-tabs-horizontal mbot15" role="tablist">
                  <li role="presentation" class="active">
                     <a href="#tab_estimate" aria-controls="tab_estimate" role="tab" data-toggle="tab">
                     <?php echo _l('estimate'); ?>
                     </a>
                  </li>
                  <li role="presentation">
                     <a href="#tab_tasks" onclick="init_rel_tasks_table(<?php echo $estimate->id; ?>,'estimate'); return false;" aria-controls="tab_tasks" role="tab" data-toggle="tab">
                     <?php echo _l('tasks'); ?>
                     </a>
                  </li>
                  <li role="presentation">
                     <a href="#tab_activity" aria-controls="tab_activity" role="tab" data-toggle="tab">
                     <?php echo _l('estimate_view_activity_tooltip'); ?>
                     </a>
                  </li>
                  <li role="presentation">
                     <a href="#tab_reminders" onclick="initDataTable('.table-reminders', admin_url + 'misc/get_reminders/' + <?php echo $estimate->id ;?> + '/' + 'estimate', undefined, undefined, undefined,[1,'asc']); return false;" aria-controls="tab_reminders" role="tab" data-toggle="tab">
                     <?php echo _l('estimate_reminders'); ?>
                     <?php
                        $total_reminders = total_rows('tblreminders',
                          array(
                           'isnotified'=>0,
                           'staff'=>get_staff_user_id(),
                           'rel_type'=>'estimate',
                           'rel_id'=>$estimate->id
                           )
                          );
                        if($total_reminders > 0){
                          echo '<span class="badge">'.$total_reminders.'</span>';
                        }
                        ?>
                     </a>
                  </li>
				  
                  <li role="presentation" class="tab-separator">
                     <a href="#tab_notes" onclick="get_sales_notes(<?php echo $estimate->id; ?>,'estimates'); return false" aria-controls="tab_notes" role="tab" data-toggle="tab">
                     </span><?php echo _l('estimate_notes'); ?> <span class="notes-total">
                     <?php if($totalNotes > 0){ ?>
                     <span class="badge"><?php echo $totalNotes; ?><span>
                     <?php } ?>
                     </span>
                     </a>
                  </li>
				  <?php
					if(!empty($proposalapproval) || !empty($checkproposal))
					{?>
				   <li role="presentation" class="tab-separator">
					  <a href="#tab_approval"  role="tab" data-toggle="tab">
					  <?php echo 'Performance Invoice Approval'; ?>
					  </a>
				   </li>
				   <?php
					}?>
                  <li role="presentation" data-toggle="tooltip" title="<?php echo _l('emails_tracking'); ?>" class="tab-separator">
                     <a href="#tab_emails_tracking" aria-controls="tab_emails_tracking" role="tab" data-toggle="tab">
                     <?php if(!is_mobile()){ ?>
                     <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                     <?php } else { ?>
                     <?php echo _l('emails_tracking'); ?>
                     <?php } ?>
                     </a>
                  </li>
                  <li role="presentation" data-toggle="tooltip" data-title="<?php echo _l('view_tracking'); ?>" class="tab-separator">
                     <a href="#tab_views" aria-controls="tab_views" role="tab" data-toggle="tab">
                     <?php if(!is_mobile()){ ?>
                     <i class="fa fa-eye"></i>
                     <?php } else { ?>
                     <?php echo _l('view_tracking'); ?>
                     <?php } ?>
                     </a>
                  </li>
                  <li role="presentation" data-toggle="tooltip" data-title="<?php echo _l('toggle_full_view'); ?>" class="tab-separator toggle_view">
                     <a href="#" onclick="small_table_full_view(); return false;">
                     <i class="fa fa-expand"></i></a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="row">
            <div class="col-md-3">
               <?php echo format_estimate_status($estimate->status,'mtop5');  ?>
            </div>
            <div class="col-md-9">
               <div class="visible-xs">
                  <div class="mtop10"></div>
               </div>
               <div class="pull-right _buttons">
                  <?php if(check_permission_page(6,'edit')){ ?>
                  <a href="<?php echo admin_url('estimates/performerinvoice/'.$estimate->id); ?>" class="btn btn-default btn-with-tooltip" data-toggle="tooltip" title="<?php echo _l('edit_estimate_tooltip'); ?>" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
                  <?php } 
				  $check_estimate_rent_item=check_estimate_item($estimate->id,0);
				  $check_estimate_sale_item=check_estimate_item($estimate->id,1);
				  ?>
                  <div class="btn-group">
                     <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-pdf-o"></i><?php if(is_mobile()){echo ' PDF';} ?> <span class="caret"></span></a>
                     <ul class="dropdown-menu dropdown-menu-right">
						<?php if($check_estimate_sale_item>=1){?> <li class="hidden-xs"><a href="<?php echo admin_url('estimates/download_pdf/'.$estimate->id.'?type=sale'); ?>"><?php echo _l('view_sale_pdf'); ?></a></li><?php }?>
						<?php if($check_estimate_rent_item>=1){?> <li class="hidden-xs"><a href="<?php echo admin_url('estimates/download_pdf/'.$estimate->id.'?type=rent'); ?>"><?php echo _l('view_rent_pdf'); ?></a></li><?php }?>
						<?php if($check_estimate_sale_item>=1){?> <li class="hidden-xs"><a href="<?php echo admin_url('estimates/download_pdf/'.$estimate->id.'?type=sale'); ?>" target="_blank"><?php echo _l('view_sale_pdf_in_new_window'); ?></a></li><?php }?>
						<?php if($check_estimate_rent_item>=1){?> <li class="hidden-xs"><a href="<?php echo admin_url('estimates/download_pdf/'.$estimate->id.'?type=rent'); ?>" target="_blank"><?php echo _l('view_rent_pdf_in_new_window'); ?></a></li><?php }?>
						<?php /* if($check_estimate_sale_item>=1){?> <li><a href="<?php echo admin_url('estimates/pdf/'.$estimate->id.'?type=sale'); ?>"><?php echo _l('download_sale'); ?></a></li><?php }?>
						<?php if($check_estimate_rent_item>=1){?> <li><a href="<?php echo admin_url('estimates/pdf/'.$estimate->id.'?type=rent'); ?>"><?php echo _l('download_rent'); ?></a></li><?php }*/ ?>
					   <li class="hidden-xs"><a href="<?php echo admin_url('estimates/download_pdf/'.$estimate->id.'?output_type=I&type=both'); ?>"><?php echo _l('view_pdf'); ?></a></li>
                        <li class="hidden-xs"><a href="<?php echo admin_url('estimates/download_pdf/'.$estimate->id.'?output_type=I&type=both'); ?>" target="_blank"><?php echo _l('view_pdf_in_new_window'); ?></a></li>
                        <li><a href="<?php echo admin_url('estimates/download_pdf/'.$estimate->id); ?>"><?php echo _l('download'); ?></a></li>
                        <li><a href="<?php echo admin_url('chalan/created/'.$estimate->id); ?>"><?php echo _l('view_created_chalan'); ?></a></li>
                        <li><a href="<?php echo admin_url('chalan/index/'.$estimate->id); ?>"><?php echo _l('view_pending_chalan'); ?></a></li>
                         <li><a href="<?php echo admin_url('chalan/return_challan/'.$estimate->id); ?>">Return Challan</a></li>
                        <!-- <li>
                           <a href="<?php echo admin_url('estimates/download_pdf/'.$estimate->id.'?print=true'); ?>" target="_blank">
                           <?php echo _l('print'); ?>
                           </a>
                        </li> -->
                     </ul>
                  </div>
                  <?php
                     $_tooltip = _l('estimate_sent_to_email_tooltip');
                     $_tooltip_already_send = '';
                     if($estimate->sent == 1){
                        $_tooltip_already_send = _l('estimate_already_send_to_client_tooltip',time_ago($estimate->datesend));
                     }
                     ?>
                  <?php if(!empty($estimate->clientid)){ ?>
                  <a href="#" class="estimate-send-to-client btn btn-default btn-with-tooltip" data-toggle="tooltip" title="<?php echo $_tooltip; ?>" data-placement="bottom"><span data-toggle="tooltip" data-title="<?php echo $_tooltip_already_send; ?>"><i class="fa fa-envelope"></i></span></a>
                  <?php } ?>
                  <div class="btn-group">
                     <button type="button" class="btn btn-default pull-left dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <?php echo _l('more'); ?> <span class="caret"></span>
                     </button>
                     <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                           <a href="<?php echo site_url('estimate/' . $estimate->id . '/' .  $estimate->hash) ?>" target="_blank">
                           <?php echo _l('view_estimate_as_client'); ?>
                           </a>
                        </li>
                        <?php if(!empty($estimate->expirydate) && date('Y-m-d') < $estimate->expirydate && ($estimate->status == 2 || $estimate->status == 5) && is_estimates_expiry_reminders_enabled()){ ?>
                        <li>
                           <a href="<?php echo admin_url('estimates/send_expiry_reminder/'.$estimate->id); ?>">
                           <?php echo _l('send_expiry_reminder'); ?>
                           </a>
                        </li>
                        <?php } ?>
                        <li>
                           <a href="#" data-toggle="modal" data-target="#sales_attach_file"><?php echo _l('invoice_attach_file'); ?></a>
                        </li>
                        <?php if($estimate->invoiceid == NULL){
                          // if(has_permission('estimates','','edit')){
                           if(check_permission_page(6,'edit')){
                             foreach($estimate_statuses as $status){
                               if($estimate->status != $status){ ?>
                        <li>
                           <a href="<?php echo admin_url() . 'estimates/mark_action_status/'.$status.'/'.$estimate->id; ?>">
                           <?php echo _l('estimate_mark_as',format_estimate_status($status,'',false)); ?></a>
                        </li>
                        <?php }
                           }
                           ?>
                        <?php } ?>
                        <?php } ?>
                        <?php if(has_permission('estimates','','create')){ ?>
                        <!-- <li>
                           <a href="<?php echo admin_url('estimates/copy/'.$estimate->id); ?>">
                           <?php echo _l('copy_estimate'); ?>
                           </a>
                        </li> -->
                        <?php } ?>
                        <?php if(!empty($estimate->signature) && (check_permission_page(6,'delete')) ){ ?>
                        <li>
                           <a href="<?php echo admin_url('estimates/clear_signature/'.$estimate->id); ?>" class="_delete">
                           <?php echo _l('clear_signature'); ?>
                           </a>
                        </li>
                        <?php } ?>
                        <?php if(check_permission_page(6,'delete')){ ?>
                        <?php
                           if((get_option('delete_only_on_last_estimate') == 1 && is_last_estimate($estimate->id)) || (get_option('delete_only_on_last_estimate') == 0)){ ?>
                        <li>
                           <a href="<?php echo admin_url('estimates/delete/'.$estimate->id); ?>" class="text-danger delete-text _delete"><?php echo _l('delete_estimate_tooltip'); ?></a>
                        </li>
                        <?php
                           }
                           }
                           ?>
                     </ul>
                  </div>
                  <?php if($estimate->invoiceid == NULL){ ?>
                  <?php //if(has_permission('invoices','','create') && !empty($estimate->clientid)){ ?>
                  <div class="btn-group pull-right mleft5">
                     
                     <?php
                     $check = check_already_converted($estimate->id,'estimate');
                     if($check == 0){
                        if(check_permission_page('17,18','create')){
                        ?>

                        <!-- <a href="<?php echo admin_url('estimates/invoices/'.$estimate->id); ?>" class="btn btn-success dropdown-toggle"><?php echo _l('estimate_convert_to_invoice'); ?></a>  -->
                        <a href="javascript:void(0);" data-estimateid="<?php echo $estimate->id; ?>" class="btn btn-success dropdown-toggle estimateconvert"><?php echo _l('estimate_convert_to_invoice'); ?></a> 
                        <?php
                      }
                     }else{
                        if ($estimate->converted_type == 2){
                     ?>
                        <a href="javascript:void(0);" data-estimateid="<?php echo $estimate->id; ?>" class="btn btn-success dropdown-toggle estimateconvert"><?php echo _l('estimate_convert_to_invoice'); ?></a> 
                     <?php      
                        }
                     }
                     ?>

                   
                  </div>
                  <?php //} ?>
                  <?php } else { ?>
                  <a href="<?php echo admin_url('invoices/list_invoices/'.$estimate->invoice->id); ?>" data-placement="bottom" data-toggle="tooltip" title="<?php echo _l('estimate_invoiced_date',_dt($estimate->invoiced_date)); ?>"class="btn mleft10 btn-info"><?php echo format_invoice_number($estimate->invoice->id); ?></a>
                  <?php } ?>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <hr class="hr-panel-heading" />
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane ptop10 active" id="tab_estimate">
               <div id="estimate-preview">
                  <div class="row">
                     <?php if($estimate->status == 4 && !empty($estimate->acceptance_firstname) && !empty($estimate->acceptance_lastname) && !empty($estimate->acceptance_email)){ ?>
                     <div class="col-md-12">
                        <div class="alert alert-info mbot15">
                           <?php echo _l('accepted_identity_info',array(
                              _l('estimate_lowercase'),
                              '<b>'.$estimate->acceptance_firstname . ' ' . $estimate->acceptance_lastname . '</b> (<a href="mailto:'.$estimate->acceptance_email.'">'.$estimate->acceptance_email.'</a>)',
                              '<b>'. _dt($estimate->acceptance_date).'</b>',
                              '<b>'.$estimate->acceptance_ip.'</b>'.(is_admin() ? '&nbsp;<a href="'.admin_url('estimates/clear_acceptance_info/'.$estimate->id).'" class="_delete text-muted" data-toggle="tooltip" data-title="'._l('clear_this_information').'"><i class="fa fa-remove"></i></a>' : '')
                              )); ?>
                        </div>
                     </div>
                     <?php } ?>
                     <?php if($estimate->project_id != 0){ ?>
                     <div class="col-md-12">
                        <h4 class="font-medium mbot15"><?php echo _l('related_to_project',array(
                           _l('estimate_lowercase'),
                           _l('project_lowercase'),
                           '<a href="'.admin_url('projects/view/'.$estimate->project_id).'" target="_blank">' . $estimate->project_data->name . '</a>',
                           )); ?></h4>
                     </div>
                     <?php } ?>
                     <div class="col-md-6 col-sm-6">
                        <h4 class="bold">
                           <?php
                              $tags = get_tags_in($estimate->id,'estimate');
                              if(count($tags) > 0){
                                echo '<i class="fa fa-tag" aria-hidden="true" data-toggle="tooltip" data-title="'.implode(', ',$tags).'"></i>';
                              }
                              ?>
                           <a href="<?php echo admin_url('estimates/estimate/'.$estimate->id); ?>">
                           <span id="estimate-number">
                           <?php echo format_estimate_number($estimate->id); ?>
                           </span>
                           </a>
                        </h4>
                        <address>
                           <?php echo format_organization_info(); ?>
                        </address>
                     </div>
                     <div class="col-sm-6 text-right">
                        <span class="bold"><?php echo _l('estimate_to'); ?>:</span>
                        <address>
                           <?php echo format_customer_info($estimate, 'estimate', 'billing', true); ?>
                        </address>
                        <?php if($estimate->include_shipping == 1 && $estimate->show_shipping_on_estimate == 1){ ?>
                        <span class="bold"><?php echo _l('ship_to'); ?>:</span>
                        <address>
                           <?php echo format_customer_info($estimate, 'estimate', 'shipping'); ?>
                        </address>
                        <?php } ?>
                        <p class="no-mbot">
                           <span class="bold">
                           <?php echo _l('estimate_data_date'); ?>:
                           </span>
                           <?php echo $estimate->date; ?>
                        </p>
                        <?php if(!empty($estimate->expirydate)){ ?>
                        <p class="no-mbot">
                           <span class="bold"><?php echo _l('estimate_data_expiry_date'); ?>:</span>
                           <?php echo $estimate->expirydate; ?>
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
                        <?php $pdf_custom_fields = get_custom_fields('estimate',array('show_on_pdf'=>1));
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
                     <!-- <div class="col-md-12">
                        <div class="table-responsive">
                           <table class="table items estimate-items-preview">
                              <thead>
                                 <tr>
                                    <th align="left">#</th>
                                    <th class="description" width="50%" align="left"><?php echo _l('estimate_table_item_heading'); ?></th>
                                    <?php
                                       $custom_fields = get_items_custom_fields_for_table_html($estimate->id,'estimate');
                                       foreach($custom_fields as $cf){
                                         echo '<th class="custom_field" align="left">' . $cf['name'] . '</th>';
                                       }
                                       ?>
                                    <?php
                                       $qty_heading = _l('estimate_table_quantity_heading');
                                       if($estimate->show_quantity_as == 2){
                                        $qty_heading = _l('estimate_table_hours_heading');
                                       } else if($estimate->show_quantity_as == 3){
                                        $qty_heading = _l('estimate_table_quantity_heading') .'/'._l('estimate_table_hours_heading');
                                       }
                                       ?>
                                    <th align="right"><?php echo $qty_heading; ?></th>
                                    <th align="right"><?php echo _l('estimate_table_rate_heading'); ?></th>
                                    <?php if(get_option('show_tax_per_item') == 1){ ?>
                                    <th align="right"><?php echo _l('estimate_table_tax_heading'); ?></th>
                                    <?php } ?>
                                    <th align="right"><?php echo _l('estimate_table_amount_heading'); ?></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $items_data = get_table_items_and_taxe($estimate->items,'estimate',true,2);
                                    $taxes = $items_data['taxes'];
                                    echo $items_data['html'];
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div> -->
                     <!-- <div class="col-md-4 col-md-offset-8">
                        <table class="table text-right">
                           <tbody>
                              <tr id="subtotal">
                                 <td><span class="bold"><?php echo _l('estimate_subtotal'); ?></span>
                                 </td>
                                 <td class="subtotal">
                                    <?php echo format_money($estimate->subtotal,$estimate->symbol); ?>
                                 </td>
                              </tr>
                              <?php if(is_sale_discount_applied($estimate)){ ?>
                              <tr>
                                 <td>
                                    <span class="bold"><?php echo _l('estimate_discount'); ?>
                                    <?php if(is_sale_discount($estimate,'percent')){ ?>
                                    (<?php echo _format_number($estimate->discount_percent,true); ?>%)
                                    <?php } ?></span>
                                 </td>
                                 <td class="discount">
                                    <?php echo '-' . format_money($estimate->discount_total,$estimate->symbol); ?>
                                 </td>
                              </tr>
                              <?php } ?>
                              <?php
                                 foreach($taxes as $tax){
                                     echo '<tr class="tax-area"><td class="bold">'.$tax['taxname'].' ('._format_number($tax['taxrate']).'%)</td><td>'.format_money($tax['total_tax'], $estimate->symbol).'</td></tr>';
                                 }
                                 ?>
                              <?php if((int)$estimate->adjustment != 0){ ?>
                              <tr>
                                 <td>
                                    <span class="bold"><?php echo _l('estimate_adjustment'); ?></span>
                                 </td>
                                 <td class="adjustment">
                                    <?php echo format_money($estimate->adjustment,$estimate->symbol); ?>
                                 </td>
                              </tr>
                              <?php } ?>
                              <tr>
                                 <td><span class="bold"><?php echo _l('estimate_total'); ?></span>
                                 </td>
                                 <td class="total">
                                    <?php echo format_money($estimate->total,$estimate->symbol); ?>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div> -->
               <?php
               /*
               ?>
               <div class="col-md-12">
                   <div class="table-responsive">
                       <table class="table items estimate-items-preview">
                           <thead>
                               <tr>
                                   <th align="left">#</th>
                                   <th class="description" width="50%" align="left">Item</th>
                                   <th align="right">Qty</th>
                                   <th align="right">Rate</th>
                                   <th align="right">Discount</th>
                                   <th align="right">Amount</th>
                               </tr>
                           </thead>
                           <tbody class="ui-sortable">

                              <?php

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

                                    ?>
                                       <tr class="sortable" data-item-id="<?php echo $value['id']; ?>">
                                            <td class="dragger item_no ui-sortable-handle" align="center"><?php echo ++$key; ?></td>
                                            <td class="description" align="left;"><span style="font-size:px;"><strong><?php echo $value['description']; ?></strong></span></td>
                                            <td align="right"><?php echo $qty; ?></td>
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

               <?php
               if(!empty($estimate->items)){
                  ?>
                  <div class="col-md-4 col-md-offset-8">
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

                          </tbody>
                      </table>
                  </div>

                  <?php
               }*/
               ?>





                     <?php if(count($estimate->attachments) > 0){ ?>
                     <div class="clearfix"></div>
                     <hr />
                     <div class="col-md-12">
                        <p class="bold text-muted"><?php echo _l('estimate_files'); ?></p>
                     </div>
                     <?php foreach($estimate->attachments as $attachment){
                        $attachment_url = site_url('download/file/sales_attachment/'.$attachment['attachment_key']);
                        if(!empty($attachment['external'])){
                          $attachment_url = $attachment['external_link'];
                        }
                        ?>
                     <div class="mbot15 row col-md-12" data-attachment-id="<?php echo $attachment['id']; ?>">
                        <div class="col-md-8">
                           <div class="pull-left"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i></div>
                           <a href="<?php echo $attachment_url; ?>" target="_blank"><?php echo $attachment['file_name']; ?></a>
                           <br />
                           <small class="text-muted"> <?php echo $attachment['filetype']; ?></small>
                        </div>
                        <div class="col-md-4 text-right">
                           <?php if($attachment['visible_to_customer'] == 0){
                              $icon = 'fa fa-toggle-off';
                              $tooltip = _l('show_to_customer');
                              } else {
                              $icon = 'fa fa-toggle-on';
                              $tooltip = _l('hide_from_customer');
                              }
                              ?>
                           <a href="#" data-toggle="tooltip" onclick="toggle_file_visibility(<?php echo $attachment['id']; ?>,<?php echo $estimate->id; ?>,this); return false;" data-title="<?php echo $tooltip; ?>"><i class="<?php echo $icon; ?>" aria-hidden="true"></i></a>
                           <?php if($attachment['staffid'] == get_staff_user_id() || is_admin()){ ?>
                           <a href="#" class="text-danger" onclick="delete_estimate_attachment(<?php echo $attachment['id']; ?>); return false;"><i class="fa fa-times"></i></a>
                           <?php } ?>
                        </div>
                     </div>
                     <?php } ?>
                     <?php } ?>
                     <?php if($estimate->clientnote != ''){ ?>
                     <div class="col-md-12 mtop15">
                        <p class="bold text-muted"><?php echo _l('estimate_note'); ?></p>
                        <p><?php echo $estimate->clientnote; ?></p>
                     </div>
                     <?php } ?>
                     <?php if($estimate->terms != ''){ ?>
                     <div class="col-md-12 mtop15">
                        <p class="bold text-muted"><?php echo _l('terms_and_conditions'); ?></p>
                        <p><?php echo $estimate->terms; ?></p>
                     </div>
                     <?php } ?>
                  </div>
               </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_tasks">
               <?php init_relation_tasks_table(array('data-new-rel-id'=>$estimate->id,'data-new-rel-type'=>'estimate')); ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_reminders">
               <a href="#" data-toggle="modal" class="btn btn-info" data-target=".reminder-modal-estimate-<?php echo $estimate->id; ?>"><i class="fa fa-bell-o"></i> <?php echo _l('estimate_set_reminder_title'); ?></a>
               <hr />
               <?php render_datatable(array( _l( 'reminder_description'), _l( 'reminder_date'), _l( 'reminder_staff'), _l( 'reminder_is_notified')), 'reminders'); ?>
               <?php $this->load->view('admin/includes/modals/reminder',array('id'=>$estimate->id,'name'=>'estimate','members'=>$members,'reminder_title'=>_l('estimate_set_reminder_title'))); ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_emails_tracking">
               <?php
                  $this->load->view('admin/includes/emails_tracking',array(
                     'tracked_emails'=>
                     get_tracked_emails($estimate->id, 'estimate'))
                  );
                  ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_notes">
               <?php echo form_open(admin_url('estimates/add_note/'.$estimate->id),array('id'=>'sales-notes','class'=>'estimate-notes-form')); ?>
               <?php echo render_textarea('description'); ?>
               <div class="text-right">
                  <button type="submit" class="btn btn-info mtop15 mbot15"><?php echo _l('estimate_add_note'); ?></button>
               </div>
               <?php echo form_close(); ?>
               <hr />
               <div class="panel_s mtop20 no-shadow" id="sales_notes_area">
               </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab_activity">
               <div class="row">
                  <div class="col-md-12">
                     <div class="activity-feed">
                        <?php foreach($activity as $activity){
                           $_custom_data = false;
                           ?>
                        <div class="feed-item" data-sale-activity-id="<?php echo $activity['id']; ?>">
                           <div class="date">
                              <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($activity['date']); ?>">
                              <?php echo time_ago($activity['date']); ?>
                              </span>
                           </div>
                           <div class="text">
                              <?php if(is_numeric($activity['staffid']) && $activity['staffid'] != 0){ ?>
                              <a href="<?php echo admin_url('profile/'.$activity["staffid"]); ?>">
                              <?php echo staff_profile_image($activity['staffid'],array('staff-profile-xs-image pull-left mright5'));
                                 ?>
                              </a>
                              <?php } ?>
                              <?php
                                 $additional_data = '';
                                 if(!empty($activity['additional_data'])){
                                  $additional_data = unserialize($activity['additional_data']);
                                  $i = 0;
                                  foreach($additional_data as $data){
                                    if(strpos($data,'<original_status>') !== false){
                                      $original_status = get_string_between($data, '<original_status>', '</original_status>');
                                      $additional_data[$i] = format_estimate_status($original_status,'',false);
                                    } else if(strpos($data,'<new_status>') !== false){
                                      $new_status = get_string_between($data, '<new_status>', '</new_status>');
                                      $additional_data[$i] = format_estimate_status($new_status,'',false);
                                    } else if(strpos($data,'<status>') !== false){
                                      $status = get_string_between($data, '<status>', '</status>');
                                      $additional_data[$i] = format_estimate_status($status,'',false);
                                    } else if(strpos($data,'<custom_data>') !== false){
                                      $_custom_data = get_string_between($data, '<custom_data>', '</custom_data>');
                                      unset($additional_data[$i]);
                                    }
                                    $i++;
                                  }
                                 }
                                 $_formatted_activity = _l($activity['description'],$additional_data);
                                 if($_custom_data !== false){
                                 $_formatted_activity .= ' - ' .$_custom_data;
                                 }
                                 if(!empty($activity['full_name'])){
                                 $_formatted_activity = $activity['full_name'] . ' - ' . $_formatted_activity;
                                 }
                                 echo $_formatted_activity;
                                 if(is_admin()){
                                 echo '<a href="#" class="pull-right text-danger" onclick="delete_sale_activity('.$activity['id'].'); return false;"><i class="fa fa-remove"></i></a>';
                                 }
                                 ?>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
               </div>
            </div>
			<div role="tabpanel" class="tab-pane" id="tab_approval">
			  <div class="row proposal-comments mtop15">
				 <div class="col-md-12">
					<div class="panel_s no-shadow leaddv">
				<?php
            //$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
            $Staffgroup =  get_staff_group(7,get_staff_user_id());
           $i = 0;
           $stafff = array();
           foreach ($Staffgroup as $singlestaff) {
               $i++;
               $stafff[$i]['id'] = $singlestaff['id'];
               $stafff[$i]['name'] = $singlestaff['name'];
               $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
               $stafff[$i]['staffs'] = $query;
           }

           $allStaffdata = $stafff;




					$checkproposal=$this->db->query("SELECT * FROM `tblestimates` WHERE `addedfrom`='".get_staff_user_id()."' AND `id`='".$estimate->id."'")->result_array();
               

					$proposalapproval=$this->db->query("SELECT * FROM `tblestimatestaffapproval` WHERE `lead_id`='".$estimate->id."'")->row_array();
               
					if(count($checkproposal)>0 && empty($proposalapproval))
					{
					foreach($allStaffdata as $singlegroup)
					{?>
						<h4><?php echo $singlegroup['name'];?></h4>
						<div class="activity-feed">
						<?php
						foreach($singlegroup['staffs'] as $singlestaff)
						{?>
							<div style="margin-bottom: 14px;" class="checkbox checkbox-primary">
								<input type="checkbox" name="staffs[]" value="<?php echo $singlestaff['staffid'];?>" id="contact_primary<?php echo $singlestaff['staffid'];?>">
								<label style="width:100%;" for="contact_primary<?php echo $singlestaff['staffid'];?>"><span style="font-size:14px;"><?php echo $singlestaff['firstname'].' - '.$singlestaff['email'];?></span></label>
							</div>
					<?php
						}?>			
						</div>
				<?php
					}?>
						<div class="col-md-12">
						   <div class="text-right">
							  <button id="estimate_approval" class="btn btn-info estimate_approval"  value="<?php echo $estimate->id;?>">Send For Approval</button>
						   </div>
						</div>
						<?php
					}
					else if(count($checkproposal)==0)
					{
						$propdetails=$this->db->query("SELECT * FROM `tblestimates` WHERE `id`='".$estimate->id."'")->row_array();
							if(count($proposalapproval)>0 && $proposalapproval['approve_status']==0)
							{?>
								<div class="panel_s no-shadow leadsdv">
									<div class="activity-feed">
									  <div class="col-md-12">
										<h4>Would you like to accept this Proposal?</h4>
										<div class="text-right">
											<input type="hidden" id="addedfrom" value="<?php echo $propdetails['addedfrom']; ?>">
											<div class="form-group">
												<textarea id="proposal_desc" placeholder="Enter Reason"class="form-control proposal_desc" rows="4" enabled="enabled"></textarea>
											</div>
											<button val="<?php echo $estimate->id;?>"class="btn btn-success approval" value="1"><?php echo 'Accept'; ?></button>
											<button val="<?php echo $estimate->id;?>" class="btn btn-info approval" value="2"><?php echo 'Decline'; ?></button>
										</div>
									  </div>
									</div>
								</div>
								<div class="leadaccept" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Proposal is Accept Successfully.</div>
								<div class="leaddecline" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Proposal is Decline Successfully.</div>
				<?php
							}
							else
							{?>
								<table class="table table-proposals dataTable no-footer dtr-inline" id="DataTables_Table_1">
									<thead style="background: #f6f8fa;">
										<tr>
											<th width="20%">Name</th>
											<th width="30%"> Approve Status</th>
											<th width="25%">Approve reason</th>
											<th width="20%">Date</th>
										</tr>
									</thead>
									<tbody>
								<?php
								$staffapprov=$this->db->query(" SELECT * FROM `tblestimatestaffapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`lead_id`='".$estimate->id."' GROUP BY aps.staff_id")->result_array();
								foreach($staffapprov as $singleapprovstaff)
								{?>
									<tr>
										<td><span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' '.$singleapprovstaff['lastname'].'<br/> '.$singleapprovstaff['email']; ?></span></td>
										<td><?php if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;"> Sent</span>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;">Accepted</span>';}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;">Decline</span>';}	?></td>
										<td><?php if($singleapprovstaff['approvereason']!=''){echo $singleapprovstaff['approvereason'];}else{echo'-';}?></td>
										<td><?php if($singleapprovstaff['created_at']!=''){echo date('d M Y h:i:s',strtotime($singleapprovstaff['created_at']));}else{echo'-';}?></td>
									</tr>
								<?php
								}?>
								</tbody>
								</table>
								<?php
							}
											
					}
					else
					{?>
						<table class="table " id="DataTables_Table_1">
							<thead style="background: #f6f8fa;">
								<tr>
									<th width="20%">Name</th>
									<th width="30%"> Approve Status</th>
									<th width="25%">Approve reason</th>
									<th width="20%">Date</th>
								</tr> 
							</thead>
							<tbody>
					<?php
						$staffapprov=$this->db->query(" SELECT * FROM `tblestimatestaffapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`lead_id`='".$estimate->id."' GROUP BY aps.staff_id")->result_array();
						foreach($staffapprov as $singleapprovstaff)
						{?>
						<tr>
							<td><span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' '.$singleapprovstaff['lastname'].' <br/> '.$singleapprovstaff['email']; ?></span></td>
							<td><?php if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;"> Sent</span>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;"> Accepted</span>';}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;"> Decline</span>';}	?></td>
							<td><?php if($singleapprovstaff['approvereason']!=''){echo $singleapprovstaff['approvereason'];}else{echo'-';}?></td>
							<td><?php if($singleapprovstaff['created_at']!=''){echo date('d M Y h:i:s',strtotime($singleapprovstaff['created_at']));}else{echo'-';}?></td>
						</tr>
						<?php
						}?>
							</tbody>
						</table>
				<?php
					}?>
					
					<div class="leadSuccess" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Proposal Send to Staff For Approval.</div>
					<div class="clearfix"></div>
				 
			  </div>
		   </div>
		   </div>
		   </div>
            <div role="tabpanel" class="tab-pane" id="tab_views">
               <?php
                  $views_activity = get_views_tracking('estimate',$estimate->id);
                  if(count($views_activity) === 0) {
                     echo '<h4 class="no-mbot">'._l('not_viewed_yet',_l('estimate_lowercase')).'</h4>';
                  }
                  foreach($views_activity as $activity){ ?>
               <p class="text-success no-margin">
                  <?php echo _l('view_date') . ': ' . _dt($activity['date']); ?>
               </p>
               <p class="text-muted">
                  <?php echo _l('view_ip') . ': ' . $activity['view_ip']; ?>
               </p>
               <hr />
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="converttoinvoice-model" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/estimateConvertType"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Convert To Invoice </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="estimateid" value="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="convert_type" class="control-label">Type</label>
                            <select class="form-control selectpicker" required="" name="convert_type" id="convert_type">
                                <option value=""></option>
                                <option value="1">Fully</option>
                                <option value="2">Partiality</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="submit" autocomplete="off" class="btn btn-info cancelremarkbtn">Submit</button> -->
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
   init_items_sortable(true);
   init_btn_with_tooltips();
   init_datepicker();
   init_selectpicker();
   init_form_reminder();
   init_tabs_scrollable();
   small_table_full_view();
</script>
<script>
$('.estimate_approval').click(function(){
	  var proposalid=$(this).attr('value');
	  var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
		var staffid=val;
		var url = '<?php echo base_url(); ?>admin/Proposals/sendapproval';
		$.post(url,
				{
					staffid: staffid,
					proposalid: proposalid,
				},
				function (data, status) {
					$('.leaddv').hide();
					$('.leadSuccess').show();
					
				});
				
   });
   $('.approval').click(function()
   {
	  var leadid=$(this).attr('val');
	  var approve_status=$(this).attr('value');
	  var leadcreatorid=$('#addedfrom').val();
	  var proposal_description=$('.proposal_desc').val();
	  var url = '<?php echo base_url(); ?>admin/Estimates/approvalaccept';
	  if(proposal_description.trim()!='')
	  {
	  $.post(url,
				{
					approve_status: approve_status,
					leadid: leadid,
					leadcreatorid: leadcreatorid,
					approvereason: proposal_description,
				},
				function (data, status) {
					if(approve_status==1)
					{
						$('.leadsdv').hide();
						$('.leadaccept').show();
					}
					if(approve_status==2)
					{
						$('.leadsdv').hide();
						$('.leaddecline').show();
					}
				});
	  }
	  else
	  {
		  if(proposal_description=='')
		  {
			$('.proposal_desc').addClass('error');  
		  }
		  else
		  {
			$('.proposal_desc').removeClass('error');    
		  }
	  }
   });

   $(document).on("click", ".estimateconvert", function(){
      var estimateid = $(this).data("estimateid");
      $(".estimateid").val(estimateid);
      $("#converttoinvoice-model").modal("show");
   });
   $(document).on("change", "#convert_type", function(){
      var type = $(this).val();
      var redirecturl = "<?php echo admin_url('estimates/invoices/'.$estimate->id); ?>?type="+type;
      window.location.href = redirecturl;
   });
</script> 
<?php $this->load->view('admin/estimates/estimate_send_to_client'); ?>
