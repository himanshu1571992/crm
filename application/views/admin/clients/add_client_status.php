<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('ClientBranch/edit_client_status'); }else{ echo admin_url('ClientBranch/add_client_status'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="name" class="control-label"><?php echo 'Status'; ?> *</label>
                                <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($status_info->name) && $status_info->name != "") ? $status_info->name : "" ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="color" class="control-label"><?php echo _l('enquiry_type_color'); ?> *</label>
                                <div id="color-group" class="input-group colorpicker-component">
                                    <input type="text" id="color" name="color" class="form-control" required="" value="<?php echo (isset($status_info->color) && $status_info->color != "") ? $status_info->color : "#ffffff" ?>">
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                                                            								
							<div class="form-group col-md-4">
                                <label for="name" class="control-label"><?php echo _l('description'); ?> </label>
                                <textarea id="description" name="description" class="form-control"><?php echo (isset($status_info->description) && $status_info->description != "") ? $status_info->description : "" ?></textarea>
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
