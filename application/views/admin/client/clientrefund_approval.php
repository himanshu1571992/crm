<?php
init_head();
?>

<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width:100%;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
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
            <?php echo form_open($this->uri->uri_string(), array('id' => 'payment-form', 'class' => '_propsal_form proposal-form', 'enctype' => 'multipart/form-data')); ?>

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h3><?php echo $title; ?></h3>
                                <hr/>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <h4 for="payment_method" class="control-label" style="color:red"> Date </h4>
                                    <div class="form-group">
                                       <p><?php echo (isset($client_refund_info)) ? _d($client_refund_info->date):'--'; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 for="payment_method" class="control-label" style="color:red"> Client </h4>
                                    <div class="form-group">
                                       <p><?php echo (isset($client_refund_info)) ? client_info($client_refund_info->client_id)->client_branch_name:'--'; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-2" id="amt_div">
                                    <h4 for="ttl_amt" class="control-label text-info" style="color:red"> Amount</h4>
                                    <div class="form-group">
                                       <p><?php echo (isset($client_refund_info)) ? $client_refund_info->amount :'--'; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-2" id="service_type">
                                    <h4 for="servicetype" class="control-label text-info" style="color:red"> Service Type</h4>
                                    <div class="form-group">
                                       <p>
                                           <?php 
                                                if (isset($client_refund_info)) {
                                                    if ($client_refund_info->service_type == 1){
                                                        echo "Rent";
                                                    }else if($client_refund_info->service_type == 2){
                                                        echo "Sales";
                                                    }else{
                                                        echo "Sales & Rent";
                                                    }
                                                }
                                            ?>
                                     </p>
                                    </div>
                                </div>
                                <div class="col-md-2" id="amt_div">
                                    <h4 for="ttl_amt" class="control-label text-info" style="color:red"> Added By</h4>
                                    <div class="form-group">
                                       <p><?php echo (isset($client_refund_info)) ? get_employee_name($client_refund_info->added_by) :'--'; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h4 for="remark" class="control-label" style="color:red">Remark</h4>
                                    <div class="form-group">
                                       <p><?php echo (isset($client_refund_info)) ? $client_refund_info->remark :'--'; ?></p>
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
                <div class="row">
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
                                          <div class="col-md-12">
                                              <div class="form-group" app-field-wrapper="remark">
                                                  <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php echo (!empty($appvoal_info)) ? $appvoal_info->approve_remark : ""; ?></textarea>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
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
