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

            <form action="<?php admin_url('tds/add_tds_desuction') ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4><?php echo $title; ?></h4>
                                    <hr/>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="party_name" class="control-label">Party Name</label>
                                        <input type="text" name="party_name" class="form-control" value="<?php echo (!empty($tds_deduction_info)) ? $tds_deduction_info->party_name : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="tds_date" class="control-label">Transaction Date</label>
                                        <div class="input-group date">
                                            <input id="tds_date" name="tds_date" class="form-control datepicker" value="<?php echo (!empty($tds_deduction_info)) ? _d($tds_deduction_info->date) : date('d/m/Y'); ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="booking_date" class="control-label">Booking Date</label>
                                        <div class="input-group date">
                                            <input id="booking_date" name="booking_date" class="form-control datepicker" value="<?php echo (!empty($tds_deduction_info)) ? _d($tds_deduction_info->booking_date) : ''; ?>" aria-invalid="false" type="text" required=''><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="paid_amount" class="control-label">Paid Amount</label>
                                        <input type="text" id="paid_amount" name="paid_amount" class="form-control" value="<?php echo (!empty($tds_deduction_info)) ? $tds_deduction_info->paid_amount : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="taxable_amount" class="control-label">Taxable Amount</label>
                                        <input type="text" id="taxable_amount" name="taxable_amount" class="form-control" value="<?php echo (!empty($tds_deduction_info)) ? $tds_deduction_info->taxable_amount : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tds_amount" class="control-label">TDS Amount</label>
                                        <input type="text" id="tds_amount" name="tds_amount" class="form-control" value="<?php echo (!empty($tds_deduction_info)) ? $tds_deduction_info->tds_amount : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pan_no" class="control-label">Pan No</label>
                                        <input type="text" id="pan_no" name="pan_no" class="form-control" value="<?php echo (!empty($tds_deduction_info)) ? $tds_deduction_info->pan_no : ''; ?>" required>
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
    $("#taxable_amount").on("input", function(evt) {
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