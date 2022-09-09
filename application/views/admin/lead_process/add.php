<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('lead_process/edit'); }else{ echo admin_url('lead_process/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label">Process Name *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($process_info->name) && $process_info->name != "") ? $process_info->name : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="orders" class="control-label">Order *</label>
                                    <input type="text" id="orders" name="orders" class="form-control" required="" value="<?php echo (isset($process_info->orders) && $process_info->orders != "") ? $process_info->orders : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="status" class="control-label"><?php echo _l('product_sub_category_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($process_info->status) && $process_info->status == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($process_info->status) && $process_info->status == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
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
