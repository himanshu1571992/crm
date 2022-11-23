<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}.error{border:1px solid red !important;} 
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
      /*width:inherit;*/ /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
}</style>
<style>
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%
        }
    }     
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

           <form action="<?php echo admin_url('bank_payments/payment_approval'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
           
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                       
                         <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                            </div>

                           
                            <div class="col-md-4">
                                <label class="control-label">Company Code </label>
                                <input readonly="" type="text" class="form-control" value="SCHACH" name="company_code" id="company_code">
                            </div>

                            <div class="col-md-4">
                                <label class="control-label">Company Account </label>
                                <input readonly="" type="text" class="form-control" value="8111580589" name="account_no" id="account_no">
                            </div>

                            <?php
                            if(!empty($action)){
                                ?>
                                    <div class="form-group col-md-4">
                                        <label class="control-label">Remark </label>                                    
                                          <textarea required="" id="approvereason" name="approvereason" class="form-control"><?php echo (!empty($approval_info)) ? $approval_info->approvereason : ""; ?></textarea>                      
                                    </div>    
                                <?php   
                            }
                            ?>


                        </div>
                        <br/>
                        <br/>


                        <div id="main_div">

                        <?php
                        if(!empty($payments_info)){

                            foreach ($payments_info as $i => $row) {

                                    $category_dtl = $this->db->query("SELECT show_date,show_deposit,name FROM `tblcompanyexpensecatergory` where id = '".$row->category_id."' ")->row();     

                                    if($row->category_id == 1){
                                        $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where active = '1' ")->result();
                                    }elseif($row->category_id == 2){
                                        $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where status = '1' ")->result();  
                                    }elseif($row->category_id == 7){
                                        $payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` where active = '1' ")->result(); 
                                    }else{
                                        $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where category_id = '".$row->category_id."' and status = '1' ")->result(); 
                                    }
                                ?>
                                <div id="form_data_<?php echo $i;?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                            <div class="col-md-4">
                                                <input type="text" disabled="" class="form-control" value="<?php echo cc($category_dtl->name); ?>">
                                            </div>
                                            <div class="col-md-8">
                                                <?php 
                                                if($row->category_id == 3){
                                                    $last_payment_info = $this->db->query("SELECT pd.id FROM `tblbankpaymentdetails` as pd LEFT JOIN `tblbankpayment` as b ON `b`.id = `pd`.main_id WHERE `pd`.`category_id` = 3 AND `pd`.`payee_id`='".$row->payee_id."' AND `b`.`status` = 1 ORDER BY date DESC ")->result();
                                                    if (!empty($last_payment_info)){
                                                ?>
                                                <a target="_blank" href="<?php echo admin_url("bank_payments/last_payment_details_list/".$row->payee_id); ?>" class="btn-sm btn-info pull-right">Show Last Payment Details</a>
                                                <?php
                                                    }
                                                }    
                                                ?>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $i;?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>                                    
                                                        <input type="text" disabled="" class="form-control" value="<?php echo date('m/d/Y',strtotime($row->date));?>">                              
                                                </div> 

                                                <?php
                                                if($row->payee_id > 0){
                                                ?>
                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>                                    
                                                     <select onchange="get_vendor_detl(<?php echo $i; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][payee]">
                                                      <option value="" disabled selected >--Select One-</option>
                                                      <?php
                                                      if(!empty($payee_info)){
                                                        foreach ($payee_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if($row->payee_id == $value->id){ echo 'selected disabled'; } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                      }
                                                      ?>
                                                    </select>                           
                                                </div> 
                                                <?php
                                                }else{
                                                ?>
                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>                                    
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $row->payee_name; ?>">                        
                                                </div>
                                                <?php    
                                                }
                                                ?>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>                                    
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $row->ifsc; ?>">                        
                                                </div> 

                                                 <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>                                    
                                                        <input type="text" disabled="" class="form-control" value="<?php echo $row->account; ?>">                       
                                                </div> 

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Bank </label>                                    
                                                        <input type="text" disabled="" class="form-control" value="<?php echo value_by_id('tblbankmaster',$row->bank_id,'name'); ?>">                       
                                                </div> 

                                            </div>
                                            <div class="row">
                                               

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>     
                                                    <input type="text" disabled="" class="form-control" value="<?php echo $row->method; ?>">                                 
                                                                              
                                                </div> 

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>   
                                                    <input type="text" disabled="" class="form-control" value="<?php echo $row->type; ?>">                                  
                                                                              
                                                </div> 

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>                                    
                                                       <input type="text" disabled="" class="form-control" value="<?php echo $row->amount; ?>">                       
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>                                    
                                                        <textarea disabled="" class="form-control"><?php echo $row->first_remark; ?></textarea>                      
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>                                    
                                                      <textarea disabled="" class="form-control"><?php echo $row->second_remark; ?></textarea>                      
                                                </div>


                                            </div>

                                            <div class="row">

                                                <?php
                                                if($category_dtl->show_deposit == 1){
                                                ?>
                                                     <div class="form-group col-md-4">
                                                        <label class="control-label">Deposit </label>                                    
                                                            <input type="text" disabled="" class="form-control" value="<?php echo $row->deposit; ?>">                             
                                                    </div>
                                                <?php    
                                                }
                                                

                                                if($category_dtl->show_date == 1){
                                                ?>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">From Date </label>                                    
                                                            <input type="text" disabled="" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->fromdate));?>">                              
                                                    </div> 

                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">To Date </label>                                    
                                                            <input type="text" disabled="" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->todate));?>">                              
                                                    </div> 
                                                <?php    
                                                }
                                                ?>

                                                                    
                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $i; ?>" value="<?php echo $row->cheque_id; ?>">
                                                <input type="hidden" class="cheque_no<?php echo $i; ?>" value="<?php echo $row->cheque_no; ?>">
                                                <?php  if ($row->cheque_id > 0){ ?>
                                                    <div class="bank_cheque_field<?php echo $i; ?>">
                                                        <div class="form-group col-md-3">
                                                            <label for="Bank" class="control-label">Cheque Book *</label>
                                                            <?php
                                                                $cheque_name = value_by_id("tblchequebook", $row->cheque_id, "chequebook_name");
                                                            ?>
                                                            <input type="text" class="form-control col-md-4" readonly="" value="<?php echo $cheque_name; ?>">
                                                        </div>    
                                                    </div>
                                                <?php }
                                                      if ($row->cheque_no > 0){
                                                ?>
                                                    <div class="bank_cheque_num_range<?php echo $i; ?>">
                                                        <div class="form-group col-md-3">
                                                            <label for="Bank" class="control-label">Cheque Book Number *</label>
                                                            <input type="text" class="form-control col-md-4" readonly="" value="<?php echo $row->cheque_no; ?>">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>   
                                             
                                    </fieldset>
                                </div> 


                                <?php
                            }

                        }  
                        ?>   

                   
                        </div>
                        

                         <?php
                        if(!empty($id)){
                            echo '<input type="hidden" value="'.$id.'" name="id">'; 
                        }

                        if(!empty($action)){
                            if (empty($approval_info) OR (!empty($approval_info) && $approval_info->approve_status == 5)) {
                        ?>
                        <div class="btn-bottom-toolbar text-right">
                            <button type="submit" name="action" value="5" style="background-color: #f9d306;color:#fff;" class="btn">
                                On Hold
                            </button>
                            <button type="submit" name="action" value="4" style="background-color: #9d0b1a;color:#fff;" class="btn">
                                Reconciliation
                            </button>
                            <button class="btn btn-info" name="action" value="1" type="submit">Approve</button>
                            <button class="btn btn-danger" name="action" value="2" type="submit">Reject</button>
                        </div>
						<?php
                            }
                         }
                        ?>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>



</body>
</html>