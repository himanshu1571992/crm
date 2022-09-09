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
                                <div class="col-md-4">
                                    <label for="party_name" class="control-label">Party Name</label>
                                    <input type="text" name="party_name" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="taxable_amount" class="control-label">Taxable Amount</label>
                                    <input type="text" id="taxable_amount" name="taxable_amount" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="tds_amount" class="control-label">TDS Amount</label>
                                    <input type="text" id="tds_amount" name="tds_amount" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="pan_no" class="control-label">Pan No</label>
                                    <input type="text" id="pan_no" name="pan_no" class="form-control" required>
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