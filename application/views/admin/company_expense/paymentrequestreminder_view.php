<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}
fieldset.for-panel {
    background-color: #fcfcfc;
	border: 1px solid #999;
	border-radius: 4px;	
	padding:15px 10px;
	background-color: #d9edf7;
    border-color: #bce8f1;
	background-color: #f9fdfd;
	margin-bottom:12px;
}
fieldset.for-panel legend {
    background-color: #fafafa;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #4381ba;
    font-size: 14px;
    font-weight: bold;
    line-height: 10px;
    margin: inherit;
    padding: 7px;
    width: auto;
	background-color: #d9edf7;
	margin-bottom: 0;
}
fieldset.for-panel i.success {
    color: green;
    font-size: 30px;
}
fieldset.for-panel i.danger {
    color: red;
    font-size: 30px;
}
fieldset.for-panel p span.badge-success {
    color: #fff;
    background-color: #28a745;
}
</style>
<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12">
      </div>
      <?php echo form_open($this->uri->uri_string(), array('id' => 'paymentrequest-form', 'class' => 'paymentrequest-approval-form')); ?>
      <div class="col-md-12">
         <div class="panel_s">
            <div class="panel-body">
                <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title: "";?></h4>
                <div class="row">
                    <fieldset class="for-panel">
                        <legend>Payment Request Reminder Info</legend>
                        <legend>Request Date : <?php echo _d($paymentrequest_info->created_at)?></legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table>
                                            <tr>
                                                <td><label class="control-label">Category :</label></td>
                                                <td>
                                                    <?php 
                                                        if(!empty($paymentrequest_info)){
                                                        echo value_by_id('tblcompanyexpensecatergory',$paymentrequest_info->category_id,'name');   
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php if(!empty($paymentrequest_info->category_id) && ($paymentrequest_info->category_id == 3 || $paymentrequest_info->category_id == 4 || $paymentrequest_info->category_id == 6) ){ ?>
                                                <tr>
                                                    <td><label class="control-label">Type :</label></td>
                                                    <td>
                                                        <?php 
                                                            if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 1 && $paymentrequest_info->category_id == 3){
                                                                    echo 'Rent';
                                                            }
                                                            else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 2 && $paymentrequest_info->category_id == 3){
                                                                    echo 'Deposit';
                                                            }
                                                            else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 3 && $paymentrequest_info->category_id == 3){
                                                                    echo 'Both';
                                                            }
                                                            else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 1 && $paymentrequest_info->category_id == 4){
                                                                    echo 'Recurring';
                                                            }
                                                            else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 2 && $paymentrequest_info->category_id == 4){
                                                                    echo 'Onetime';
                                                            }
                                                            else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 1 && $paymentrequest_info->category_id == 6){
                                                                    echo 'Regular';
                                                            }
                                                            else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 2 && $paymentrequest_info->category_id == 6){
                                                                    echo 'Onetime';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 2 && $paymentrequest_info->category_id == 3){ ?>
                                                <tr>
                                                    <td><label class="control-label">Deposit Amount : </label></td>
                                                    <td>
                                                        <?php 
                                                            if(!empty($paymentrequest_info->deposit_amount)){
                                                                echo $paymentrequest_info->deposit_amount;
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 3 && $paymentrequest_info->category_id == 3){?>    
                                                <tr>
                                                    <td><label class="control-label">Transport Against : </label></td>
                                                    <td>
                                                        <?php 
                                                            if(!empty($paymentrequest_info->transport_against) && $paymentrequest_info->transport_against == 1){
                                                                echo 'Invoice';
                                                            }
                                                            else
                                                            {
                                                                echo 'PO';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Party Name : </label></td>
                                                    <td>
                                                        <?php 
                                                            echo (!empty($paymentrequest_info->party_name)) ? $paymentrequest_info->party_name : '--';
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 2 && $paymentrequest_info->category_id == 6){?>    
                                                <tr>
                                                    <td><label class="control-label">Transport Against : </label></td>
                                                    <td>
                                                        <?php 
                                                            if(!empty($paymentrequest_info->transport_against) && $paymentrequest_info->transport_against == 1){
                                                                echo 'Invoice';
                                                            }
                                                            else
                                                            {
                                                                echo 'PO';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label class="control-label">Party Name : </label></td>
                                                    <td>
                                                        <?php 
                                                            if(!empty($paymentrequest_info->party_id)){

                                                            echo value_by_id('tblcompanyexpenseparties',$paymentrequest_info->party_id,'name');
                                                            }elseif(!empty($paymentrequest_info->party_name)){
                                                                echo $paymentrequest_info->party_name;
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if(!empty($paymentrequest_info->category_id) && $paymentrequest_info->category_id == 3 || $paymentrequest_info->category_id == 4 || $paymentrequest_info->category_id == 5) { ?>
                                                <tr>
                                                    <td><label class="control-label">Party Name : </label></td>
                                                    <td>
                                                        <?php 
                                                            if(!empty($paymentrequest_info->party_id)){
                                                                echo value_by_id('tblcompanyexpenseparties',$paymentrequest_info->party_id,'name');
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if(!empty($paymentrequest_info->head_id)) { ?>
                                                <tr>
                                                    <td><label class="control-label">Head : </label></td>
                                                    <td>
                                                        <?php 
                                                            echo value_by_id('tblheads',$paymentrequest_info->head_id,'name');
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table>
                                        <?php if(!empty($paymentrequest_info->sub_head_id)) { ?>
                                                <tr>
                                                    <td><label class="control-label">Sub Head : </label></td>
                                                    <td>
                                                        <?php 
                                                            echo value_by_id('tblsubheads',$paymentrequest_info->sub_head_id,'name');
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if(!empty($paymentrequest_info->amount)) { ?>
                                                <tr>
                                                    <td><label class="control-label">Amount : </label></td>
                                                    <td>
                                                        <?php 
                                                            echo $paymentrequest_info->amount;
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if(!empty($paymentrequest_info->tds_amt)) { ?>
                                                <tr>
                                                    <td><label class="control-label">TDS Amount : </label></td>
                                                    <td>
                                                        <?php 
                                                            echo $paymentrequest_info->tds_amt;
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php if(!empty($paymentrequest_info->reminderdays) && $paymentrequest_info->reminderdays > 0) { ?>
                                                <tr>
                                                    <td><label class="control-label">Reminder Day : </label></td>
                                                    <td>
                                                        <?php 
                                                            echo $paymentrequest_info->reminderdays;
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                            if(!empty($paymentrequest_info->reminder_send_to) && $paymentrequest_info->reminder_send_to != "") {
                                                $reminder_ids = explode(',', $paymentrequest_info->reminder_send_to);
                                            ?>
                                                <tr>
                                                    <td><label class="control-label">Reminder Send To : </label></td>
                                                    <td>
                                                        <?php 
                                                            foreach($reminder_ids as $k => $sid){
                                                                echo ($k > 0) ? ', ' : '';
                                                                echo get_employee_name($sid);
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?> 
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                       </fieldset>
                </div>
                
                <?php if(!empty($paymentrequest_info->category_id) && $paymentrequest_info->category_id == 6) { ?>
                <div class="row">
                <fieldset class="for-panel">
                <div class="row">
                <?php if(!empty($paymentrequest_info->transport_against) && $paymentrequest_info->transport_against == 1) { ?>
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Invoice Details</h4>
                </div>
                <?php } else { ?>
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Purchase Order Details</h4>
                </div>
                <?php } ?>
                <hr/>
                
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" id="docAttachDivVideo" >
                            
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                <thead>
                                    <?php if(!empty($paymentrequest_info->transport_against) && $paymentrequest_info->transport_against == 1) { ?>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Invoice</td>
                                        <td>Client</td>
                                        <td>Date</td>
                                        <td>Total Tax</td>
                                        <td>Total</td>
                                    </tr>
                                    <?php } else { ?>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Purchase Order</td>
                                        <td>Vendor</td>
                                        <td>Date</td>
                                        <td>Total Amount</td>
                                        <td>Discount Percent</td>
                                        <td>Discount Amount</td>
                                    </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                if(!empty($paymentrequest_info->transport_against) && $paymentrequest_info->transport_against == 1) {
                        
                                $exp = explode(',',$paymentrequest_info->document_id);
                                if(!empty($exp)){
                                    foreach($exp as $invoice_id){
                                        $invoice_info = $this->home_model->get_row('tblinvoices', array('id'=>$invoice_id), '');
                                        if(!empty($invoice_info)){ 
                                        $client_info = $this->home_model->get_row('tblclientbranch', array('userid'=>$invoice_info->clientid), '');
                                        ?>
                                         <tr>                                                      
                                            <td><?php echo $i++;?></td>

                                            <td><a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$invoice_info->id.'/?output_type=I');?>" data-status="1"><?php echo $invoice_info->prefix.$invoice_info->number;?></a></td>
                                            <td><?php echo $client_info->client_branch_name;?></td>
                                            <td><?php echo _d($invoice_info->date);?></td>   
                                            <td><?php echo $invoice_info->total_tax;?></td>   <td><?php echo $invoice_info->total;?></td>                                                    
                                         </tr>   
                                       <?php }
                                    }
                                } 


                                }
                                else
                                {
                                   $exp1 = explode(',',$paymentrequest_info->document_id);
                                   if(!empty($exp1)){
                                    foreach($exp1 as $po_id){
                                        $Po_info = $this->home_model->get_row('tblpurchaseorder', array('id'=>$po_id), '');
                                        if(!empty($Po_info)){ 
                                        $vendor_info = $this->home_model->get_row('tblvendor', array('id'=>$Po_info->vendor_id), '');
                                        ?>
                                         <tr>                                                      
                                            <td><?php echo $i++;?></td>
                                            <td><a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$Po_info->id); ?>"><?php echo $Po_info->prefix.$Po_info->number;?></a></td>
                                            <td><?php echo $vendor_info->name;?></td>
                                            <td><?php echo _d($Po_info->date);?></td>   
                                            <td><?php echo $Po_info->totalamount;?></td>   
                                            <td><?php echo $Po_info->finaldiscountpercentage.'%'; ?></td>           
                                            <td><?php echo $Po_info->finaldiscountamount; ?></td>                                        
                                         </tr>   
                                       <?php }
                                    }
                                } 
                                }
                                ?>  
                                    
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
               
                </div>
                </fieldset>
                </div>

                <?php } ?>
            </div>
         </div>
      </div>
      <?php echo form_close(); ?>
   </div>


   <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>
</body>
</html>
