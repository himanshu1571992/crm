<?php
init_head();
?>

<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width:100%;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'payment-form', 'class' => '_propsal_form proposal-form', 'enctype' => 'multipart/form-data')); ?>

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h3><?php echo $title; ?> Form</h3>
                                <hr/>
                            </div>

                            <div class="col-md-12">

                                <div class="form-group col-md-4 select-placeholder">

                                    <label for="payment_method" class="control-label"><small class="req text-danger">* </small> Select Client </label>

                                    <select class="form-control selectpicker" disabled="" id="client_id"  name="client_id" required="" data-live-search="true">

                                        <option value="">--Select One--</option>
                                        <?php
                                        if (!empty($client_info)) {

                                            foreach ($client_info as $key => $value) {
                                                
                                                $selected = (isset($client_deposits) && $client_deposits->client_id == $value->userid) ? "selected=''" : "";
                                                ?>

                                                <option value="<?php echo $value->userid; ?>" <?php echo $selected; ?>><?php echo cc($value->client_branch_name); ?></option>

                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 select-placeholder">

                                    <label for="payment_mode" class="control-label"><small class="req text-danger">* </small> Payment Mode </label>

                                    <select class="form-control selectpicker" disabled="" id="payment_mode"  name="payment_mode" required="">

                                        <option value="">--Select One--</option>

                                        <option value="1" <?php echo (isset($client_deposits) && $client_deposits->payment_mode == "1") ? "selected=''" : ""; ?>>Cheque</option>

                                        <option value="2" <?php echo (isset($client_deposits) && $client_deposits->payment_mode == "2") ? "selected=''" : ""; ?>>NEFT</option>

                                        <option value="3" <?php echo (isset($client_deposits) && $client_deposits->payment_mode == "3") ? "selected=''" : ""; ?>>Cash</option>

                                    </select>

                                </div>

                                <div class="form-group col-md-4">
                                    <?php
                                    $value = (isset($client_deposits) ? _d($client_deposits->date) : _d(date('Y-m-d')));

                                    echo render_date_input('date', 'Payment Date', $value, array("readonly"=>1));
                                    ?>
                                </div>
                                
                                <div id="cheque_div" <?php echo (isset($client_deposits) && $client_deposits->payment_mode == 1) ? "" : "hidden"; ?>>

                                    <div class="form-group col-md-4 select-placeholder">

                                        <label for="chaque_for" class="control-label"><small class="req text-danger">* </small> Cheque For </label>

                                        <select class="form-control selectpicker" disabled="" id="chaque_for"  name="chaque_for" >

                                            <option value="">--Select One--</option>

                                            <option value="1" <?php echo (isset($client_deposits) && $client_deposits->chaque_for == "1") ? "selected=''" : ""; ?>>Post Date</option>

                                            <option value="2" <?php echo (isset($client_deposits) && $client_deposits->chaque_for == "2") ? "selected=''" : ""; ?>>Current Date</option>

                                        </select>

                                    </div>

                                    <div class="form-group col-md-4">     
                                        <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Cheque No.</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span id="prefix">CHQ-</span>
                                            </span>                              

                                            <input type="text" id="cheque_no" readonly=""onkeyup="nospaces(this)" name="cheque_no" class="form-control onlynumbers1" value="<?php echo (isset($client_deposits)) ? $client_deposits->cheque_no : ""; ?>">                                   
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">

                                        <?php
                                        $value = (isset($client_deposits) ? _d($client_deposits->cheque_date) : _d(date('Y-m-d')));

                                        echo render_date_input('cheque_date', 'Cheque Date', $value, array("readonly"=>1));
                                        ?>

                                    </div>    
                                </div>
                                <div id="service_type">

                                    <div class="form-group col-md-4 select-placeholder">

                                        <label for="invoice_id" class="control-label"><small class="req text-danger">* </small> Select Service Type </label>

                                        <select class="form-control selectpicker" disabled=""  data-live-search="true" id="service_type" name="service_type">

                                            <option value=""></option>

                                            <?php
                                            if (isset($service_type) && count($service_type) > 0) {

                                                foreach ($service_type as $service_type_key => $service_type_value) {
                                                    $selected = (isset($client_deposits) && $client_deposits->service_type == $service_type_value['id']) ? "selected=''" : "";
                                                    ?>

                                                    <option value="<?php echo $service_type_value['id'] ?>" <?php echo $selected; ?>><?php echo cc($service_type_value['name']); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-4" id="amt_div">                                   

                                    <label for="ttl_amt" class="control-label"> <small class="req text-danger">* </small> Amount</label>

                                    <input type="text" id="ttl_amt" readonly="" name="ttl_amt" class="form-control" value="<?php echo (isset($client_deposits)) ? $client_deposits->ttl_amt : ""; ?>">                                   

                                </div>

                                <div class="form-group col-md-4">                                   

                                    <label for="reference_no" class="control-label">Reference No.</label>

                                    <input type="text" id="reference_no" readonly="" name="reference_no" class="form-control" value="<?php echo (isset($client_deposits)) ? $client_deposits->reference_no : ""; ?>">                                   

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bank" class="control-label">Bank</label>
                                    <select class="form-control selectpicker" id="bank_id" disabled="" name="bank_id" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if (!empty($bank_info)) {
                                            foreach ($bank_info as $bank_key => $bank_value) {
                                                $selected = (isset($client_deposits) && $client_deposits->bank_id == $bank_value->id) ? "selected=''" : "";
                                                ?>
                                                <option value="<?php echo $bank_value->id; ?>" <?php echo $selected; ?>><?php echo cc($bank_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group col-md-8">

                                    <label for="remark" class="control-label">Remark</label>

                                    <textarea id="remark" name="remark"  readonly="" class="form-control"><?php echo (isset($client_deposits)) ? $client_deposits->remark : ""; ?></textarea>

                                </div>

                                
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel_s">
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                                        </div>

                                        <hr/>
                                        <div class="col-md-12">

                                            <input type="hidden" value="<?php echo $id; ?>" name="id">
                                            <div class="row">
                                                <div class="col-md-12 pull-right">
                                                    <div class="form-group" app-field-wrapper="remark">
                                                        <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php echo (isset($appvoal_info) && !empty($appvoal_info)) ? $appvoal_info->approve_remark : ""; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                            </div>
                        </div>  
                        
                        <?php 
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="5" style="background-color: #e8bb0b;color: #fff;" class="btn btn-warning hold mleft10 proposal-form-submit save-and-send transaction-submit">
                                    On Hold
                                </button>
                                <button type="submit" name="submit" value="4" style="background-color: brown;color: #fff;" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit button3">
                                    Reconciliation
                                </button>
                                <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>
                               <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approved
                                </button>
                            </div> 
                           <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div id="invice_table" class="col-md-12">
            </div>
            <?php echo form_close(); ?>
        </div>
        <?php init_tail(); ?>

        <script type="text/javascript">

            $(document).on('change', '#payment_mode', function () {

                var payemt_mode = $(this).val();

                if (payemt_mode == 1) {

                    $('#cheque_div').show();

                } else {

                    $('#cheque_div').hide();

                }



            });

        </script>

        <script type="text/javascript">

            $(document).on('change', '#site_id', function () {

                var site_id = $(this).val();

                var client_id = $('#client_id').val();



                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/invoice_payments/get_invoice'); ?>",
                    data: {'site_id': site_id, 'client_id': client_id},
                    success: function (response) {

                        if (response != '') {

                            $('#invoice_id').html(response);

                            $('.selectpicker').selectpicker('refresh');

                        }

                    }

                })


            });

        </script>

        <script type="text/javascript">

            $(document).on('click', '#add_payment', function () {

                var payment_behalf = $('#payment_behalf').val();
                var bank_id = $('#bank_id').val();
                var assign = $('#assign').val();
                var reference_no = $('#reference_no').val();
                var chk_page = "<?php echo (isset($client_deposits)) ? 0 : 1?>";

                var ttl_amt = parseInt($('#ttl_amt').val());


                var ttl_inv_amt = 0;

                if (payment_behalf == 2) {

                    $(".amt").each(function () {

                        var inv_amt = parseInt($(this).val());

                        if (inv_amt > 0) {

                            ttl_inv_amt = (ttl_inv_amt + inv_amt);

                        }



                    });



                    if (ttl_amt == ttl_inv_amt) {

                        if (bank_id == '') {
                            alert('Bank Can\'t be empty');
                        } else if (assign == '' && chk_page == 1) {
                            alert('Please select Approed By person');
                        } else if (reference_no == '') {
                            alert('Reference No. Can\'t be empty');
                        } else if (ttl_amt == '') {
                            alert('Amount Can\'t be empty');
                        } else {
                            $("#payment-form").submit();
                        }

                    } else {

                        alert('Amount is not match with total amount!');

                    }

                } else {


                    if (bank_id == '') {
                        alert('Bank Can\'t be empty');
                    } else if (assign == '') {
                        alert('Please select Approed By person');
                    } else if (reference_no == '') {
                        alert('Reference No. Can\'t be empty');
                    } else if (ttl_amt == '') {
                        alert('Amount Can\'t be empty');
                    } else {
                        $("#payment-form").submit();
                    }

                    /*if(bank_id != '' && assign != ''){
                     $("#payment-form").submit();
                     }else{
                     alert('Please select Bank Or Approed By');  
                     }*/




                }



            });
            $('.onlynumbers1').keypress(function (event) {

                if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                    event.preventDefault(); //stop character from entering input
                }

            });

            function nospaces(t) {
                if (t.value.match(/\s/g)) {
                    t.value = t.value.replace(/\s/g, '');
                }
            }
        </script>



        </body>

        </html>

