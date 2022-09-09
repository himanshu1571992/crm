<?php
init_head();
?>

<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width:100%;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">

           <?php echo form_open($this->uri->uri_string(), array('id' => 'company-receipt-form', 'class' => 'company-receipt-form')); ?>

            <div class="col-md-12">
                <div class="panel_s">
                 <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><?php if(!empty($title)){ echo $title;}?></h3>
                            <hr/>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group col-md-3 select-placeholder">
                                <label for="type" class="control-label">Type</label>
                                <select class="form-control selectpicker" id="type"  name="type" required="">
                                    <option value="">--Select One--</option>
                                    <option value="1" <?php echo (isset($receipt->type) && $receipt->type == 1) ? 'selected' : "" ?>>General Receipt</option>
                                    <option value="2" <?php echo (isset($receipt->type) && $receipt->type == 2) ? 'selected' : "" ?>>Internal Point Transfer</option>
                                </select>
                            </div>
                        

                        <div class="form-group col-md-3" id="amt_div">
                            <label for="amount" class="control-label">Amount</label>
                            <input type="text" id="amount" name="amount" class="form-control" required value="<?php echo (isset($receipt->amount) && $receipt->amount != "") ? $receipt->amount : ''; ?>">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="utr_no" class="control-label">Utr No.</label>
                            <input type="text" id="utr_no" name="utr_no" class="form-control" value="<?php echo (isset($receipt->utr_no) && $receipt->utr_no != "") ? $receipt->utr_no : ''; ?>">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="remark" class="control-label">Date</label>
                            <div class="input-group date">
                                <input id="date" required name="date" class="form-control datepicker" value="<?php echo (isset($receipt->date) && $receipt->date != "") ? $receipt->date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="remark" class="control-label">Remark</label>
                            <textarea id="remark" name="remark" class="form-control"><?php echo (isset($receipt->remark) && $receipt->remark != "") ? $receipt->remark : ''; ?></textarea>
                        </div>

                        <?php 
                        if(!empty($receipt)) {
                        if($receipt->type == 1)
                        { ?>
                         <div id="Receipt" style="display: block;">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="receipt" class="control-label">Receipt</label>
                                <select class="form-control selectpicker" id="receipt"  name="receipt_name" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($receipt_info)){
                                             foreach ($receipt_info as $receipt_key => $receipt_value) {
                                                ?>
                                             <option value="<?php echo $receipt_value->id; ?>" <?php echo (isset($receipt->receipt_id) && $receipt->receipt_id==$receipt_value->id) ? 'selected' : "" ?>><?php echo $receipt_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div id="Receipt" style="display: none;">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="receipt" class="control-label">Receipt</label>
                                <select class="form-control selectpicker" id="receipt"  name="receipt_name" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($receipt_info)){
                                             foreach ($receipt_info as $receipt_key => $receipt_value) {
                                                ?>
                                             <option value="<?php echo $receipt_value->id; ?>" ><?php echo $receipt_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <?php }  
                        } else { ?>
                        <div id="Receipt" style="display: none;">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="receipt" class="control-label">Receipt</label>
                                <select class="form-control selectpicker" id="receipt"  name="receipt_name" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($receipt_info)){
                                             foreach ($receipt_info as $receipt_key => $receipt_value) {
                                                ?>
                                             <option value="<?php echo $receipt_value->id; ?>" ><?php echo $receipt_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <?php }
                        ?>
                        

                        <?php
                        if(!empty($receipt)) {
                        if($receipt->type == 2)
                        { ?>
                        <div id="bank" style="display: block;">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="from_bank" class="control-label">From Bank</label>
                                <select class="form-control selectpicker" id="from_bank"  name="from_bank" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($bank_info)){
                                             foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                             <option value="<?php echo $bank_value->id; ?>" <?php echo (isset($receipt->from_bank) && $receipt->from_bank==$bank_value->id) ? 'selected' : "" ?>><?php echo $bank_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="to_bank" class="control-label">To Bank</label>
                                <select class="form-control selectpicker" id="to_bank"  name="to_bank" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($bank_info)){
                                             foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                             <option value="<?php echo $bank_value->id; ?>" <?php echo (isset($receipt->to_bank) && $receipt->to_bank==$bank_value->id) ? 'selected' : "" ?>><?php echo $bank_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div id="bank" style="display: none;">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="from_bank" class="control-label">From Bank</label>
                                <select class="form-control selectpicker" id="from_bank"  name="from_bank" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($bank_info)){
                                             foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                             <option value="<?php echo $bank_value->id; ?>" ><?php echo $bank_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="to_bank" class="control-label">To Bank</label>
                                <select class="form-control selectpicker" id="to_bank"  name="to_bank" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($bank_info)){
                                             foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                             <option value="<?php echo $bank_value->id; ?>" ><?php echo $bank_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <?php } } else {?>
                        <div id="bank" style="display: none;">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="from_bank" class="control-label">From Bank</label>
                                <select class="form-control selectpicker" id="from_bank"  name="from_bank" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($bank_info)){
                                             foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                             <option value="<?php echo $bank_value->id; ?>" ><?php echo $bank_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="to_bank" class="control-label">To Bank</label>
                                <select class="form-control selectpicker" id="to_bank"  name="to_bank" data-live-search="true">
                                       <option value="">--Select One--</option>
                                        <?php

                                        if(!empty($bank_info)){
                                             foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                             <option value="<?php echo $bank_value->id; ?>" ><?php echo $bank_value->name; ?></option>
                                        <?php
                                           }
                                          }   
                                        ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <?php } ?>

                        </div>

                    </div>



                    <div class="btn-bottom-toolbar text-right">
                        <button class="btn btn-info" type="submit" id="submit">
                            <?php echo 'Submit'; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
     
<?php echo form_close(); ?>

    </div>
</div>
</div>

<?php init_tail(); ?>

<script type="text/javascript">
    $(document).on('change', '#type', function() {   

       var type = $(this).val();
 
       if(type == 1){
            $('#Receipt').show();

            $('#bank').hide();

       }


       else if(type == 2){

            $('#bank').show();

            $('#Receipt').hide();

       }else{
            $('#Receipt').hide();

            $('#bank').hide();

       }



    });
</script>
<script type="text/javascript">
    function preventDupes( select, index ) { 
    var options = select.options,
        len = options.length;
    while( len-- ) {
        options[ len ].disabled = false;
    }
    select.options[ index ].disabled = true;
    /*if( index === select.selectedIndex ) {
        alert('You\'ve already selected the item "' + select.options[index].text + '".\n\nPlease choose another.');
        this.selectedIndex = 0;
    }*/
}

var select1 = select = document.getElementById( 'from_bank' ); 
var select2 = select = document.getElementById( 'to_bank' );

select1.onchange = function() { 
    preventDupes.call(this, select2, this.selectedIndex );
};

select2.onchange = function() {
    preventDupes.call(this, select1, this.selectedIndex );
};
</script>

</body>

</html>

