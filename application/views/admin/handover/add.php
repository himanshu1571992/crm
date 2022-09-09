<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('handover/edit'); }else{ echo admin_url('handover/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="title" class="control-label"><?php echo 'Title'; ?> *</label>
                                    <input type="text" id="title" name="title" class="form-control" required="" value="<?php echo (isset($handover_info->title) && $handover_info->title != "") ? $holiday_info->title : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="staff_id" class="control-label">Receiver Name *</label>
                                    <select class="form-control selectpicker" required="" id="staff_id" name="staff_id" data-live-search="true">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        if(!empty($staff_info)){
                                            foreach ($staff_info as $key => $value) {
                                                echo '<option value="'.$value->staffid.'">'.cc($value->firstname).'</option>';        
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="receiver_id" class="control-label">Final Receiver Person *</label>
                                    <select class="form-control selectpicker" required="" id="receiver_id" name="receiver_id" data-live-search="true">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        if(!empty($staff_info)){
                                            foreach ($staff_info as $key => $value) {
                                                echo '<option value="'.$value->staffid.'">'.cc($value->firstname).'</option>';        
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                                                								
								<div class="form-group col-md-6">
                                    <label for="name" class="control-label">Remark </label>
                                    <textarea id="remark" name="remark" class="form-control"><?php echo (isset($handover_info->remark) && $handover_info->remark != "") ? $handover_info->remark : "" ?></textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="file" class="control-label"><?php echo 'Attachment File'; ?></label>
                                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
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
