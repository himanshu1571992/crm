<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('expense_type/edit_subtype'); }else{ echo admin_url('expense_type/add_subtype'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name" class="control-label">Name <small class="req text-danger">* </small></label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($type_info->name) && $type_info->name != "") ? $type_info->name : "" ?>">
                                </div>
                                <div class="form-group col-md-4 select-placeholder">
                                    <label for="payment_method" class="control-label"> Select Expense Category <small class="req text-danger">* </small></label>
                                    <select class="form-control selectpicker" id="type_id" required="" name="type_id" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if(!empty($type_data)){
                                            foreach ($type_data as $key => $value) {
                                               $for = ($value->expense_for == 1) ? 'Personal' : 'Company';
                                                ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo (isset($type_info->type_id) && $type_info->type_id == $value->id) ? "selected" : "" ?>><?php echo $value->name.' ('.$for.')'; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 select-placeholder">
                                    <label for="payment_method" class="control-label"> Designation </label>
                                    <select class="form-control selectpicker" id="designation_ids" name="designation_ids[]" multiple data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if(!empty($designation_list) ){
                                            foreach ($designation_list as $key => $value) {
                                                  $designationids = (!empty($type_info->designation_ids)) ? explode(',', $type_info->designation_ids) : '';
                                                  $selectcls = ($designationids != '' && in_array($value->id, $designationids)) ? 'selected=""' : '';
                                        ?>
                                                  <option value="<?php echo $value->id; ?>" <?php echo $selectcls; ?>><?php echo $value->designation; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								                <div class="form-group col-md-12">
                                    <label for="name" class="control-label"><?php echo _l('description'); ?> </label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($type_info->description) && $type_info->description != "") ? $type_info->description : "" ?></textarea>
                                </div>
                            </div>
                        <?php
                        if(!empty($id)){
                            ?>
                            <input type="hidden" value="<?php echo $id;?>" name="id">
                            <?php
                        }
                        ?>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
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


<!-- <script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });

    function getdesignationlist(type_id){
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/expense_type/getExpenseDesignationList",
            data    : {'type_id' : type_id},
            success : function(response){
                if(response != ''){
                    $("#designation_ids").html('').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    }
</script> -->





</body>
</html>
