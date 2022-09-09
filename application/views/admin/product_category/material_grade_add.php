<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php echo site_url($this->uri->uri_string()); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="control-label"><?php echo 'Title'; ?> <span style="color:red;">*</span></label>
                                <input type="text" id="title" name="title" class="form-control" required="" value="<?php echo (isset($material_data) && $material_data->title != "") ? $material_data->title : "" ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="is_main" class="control-label"><?php echo 'Thickness'; ?>  (In MM)<span style="color:red;">*</span></label>
                                <input type="text" id="thickness" name="thickness" class="form-control" required="" value="<?php echo  (!empty($material_data) && $material_data->thickness != "") ? $material_data->thickness : ""; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="is_main" class="control-label"><?php echo 'Remark'; ?> </label>
                                <textarea id="remark" name="remark" rows="4" class="form-control"><?php echo  (!empty($material_data) && $material_data->remark != "") ? $material_data->remark : ""; ?></textarea>
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


<script type="text/javascript">
$(document).on('change', '#parent_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/menu_master/get_sub_menu",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                $("#sub_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>


</body>
</html>
