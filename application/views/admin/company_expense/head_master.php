<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'product-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($heads_info->name) && $heads_info->name != "") ? $heads_info->name : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label for="status" class="control-label">Category</label>
                                    <select class="form-control" required="" id="category_id" name="category_id">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        if(!empty($category_info)){
                                            foreach ($category_info as $key => $value) {
                                               ?>                                               
                                                 <option value="<?php echo $value->id; ?>" <?php if(!empty($heads_info->category_id) && $heads_info->category_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                               <?php
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
