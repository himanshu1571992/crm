<?php init_head(); ?>
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
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'paymentrequest-form', 'class' => 'paymentrequest-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                                <?php if (isset($_GET["reminder_id"]) && !empty($_GET["reminder_id"])) {
                                    echo '<input type="hidden" name="reminder_id" value="'.$_GET["reminder_id"].'">';
                                } ?>    
                                <div class="form-group col-md-6">
                                    <label for="category_id" class="control-label">Expense Category *</label>
                                    <select class="form-control" required="" id="category_id" name="category_id">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        if(!empty($category_info)){
                                            foreach ($category_info as $key => $value) {
                                               ?>                                               
                                                 <option value="<?php echo $value->id; ?>" <?php if(!empty($payment_info->category_id) && $payment_info->category_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                               <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                                    $tcls = '';
                                    if (isset($payment_info)){
                                        if ($payment_info->type == 0){
                                            $tcls = 'hidden';
                                        }
                                    }
                                ?>          
                                <div class="form-group col-md-6" id="type_div" <?php echo $tcls; ?>>
                                    <label for="type" class="control-label">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        if(!empty($payment_info->category_id) && $payment_info->category_id == 3)
                                        { ?>
                                        <option value="1" <?php if(!empty($payment_info->type) && $payment_info->type == 1){ echo 'selected';} ?>>Rent</option>
                                        <option value="2" <?php if(!empty($payment_info->type) && $payment_info->type == 2){ echo 'selected';} ?>>Deposit</option>
                                        <option value="3" <?php if(!empty($payment_info->type) && $payment_info->type == 3){ echo 'selected';} ?>>Both</option>
                                        <?php }
                                        else if(!empty($payment_info->category_id) && $payment_info->category_id == 4)
                                        { ?>
                                        <option value="1" <?php if(!empty($payment_info->type) && $payment_info->type == 1){ echo 'selected';} ?>>Recurring</option>
                                        <option value="2" <?php if(!empty($payment_info->type) && $payment_info->type == 2){ echo 'selected';} ?>>Onetime</option>
                                        <?php }
                                        else if(!empty($payment_info->category_id) && $payment_info->category_id == 6)
                                        { ?>
                                        <option value="1" <?php if(!empty($payment_info->type) && $payment_info->type == 1){ echo 'selected';} ?>>Regular</option>
                                        <option value="2" <?php if(!empty($payment_info->type) && $payment_info->type == 2){ echo 'selected';} ?>>Onetime</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <?php 
                                    $showdiv = 'hidden';
                                    if (!empty($payment_info->category_id)) {
                                        if ($payment_info->category_id == 3 && ($payment_info->type == 1 OR $payment_info->type == 3)){
                                            $showdiv = '';
                                        }else if($payment_info->category_id == 4 && $payment_info->type == 1){
                                            $showdiv = '';
                                        }
                                    }
                                ?>
                                <div id="rent_type" <?php echo $showdiv;?>>
                                    <div class="form-group col-md-3" app-field-wrapper="date">
                                        <label for="from_date" class="control-label"><?php echo 'From Date'; ?></label>
                                        <div class="input-group date">
                                            <input id="from_date" name="from_date" class="form-control datepicker" value="<?php echo (isset($payment_info->from_date) && $payment_info->from_date != "") ? _d($payment_info->from_date) : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3" app-field-wrapper="date">
                                        <label for="to_date" class="control-label"><?php echo 'To Date'; ?></label>
                                        <div class="input-group date">
                                            <input id="to_date" name="to_date" class="form-control datepicker" value="<?php echo (isset($payment_info->to_date) && $payment_info->to_date != "") ? _d($payment_info->to_date) : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div> 
                                </div>

                                <div id="deposit_type" <?php echo (isset($payment_info->deposit_amount) && $payment_info->deposit_amount != "0.00") ? "" : "hidden"; ?>>
                                <div class="form-group col-md-6">
                                    <label for="deposit_amount" class="control-label">Deposit Amount</label>
                                    <input type="text" id="deposit_amount" onkeypress="return isNumberKey(event)" name="deposit_amount" class="form-control" value="<?php echo (isset($payment_info->deposit_amount) && $payment_info->deposit_amount != "") ? $payment_info->deposit_amount : "" ?>">
                                </div>  
                                </div>
                                
                                <div id="transport_type" <?php echo (!empty($payment_info->transport_against) && $payment_info->transport_against > 0) ? '': 'hidden'; ?>>
                                    <div class="form-group col-md-6">
                                        <label for="transport_against" class="control-label">Transport Against</label>
                                        <select class="form-control" id="transport_against" name="transport_against">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <option value="1" <?php if(!empty($payment_info->transport_against) && $payment_info->transport_against == 1){ echo 'selected';} ?>>Invoice</option>
                                        <option value="2" <?php if(!empty($payment_info->transport_against) && $payment_info->transport_against == 2){ echo 'selected';} ?>>PO</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6" id="transport_party" <?php echo (!empty($payment_info) && $payment_info->category_id == '6' && $payment_info->type == '1') ? 'hidden':''; ?>>
                                        <label for="party_name" class="control-label">Party Name</label>
                                        <input type="text" id="party_name" name="party_name" class="form-control" value="<?php echo (isset($payment_info->party_name) && $payment_info->party_name != "") ? $payment_info->party_name : "" ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="document_id" class="control-label">Select Document</label>
                                        <select class="form-control selectpicker" id="document_id" name="document_id[]" data-live-search="true" multiple="">
                                            <option value="0">--Select One-</option>
                                                <?php
                                                    if (!empty($payment_info->document_id)){
                                                        $documentids = explode(',', $payment_info->document_id);
                                                        if($payment_info->transport_against == 1)
                                                        {
                                                            $invoice_info = $this->db->query("SELECT * FROM `tblinvoices` where status = 1")->result();
                                                            if(!empty($invoice_info)){
                                                                foreach ($invoice_info as $key => $value) {
                                                                    $selectedcls = (in_array($value->id, $documentids)) ? 'selected': '';
                                                                    $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();
                                                                    $client = $value->number.' '.'('.$client_info->client_branch_name.')';
                                                                    echo '<option value="'.$value->id.'" '.$selectedcls.'>'.$client.'</option>';
                                                                }
                                                            }
                                                        }
                                                        else if($payment_info->transport_against == 2)
                                                        {
                                                            $po_info = $this->db->query("SELECT * FROM `tblpurchaseorder` where status = 1")->result();
                                                            if(!empty($po_info)){
                                                                foreach ($po_info as $key => $value) {
                                                                    $selectedcls = (in_array($value->id, $documentids)) ? 'selected': '';
                                                                    $vendor_info = value_by_id('tblvendor',$value->vendor_id,'name');
                                                                    $vendor = 'PO-'.$value->number.' '.'('.$vendor_info.')';
                                                                    echo '<option value="'.$value->id.'" '.$selectedcls.'>'.$vendor.'</option>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
                                        </select>
                                    </div>  
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="head_id" class="control-label">Head *</label>
                                    <select class="form-control selectpicker" required="" id="head_id" name="head_id" data-live-search="true">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        $head_data = $this->db->query("SELECT * from `tblheads` where category_id = '".$payment_info->category_id."' AND status = 1 order by id desc  ")->result();
                                        if(!empty($head_data)){
                                            foreach ($head_data as $key => $value) {
                                               ?>                                               
                                                 <option value="<?php echo $value->id; ?>" <?php if(!empty($payment_info->head_id) && $payment_info->head_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                               <?php
                                            }
                                        }
                                        ?> 
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="subhead_id" class="control-label">Sub Head</label>
                                    <select class="form-control selectpicker" id="subhead_id" name="sub_head_id" data-live-search="true">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        $subhead_data = $this->db->query("SELECT * from `tblsubheads` where head_id = '".$payment_info->head_id."' AND status = 1 order by id desc  ")->result();
                                        if(!empty($subhead_data)){
                                            foreach ($subhead_data as $key => $value) {
                                               ?>                                               
                                                 <option value="<?php echo $value->id; ?>" <?php if(!empty($payment_info->sub_head_id) && $payment_info->sub_head_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                               <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                                    $pcls = '';
                                    if (isset($payment_info)){
                                        if ($payment_info->party_id == 0){
                                            $pcls = 'hidden';
                                        }
                                    }
                                ?>
                                <div class="form-group col-md-6" id="party_name1" <?php echo $pcls; ?>>
                                    <label for="party_id" class="control-label">Party Name</label>
                                    <select class="form-control selectpicker" id="party_id" name="party_id" data-live-search="true">
                                        <?php 
                                            if (isset($payment_info) && $payment_info->party_id > 0){
                                                if ($payment_info->head_id > 0 && $payment_info->category_id > 0){
                                                    $party_info = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where category_id = '".$payment_info->category_id."' and head_id = '".$payment_info->head_id."' order by name asc")->result();
                                                }else{
                                                    $party_info = $this->db->query("SELECT * FROM `tblcompanyexpenseparties` where category_id = '".$payment_info->category_id."'")->result();
                                                }
                                    
                                                echo '<option value="">--Select One-</option>';
                                                if(!empty($party_info)){
                                                    foreach ($party_info as $key => $value) {
                                                        $selectedcls = ($payment_info->party_id == $value->id) ? 'selected=""': '';
                                                        echo '<option value="'.$value->id.'" '.$selectedcls.'>'.cc($value->name).'</option>';
                                                    }
                                                }
                                            }
                                       ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="amount" class="control-label">Paid Amount</label>
                                            <input type="text" id="amount" onkeypress="return isNumberKey(event)" name="amount" class="form-control" required="" value="<?php echo (isset($payment_info->amount) && $payment_info->amount != "") ? $payment_info->amount : "" ?>">
                                        </div> 
                                        <div class="form-group col-md-6" app-field-wrapper="date">
                                            <label for="to_date" class="control-label"><?php echo 'Booking Date'; ?></label>
                                            <div class="input-group date">
                                                <input id="booking_date" name="booking_date" required="" class="form-control datepicker" value="<?php echo (isset($payment_info->booking_date) && $payment_info->booking_date != "") ? _d($payment_info->booking_date) : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>            
                                

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-6" app-field-wrapper="date">
                                            <label for="taxable_amount" class="control-label">Taxable Amount</label>
                                            <input type="text" id="taxable_amount"  onkeypress="return isNumberKey(event)" name="taxable_amount" class="form-control" required="" value="<?php echo (isset($payment_info->taxable_amount) && $payment_info->taxable_amount != "") ? $payment_info->taxable_amount : "" ?>">
                                        </div>
                                        <div class="form-group col-md-6" app-field-wrapper="date">
                                            <label for="tds_amt" class="control-label">TDS Amount</label>
                                            <input type="text" id="tds_amt" onkeypress="return isNumberKey(event)" name="tds_amt" class="form-control" required="" value="<?php echo (isset($payment_info->tds_amt) && $payment_info->tds_amt != "") ? $payment_info->tds_amt : "" ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="remark" class="control-label">Remark </label>
                                    <textarea id="remark" name="remark" class="form-control"><?php echo (isset($payment_info->remark) && $payment_info->remark != "") ? $payment_info->remark : "" ?></textarea>
                                </div>
                                
                                <div class="form-group col-md-6">
                                 <label for="color" class="control-label">Approved By</label>
                                    
                                    <select class="form-control selectpicker" required="" multiple data-live-search="true" id="assign" name="assign[assignid][]">
                                        <?php
                                        if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                            foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) 
                                            {?>
                                                 <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
                                                <option value=""><?php echo $Staffgroup_value['name'] ?></option>
                                                <?php
                                                foreach($Staffgroup_value['staffs'] as $singstaff)
                                                {?>
                                                    <option style="padding-left: 50px;" value="<?php echo $singstaff['staffid'] ?>" <?php 
                                                     foreach ($approved_by as $approvby) 
                                                     {
                                                    if(isset($approvby->staffid) && in_array($singstaff['staffid'],$approvby->staffid)){echo'selected';} }?>><?php echo $singstaff['firstname'] ?></option>
                                                <?php
                                                }?>
                                                </optgroup>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </select> 
                                </div>
                                <div class="col-md-6">
                                    <label for="file" class="control-label">File</label>
                                    <input type="file" id="file" class="form-control" multiple="" name="file[]" style="width: 100%;">
                                    <div class="row">
                                        <div class="card">
                                            <ul class="list-group list-group-flush">
                                        <?php 
                                            if (!empty($payment_info)){
                                                $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'payment_request' and rel_id = '".$payment_info->id."' ")->result();
                                                if(!empty($file_info)){
                                                    foreach ($file_info as $key => $file) {
                                        ?>
                                                        <li class="list-group-item col-md-6"><?php echo 1+$key.') '; ?><a target="_blank" href="<?php echo base_url('uploads/payment_request/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a></li>
                                        <?php            
                                                    }
                                                }
                                            }    
                                        ?>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                </div> 
                              
                        </div>

                        <?php
                        if(!empty($id)){
                            ?>
                            <input type="hidden" value="<?php echo $id;?>" name="id">
                            <?php
                        }
                        ?>

                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
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


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });

    function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

$(document).on('change', '#category_id', function() {   
       var category_id = $("#category_id").val();
       
           $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/company_expense/get_head'); ?>",
                data    : {'category_id' : category_id},
                success : function(response){
                    if(response != ''){                   
                         $('#head_id').html(response);  
                         $('.selectpicker').selectpicker('refresh');
                         $('#subhead_id').html('<option value="">--Select One-</option>');
                    }
                }
            })    
    

           $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/company_expense/get_type'); ?>",
                data    : {'category_id' : category_id},
                success : function(response){
                    if(response != ''){ 
                         if(response == 5)
                         { 
                           $('#type_div').hide();
                           $('#rent_type').hide();
                           $('#deposit_type').hide();
                           $('#transport_type').hide();
                           $('#party_name1').show();
                           $('#transport_party').hide();

                         } 
                         else 
                         {
                            $('#type_div').show();
                            $('#type').html(response);
                         }               
                          
                    }
                }
            })

                
});

$(document).on('change', '#head_id', function() {   
       var head_id = $("#head_id").val();
       var category_id = $("#category_id").val(); 
           $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/company_expense/get_subhead'); ?>",
                data    : {'head_id' : head_id},
                success : function(response){
                    if(response != ''){                   
                         $('#subhead_id').html(response); 
                         $('.selectpicker').selectpicker('refresh'); 
                    }
                }
            })

            if(head_id != '')
            { 
               $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/company_expense/get_party'); ?>",
                data    : {'category_id' : category_id,'head_id' : head_id},
                success : function(response){
                    if(response != ''){                   
                         $('#party_id').html(response); 
                         $('.selectpicker').selectpicker('refresh');
                    }
                }
            }) 
            }    
    });

$(document).on('change', '#subhead_id', function() {   
       var subhead_id = $("#subhead_id").val();
       var head_id = $("#head_id").val();
       var category_id = $("#category_id").val(); 

            if(head_id != '' && subhead_id != '')
            { 
               $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/company_expense/get_subparty'); ?>",
                data    : {'category_id' : category_id,'head_id' : head_id,'subhead_id' : subhead_id},
                success : function(response){
                    if(response != ''){                   
                         $('#party_id').html(response);
                         $('.selectpicker').selectpicker('refresh'); 
                    }
                }
            }) 
            }    
    });

$(document).on('change', '#type', function() {   
       var type = $(this).val(); 
       var category_id = $("#category_id").val();  
       
       if(category_id == 3)
       { 
            if(type == 1){
                $('#rent_type').show();
                $('#deposit_type').hide();
                $('#transport_type').hide();
                $('#party_name1').show();
            }else if(type == 2){

                    $('#deposit_type').show();
                    $('#rent_type').hide();
                    $('#transport_type').hide();
                    $('#party_name1').show();
            }
            else if(type == 3){

                    $('#deposit_type').show();
                    $('#rent_type').show();
                    $('#transport_type').hide();
                    $('#party_name1').show();
            }
            else
            {
                $('#deposit_type').hide();
                $('#rent_type').hide();
                $('#transport_type').hide();
                $('#party_name1').show();
            }
       }
       else if(category_id == 4)
       { 
           if(type == 1){
                $('#rent_type').show();
                $('#deposit_type').hide();
                $('#transport_type').hide();
                $('#party_name1').show();
            }
            else if(type == 2)
            {
                $('#rent_type').hide();
                $('#deposit_type').hide();
                $('#transport_type').hide();
                $('#party_name1').show();
            }
            else
            {
                $('#rent_type').hide();
                $('#deposit_type').hide();
                $('#transport_type').hide();
                $('#party_name1').show();
            }
       }
       else if(category_id == 6)
       {
           
            if(type == 1){
                $('#rent_type').hide();
                $('#deposit_type').hide();
                $('#transport_type').show();
                $('#transport_party').hide();
                $('#party_name1').show();
            }
            else if(type == 2)
            {
                $('#rent_type').hide();
                $('#deposit_type').hide();
                $('#transport_type').show();
                $('#transport_party').show();
                $('#party_name1').hide();
            }
            else
            {
                $('#rent_type').hide();
                $('#deposit_type').hide();
                $('#transport_type').hide();
                $('#party_name1').show();
            }
       }
       else
       { 
           $('#rent_type').hide();
           $('#deposit_type').hide();
           $('#transport_type').hide();
           $('#party_name1').show();
       }

           
       });

$(document).on('change', '#transport_against', function() {   
       var transport_id = $("#transport_against").val(); 

               $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/company_expense/get_transportagainst'); ?>",
                data    : {'transport_id' : transport_id},
                success : function(response){
                    if(response != ''){                   
                         $('#document_id').html(response);
                         $('.selectpicker').selectpicker('refresh'); 
                    }
                }
            })    
    });

</script>

</body>
</html>
