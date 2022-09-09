<?php init_head(); ?>
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
                                    <div class="form-group col-md-6" id="transport_party" <?php echo (isset($payment_info->party_name) && $payment_info->party_name != "") ? '' : "hidden" ?>>
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
                                <div class="form-group col-md-6">
                                    <label for="amount" class="control-label">Amount</label>
                                    <input type="text" id="amount" onkeypress="return isNumberKey(event)" name="amount" class="form-control" required="" value="<?php echo (isset($payment_info->amount) && $payment_info->amount != "") ? $payment_info->amount : "" ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tds_amt" class="control-label">TDS Amount</label>
                                    <input type="text" id="tds_amt" onkeypress="return isNumberKey(event)" name="tds_amt" class="form-control" required="" value="<?php echo (isset($payment_info->tds_amt) && $payment_info->tds_amt != "") ? $payment_info->tds_amt : "" ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="reminderdays" class="control-label">Reminder Day</label>
                                    <input type="number" id="reminderdays" min="1" max="31" name="reminderdays" class="form-control" required="" value="<?php echo (isset($payment_info->reminderdays) && $payment_info->reminderdays != "") ? $payment_info->reminderdays : "" ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="reminderdays" class="control-label">Reminder Send To</label>
                                    <select class="form-control selectpicker" id="remindersendto" required="" name="reminder_send_to[]" multiple data-live-search="true">
                                       <?php 
                                            if(!empty($staff_list)){
                                                foreach ($staff_list as $key => $value) {
                                                    $reminder_send_to = (isset($payment_info) && $payment_info->reminder_send_to != "") ? explode(',',$payment_info->reminder_send_to) : [];
                                                    
                                                    $selectedcls = (in_array($value->staffid, $reminder_send_to)) ? 'selected=""': '';
                                                    echo '<option value="'.$value->staffid.'" '.$selectedcls.'>'.cc($value->firstname).'</option>';
                                                }
                                            }
                                       ?>
                                    </select>
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

        // var chksection = '<?php echo (isset($payment_info)) ? 1 : 0; ?>';
        // if (chksection == 1){
        //     getTypedata();
        //     get_category_data();
        //     get_head_data();
        //     getsubhead_data();
        //     get_transport_against();
        // }
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
    get_category_data();
    $('#from_date').val('');
    $('#to_date').val('');            
    $('#deposit_amount').val('');            
    $('#type').val('');            
});

function get_category_data(){
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
                    $('#from_date').val('');
                    $('#to_date').val('');
                } 
                else 
                {
                    $('#type_div').show();
                    $('#type').html(response);
                    $('#from_date').val('');
                    $('#to_date').val('');
                }                
            }
        }
    });
}

$(document).on('change', '#head_id', function() {   
    get_head_data();
});
function get_head_data(){
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
        });

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
            });
        }
}
$(document).on('change', '#subhead_id', function() {   
    getsubhead_data();
});
function getsubhead_data(){
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
}

$(document).on('change', '#type', function() {   
    getTypedata();
});

function getTypedata(){
    var type = $("#type").val(); 
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
}
$(document).on('change', '#transport_against', function() {   
    get_transport_against();
});

function get_transport_against(){
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
    });  
}
</script>

</body>
</html>
