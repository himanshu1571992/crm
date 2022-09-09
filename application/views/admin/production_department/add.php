<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('production_department/edit'); }else{ echo admin_url('production_department/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label"><?php echo 'Department Name'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($depatment_info->name) && $depatment_info->name != "") ? $depatment_info->name : "" ?>">
                                </div>

                              
                                <div class="form-group col-md-12">
                                    <label for="client_cat_id" class="control-label">Department Staff</label>
                                    <select class="form-control selectpicker" multiple data-live-search="true" required="" id="staff_ids" name="staff_ids[]">
                                        <option value=""></option>
                                        <?php
                                        if(!empty($depatment_info)){
                                            $staff_arr=explode(',',$depatment_info->staff_ids); 
                                        }
                                                                             
                                        if (isset($staff_info) && count($staff_info) > 0) {
                                            foreach ($staff_info as $staff_value) {
                                                ?>
                                                <option value="<?php echo $staff_value->staffid; ?>" <?php echo (isset($depatment_info->staff_ids) && in_array($staff_value->staffid,$staff_arr)) ? 'selected' : "" ?>><?php echo $staff_value->firstname; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="client_cat_id" class="control-label">Department Superior</label>
                                    <select class="form-control selectpicker" multiple data-live-search="true" id="superior_ids" name="superior_ids[]">
                                        <option value=""></option>
                                        <?php
                                        if(!empty($depatment_info)){
                                            $department_arr=explode(',',$depatment_info->superior_ids); 
                                        }
                                                                             
                                        if (isset($department_list) && count($department_list) > 0) {
                                            foreach ($department_list as $dep_value) {
                                                ?>
                                                <option value="<?php echo $dep_value->id; ?>" <?php echo (isset($depatment_info->superior_ids) && in_array($dep_value->id,$department_arr)) ? 'selected' : "" ?>><?php echo $dep_value->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                                                								
								<div class="form-group col-md-12">
                                    <label for="name" class="control-label"><?php echo _l('description'); ?> </label>
                                    <textarea id="remark" name="remark" class="form-control"><?php echo (isset($depatment_info->remark) && $depatment_info->remark != "") ? $depatment_info->remark : "" ?></textarea>
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


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>





</body>
</html>
