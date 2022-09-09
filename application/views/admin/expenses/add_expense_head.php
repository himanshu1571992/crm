<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                         <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label">Name *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($expense_head_info->name) && $expense_head_info->name != "") ? $expense_head_info->name : "" ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="designation_ids" class="control-label">Designation *</label>
                                    <select class="form-control selectpicker" name="designation_ids[]" multiple data-live-search="true" >
                                        <option value=""></option>
                                        <?php 
                                            if (isset($designation_list) && !empty($designation_list)){
                                                foreach($designation_list as $designation){
                                                    $selectcls = '';
                                                    $designationdata = (!empty($expense_head_info)) ? explode(',', $expense_head_info->designation_ids) : [];
                                                    if (in_array($designation->id, $designationdata)){
                                                        $selectcls = 'selected="selected"';
                                                    }
                                                    echo '<option value="'.$designation->id.'" '.$selectcls.'>'.cc($designation->designation).'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
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
