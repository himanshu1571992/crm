
<?php init_head(); ?>
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

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?> </h4>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">                                                             
                                <div class="form-group col-md-4">
                                    <label for="certificate_no" class="control-label">Certificate No.</label>
                                    <?php 
                                        $certificatecls = '';
                                        if (!empty($certificate_info)){
                                            $certificatecls = 'readOnly=""';
                                            $certificate_no = $certificate_info->certificate_number;
                                        }else{
                                            $certificate_no = get_certificate_number($invoice_id, 1);
                                        }
                                    ?>
                                    <input type="text" id="certificate_no" required="" <?php echo $certificatecls; ?> value="<?php echo $certificate_no;?>" name="certificate_no" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="date" class="control-label">Date</label>
                                    <div class="input-group date">
                                    <?php 
                                        if (!empty($certificate_info)){
                                            $certificate_date = _d($certificate_info->date);
                                        }else{
                                            $certificate_date = date('d-m-Y');
                                        }
                                    ?>
                                        <input type="text" id="date" name="date" required="" class="form-control datepicker" value="<?php echo $certificate_date; ?>" aria-invalid="false">
                                        <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="width_type" class="control-label">Width Type</label>
                                        <select class="form-control selectpicker" data-live-search="true" required="" id="width_type" name="width_type" <?php echo (!empty($certificate_info)) ? 'disabled' : ''; ?>>
                                            <option value="1" <?php echo (!empty($certificate_info) && $certificate_info->width_type == 1) ? 'selected':''; ?> >Narrow Width</option>
                                            <option value="2" <?php echo (!empty($certificate_info) && $certificate_info->width_type == 2) ? 'selected':''; ?>>Double Width</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12"> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tested_by" class="control-label">Tested By</label>
                                        <select class="form-control selectpicker" data-live-search="true" required="" id="tested_by" name="tested_by">
                                            <option value=""></option>
                                            <?php 
                                                if ($stafflist){
                                                    foreach ($stafflist as $key => $staff) {
                                            ?>
                                                        <option value="<?php echo $staff->staffid; ?>" <?php echo (!empty($certificate_info) && $certificate_info->tested_by == $staff->staffid) ? 'selected':''; ?>><?php echo cc($staff->firstname); ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-8" app-field-wrapper="adminnote">
                                    <label for="adminnote" class="control-label">Remark </label>
                                    <textarea id="remark" name="remark" class="form-control" rows="4" required=""><?php echo (!empty($certificate_info)) ? $certificate_info->remark:''; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-12" app-field-wrapper="note">
                                    <label for="note" class="control-label">Note </label>
                                    <textarea id="note" name="note" class="form-control" rows="4" required=""><?php echo (!empty($certificate_info)) ? $certificate_info->note:''; ?></textarea>
                                </div>               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                 <span class="widthnote_text">  </span>
                            </div>
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>Item Description</th>
                                            <th>Qty</th>
                                            <th>Load Cap (KG)</th>
                                            <th>Load Applied (KG)</th>
                                            <th>Remark</th>
                                            <th>Special Remark</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $t = 0;
                                            if (!empty($invoice_products)){
                                                foreach ($invoice_products as $row) {
                                        ?>
                                                    <tr class="row<?php echo $t; ?>">
                                                        <td>
                                                            <?php echo value_by_id("tblproducts", $row->pro_id, "sub_name");?>
                                                            <input type="hidden" name="invoice_item[<?php echo $t; ?>][item_id]" value="<?php echo $row->pro_id; ?>">
                                                        </td>
                                                        <td><?php echo $row->qty;?></td>
                                                        <td><input type="text" class="form-control loadcap" name="invoice_item[<?php echo $t; ?>][load_cap]" value="150"></td>
                                                        <td><input type="text" class="form-control loadapplied" name="invoice_item[<?php echo $t; ?>][load_applied]" value="400"></td>
                                                        <td><textarea name="invoice_item[<?php echo $t; ?>][remarks]" class="form-control" rows="4">No breakeges of components and no permanent deformation found in Aluminium Sections </textarea></td>
                                                        <td><textarea name="invoice_item[<?php echo $t; ?>][spl_remarks]" class="form-control spl_remarks" rows="4">Maximum number of people that can safely work on the tower is two (2). </textarea></td>
                                                        <td><a href="javascript:void(0);" class="btn-sm btn-danger" onclick="removeitems('<?php echo $t; ?>');">X</a></td>
                                                    </tr>
                                        <?php
                                                    $t++;
                                                }
                                            }else if (!empty($certificate_items)){
                                                foreach ($certificate_items as $row) {
                                                    $proitem = $this->db->query("SELECT qty FROM tblitems_in WHERE rel_id='".$invoice_id."' AND pro_id= '".$row->item_id."' AND rel_type='invoice'")->row();
                                        ?>
                                                    <tr class="row<?php echo $t; ?>">
                                                        <td>
                                                            <?php echo value_by_id("tblproducts", $row->item_id, "sub_name");?>
                                                            <input type="hidden" name="invoice_item[<?php echo $t; ?>][item_id]" value="<?php echo $row->item_id; ?>">
                                                        </td>
                                                        <td><?php echo $proitem->qty;?></td>
                                                        <td><input type="text" class="form-control loadcap" name="invoice_item[<?php echo $t; ?>][load_cap]" value="<?php echo $row->load_cap; ?>"></td>
                                                        <td><input type="text" class="form-control loadapplied" name="invoice_item[<?php echo $t; ?>][load_applied]" value="<?php echo $row->load_applied; ?>"></td>
                                                        <td><textarea name="invoice_item[<?php echo $t; ?>][remarks]" class="form-control" rows="4"><?php echo $row->remark; ?> </textarea></td>
                                                        <td><textarea name="invoice_item[<?php echo $t; ?>][spl_remarks]" class="form-control spl_remarks" rows="4"><?php echo $row->spl_remark; ?> </textarea></td>
                                                        <td><a href="javascript:void(0);" class="btn-sm btn-danger" onclick="removeitems('<?php echo $t; ?>');">X</a></td>
                                                    </tr>
                                        <?php
                                                    $t++;
                                                }
                                            } 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                            <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit" name="submit">Submit</button>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>

<?php init_tail(); ?>

<script>
    function removeitems(rowid){
        $('.row' + rowid).remove();
    }
    var checkpage = '<?php echo (!empty($certificate_info)) ? 'edit' : 'add'; ?>';
    if (checkpage == 'add'){
        get_width_type();
    }
    
    function get_width_type(){
        var val = $("#width_type").val();
        if (val == 1){
            var cretificate_no = '<?php echo get_certificate_number($invoice_id, 1);?>';
            $(".loadcap").val('150');
            $(".loadapplied").val('400');
            $(".spl_remarks").val('Maximum number of people that can safely work on the tower is two (2).');
            $("#note").val('THIS IS TO CERTIFY THAT WE HAVE TESTED THE LOAD CAPACITY AND INSPECTED FOR FOLLOWING ALUMINIUM SCAFFOLDING WITHOUT STAIRLADDER.');
            $("#certificate_no").val(cretificate_no);
        }else if(val == 2){
            var cretificate_no = '<?php echo get_certificate_number($invoice_id, 2);?>';
            $(".loadcap").val('250');
            $(".loadapplied").val('500');
            $(".spl_remarks").val('Maximum number of people that can safely work on the tower is three (3).');
            $("#note").val('THIS IS TO CERTIFY THAT WE HAVE TESTED THE LOAD CAPACITY AND INSPECTED FOR FOLLOWING ALUMINIUM SCAFFOLDING WITH STAIRLADDER AND HEAVY DUTY CASTORS.');
            $("#certificate_no").val(cretificate_no);
        }
    }
    $(document).on("change", "#width_type", function(){
        get_width_type();
    });
    
</script>    

</body>
</html>
