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

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

           <form action="<?php if(!empty($id)){ echo admin_url('bank_payments/edit'); }else{ echo admin_url('bank_payments/add'); } ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                         <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                            </div>
                            <input type="hidden" value="8111580589" name="account_no">

                            <div class="col-md-4">
                                <label class="control-label">Company Code </label>
                                <input readonly="" type="text" class="form-control" value="SCHACH" name="company_code" id="company_code">
                            </div>

                            <div class="col-md-4">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
                                        <select class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
                                            <?php
                                            if(isset($stockdata['approvby']))
                                            {
                                                $approvby=explode(',',$stockdata['approvby']);
                                            }
                                            if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value)
                                                {?>
                                                     <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
                                                    <option value="<?php echo 'group'.$Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                    <?php
                                                    foreach($Staffgroup_value['staffs'] as $singstaff)
                                                    {?>
                                                        <option style="margin-left: 3%;" value="<?php echo 'staff'.$singstaff['staffid'] ?>" <?php if(isset($approvby) && in_array($singstaff['staffid'],$approvby)){echo'selected';}?>><?php echo $singstaff['firstname'] ?></option>
                                                    <?php
                                                    }?>
                                                    </optgroup>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                </div>

                            <div class="col-md-4">
                                <label for="remark" class="control-label">Remarks</label>
                                <textarea id="remark" class="form-control" name="remark"><?php if(!empty($main_info)){ echo $main_info->remark; }elseif(!empty($save_info)){ echo $save_info->remark; } ?></textarea>
                            </div>

                        </div>
                        <br/>
                        <br/>


                        <div id="main_div">

                        <?php
                        $j = 0;
                        if(!empty($payments_info)){

                            foreach ($payments_info as $i => $row) {
                                $j++;
                                    $category_dtl = $this->db->query("SELECT show_date,show_deposit FROM `tblcompanyexpensecatergory` where id = '".$row->category_id."' ")->row();

                                    if($row->category_id == 1){
                                        $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where active = '1' ")->result();
                                    }elseif($row->category_id == 2){
                                        $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where status = '1' ")->result();
                                    }elseif($row->category_id == 7){
										                    $payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` WHERE active = '1' ORDER BY `client_branch_name` ASC ")->result();
									                  }else{
                                        $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where category_id = '".$row->category_id."' and status = '1' ")->result();
                                    }
                                ?>
                                <input type="hidden" name="paymentdata[<?php echo $i; ?>][pay_type]" value="<?php echo $row->pay_type; ?>">
                                <input type="hidden" name="paymentdata[<?php echo $i; ?>][pay_type_id]" value="<?php echo $row->pay_type_id; ?>">

                                <div id="form_data_<?php echo $i;?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                             <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $i;?>" required="" id="category_id<?php echo $i;?>" name="paymentdata[<?php echo $i;?>][category_id]">
                                                  <option value="" disabled selected >--Select One-</option>
                                                  <?php
                                                  if(!empty($category_info)){
                                                    foreach ($category_info as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>" <?php if($row->category_id == $value->id){ echo 'selected'; } ?>><?php echo cc($value->name); ?></option>
                                                        <?php
                                                    }
                                                  }
                                                  ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $i;?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                        <input type="text" id="date<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->date));?>">
                                                </div>


                                                <?php
                                                if($row->payee_id > 0){
                                                ?>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Payee Name </label>
                                                         <select onchange="get_vendor_detl(<?php echo $i; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $i; ?>" required="" name="paymentdata[<?php echo $i; ?>][payee]">
                                                          <option value="" disabled selected >--Select One-</option>
                                                          <?php
                                                          if(!empty($payee_info)){
                                                            foreach ($payee_info as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>" <?php if($row->payee_id == $value->id){ echo 'selected'; } ?>><?php echo cc($value->name); ?></option>
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
                                                    <label class="control-label">Payee Name  </label>
                                                        <input type="text" required="" id="payee_name<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][payee_name]" class="form-control" value="<?php echo $row->payee_name; ?>">
                                                </div>
                                                <?php
                                                }
                                                ?>



                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                        <input type="text" required="" id="ifsc<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][ifsc]" class="form-control" value="<?php echo $row->ifsc; ?>">
                                                </div>

                                                 <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                        <input type="text" required="" id="account<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][account]" class="form-control" value="<?php echo $row->account; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                <label class="control-label">Select Bank </label>
                                                  <select class="form-control selectpicker bank_id" data-rid="<?php echo $i; ?>" data-live-search="true" id="bank_id<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][bank_id]">
                                                    <option value="">-- Select Bank --</option>
                                                    <?php
                                                    if(!empty($bank_info)){
                                                        foreach ($bank_info as  $bank) {
                                                            ?>
                                                                <option value="<?php echo $bank->id; ?>" <?php if($row->bank_id == $bank->id){ echo 'selected'; }?>><?php echo cc($bank->name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                      <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $i; ?>" data-live-search="true" id="method<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][method]">
                                                        <option value="NEFT" <?php if($row->method == 'NEFT'){ echo 'selected'; }?>>NEFT</option>
                                                        <option value="RTGS" <?php if($row->method == 'RTGS'){ echo 'selected'; }?>>RTGS</option>
                                                        <option value="IFT" <?php if($row->method == 'IFT'){ echo 'selected'; }?>>IFT</option>
                                                        <option value="CASH" <?php if($row->method == 'CASH'){ echo 'selected'; }?>>CASH</option>
                                                        <option value="CHEQUE" <?php if($row->method == 'CHEQUE'){ echo 'selected'; }?>>CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                      <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][type]">
                                                        <option value="RPAY" <?php if($row->type == 'RPAY'){ echo 'selected'; }?>>RPAY</option>
                                                        <option value="SALPAY" <?php if($row->type == 'SALPAY'){ echo 'selected'; }?>>SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                       <input type="text" required="" id="amount<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][amount]" class="form-control" value="<?php echo $row->amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                        <textarea id="first_remark<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][first_remark]" class="form-control"><?php echo $row->first_remark; ?></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                      <textarea id="second_remark<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][second_remark]" class="form-control"><?php echo $row->second_remark; ?></textarea>
                                                </div>


                                            </div>

                                            <div class="row">

                                                <?php
                                                if($category_dtl->show_deposit == 1){
                                                ?>
                                                     <div class="form-group col-md-4">
                                                        <label class="control-label">Deposit </label>
                                                            <input type="text" required="" id="deposit<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][deposit]" class="form-control" value="<?php echo $row->deposit; ?>">
                                                    </div>
                                                <?php
                                                }


                                                if($category_dtl->show_date == 1){
                                                ?>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">From Date </label>
                                                            <input type="text" id="fromdate<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][fromdate]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->fromdate));?>">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">To Date </label>
                                                            <input type="text" id="todate<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][todate]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->todate));?>">
                                                    </div>
                                                <?php
                                                }
                                                ?>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $i; ?>" value="<?php echo $row->cheque_id; ?>">
                                                <input type="hidden" class="cheque_no<?php echo $i; ?>" value="<?php echo $row->cheque_no; ?>">
                                                <div class="bank_cheque_field<?php echo $i;?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $i;?>">

                                                </div>
                                            </div>

                                        </div>
                                             <button style="float: right;" onclick="removeprocomp('<?php echo $i;?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>


                                <?php
                            }

                        }elseif(!empty($save_payments_info)){

                            foreach ($save_payments_info as $i => $row) {
                                $j++;
                                    $category_dtl = $this->db->query("SELECT show_date,show_deposit FROM `tblcompanyexpensecatergory` where id = '".$row->category_id."' ")->row();

                                    if($row->category_id == 1){
                                        $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where active = '1' ")->result();
                                    }elseif($row->category_id == 2){
                                        $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where status = '1' ")->result();
                                    }elseif($row->category_id == 7){
                  										$payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` WHERE active = '1' ORDER BY client_branch_name ASC ")->result();
                  									}else{
                                        $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where category_id = '".$row->category_id."' and status = '1' ")->result();
                                    }
                                ?>
                                <input type="hidden" name="paymentdata[<?php echo $i; ?>][pay_type]" value="<?php echo $row->pay_type; ?>">
                                <input type="hidden" name="paymentdata[<?php echo $i; ?>][pay_type_id]" value="<?php echo $row->pay_type_id; ?>">
                                <div id="form_data_<?php echo $i;?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                             <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $i;?>" required="" id="category_id<?php echo $i;?>" name="paymentdata[<?php echo $i;?>][category_id]">
                                                  <option value="" disabled selected >--Select One-</option>
                                                  <?php
                                                  if(!empty($category_info)){
                                                    foreach ($category_info as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>" <?php if($row->category_id == $value->id){ echo 'selected'; } ?>><?php echo cc($value->name); ?></option>
                                                        <?php
                                                    }
                                                  }
                                                  ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $i;?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                        <input type="text" id="date<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->date));?>">
                                                </div>


                                                <?php
                                                if($row->payee_id > 0){
                                                ?>

                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>
                                                     <select onchange="get_vendor_detl(<?php echo $i; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $i; ?>" required="" name="paymentdata[<?php echo $i; ?>][payee]">
                                                      <option value="" disabled selected >--Select One-</option>
                                                      <?php
                                                      if(!empty($payee_info)){
                                                        foreach ($payee_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if($row->payee_id == $value->id){ echo 'selected'; } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                      }
                                                      ?>
                                                    </select>
                                                </div>
                                                <?php
                                                }else{
                                                ?>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payee Name </label>
                                                        <input type="text" required="" id="payee_name<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][payee_name]" class="form-control" value="<?php echo $row->payee_name; ?>">
                                                </div>
                                                <?php
                                                }
                                                ?>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                        <input type="text" required="" id="ifsc<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][ifsc]" class="form-control" value="<?php echo $row->ifsc; ?>">
                                                </div>

                                                 <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                        <input type="text" required="" id="account<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][account]" class="form-control" value="<?php echo $row->account; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Select Bank </label>
                                                      <select class="form-control selectpicker bank_id" data-live-search="true" data-rid="<?php echo $i; ?>" id="bank_id<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][bank_id]">
                                                        <option value="">-- Select Bank --</option>
                                                        <?php
                                                        if(!empty($bank_info)){
                                                            foreach ($bank_info as  $bank) {
                                                                ?>
                                                                    <option value="<?php echo $bank->id; ?>" <?php if($row->bank_id == $bank->id){ echo 'selected'; }?>><?php echo cc($bank->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                      <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $i; ?>"  data-live-search="true" id="method<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][method]">
                                                        <option value="NEFT" <?php if($row->method == 'NEFT'){ echo 'selected'; }?>>NEFT</option>
                                                        <option value="RTGS" <?php if($row->method == 'RTGS'){ echo 'selected'; }?>>RTGS</option>
                                                        <option value="IFT" <?php if($row->method == 'IFT'){ echo 'selected'; }?>>IFT</option>
                                                        <option value="CASH" <?php if($row->method == 'CASH'){ echo 'selected'; }?>>CASH</option>
                                                        <option value="CHEQUE" <?php if($row->method == 'CHEQUE'){ echo 'selected'; }?>>CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                      <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][type]">
                                                        <option value="RPAY" <?php if($row->type == 'RPAY'){ echo 'selected'; }?>>RPAY</option>
                                                        <option value="SALPAY" <?php if($row->type == 'SALPAY'){ echo 'selected'; }?>>SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                       <input type="text" required="" id="amount<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][amount]" class="form-control" value="<?php echo $row->amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                        <textarea id="first_remark<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][first_remark]" class="form-control"><?php echo $row->first_remark; ?></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                      <textarea id="second_remark<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][second_remark]" class="form-control"><?php echo $row->second_remark; ?></textarea>
                                                </div>


                                            </div>

                                            <div class="row">

                                                <?php
                                                if($category_dtl->show_deposit == 1){
                                                ?>
                                                     <div class="form-group col-md-4">
                                                        <label class="control-label">Deposit </label>
                                                            <input type="text" required="" id="deposit<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][deposit]" class="form-control" value="<?php echo $row->deposit; ?>">
                                                    </div>
                                                <?php
                                                }


                                                if($category_dtl->show_date == 1){
                                                ?>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">From Date </label>
                                                            <input type="text" id="fromdate<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][fromdate]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->fromdate));?>">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">To Date </label>
                                                            <input type="text" id="todate<?php echo $i; ?>" name="paymentdata[<?php echo $i; ?>][todate]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->todate));?>">
                                                    </div>
                                                <?php
                                                }
                                                ?>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $i; ?>" value="<?php echo $row->cheque_id; ?>">
                                                <input type="hidden" class="cheque_no<?php echo $i; ?>" value="<?php echo $row->cheque_no; ?>">
                                                <div class="bank_cheque_field<?php echo $i; ?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $i; ?>">

                                                </div>
                                            </div>
                                        </div>
                                             <button style="float: right;" onclick="removeprocomp('<?php echo $i;?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>


                                <?php
                            }

                        }else{
                            if($type == ''){
                            ?>
                            <div id="form_data_0">
                                <fieldset class="scheduler-border">

                                    <legend class="scheduler-border">
                                         <div class="col-md-4">
                                            <select class="form-control selectpicker category" val="0" required="" id="category_id0" name="paymentdata[0][category_id]">
                                              <option value="" disabled selected >--Select One-</option>
                                              <?php
                                              if(!empty($category_info)){
                                                foreach ($category_info as $key => $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id; ?>"><?php echo cc($value->name); ?></option>
                                                    <?php
                                                }
                                              }
                                              ?>
                                            </select>
                                        </div>
                                    </legend>

                                    <div id="cat_data_0">


                                    </div>
                                         <button style="float: right;" onclick="removeprocomp('0');" class="btn btn-danger" type="button">Remove</button>
                                </fieldset>
                             </div>
                            <?php
                            }
                        }

                        if($type == 'po_payment'){
                           $j++;
                           $po_id = value_by_id_empty('tblpurchaseorderpayments',$type_id,'po_id');
                           $approved_amount = value_by_id_empty('tblpurchaseorderpayments',$type_id,'approved_amount');
                           $vendor_id = value_by_id_empty('tblpurchaseorder',$po_id,'vendor_id');
                           $ifsc = value_by_id_empty('tblvendor',$vendor_id,'ifsc');
                           $account_no = value_by_id_empty('tblvendor',$vendor_id,'account_no');

                           $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where status = '1' ")->result();
                        ?>
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type]" value="po_payment">
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type_id]" value="<?php echo $type_id; ?>">

                            <div id="form_data_<?php echo $j; ?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                            <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $j; ?>" required="" id="category_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][category_id]">
                                                    <option value="" disabled selected >--Select One-</option>
                                                    <?php
                                                    if (!empty($category_info)) {
                                                        foreach ($category_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == 2) {
                                                    echo 'selected';
                                                } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $j; ?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                    <input type="text" id="date<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y'); ?>">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>
                                                    <select onchange="get_vendor_detl(<?php echo $j; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $j; ?>" required="" name="paymentdata[<?php echo $j; ?>][payee]">
                                                        <option value="" disabled selected >--Select One-</option>
                                                        <?php
                                                        if (!empty($payee_info)) {
                                                            foreach ($payee_info as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>" <?php if ($vendor_id == $value->id) {
                                                        echo 'selected';
                                                    } ?>><?php echo cc($value->name); ?></option>
            <?php
        }
    }
    ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                    <input type="text" required="" id="ifsc<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][ifsc]" class="form-control" value="<?php echo $ifsc; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                    <input type="text" required="" id="account<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][account]" class="form-control" value="<?php echo $account_no; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Select Bank </label>
                                                    <select class="form-control selectpicker bank_id"  data-rid="<?php echo $j; ?>" data-live-search="true" id="bank_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][bank_id]">
                                                        <option value="">-- Select Bank --</option>
                                                        <?php
                                                        if (!empty($bank_info)) {
                                                            foreach ($bank_info as $bank) {
                                                                ?>
                                                                <option value="<?php echo $bank->id; ?>" ><?php echo cc($bank->name); ?></option>
            <?php
        }
    }
    ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                    <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $j; ?>" data-live-search="true" id="method<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][method]">
                                                        <option value="NEFT">NEFT</option>
                                                        <option value="RTGS">RTGS</option>
                                                        <option value="IFT">IFT</option>
                                                        <option value="CASH">CASH</option>
                                                        <option value="CHEQUE">CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                    <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][type]">
                                                        <option value="RPAY">RPAY</option>
                                                        <option value="SALPAY">SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                    <input type="text" required="" id="amount<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][amount]" class="form-control" value="<?php echo $approved_amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                    <textarea id="first_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][first_remark]" class="form-control"></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                    <textarea id="second_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][second_remark]" class="form-control"></textarea>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $j; ?>" value="0">
                                                <input type="hidden" class="cheque_no<?php echo $j; ?>" value="0">
                                                <div class="bank_cheque_field<?php echo $j; ?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $j; ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <button style="float: right;" onclick="removeprocomp('<?php echo $j; ?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>
                        <?php
                        }elseif($type == 'request'){
                           $j++;
                           $request_info = $this->db->query("SELECT * FROM `tblrequests` where id = '".$type_id."' ")->row();
                           $staff_id = $request_info->addedfrom;
                           $employee_info = get_employee_info($staff_id);
                           $approved_amount = $request_info->approved_amount;


                           $ifsc = $employee_info->ifsc_code;
                           $account_no = $employee_info->account_no;

                           $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where active = '1' ")->result();
                        ?>
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type]" value="request">
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type_id]" value="<?php echo $type_id; ?>">

                            <div id="form_data_<?php echo $j; ?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                            <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $j; ?>" required="" id="category_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][category_id]">
                                                    <option value="" disabled selected >--Select One-</option>
                                                    <?php
                                                    if (!empty($category_info)) {
                                                        foreach ($category_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == 1) {
                                                    echo 'selected';
                                                } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $j; ?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                    <input type="text" id="date<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y'); ?>">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>
                                                    <select onchange="get_vendor_detl(<?php echo $j; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $j; ?>" required="" name="paymentdata[<?php echo $j; ?>][payee]">
                                                        <option value="" disabled selected >--Select One-</option>
                                                        <?php
                                                        if (!empty($payee_info)) {
                                                            foreach ($payee_info as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>" <?php if ($staff_id == $value->id) {
                                                        echo 'selected';
                                                    } ?>><?php echo cc($value->name); ?></option>
            <?php
        }
    }
    ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                    <input type="text" required="" id="ifsc<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][ifsc]" class="form-control" value="<?php echo $ifsc; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                    <input type="text" required="" id="account<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][account]" class="form-control" value="<?php echo $account_no; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Select Bank </label>
                                                    <select class="form-control selectpicker bank_id" data-rid="<?php echo $j; ?>"  data-live-search="true" id="bank_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][bank_id]">
                                                        <option value="">-- Select Bank --</option>
                                                        <?php
                                                        if (!empty($bank_info)) {
                                                            foreach ($bank_info as $bank) {
                                                                ?>
                                                                <option value="<?php echo $bank->id; ?>" ><?php echo cc($bank->name); ?></option>
            <?php
        }
    }
    ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                    <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $j; ?>"  data-live-search="true" id="method<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][method]">
                                                        <option value="NEFT">NEFT</option>
                                                        <option value="RTGS">RTGS</option>
                                                        <option value="IFT">IFT</option>
                                                        <option value="CASH">CASH</option>
                                                        <option value="CHEQUE">CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                    <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][type]">
                                                        <option value="RPAY">RPAY</option>
                                                        <option value="SALPAY">SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                    <input type="text" required="" id="amount<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][amount]" class="form-control" value="<?php echo $approved_amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                    <textarea id="first_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][first_remark]" class="form-control"></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                    <textarea id="second_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][second_remark]" class="form-control"></textarea>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $j; ?>" value="0">
                                                <input type="hidden" class="cheque_no<?php echo $j; ?>" value="0">
                                                <div class="bank_cheque_field<?php echo $j; ?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $j; ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <button style="float: right;" onclick="removeprocomp('<?php echo $j; ?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>
                        <?php
                        }elseif($type == 'employee_salary'){
                           $j++;
                           $salalrypaidlog_info = $this->db->query("SELECT * FROM `tblsalarypaidlog` where id = '".$type_id."' ")->row();
                           $staff_id = $salalrypaidlog_info->staff_id;
                           $employee_info = get_employee_info($staff_id);
                           $approved_amount = $salalrypaidlog_info->net_salary;


                           $ifsc = $employee_info->ifsc_code;
                           $account_no = $employee_info->account_no;

                           $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where active = '1' ")->result();
                        ?>
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type]" value="employee_salary">
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type_id]" value="<?php echo $type_id; ?>">

                            <div id="form_data_<?php echo $j; ?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                            <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $j; ?>" required="" id="category_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][category_id]">
                                                    <option value="" disabled selected >--Select One-</option>
                                                    <?php
                                                    if (!empty($category_info)) {
                                                        foreach ($category_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == 1) {
                                                    echo 'selected';
                                                } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $j; ?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                    <input type="text" id="date<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y'); ?>">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>
                                                    <select onchange="get_vendor_detl(<?php echo $j; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $j; ?>" required="" name="paymentdata[<?php echo $j; ?>][payee]">
                                                        <option value="" disabled selected >--Select One-</option>
                                                        <?php
                                                        if (!empty($payee_info)) {
                                                            foreach ($payee_info as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>" <?php if ($staff_id == $value->id) {
                                                        echo 'selected';
                                                    } ?>><?php echo cc($value->name); ?></option>
            <?php
        }
    }
    ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                    <input type="text" required="" id="ifsc<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][ifsc]" class="form-control" value="<?php echo $ifsc; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                    <input type="text" required="" id="account<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][account]" class="form-control" value="<?php echo $account_no; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Select Bank </label>
                                                    <select class="form-control selectpicker bank_id" data-rid="<?php echo $j; ?>" data-live-search="true" id="bank_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][bank_id]">
                                                        <option value="">-- Select Bank --</option>
                                                        <?php
                                                        if (!empty($bank_info)) {
                                                            foreach ($bank_info as $bank) {
                                                                ?>
                                                                <option value="<?php echo $bank->id; ?>" ><?php echo cc($bank->name); ?></option>
            <?php
        }
    }
    ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                    <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $j; ?>" data-live-search="true" id="method<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][method]">
                                                        <option value="NEFT">NEFT</option>
                                                        <option value="RTGS">RTGS</option>
                                                        <option value="IFT">IFT</option>
                                                        <option value="CASH">CASH</option>
                                                        <option value="CHEQUE">CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                    <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][type]">
                                                        <option value="RPAY">RPAY</option>
                                                        <option value="SALPAY">SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                    <input type="text" required="" id="amount<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][amount]" class="form-control" value="<?php echo $approved_amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                    <textarea id="first_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][first_remark]" class="form-control"></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                    <textarea id="second_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][second_remark]" class="form-control"></textarea>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $j; ?>" value="0">
                                                <input type="hidden" class="cheque_no<?php echo $j; ?>" value="0">
                                                <div class="bank_cheque_field<?php echo $j; ?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $j; ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <button style="float: right;" onclick="removeprocomp('<?php echo $j; ?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>
                        <?php
                        }elseif($type == 'pettycash'){
                           $j++;
                           $request_info = $this->db->query("SELECT * FROM `tblpettycashrequest` where id = '".$type_id."' ")->row();
                           $staff_id = $request_info->addedfrom;
                           $employee_info = get_employee_info($staff_id);
                           $approved_amount = $request_info->approved_amount;


                           $ifsc = $employee_info->ifsc_code;
                           $account_no = $employee_info->account_no;

                           $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where active = '1' ")->result();
                        ?>
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type]" value="pettycash">
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type_id]" value="<?php echo $type_id; ?>">

                            <div id="form_data_<?php echo $j; ?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                            <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $j; ?>" required="" id="category_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][category_id]">
                                                    <option value="" disabled selected >--Select One-</option>
                                                    <?php
                                                    if (!empty($category_info)) {
                                                        foreach ($category_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == 1) {
                                                    echo 'selected';
                                                } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $j; ?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                    <input type="text" id="date<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y'); ?>">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>
                                                    <select onchange="get_vendor_detl(<?php echo $j; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $j; ?>" required="" name="paymentdata[<?php echo $j; ?>][payee]">
                                                        <option value="" disabled selected >--Select One-</option>
                                                        <?php
                                                        if (!empty($payee_info)) {
                                                            foreach ($payee_info as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>" <?php if ($staff_id == $value->id) {
                                                        echo 'selected';
                                                    } ?>><?php echo cc($value->name); ?></option>
            <?php
        }
    }
    ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                    <input type="text" required="" id="ifsc<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][ifsc]" class="form-control" value="<?php echo $ifsc; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                    <input type="text" required="" id="account<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][account]" class="form-control" value="<?php echo $account_no; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Select Bank </label>
                                                    <select class="form-control selectpicker bank_id" data-rid="<?php echo $j; ?>" data-live-search="true" id="bank_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][bank_id]">
                                                        <option value="">-- Select Bank --</option>
                                                        <?php
                                                        if (!empty($bank_info)) {
                                                            foreach ($bank_info as $bank) {
                                                                ?>
                                                                <option value="<?php echo $bank->id; ?>" ><?php echo cc($bank->name); ?></option>
            <?php
        }
    }
    ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                    <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $j; ?>" data-live-search="true" id="method<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][method]">
                                                        <option value="NEFT">NEFT</option>
                                                        <option value="RTGS">RTGS</option>
                                                        <option value="IFT">IFT</option>
                                                        <option value="CASH">CASH</option>
                                                        <option value="CHEQUE">CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                    <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][type]">
                                                        <option value="RPAY">RPAY</option>
                                                        <option value="SALPAY">SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                    <input type="text" required="" id="amount<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][amount]" class="form-control" value="<?php echo $approved_amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                    <textarea id="first_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][first_remark]" class="form-control"></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                    <textarea id="second_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][second_remark]" class="form-control"></textarea>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $j; ?>" value="0">
                                                <input type="hidden" class="cheque_no<?php echo $j; ?>" value="0">
                                                <div class="bank_cheque_field<?php echo $j; ?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $j; ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <button style="float: right;" onclick="removeprocomp('<?php echo $j; ?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>
                        <?php
                        }elseif($type == 'pay_request'){
                           $row = $this->db->query("SELECT * FROM `tblpaymentrequest` where id = '".$type_id."' ")->row();

                                $j++;

                                    $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where category_id = '".$row->category_id."' and status = '1' ")->result();
                                    $party_info = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where id = '".$row->party_id."' ")->row();
                                ?>
                                <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type]" value="pay_request">
                                <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type_id]" value="<?php echo $type_id; ?>">

                                <div id="form_data_<?php echo $j;?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                             <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $j;?>" required="" id="category_id<?php echo $j;?>" name="paymentdata[<?php echo $j;?>][category_id]">
                                                  <option value="" disabled selected >--Select One-</option>
                                                  <?php
                                                  if(!empty($category_info)){
                                                    foreach ($category_info as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>" <?php if($row->category_id == $value->id){ echo 'selected'; } ?>><?php echo cc($value->name); ?></option>
                                                        <?php
                                                    }
                                                  }
                                                  ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $j;?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                        <input type="text" id="date<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->created_at));?>">
                                                </div>

												<?php
												if($row->party_id > 0){
												?>
												<div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>
                                                     <select onchange="get_vendor_detl(<?php echo $j; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $j; ?>" required="" name="paymentdata[<?php echo $j; ?>][payee]">
                                                      <option value="" disabled selected >--Select One-</option>
                                                      <?php
                                                      if(!empty($payee_info)){
                                                        foreach ($payee_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if($row->party_id == $value->id){ echo 'selected'; } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                      }
                                                      ?>
                                                    </select>
                                                </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="form-group col-md-4">
                                                            <label class="control-label">Payee Name </label>
                                                            <input type="text" required="" id="payee_name<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][payee_name]" class="form-control" value="<?php echo $row->party_name; ?>">
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                        <input type="text" required="" id="ifsc<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][ifsc]" class="form-control" value="<?php echo (!empty($party_info)) ? $party_info->ifsc : ''; ?>">
                                                </div>

                                                 <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                        <input type="text" required="" id="account<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][account]" class="form-control" value="<?php echo (!empty($party_info)) ? $party_info->account_no : ''; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Select Bank </label>
                                                      <select class="form-control selectpicker bank_id"  data-rid="<?php echo $j; ?>" data-live-search="true" id="bank_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][bank_id]">
                                                        <option value="">-- Select Bank --</option>
                                                        <?php
                                                        if(!empty($bank_info)){
                                                            foreach ($bank_info as  $bank) {
                                                                ?>
                                                                    <option value="<?php echo $bank->id; ?>" ><?php echo cc($bank->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                      <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $j; ?>" data-live-search="true" id="method<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][method]">
                                                        <option value="NEFT">NEFT</option>
                                                        <option value="RTGS">RTGS</option>
                                                        <option value="IFT">IFT</option>
                                                        <option value="CASH">CASH</option>
                                                        <option value="CHEQUE">CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                      <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][type]">
                                                        <option value="RPAY">RPAY</option>
                                                        <option value="SALPAY">SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                       <input type="text" required="" id="amount<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][amount]" class="form-control" value="<?php echo $row->amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                        <textarea id="first_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][first_remark]" class="form-control"><?php echo $row->remark; ?></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                      <textarea id="second_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][second_remark]" class="form-control"><?php //echo $row->second_remark; ?></textarea>
                                                </div>


                                            </div>

                                            <div class="row">

                                                <?php
                                                if($row->deposit_amount > 0){
                                                ?>
                                                     <div class="form-group col-md-4">
                                                        <label class="control-label">Deposit </label>
                                                            <input type="text" required="" id="deposit<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][deposit]" class="form-control" value="<?php echo $row->deposit_amount; ?>">
                                                    </div>
                                                <?php
                                                }


                                                if($row->from_date > 0 && $row->to_date > 0){
                                                ?>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">From Date </label>
                                                            <input type="text" id="fromdate<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][fromdate]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->from_date));?>">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">To Date </label>
                                                            <input type="text" id="todate<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][todate]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->to_date));?>">
                                                    </div>
                                                <?php
                                                }
                                                ?>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $j; ?>" value="0">
                                                <input type="hidden" class="cheque_no<?php echo $j; ?>" value="0">
                                                <div class="bank_cheque_field<?php echo $j;?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $j;?>">

                                                </div>
                                            </div>
                                        </div>
                                             <button style="float: right;" onclick="removeprocomp('<?php echo $j;?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>


                                    <?php
                                } elseif ($type == 'client_deposit') {
                                    $j++;
                                    $approved_amount = value_by_id_empty('tblclientdeposits', $type_id, 'ttl_amt');
                                    $client_id = value_by_id_empty('tblclientdeposits', $type_id, 'client_id');
                                    $ifsc = '';
                                    $account_no = '';

                                    $payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` where active = '1' ORDER BY client_branch_name ASC")->result();
                                    ?>
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type]" value="client_deposit">
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type_id]" value="<?php echo $type_id; ?>">

                            <div id="form_data_<?php echo $j; ?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                            <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $j; ?>" required="" id="category_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][category_id]">
                                                    <option value="" disabled selected >--Select One-</option>
                                                    <?php
                                                    if (!empty($category_info)) {
                                                        foreach ($category_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == 7) {
                                                    echo 'selected';
                                                } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $j; ?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                    <input type="text" id="date<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y'); ?>">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>
                                                    <select onchange="get_vendor_detl(<?php echo $j; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $j; ?>" required="" name="paymentdata[<?php echo $j; ?>][payee]">
                                                        <option value="" disabled selected >--Select One-</option>
                                                        <?php
                                                        if (!empty($payee_info)) {
                                                            foreach ($payee_info as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>" <?php if ($client_id == $value->id) {
                                                        echo 'selected';
                                                    } ?>><?php echo cc($value->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                    <input type="text" required="" id="ifsc<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][ifsc]" class="form-control" value="<?php echo $ifsc; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                    <input type="text" required="" id="account<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][account]" class="form-control" value="<?php echo $account_no; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Select Bank </label>
                                                    <select class="form-control selectpicker bank_id" data-rid="<?php echo $j; ?>" data-live-search="true" id="bank_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][bank_id]">
                                                        <option value="">-- Select Bank --</option>
                                                        <?php
                                                        if (!empty($bank_info)) {
                                                            foreach ($bank_info as $bank) {
                                                                ?>
                                                                <option value="<?php echo $bank->id; ?>" ><?php echo cc($bank->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                    <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $j; ?>" data-live-search="true" id="method<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][method]">
                                                        <option value="NEFT">NEFT</option>
                                                        <option value="RTGS">RTGS</option>
                                                        <option value="IFT">IFT</option>
                                                        <option value="CASH">CASH</option>
                                                        <option value="CHEQUE">CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                    <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][type]">
                                                        <option value="RPAY">RPAY</option>
                                                        <option value="SALPAY">SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                    <input type="text" required="" id="amount<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][amount]" class="form-control" value="<?php echo $approved_amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                    <textarea id="first_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][first_remark]" class="form-control"></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                    <textarea id="second_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][second_remark]" class="form-control"></textarea>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $j; ?>" value="0">
                                                <input type="hidden" class="cheque_no<?php echo $j; ?>" value="0">
                                                <div class="bank_cheque_field<?php echo $j; ?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $j; ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <button style="float: right;" onclick="removeprocomp('<?php echo $j; ?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>
                        <?php
                        }elseif ($type == 'client_refund') {
                                    $j++;
                                    $approved_amount = value_by_id_empty('tblclientrefund', $type_id, 'amount');
                                    $client_id = value_by_id_empty('tblclientrefund', $type_id, 'client_id');
                                    $ifsc = '';
                                    $account_no = '';

                                    $payee_info = $this->db->query("SELECT userid as id,client_branch_name as name FROM `tblclientbranch` where active = '1' ORDER BY `client_branch_name` ASC ")->result();
                                    ?>
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type]" value="client_refund">
                            <input type="hidden" name="paymentdata[<?php echo $j; ?>][pay_type_id]" value="<?php echo $type_id; ?>">

                            <div id="form_data_<?php echo $j; ?>">
                                    <fieldset class="scheduler-border">

                                        <legend class="scheduler-border">
                                            <div class="col-md-4">
                                                <select class="form-control selectpicker category" val="<?php echo $j; ?>" required="" id="category_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][category_id]">
                                                    <option value="" disabled selected >--Select One-</option>
                                                    <?php
                                                    if (!empty($category_info)) {
                                                        foreach ($category_info as $value) {
                                                            ?>
                                                            <option value="<?php echo $value->id; ?>" <?php if ($value->id == 7) {
                                                    echo 'selected';
                                                } ?>><?php echo cc($value->name); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </legend>

                                        <div id="cat_data_<?php echo $j; ?>">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Date </label>
                                                    <input type="text" id="date<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y'); ?>">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="control-label">Payee Name </label>
                                                    <select onchange="get_vendor_detl(<?php echo $j; ?>,this.value)" class="form-control selectpicker" id="payee<?php echo $j; ?>" required="" name="paymentdata[<?php echo $j; ?>][payee]">
                                                        <option value="" disabled selected >--Select One-</option>
                                                        <?php
                                                        if (!empty($payee_info)) {
                                                            foreach ($payee_info as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id; ?>" <?php if ($client_id == $value->id) {
                                                        echo 'selected';
                                                    } ?>><?php echo cc($value->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">IFSC Code </label>
                                                    <input type="text" required="" id="ifsc<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][ifsc]" class="form-control" value="<?php echo $ifsc; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Account No. </label>
                                                    <input type="text" required="" id="account<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][account]" class="form-control" value="<?php echo $account_no; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Select Bank </label>
                                                    <select class="form-control selectpicker bank_id" data-rid="<?php echo $j; ?>" data-live-search="true" id="bank_id<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][bank_id]">
                                                        <option value="">-- Select Bank --</option>
                                                        <?php
                                                        if (!empty($bank_info)) {
                                                            foreach ($bank_info as $bank) {
                                                                ?>
                                                                <option value="<?php echo $bank->id; ?>" ><?php echo cc($bank->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Method </label>
                                                    <select required="" class="form-control selectpicker payment_method" data-rid="<?php echo $j; ?>" data-live-search="true" id="method<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][method]">
                                                        <option value="NEFT">NEFT</option>
                                                        <option value="RTGS">RTGS</option>
                                                        <option value="IFT">IFT</option>
                                                        <option value="CASH">CASH</option>
                                                        <option value="CHEQUE">CHEQUE</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Payment Type </label>
                                                    <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][type]">
                                                        <option value="RPAY">RPAY</option>
                                                        <option value="SALPAY">SALPAY</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label class="control-label">Amount </label>
                                                    <input type="text" required="" id="amount<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][amount]" class="form-control" value="<?php echo $approved_amount; ?>">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">First Remark </label>
                                                    <textarea id="first_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][first_remark]" class="form-control"></textarea>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label class="control-label">Second Remark </label>
                                                    <textarea id="second_remark<?php echo $j; ?>" name="paymentdata[<?php echo $j; ?>][second_remark]" class="form-control"></textarea>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <input type="hidden" class="chequeid<?php echo $j; ?>" value="0">
                                                <input type="hidden" class="cheque_no<?php echo $j; ?>" value="0">
                                                <div class="bank_cheque_field<?php echo $j; ?>">

                                                </div>
                                                <div class="bank_cheque_num_range<?php echo $j; ?>">

                                                </div>
                                            </div>
                                        </div>
                                        <button style="float: right;" onclick="removeprocomp('<?php echo $j; ?>');" class="btn btn-danger" type="button">Remove</button>
                                    </fieldset>
                                </div>
                        <?php
                        }
						?>

                        </div>

                        <button style="float: right;" class="btn btn-info addmorepro" value="<?php echo $j; ?>" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button>

                         <?php
                        if(!empty($id)){
                            echo '<input type="hidden" class="pay_id" value="'.$id.'" name="id">';
                        }
                        if(!empty($save_info)){
                            echo '<input type="hidden" class="save_id" value="'.$save_info->id.'" name="save_id">';
                        }
                        ?>

                        <div class="btn-bottom-toolbar text-right">
                            <?php
                            if(empty($id)){
                                echo '<button class="btn btn-success" name="save" value="1" type="submit">Save</button>';
                            }
                            ?>
                            <button class="btn btn-info" type="submit"><?php if(!empty($id)){ echo 'Update Payments'; }else{ echo 'Send For Approval'; } ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<script type="text/javascript">
     $('.date').datepicker();


    $(document).on('click', '.addmorepro', function()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);

        $('#main_div').append('<br/><div id="form_data_'+newaddmore+'"> <fieldset class="scheduler-border"> <legend class="scheduler-border"> <div class="col-md-4"> <select class="form-control selectpicker category" required="" val="'+newaddmore+'" id="category_id'+newaddmore+'" name="paymentdata['+newaddmore+'][category_id]"> <option value="" disabled selected >--Select One-</option> <?php if(!empty($category_info)) { foreach ($category_info as $key=> $value) { ?> <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option> <?php } } ?> </select> </div></legend> <div id="cat_data_'+newaddmore+'"> </div><button style="float: right;" onclick="removeprocomp('+newaddmore+');" class="btn btn-danger" type="button">Remove</button> </fieldset> </div>');



    $('.selectpicker').selectpicker('refresh');
    $('.date').datepicker();
    });

    function removeprocomp(procompid)
    {
        $('#form_data_' + procompid).remove();
    }




    $(document).on('change', '.category', function()
    {
        var category_id = $(this).val();
        var i = $(this).attr('val');



        if(category_id > 0){
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/bank_payments/get_html'); ?>",
                data    : {'category_id' : category_id,'i' : i},
                success : function(response){
                    if(response != ''){
                         $('#cat_data_'+i).html(response);
                         $('.selectpicker').selectpicker('refresh');
                         $('.date').datepicker();
                    }
                }
            })
        }


    });

    function get_vendor_detl(i,vendor)
    {
        var category_id = $('#category_id'+i).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/bank_payments/get_vendor_detl'); ?>",
            data    : {'vendor' : vendor, 'category_id' : category_id},
            success:function(res) {
                var data=JSON.parse(res);
                $('#ifsc'+i).val(data.ifsc);
                $('#account'+i).val(data.account_no);
            }
        })

    }

    $(document).ready(function(){
        var save_id = $(".save_id").val();
        var save_data = (typeof(save_id) !== "undefined") ? save_id : 0;
        $.each($(".bank_id"), function(){
            var rid = $(this).data("rid");
            if (typeof(rid) !== "undefined"){
                var bval = $("#bank_id"+rid).val();
                var methodval = $("#method"+rid).val();
                var chequeid = $(".chequeid"+rid).val();
                $.ajax({
                    type    : "POST",
                    url     : "<?php echo admin_url("bank_payments/getbankchequebook"); ?>",
                    data    : {bank_id: bval, method: methodval, div_id: rid, chequeid: chequeid},
                    success:function(res) {
                         $(".bank_cheque_field"+rid).html(res);
                         $('.selectpicker').selectpicker('refresh');

                        var cheque_book_id = $("#cheque_book_id"+rid).val();
                        var cheque_no = $(".cheque_no"+rid).val();
                        $.ajax({
                            type    : "POST",
                            url     : "<?php echo admin_url("bank_payments/getbankchequerange"); ?>",
                            data    : {cheque_book_id: cheque_book_id, div_id: rid, save_id: save_data, cheque_no: cheque_no},
                            success:function(res) {
                                 $(".bank_cheque_num_range"+rid).html(res);
                                 $('.selectpicker').selectpicker('refresh');
                            }
                        });
                    }
                });
            }

        });

    });

    $(document).on('change', '.bank_id', function(){
        var rid = $(this).data("rid");
        var bval = $("#bank_id"+rid).val();
        var methodval = $("#method"+rid).val();
        var chequeid = $(".chequeid"+rid).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo admin_url("bank_payments/getbankchequebook"); ?>",
            data    : {bank_id: bval, method: methodval, div_id: rid, chequeid: chequeid},
            success:function(res) {
                 $(".bank_cheque_field"+rid).html(res);
                 $('.selectpicker').selectpicker('refresh');
            }
        });
    });
    $(document).on('change', '.payment_method', function(){
        var rid = $(this).data("rid");
        var bval = $("#bank_id"+rid).val();
        var methodval = $("#method"+rid).val();
        var chequeid = $(".chequeid"+rid).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo admin_url("bank_payments/getbankchequebook"); ?>",
            data    : {bank_id: bval, method: methodval, div_id: rid, chequeid: chequeid},
            success:function(res) {
                 $(".bank_cheque_field"+rid).html(res);
                 $('.selectpicker').selectpicker('refresh');
            }
        });
    });
    $(document).on('change', '.chequebook_id', function(){
        var save_id = $(".save_id").val();
        var save_data = (typeof(save_id) !== "undefined") ? save_id : 0;
        var rid = $(this).data("rid");
        var cheque_book_id = $(this).val();
        var cheque_no = $(".cheque_no"+rid).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo admin_url("bank_payments/getbankchequerange"); ?>",
            data    : {cheque_book_id: cheque_book_id, div_id: rid, save_id: save_data, cheque_no: cheque_no},
            success:function(res) {
                 $(".bank_cheque_num_range"+rid).html(res);
                 $('.selectpicker').selectpicker('refresh');
            }
        });
    });
</script>

</body>
</html>
