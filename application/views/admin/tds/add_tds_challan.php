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
        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'tds_challan_form', 'class' => 'tds-challan-form')); ?>
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
                                        <input type="text" name="challan_no" class="form-control" value="<?php echo (isset($tds_challan_info)) ? $tds_challan_info->challan_no : ''; ?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="date" class="control-label">Challan Date</label>
                                        <div class="input-group date">
                                            <input id="challan_date" name="challan_date" class="form-control datepicker" value="<?php echo (isset($tds_challan_info)) ? _d($tds_challan_info->date) : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="amount" class="control-label">Amount</label>
                                        <input type="text" id="amount" name="amount" class="form-control" value="<?php echo (isset($tds_challan_info)) ? $tds_challan_info->amount : ''; ?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="bsr_code" class="control-label">BSR Code</label>
                                        <input type="text" id="bsr_code" name="bsr_code" class="form-control" value="<?php echo (isset($tds_challan_info)) ? $tds_challan_info->bsr_code : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-3">
                                        <label for="section_of_tds" class="control-label">Section Of TDS</label>
                                        <select name="section_of_tds" class="form-control selectpicker" <?php echo (isset($tds_challan_info)) ? 'disabled=""':'';?> required='' data-live-search="true" id="section_of_tds">
                                            <option value=""></option>
                                            <?php 
                                                if (!empty($tds_section_list)){
                                                    foreach ($tds_section_list as $value) {
                                                        $selectedcls = (isset($tds_challan_info) && $tds_challan_info->section_of_tds == $value->id) ? 'selected=""':'';
                                                        echo '<option value="'.$value->id.'" '.$selectedcls.'>'.cc($value->name).'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <?php 
                                            if (!empty($tds_challan_info->section_of_tds)){
                                                echo '<input type="hidden" name="section_of_tds" value="'.$tds_challan_info->section_of_tds.'">';
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="tax_applicable" class="control-label">Tax Applicable</label>
                                        <select name="tax_applicable" class="form-control selectpicker" required='' data-live-search="true" id="tax_applicable">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($tds_challan_info) && $tds_challan_info->tax_applicable == '1') ? 'selected=""':''; ?>>(0020) Company Deductees</option>
                                            <option value="2" <?php echo (isset($tds_challan_info) && $tds_challan_info->tax_applicable == '2') ? 'selected=""':''; ?>>(0021) Non-Company Deductees</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="type_of_payment" class="control-label">Type of Payment</label>
                                        <select name="type_of_payment" class="form-control selectpicker" required='' data-live-search="true" id="type_of_payment">
                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($tds_challan_info) && $tds_challan_info->tax_applicable == '1') ? 'selected=""':''; ?>>(200) TDS/TCS Payable by Taxpayer</option>
                                            <option value="2" <?php echo (isset($tds_challan_info) && $tds_challan_info->tax_applicable == '2') ? 'selected=""':''; ?>>(400) TDS/TCS Regular Assessment</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <br>
                                        <br>
                                        <?php $checkedcls = (isset($tds_challan_info) && $tds_challan_info->Interested_late_fees_payment == '1') ? 'checked=""':''; ?>
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
    $("#amount").on("input", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/\D/g, ""));
        if ((evt.which < 48 || evt.which > 57)) 
        {
        evt.preventDefault();
        }
    });

    $("#tds_amount").on("input", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/\D/g, ""));
        if ((evt.which < 48 || evt.which > 57)) 
        {
        evt.preventDefault();
        }
    });
</script>

</body>
</html>