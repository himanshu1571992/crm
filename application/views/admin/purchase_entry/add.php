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

            <form action="<?php echo site_url($this->uri->uri_string()); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label for="type" class="control-label">Name</label>
                                        <div class="form-group">
                                            
                                            <input type="text" class="form-control" required="" name="name" value="<?php echo (isset($purchaseentry_info) && !empty($purchaseentry_info->name)) ? $purchaseentry_info->name : "";?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="t_date" class="control-label">Company Branch</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="branch_id" name="branch_id">   
                                            <option value=""></option>
                                            <?php
                                            if ($companybranch_list) {
                                                foreach ($companybranch_list as $value) {
                                                    $selected = (isset($purchaseentry_info) && $purchaseentry_info->branch_id == $value->id) ? "selected" : "";
                                                    echo '<option value="' . $value->id . '" ' . $selected . '>' . $value->comp_branch_name . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="type" class="control-label">GST Number</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" required="" name="gst_number" value="<?php echo (isset($purchaseentry_info) && !empty($purchaseentry_info->gst_number)) ? $purchaseentry_info->gst_number : "";?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="type" class="control-label">Invoice Number</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" required="" name="invoice_number" value="<?php echo (isset($purchaseentry_info) && !empty($purchaseentry_info->invoice_number)) ? $purchaseentry_info->invoice_number : "";?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label"> Invoice Date </label>
                                        <?php $invdate = (isset($purchaseentry_info)) ? db_date($purchaseentry_info->invoice_date) : date("d/m/Y") ?>
                                        <input type="text" id="date" name="invoice_date" class="form-control datepicker" value="<?php echo $invdate; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tax_type" class="control-label">Tax Type</label>
                                        <div class="form-group">
                                            <select required="" class="form-control selectpicker" id="tax_type" name="tax_type" data-live-search="true">
                                                <option value=""></option>
                                                <option value="1" <?php echo (!empty($purchaseentry_info) && $purchaseentry_info->tax_type == 1) ? 'selected' : ''; ?> >CGST+SGST</option>
                                                <option value="2" <?php echo (!empty($purchaseentry_info) && $purchaseentry_info->tax_type == 2) ? 'selected' : ''; ?> >IGST</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="type" class="control-label">Total Amount</label>
                                        <div class="form-group">
                                            <input type="text" id="totalamount" class="form-control" required="" name="totalamount" value="<?php echo (isset($purchaseentry_info) && !empty($purchaseentry_info->totalamount)) ? $purchaseentry_info->totalamount : "";?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="type" class="control-label">Basic Amount</label>
                                        <div class="form-group">
                                            <input type="text" id="basic_amount" class="form-control" required="" name="basic_amount" value="<?php echo (isset($purchaseentry_info) && !empty($purchaseentry_info->basic_amount)) ? $purchaseentry_info->basic_amount : "";?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label for="type" class="control-label">Tax Amount</label>
                                        <div class="form-group">
                                            <input type="text"id="tax_amt" class="form-control" readonly="" required="" name="total_tax" value="<?php echo (isset($purchaseentry_info) && !empty($purchaseentry_info->total_tax)) ? $purchaseentry_info->total_tax : "";?>">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <label for="remark" class="control-label">Remarks</label>
                                        <textarea id="remark" class="form-control" rows="5" name="remark"><?php echo (isset($purchaseentry_info) && !empty($purchaseentry_info->remark)) ? $purchaseentry_info->remark : "";?></textarea>
                                    </div> 
                                </div>
                            </div>
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" type="submit">Save</button>
                            </div>
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

    $(document).on("keyup", "#basic_amount", function(){
        var basic_amount = $(this).val();
        var totalamount = $("#totalamount").val();
        if (totalamount != "" && basic_amount != ""){
            $("#tax_amt").val(parseFloat(totalamount)-parseFloat(basic_amount));
        }
    });
    
    $(document).on("keyup", "#totalamount", function(){
        var totalamount = $(this).val();
        var basic_amount = $("#basic_amount").val();
        if (totalamount != "" && basic_amount != ""){
            $("#tax_amt").val(parseFloat(totalamount)-parseFloat(basic_amount));
        }
    });
   
</script>

</body>
</html>