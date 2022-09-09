<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('company_expense/edit'); }else{ echo admin_url('company_expense/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name" class="control-label"><?php echo 'Category Name'; ?> *</label>
                                    <input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($category_info->name) && $category_info->name != "") ? $category_info->name : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="show_date" class="control-label"><?php echo 'Show Date'; ?> *</label>
                                    <select class="form-control" required="" id="show_date" name="show_date">
                                        <option value="0" <?php if(!empty($category_info->show_date) && $category_info->show_date == 0){ echo 'selected';} ?>  >No</option>
                                        <option value="1" <?php if(!empty($category_info->show_date) && $category_info->show_date == 1){ echo 'selected';} ?>  >Yes</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="show_deposit" class="control-label"><?php echo 'Show Deposit'; ?> *</label>
                                    <select class="form-control" required="" id="show_deposit" name="show_deposit">
                                        <option value="0" <?php if(!empty($category_info->show_deposit) && $category_info->show_deposit == 0){ echo 'selected';} ?>  >No</option>
                                        <option value="1" <?php if(!empty($category_info->show_deposit) && $category_info->show_deposit == 1){ echo 'selected';} ?>  >Yes</option>
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
