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
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Field Name <span style="color: red;">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (!empty($field_info)) ? $field_info->name : ""; ?>">
                                </div>
                            </div>

                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type" class="control-label">Type <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" name="type" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($field_info->type) && $field_info->type == 1) ? 'selected' : "" ?>>Input Box</option>
                                        <option value="2" <?php echo (isset($field_info->type) && $field_info->type == 2) ? 'selected' : "" ?>>Text Box</option>
                                        <option value="3" <?php echo (isset($field_info->type) && $field_info->type == 3) ? 'selected' : "" ?>>Product Drawing</option>

                                    </select>
                                </div>
                            </div>

                             <div class="col-md-1">
                                    <div class="form-group">
                                        <label>HSN Code</label>
                                        <input  type="radio" value="1" name="field_for" <?php echo (isset($field_info->field_for) && $field_info->field_for == 1) ? 'checked' : "" ?>>
                                    </div>
                             </div>

                             <div class="col-md-1">
                                    <div class="form-group">
                                        <label>SAC Code</label>
                                        <input type="radio" value="2" name="field_for" <?php echo (isset($field_info->field_for) && $field_info->field_for == 2) ? 'checked' : "" ?>>
                                    </div>
                             </div>

                             <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Minimum Qty</label>
                                        <input  type="radio" value="3" name="field_for" <?php echo (isset($field_info->field_for) && $field_info->field_for == 3) ? 'checked' : "" ?>>
                                    </div>
                             </div>

                             <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Maximum Qty</label>
                                        <input type="radio" value="4" name="field_for" <?php echo (isset($field_info->field_for) && $field_info->field_for == 4) ? 'checked' : "" ?>>
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


<script type="text/javascript">

    $(function () {

        $('#color-group').colorpicker({horizontal: true});

    });

</script>

</body>

</html>

