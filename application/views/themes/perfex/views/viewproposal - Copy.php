<div id="proposal-wrapper">
   <?php ob_start(); $type=$this->input->get('type'); 
					 $yy= $this->db->query("SELECT fieldname FROM `tblproposalproductfields` WHERE `proposalid`='".$proposal->id."'")->result_array();
					 $fieldname=array_column($yy,'fieldname');?>
   


<?php
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

$proposal->items = get_proposal_items_list($proposal->id,$type);

/*$months_info = '';
if($type=='rent'){
  if(!empty($proposal->items)){
    if($proposal->items[0]['days'] > 0){
        $months_info = '<br /><br /><b>Note :- The Proposal is for '.$proposal->items[0]['months'].' Month and '.$proposal->items[0]['days'].' Days </b>';
    }else{
       $months_info = '<br /><br /><b>Note :- The Proposal is for '.$proposal->items[0]['months'].' Month </b>';
    }
   
  }
}*/


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

$show_discount = 0;
if(!empty($proposal->items)){
  foreach ($proposal->items as $key => $value) {
      if($value['discount'] > 0){
        $show_discount = 1;
      }
  }

}

?>


  <div class="table-responsive">
    <table class="table items no-margin">
        <thead>
            <tr>
                <th align="center">#</th>
                <th class="description" align="left">Item</th>
                <th align="right">Qty</th>
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

              ?>

               <tr class="sortable" data-item-id="<?php echo $value['id']; ?>">
                  <td class="dragger item_no ui-sortable-handle" align="center"><?php echo ++$key; ?></td>
                  <td class="description" align="left;"><span style="font-size:px;"><strong><?php echo $value['description']; ?></strong></span></td>
                  <td align="right"><?php echo $qty; ?></td>
                  <?php
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

  <?php

  $final_amount = 0;
  if(!empty($proposal->items)){
  ?>
  <div class="row mtop15">
    <div class="col-md-6 col-md-offset-6">
        <div class="table-responsive">
            <table class="table text-right">
                <tbody>
                    <tr id="subtotal">
                        <td><span class="bold">Sub Total</span>
                        </td>
                        <td class="subtotal"><?php echo number_format($total_price, 2, '.', ''); ?></td>
                    </tr>


                     <?php
                          $discount = 0;
                          if(!empty($discount_percent > 0)){
                             $discount = ($total_price*$discount_percent/100);
                             ?>
                             <tr class="tax-area">
                                 <td><span class="bold">Discount</span></td>
                                 <td ><?php echo '-'.number_format($discount, 2, '.', ''); ?></td>
                             </tr>
                             <?php
                          }


                          // For Including Other Charges Tax
                          if($proposal->other_charges_tax == 2){
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

                          if(!empty($proposal->tax_type == 1)){
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


                         // For Including Other Charges Tax 
                        if($proposal->other_charges_tax == 1){

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
    </div>
</div>  

  <?php
  }
  ?>             







    <?php

      if(get_option('total_to_words_enabled') == 1){ ?>
   <div class="col-md-12 text-center">
      <p class="bold"><?php echo 'In Words : '.convert_number_to_words($final_amount); ?></p>
   </div>
   <?php }
   echo $months_info;
      $items = ob_get_contents();
      ob_end_clean();
      $proposal->content = str_replace('{proposal_items}',$items,$proposal->content);
      ?>
   <div class="mtop30">
      <div class="row">
        <div class="col-md-12">
         <div class="mbot30">
          <?php echo get_dark_company_logo(); ?>
        </div>
        </div>
         <div class="col-md-12">
            <div class="pull-left">
               <h4 class="bold no-mtop"># <?php echo format_proposal_number($proposal->id); ?><br />
                  <small><?php echo $proposal->subject; ?></small>
               </h4>
            </div>
            <div class="visible-xs">
               <div class="clearfix"></div>
            </div>
            <?php if(($proposal->status != 2 && $proposal->status != 3)){
               if(!empty($proposal->open_till) && date('Y-m-d',strtotime($proposal->open_till)) < date('Y-m-d')){
                 echo '<span class="warning-bg content-view-status">'._l('proposal_expired').'</span>';
               } else { ?>
            <?php if($identity_confirmation_enabled == '1'){ ?>
            <button type="button" id="accept_action" class="btn btn-success pull-right mleft5">
              <i class="fa fa-check"></i> <?php echo _l('proposal_accept_info'); ?>
            </button>
            <?php } else { ?>
            <?php echo form_open($this->uri->uri_string()); ?>
            <button type="submit" data-loading-text="<?php echo _l('wait_text'); ?>" autocomplete="off" class="btn btn-success pull-right mleft5"><i class="fa fa-check"></i> <?php echo _l('proposal_accept_info'); ?></button>
            <?php echo form_hidden('action','accept_proposal'); ?>
            <?php echo form_close(); ?>
            <?php } ?>
            <?php echo form_open($this->uri->uri_string()); ?>
            <button type="submit" data-loading-text="<?php echo _l('wait_text'); ?>" autocomplete="off" class="btn btn-default pull-right mleft5"><i class="fa fa-remove"></i> <?php echo _l('proposal_decline_info'); ?></button>
            <?php echo form_hidden('action','decline_proposal'); ?>
            <?php echo form_close(); ?>
            <?php } ?>
            <!-- end expired proposal -->
            <?php } else {
               if($proposal->status == 2){
                 echo '<span class="danger-bg content-view-status">'._l('proposal_status_declined').'</span>';
               } else if($proposal->status == 3){
                 echo '<span class="success-bg content-view-status">'._l('proposal_status_accepted').'</span>';
               }
               } ?>
            <?php echo form_open($this->uri->uri_string().'?type='.$type); ?>
            <button type="submit" class="btn btn-default pull-right mleft5"><i class="fa fa-file-pdf-o"></i> <?php echo _l('clients_invoice_html_btn_download'); ?></button>
            <input type='hidden' name="type">
			<?php echo form_hidden('action','proposal_pdf'); ?>
            <?php echo form_close(); ?>
            <?php if(is_client_logged_in() && has_contact_permission('proposals')){ ?>
                <a href="<?php echo site_url('clients/proposals/'); ?>" class="btn btn-default mleft5 pull-right">
                <?php echo _l('client_go_to_dashboard'); ?>
            </a>
            <?php } ?>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-8 proposal-left">
            <div class="panel_s mtop20">
               <div class="panel-body proposal-content tc-content padding-30">
                  <?php echo $proposal->content; ?>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="mtop20">
               <ul class="nav nav-tabs nav-tabs-flat mbot15" role="tablist">
                  <li role="presentation" class="<?php if(!$this->input->get('tab') || $this->input->get('tab') === 'summary'){echo 'active';} ?>">
                     <a href="#summary" aria-controls="summary" role="tab" data-toggle="tab">
                     <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php echo _l('summary'); ?></a>
                  </li>
                  <?php if($proposal->allow_comments == 1){ ?>
                  <li role="presentation" class="<?php if($this->input->get('tab') === 'discussion'){echo 'active';} ?>">
                     <a href="#discussion" aria-controls="discussion" role="tab" data-toggle="tab">
                      <i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo _l('discussion'); ?>
                     </a>
                  </li>
                  <?php } ?>
               </ul>
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab') || $this->input->get('tab') === 'summary'){echo ' active';} ?>" id="summary">
                     <address>
                        <?php echo format_organization_info(); ?>
                     </address>
                     <hr />
                     <p class="bold">
                        <?php echo _l('proposal_information'); ?>
                     </p>
                     <address class="no-margin">
                        <?php echo get_proposal_to_data($proposal->id); ?>
                     </address>
                     <div class="row mtop20">
                        <?php if($proposal->total != 0){ ?>
                        <div class="col-md-12">
                           <h4 class="bold mbot30"><?php echo _l('proposal_total_info',format_money($final_amount,$this->currencies_model->get($proposal->currency)->symbol)); ?></h4>
                        </div>
                        <?php } ?>
                        <div class="col-md-4 text-muted proposal-status">
                           <?php echo _l('proposal_status'); ?>
                        </div>
                        <div class="col-md-8 proposal-status">
                           <?php echo format_proposal_status($proposal->status,'', false); ?>
                        </div>
                        <div class="col-md-4 text-muted proposal-date">
                           <?php echo _l('proposal_date'); ?>
                        </div>
                        <div class="col-md-8 proposal-date">
                           <?php echo _d($proposal->date); ?>
                        </div>
                        <?php if(!empty($proposal->open_till)){ ?>
                        <div class="col-md-4 text-muted proposal-open-till">
                           <?php echo _l('proposal_open_till'); ?>
                        </div>
                        <div class="col-md-8 proposal-open-till">
                           <?php echo _d($proposal->open_till); ?>
                        </div>
                        <?php } ?>
                     </div>
                     <?php if(count($proposal->attachments) > 0 && $proposal->visible_attachments_to_customer_found == true){ ?>
                     <div class="proposal-attachments">
                        <hr />
                        <p class="bold mbot15"><?php echo _l('proposal_files'); ?></p>
                        <?php foreach($proposal->attachments as $attachment){
                           if($attachment['visible_to_customer'] == 0){continue;}
                           $attachment_url = site_url('download/file/sales_attachment/'.$attachment['attachment_key']);
                           if(!empty($attachment['external'])){
                             $attachment_url = $attachment['external_link'];
                           }
                           ?>
                        <div class="col-md-12 row mbot15">
                           <div class="pull-left"><i class="<?php echo get_mime_class($attachment['filetype']); ?>"></i></div>
                           <a href="<?php echo $attachment_url; ?>"><?php echo $attachment['file_name']; ?></a>
                        </div>
                        <?php } ?>
                     </div>
                     <?php } ?>
                  </div>
                  <?php if($proposal->allow_comments == 1){ ?>
                  <div role="tabpanel" class="tab-pane<?php if($this->input->get('tab') === 'discussion'){echo ' active';} ?>" id="discussion">
                     <?php echo form_open($this->uri->uri_string()) ;?>
                     <div class="proposal-comment">
                        <textarea name="content" rows="4" class="form-control"></textarea>
                        <button type="submit" class="btn btn-info mtop10 pull-right"><?php echo _l('proposal_add_comment'); ?></button>
                        <?php echo form_hidden('action','proposal_comment'); ?>
                     </div>
                     <?php echo form_close(); ?>
                     <div class="clearfix"></div>
                     <?php
                        $proposal_comments = '';
                        foreach ($comments as $comment) {
                         $proposal_comments .= '<div class="proposal_comment mtop10 mbot20" data-commentid="' . $comment['id'] . '">';
                         if($comment['staffid'] != 0){
                           $proposal_comments .= staff_profile_image($comment['staffid'], array(
                             'staff-profile-image-small',
                             'media-object img-circle pull-left mright10'
                           ));
                         }
                         $proposal_comments .= '<div class="media-body valign-middle">';
                         $proposal_comments .= '<div class="mtop5">';
                         $proposal_comments .= '<b>';
                         if($comment['staffid'] != 0){
                           $proposal_comments .= get_staff_full_name($comment['staffid']);
                         } else {
                           $proposal_comments .= _l('is_customer_indicator');
                         }
                         $proposal_comments .= '</b>';
                         $proposal_comments .= ' - <small class="mtop10 text-muted">' . time_ago($comment['dateadded']) . '</small>';
                         $proposal_comments .= '</div>';
                         $proposal_comments .= '<br />';
                         $proposal_comments .= check_for_links($comment['content']) . '<br />';
                         $proposal_comments .= '</div>';
                         $proposal_comments .= '</div>';
                        }
                        echo $proposal_comments; ?>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php
      if($identity_confirmation_enabled == '1'){
        get_template_part('identity_confirmation_form',array('formData'=>form_hidden('action','accept_proposal')));
      }
      ?>
   <script>
      $(function(){
        $(".proposal-left table").wrap("<div class='table-responsive'></div>");
            // Create lightbox for proposal content images
            $('.proposal-content img').wrap( function(){ return '<a href="' + $(this).attr('src') + '" data-lightbox="proposal"></a>'; });
          });

   </script>
</div>
