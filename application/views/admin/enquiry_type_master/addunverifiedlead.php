<?php init_head(); ?>
<style>
    
@media (max-width: 500px){
    .btn-bottom-toolbar {
        width: 100%
    }
}    
@media (max-width: 768px){
    .btn-bottom-toolbar {
        width: 100%
    }
}
</style>
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
                                <label for="title" class="control-label"><?php echo 'Title'; ?> *</label>
                                <input type="text" id="title" name="title" class="form-control" required="" value="<?php echo (isset($unverified_leadinfo->title) && $unverified_leadinfo->title != "") ? $unverified_leadinfo->title : "" ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="status" class="control-label"><?php echo 'Status'; ?> *</label>
                                <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                    <option value="" ></option>
                                    <option value="1" <?php echo (isset($unverified_leadinfo) && $unverified_leadinfo->status == 1) ? "selected" : ""; ?> >Enable</option>
                                    <option value="2" <?php echo (isset($unverified_leadinfo) && $unverified_leadinfo->status == 2) ? "selected" : ""; ?> >Disable</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description" class="control-label"><?php echo 'Description'; ?> *</label>
                                <textarea class="form-control" name="description" rows="6"><?php echo (isset($unverified_leadinfo->description) && $unverified_leadinfo->description != "") ? $unverified_leadinfo->description : "" ?></textarea>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit"><?php echo 'Submit'; ?></button>
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
