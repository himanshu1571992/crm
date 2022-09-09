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

            <form action="<?php admin_url('stock_consumption/add') ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                                
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        <label for="client_id" class="control-label">Client</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="client_id" name="client_id" required="">
                                            <option value=""></option>
                                            <?php
                                            if (isset($client_data) && count($client_data) > 0) {
                                                foreach ($client_data as $client_value) {
                                                    $selectedcls = (!empty($upcoming_payment_info) && $upcoming_payment_info->client_id == $client_value->userid) ? "selected": ""; ?>
                                                    ?>
                                                    <option value="<?php echo $client_value->userid; ?>" <?php echo $selectedcls; ?>><?php echo $client_value->client_branch_name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="type" class="control-label">Payment Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="payment_type" name="payment_type" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (!empty($upcoming_payment_info) && $upcoming_payment_info->payment_type == 1) ? "selected": ""; ?>>Cheque</option>
                                        <option value="2" <?php echo (!empty($upcoming_payment_info) && $upcoming_payment_info->payment_type == 2) ? "selected": ""; ?>>NEFT</option>
                                    </select> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="amount" class="control-label">Amount</label>
                                        <input type="number" name="amount" step="any" class="form-control" value="<?php echo (!empty($upcoming_payment_info)) ?$upcoming_payment_info->amount : ''; ?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="reference_no" class="control-label">Reference No</label>
                                        <input type="text" name="ref_no" class="form-control" value="<?php echo (!empty($upcoming_payment_info)) ?$upcoming_payment_info->ref_no : ''; ?>" required="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="remark" class="control-label">Remarks</label>
                                    <textarea id="remark" class="form-control" rows="5" name="remark"><?php echo (!empty($upcoming_payment_info)) ?$upcoming_payment_info->remark : ''; ?></textarea>
                                </div>    
                            </div>
                            <br/>
                            <br/>
                            
                            
                            <br>
                            <br>
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


</body>
</html>