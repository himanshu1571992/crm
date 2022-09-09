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
                                    <label for="name" class="control-label">Name <span style="color: red;">*</span></label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (!empty($machinemaster_info)) ? $machinemaster_info->name : ""; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department" class="control-label">Division <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" name="department" required="" id="department">
                                        <option value=""></option>
                                        <?php
                                        if(!empty($division_info)){
                                            foreach ($division_info as $value) {
                                                ?>
                                                <option value="<?php echo $value->id; ?>" <?php echo (isset($machinemaster_info->department) && $machinemaster_info->department == $value->id) ? 'selected' : "" ?>><?php echo $value->title; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <!-- <option value="1" <?php echo (isset($machinemaster_info->department) && $machinemaster_info->department == 1) ? 'selected' : "" ?>>Aluminum Scaffolding</option>
                                        <option value="2" <?php echo (isset($machinemaster_info->department) && $machinemaster_info->department == 2) ? 'selected' : "" ?>>MS Scaffolding</option>                                        
                                        <option value="3" <?php echo (isset($machinemaster_info->department) && $machinemaster_info->department == 3) ? 'selected' : "" ?>>Aluminium Formwork</option> -->
                                    </select>
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



</body>

</html>

