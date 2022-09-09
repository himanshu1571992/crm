<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'product_sub_category-form', 'class' => 'proposal-form')); ?>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name <span style="color: red;">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (!empty($operationmaster_info)) ? $operationmaster_info->name : ""; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="department" class="control-label">Division <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" name="department" required="" id="department">
                                        <option value=""></option>
                                        <?php
                                        if(!empty($division_info)){
                                            foreach ($division_info as $value) {
                                                ?>
                                                <option value="<?php echo $value->id; ?>" <?php echo (isset($operationmaster_info->department) && $operationmaster_info->department == $value->id) ? 'selected' : "" ?>><?php echo $value->title; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!-- <option value="1" <?php echo (isset($operationmaster_info->department) && $operationmaster_info->department == 1) ? 'selected' : "" ?>>Aluminum Scaffolding</option>
                                        <option value="2" <?php echo (isset($operationmaster_info->department) && $operationmaster_info->department == 2) ? 'selected' : "" ?>>MS Scaffolding</option>
                                        <option value="3" <?php echo (isset($operationmaster_info->department) && $operationmaster_info->department == 3) ? 'selected' : "" ?>>Aluminum Formwork</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="machine_id" class="control-label">Machine <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker machine_id" multiple="" name="machine_id[]" required="" id="machine_id">
                                        <option value=""></option>
                                        <?php 
                                            if (isset($machinemaster_list)){
                                                foreach ($machinemaster_list as $value) {
                                                    $machine_ids = (isset($operationmaster_info->machine_id)) ? explode(',', $operationmaster_info->machine_id) : [];

                                        ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo (in_array($value->id, $machine_ids)) ? 'selected' : "" ?>><?php echo cc($value->name); ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cycle_time" class="control-label">Cycle Time <span style="color: red;">*</span></label>
                                    <input type="text" id="cycle_time" name="cycle_time" class="form-control" required="" value="<?php echo (!empty($operationmaster_info)) ? $operationmaster_info->cycle_time : ""; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-bottom-toolbar text-right">
                        <button class="btn btn-info" type="submit">
                            <?php echo 'Submit'; ?>
                        </button>
                    </div>

                    </div>

                </div>

            </div> 

            <?php echo form_close(); ?>



        </div>

        <div class="btn-bottom-pusher"></div>

    </div>

</div>

<?php init_tail(); ?>

<script>
    $('#department').on("change",function(){
        var departmentid = $(this).val();

        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/production_department/get_machinelist'); ?>",
            data    : {'departmentid' : departmentid},
            success : function(response){
                if(response != ''){
                    $("#machine_id").html('').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    });
</script>

</body>

</html>

