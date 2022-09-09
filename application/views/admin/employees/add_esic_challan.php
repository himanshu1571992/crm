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
        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'pf_challan_form', 'class' => 'pf-challan-form')); ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="challan_no" class="control-label">Challan No</label>
                                        <input type="text" name="challan_no" class="form-control" value="<?php echo (isset($pf_challan_info)) ? $pf_challan_info->challan_no : ''; ?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date" class="control-label">Challan Date</label>
                                        <div class="input-group date">
                                            <input id="challan_date" name="challan_date" class="form-control datepicker" value="<?php echo (isset($pf_challan_info)) ? _d($pf_challan_info->challan_date) : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date" class="control-label">Payment Date</label>
                                        <div class="input-group date">
                                            <input id="payment_date" name="payment_date" class="form-control datepicker" value="<?php echo (isset($pf_challan_info)) ? _d($pf_challan_info->payment_date) : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="employee_contribution" class="control-label">Employee Contribution</label>
                                        <input type="text" id="employee_contribution" onkeyup="calculate_amt();" name="employee_contribution" class="form-control amount" value="<?php echo (isset($pf_challan_info)) ? $pf_challan_info->employee_contribution : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="employer_contribution" class="control-label">Employer Contribution</label>
                                        <input type="text" id="employer_contribution" onkeyup="calculate_amt();" name="employer_contribution" class="form-control amount" value="<?php echo (isset($pf_challan_info)) ? $pf_challan_info->employer_contribution : ''; ?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="pf_admin" class="control-label">Total Challan Amount</label>
                                        <input type="text" id="ttl_challan_amt" name="ttl_challan_amt" class="form-control amount" value="<?php echo (isset($pf_challan_info)) ? ($pf_challan_info->employee_contribution+$pf_challan_info->employer_contribution+$pf_challan_info->pf_admin+$pf_challan_info->pf_edli) : ''; ?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <br>
                                        <br>
                                        <?php $checkedcls = (isset($pf_challan_info) && $pf_challan_info->Interested_late_fees_payment == '1') ? 'checked=""':''; ?>
                                        <input type="checkbox" id="Interested_late_fees_payment" name="late_fees_payment" <?php echo $checkedcls; ?>>
                                        <label for="Interested_late_fees_payment" class="control-label">&nbsp;Interested Late Fees Payment</label>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" type="submit">Submit</button>
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
<script>
    $(".amount").on("input", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/\D/g, ""));
        if ((evt.which < 48 || evt.which > 57)) 
        {
        evt.preventDefault();
        }
    });

    function calculate_amt(){
        var employee_contribution = $("#employee_contribution").val();
        var employer_contribution = $("#employer_contribution").val();
        var ttl_amount = 0;
        if (employee_contribution != ''){
            ttl_amount += parseInt(employee_contribution);
        }
        if (employer_contribution != ''){
            ttl_amount += parseInt(employer_contribution);
        }
        $("#ttl_challan_amt").val(ttl_amount);
    }
</script>

</body>
</html>