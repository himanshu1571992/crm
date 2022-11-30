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
@media (max-width: 500px){
    .form-control-static {
        margin-right: 100px;
        float: right;
    }
}    
@media (max-width: 768px){
    .form-control-static {
        margin-right: 100px;
        float: right;
    }
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
                        <legend>Payment Request Info</legend>
                        <legend>Request Date : <?php echo _d($paymentrequest_info->created_at)?></legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table>
                                                    <tr>
                                                        <td class="col-md-6"><label class="control-label">Category : &nbsp;</label></td>
                                                        <td class="col-md-6">
                                                            <?php 
                                                                if(!empty($paymentrequest_info)){
                                                                    echo value_by_id('tblcompanyexpensecatergory',$paymentrequest_info->category_id,'name');   
                                                                }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php if(!empty($paymentrequest_info->category_id) && ($paymentrequest_info->category_id == 3 || $paymentrequest_info->category_id == 4 || $paymentrequest_info->category_id == 6) ){ ?>
                                                        <tr>
                                                            <td class="col-md-6"><label class="control-label">Type : &nbsp;</label></td>
                                                            <td class="col-md-6">
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
                                                    <?php if($paymentrequest_info->from_date > 0  && $paymentrequest_info->to_date > 0){ ?>
                                                        <tr>
                                                            <td class="col-md-6"><label class="control-label">From Date : &nbsp;</label></td>
                                                            <td class="col-md-6">
                                                                <?php 
                                                                    if(!empty($paymentrequest_info->from_date)){
                                                                        echo _d($paymentrequest_info->from_date);
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-6"><label class="control-label">To Date : &nbsp;</label></td>
                                                            <td class="col-md-6">
                                                                <?php 
                                                                    if(!empty($paymentrequest_info->to_date)){
                                                                        echo _d($paymentrequest_info->to_date);
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                    <label class="col-md-4 control-label">Category :</label>
                                    <p class="form-control-static">
                                        <?php 
                                            if(!empty($paymentrequest_info)){
                                             echo value_by_id('tblcompanyexpensecatergory',$paymentrequest_info->category_id,'name');   
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>

                            <?php if(!empty($paymentrequest_info->category_id) && ($paymentrequest_info->category_id == 3 || $paymentrequest_info->category_id == 4 || $paymentrequest_info->category_id == 6) ){ ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">Type :</label>
                                    <p class="form-control-static">
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
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                            
                            <?php 
                            //if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 1 && $paymentrequest_info->category_id == 3){
                            if($paymentrequest_info->from_date > 0  && $paymentrequest_info->to_date > 0){
                            ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">From Date : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->from_date)){
                                                echo _d($paymentrequest_info->from_date);
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">To Date : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->to_date)){
                                                echo _d($paymentrequest_info->to_date);
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 2 && $paymentrequest_info->category_id == 3){ ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">Deposit Amount : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->deposit_amount)){
                                                echo $paymentrequest_info->deposit_amount;
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 3 && $paymentrequest_info->category_id == 3){?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">From Date : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->from_date)){
                                                echo _d($paymentrequest_info->from_date);
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">To Date : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->to_date)){
                                                echo _d($paymentrequest_info->to_date);
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">Deposit Amount : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->deposit_amount)){
                                                echo $paymentrequest_info->deposit_amount;
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 1 && $paymentrequest_info->category_id == 6){ ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">Transport Against : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->transport_against) && $paymentrequest_info->transport_against == 1){
                                                echo 'Invoice';
                                            }
                                            else
                                            {
                                                echo 'PO';
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">Party Name : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->party_id)){
                                                echo value_by_id('tblcompanyexpenseparties',$paymentrequest_info->party_id,'name');
                                            }elseif(!empty($paymentrequest_info->party_name)){
                                                echo $paymentrequest_info->party_name;
                                            }else{
                                                echo "N/a";
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } else if(!empty($paymentrequest_info->type) && $paymentrequest_info->type == 2 && $paymentrequest_info->category_id == 6){?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">Transport Against : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->transport_against) && $paymentrequest_info->transport_against == 1){
                                                echo 'Invoice';
                                            }
                                            else
                                            {
                                                echo 'PO';
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-md-4 control-label">Party Name : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(!empty($paymentrequest_info->party_id)){
                                               echo value_by_id('tblcompanyexpenseparties',$paymentrequest_info->party_id,'name');
                                            }elseif(!empty($paymentrequest_info->party_name)){
                                                echo $paymentrequest_info->party_name;
                                            }else{
                                                echo "N/a";
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
 
                            <?php if(!empty($paymentrequest_info->category_id) && $paymentrequest_info->category_id == 3 || $paymentrequest_info->category_id == 4 || $paymentrequest_info->category_id == 5) { ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-xs-4 control-label">Party Name : </label>
                                    <p class="form-control-static">
                                         <?php 
                                            if(isset($paymentrequest_info->party_id) && $paymentrequest_info->party_id > 0){
                                               echo value_by_id('tblcompanyexpenseparties',$paymentrequest_info->party_id,'name');
                                            }else{
                                                echo "N/a";
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                      
                            <?php if(!empty($paymentrequest_info->head_id)) { ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-xs-4 control-label">Head :</label>
                                    <p class="form-control-static">
                                        <?php 
                                            echo value_by_id('tblheads',$paymentrequest_info->head_id,'name');
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if(!empty($paymentrequest_info->sub_head_id)) { ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-xs-4 control-label">Sub Head :</label>
                                    <p class="form-control-static">
                                        <?php 
                                            echo value_by_id('tblsubheads',$paymentrequest_info->sub_head_id,'name');
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>

                            <?php if(!empty($paymentrequest_info->amount)) { ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-xs-4 control-label">Paid Amount :</label>
                                    <p class="form-control-static">
                                        <?php 
                                            echo $paymentrequest_info->amount;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($paymentrequest_info->taxable_amount)) { ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-xs-4 control-label">Taxable Amount :</label>
                                    <p class="form-control-static">
                                        <?php 
                                            echo $paymentrequest_info->taxable_amount;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>    
                            <?php if(!empty($paymentrequest_info->tds_amt)) { ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-xs-4 control-label">TDS Amount :</label>
                                    <p class="form-control-static">
                                        <?php 
                                            echo $paymentrequest_info->tds_amt;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($paymentrequest_info->booking_date)) { ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-xs-4 control-label">Booking Date :</label>
                                    <p class="form-control-static">
                                        <?php 
                                            echo _d($paymentrequest_info->booking_date);
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(!empty($paymentrequest_info->remark)) { ?>
                            <div class="col-md-6">
                                <div class="form-horizontal">
                                <label class="col-xs-4 control-label">Remark :</label>
                                    <p class="form-control-static">
                                        <?php 
                                            echo $paymentrequest_info->remark;
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <?php }
                            if (!empty($paymentrequest_info)){
                                $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'payment_request' and rel_id = '".$paymentrequest_info->id."' ")->result();
                                if(!empty($file_info)){
                            ?>
                            <div class="col-md-12">
                            <legend for="file" class="control-label">Uploaded Files :</legend>
                                <div class="form-horizontal">
                                    
                                    <div class="card">
                                        <ul class="list-group list-group-flush">
                                        <?php 
                                            foreach ($file_info as $key => $file) {
                                        ?>
                                                <li class="list-group-item col-md-6"><?php echo 1+$key.') '; ?><a target="_blank" href="<?php echo base_url('uploads/payment_request/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></li>
                                        <?php            
                                            }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                }
                            }
                            ?>     
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

                <?php 
                $assign_info = $this->db->query("SELECT * from tblmasterapproval  where module_id = '16' and table_id = '".$paymentrequest_info->id."'  ")->result();
                ?>
             <div class="row">
              <fieldset class="for-panel">
                <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                            </div>
                             <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Status</td>
                                                <td>Read At</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($assign_info)){
                                            $i = 1;
                                            foreach ($assign_info as $key => $value) {

                                                    if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                    }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                    }elseif($value->approve_status == 2){
                                                        $status = 'Reject';
                                                        $color = 'red';
                                                    }elseif($value->approve_status == 4){
                                                        $status = 'Reconciliation';
                                                        $color = 'brown';
                                                    }
                                                ?>
                                                <tr>                                                      
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>   
                                                    <td><?php if(!empty($value->readdate)){ echo _d($value->readdate); }else{ echo 'Not Yet'; }   ?></td>                                                       
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
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
