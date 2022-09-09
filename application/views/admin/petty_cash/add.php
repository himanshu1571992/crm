<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('petty_cash/edit'); }else{ echo admin_url('petty_cash/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="department_name" class="control-label"><?php echo 'Department Name'; ?> *</label>
                                    <input type="text" id="department_name" name="department_name" class="form-control" required="" value="<?php echo (isset($pettycash_info->department_name) && $pettycash_info->department_name != "") ? $pettycash_info->department_name : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="amount" class="control-label"><?php echo 'Amount'; ?> *</label>
                                    <input type="text" id="amount" name="amount" class="form-control" <?php if(!empty($pettycash_info)){ echo 'disabled'; } ?> required="" value="<?php echo (isset($pettycash_info->amount) && $pettycash_info->amount != "") ? $pettycash_info->amount : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="branch_id" class="control-label">Select Manager *</label>
                                    <select class="form-control" required="" id="staff_id" name="staff_id">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        if(!empty($staff_info)){
                                            foreach ($staff_info as $key => $value) {
                                                ?>
                                                <option value="<?php echo $value->staffid; ?>" <?php if(!empty($pettycash_info->staff_id) && $pettycash_info->staff_id == $value->staffid){ echo 'selected';} ?>  ><?php echo $value->firstname; ?></option>
                                                <?php
                                            }
                                        }
                                       
                                        ?>
                                    </select>
                                </div>

                                                                								
								<div class="form-group col-md-12">
                                    <label for="name" class="control-label"><?php echo _l('description'); ?> </label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($pettycash_info->description) && $pettycash_info->description != "") ? $pettycash_info->description : "" ?></textarea>
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
