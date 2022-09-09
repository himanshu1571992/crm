<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('menu_master/edit'); }else{ echo admin_url('menu_master/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">

                                <div class="form-group col-md-3">
                                    <label for="branch_id" class="control-label">Parent Menu</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        if(!empty($main_menu)){
                                            foreach ($main_menu as $r) {
                                                ?>
                                                <option value="<?php echo $r->id; ?>" <?php if(!empty($menu_info->parent_id) && $menu_info->parent_id == $r->id){ echo 'selected';} ?>  ><?php echo $r->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="sub_id" class="control-label">Sub Menu</label>
                                    <select class="form-control" id="sub_id" name="sub_id">
                                        <option value="" selected >--Select One-</option>
                                        <?php
                                        /*if(!empty($sub_menu)){
                                            foreach ($sub_menu as $r) {
                                                ?>
                                                <option value="<?php echo $r->id; ?>" <?php if(!empty($menu_info->sub_id) && $menu_info->sub_id == $r->id){ echo 'selected';} ?>  ><?php echo $r->name; ?></option>
                                                <?php
                                            }
                                        }*/
                                        ?>
                                    </select>
                                </div>



                                <div class="form-group col-md-4">
                                    <label for="name" class="control-label"><?php echo 'Menu Name'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($menu_info->name) && $menu_info->name != "") ? $menu_info->name : "" ?>">
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="is_main" class="control-label"><?php echo 'Main Menu'; ?> </label>
                                    <input type="checkbox" id="is_main" name="is_main" class="form-control" value="1" <?php echo  (!empty($menu_info) && $menu_info->is_main == 1) ? "checked" : ""; ?>>
                                </div>

                                <div class="form-group col-md-1">
                                    <label for="is_sub" class="control-label"><?php echo 'Sub Menu'; ?> </label>
                                    <input type="checkbox" id="is_sub" name="is_sub" class="form-control" value="1" <?php echo  (!empty($menu_info) && $menu_info->is_sub == 1) ? "checked" : ""; ?>>
                                </div>


                                
                                <div class="form-group col-md-6">
                                    <label for="link" class="control-label"><?php echo 'Link'; ?> *</label>
                                    <input type="text" id="link" name="link" class="form-control" required="" value="<?php echo (isset($menu_info->link) && $menu_info->link != "") ? $menu_info->link : "" ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="icon" class="control-label"><?php echo 'Icon'; ?> </label>
                                    <input type="text" id="icon" name="icon" class="form-control" value="<?php echo (isset($menu_info->icon) && $menu_info->icon != "") ? $menu_info->icon : "" ?>">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="order_no" class="control-label"><?php echo 'Order'; ?> </label>
                                    <input type="text" id="order_no" name="order_no" class="form-control" value="<?php echo (isset($menu_info->order_no) && $menu_info->order_no != "") ? $menu_info->order_no : "" ?>">
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
