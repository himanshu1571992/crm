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
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                                <div class="col-md-6">
                                    <label class="control-label">PO No. : </label>
                                    <div class="form-group">
                                        <span class="text-info"><?php echo (!empty($vendor_activity->po_id)) ? value_by_id("tblpurchaseorder", $vendor_activity->po_id, "number") : "--"; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Vendor Name : </label>
                                    <div class="form-group">
                                        <span class="text-info"><?php echo (!empty($vendor_activity->vendor_id)) ? value_by_id("tblvendor", $vendor_activity->vendor_id, "name") : "--"; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Date : </label>
                                    <div class="form-group">
                                        <span class="text-info"><?php echo (!empty($vendor_activity->date)) ? _d($vendor_activity->date) : "--"; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Send By : </label>
                                    <div class="form-group">
                                        <span class="text-info"><?php echo (!empty($vendor_activity->staffid)) ? get_staff_full_name($vendor_activity->staffid) : "--"; ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="control-label">Message : </label>
                                    <div class="form-group">
                                        <span class="text-info"><?php echo (!empty($vendor_activity->message)) ? cc($vendor_activity->message) : "--"; ?></span>
                                    </div>
                                </div>
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