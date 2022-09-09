<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('expense_type/edit'); }else{ echo admin_url('expense_type/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                            <hr class="hr-panel-heading">
                            <div class="row">

                                <div class="form-group col-md-3 select-placeholder">
                                    <label for="payment_method" class="control-label"> Expense Head <small class="req text-danger">* </small> </label>
                                    <select class="form-control selectpicker" id="head_id" required="" name="head_id" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if(!empty($expensehead_list)){
                                            foreach ($expensehead_list as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo (isset($type_info->head_id) && $type_info->head_id == $value->id) ? "selected" : "" ?>><?php echo $value->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="branch_id" class="control-label">Expense For *</label>
                                    <select class="form-control" required="" id="expense_for" name="expense_for">
                                        <option value="" disabled selected >--Select One-</option>
                                        <option value="1" <?php if(!empty($type_info->expense_for) && $type_info->expense_for == 1){ echo 'selected';} ?>  >Personal</option>
                                        <option value="2" <?php if(!empty($type_info->expense_for) && $type_info->expense_for == 2){ echo 'selected';} ?>  >Company</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="name" class="control-label">Name *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($type_info->name) && $type_info->name != "") ? $type_info->name : "" ?>">
                                </div>
                                <div class="form-group col-md-3 select-placeholder">
                                    <label for="payment_method" class="control-label"><small class="req text-danger">* </small> Select Expense Category </label>
                                    <select class="form-control selectpicker" id="category_id" required="" name="category_id" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if(!empty($category_info)){
                                            foreach ($category_info as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo (isset($type_info->category_id) && $type_info->category_id == $value->id) ? "selected" : "" ?>><?php echo $value->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 select-placeholder">
                                    <label for="payment_method" class="control-label"> </small> Default Sub-Type Category </label>
                                    <select class="form-control selectpicker" id="default_sub_category"  name="default_sub_category" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if(!empty($default_type_info)){
                                            foreach ($default_type_info as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo (isset($type_info->default_sub_category) && $type_info->default_sub_category == $value->id) ? "selected" : "" ?>><?php echo $value->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 select-placeholder">
                                    <label for="payment_method" class="control-label"> Designation </label>
                                    <select class="form-control selectpicker" id="designation_ids" name="designation_ids[]" multiple data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if(!empty($designation_list)){
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
                                
							    <div class="form-group col-md-6">
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


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>





</body>
</html>
