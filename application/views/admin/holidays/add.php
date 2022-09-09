<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php if(!empty($id)){ echo admin_url('holidays/edit'); }else{ echo admin_url('holidays/add'); } ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="title" class="control-label"><?php echo 'Title'; ?> *</label>
                                    <input type="text" id="title" name="title" class="form-control" required="" value="<?php echo (isset($holiday_info->title) && $holiday_info->title != "") ? $holiday_info->title : "" ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="branch_id" class="control-label"><?php echo 'Year'; ?> *</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="year" name="year">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        $j = date('Y')+1;
                                        for($i=2018; $i<=$j; $i++){
                                            ?>
                                            <option value="<?php echo $i;?>" <?php if(!empty($holiday_info->year) && $holiday_info->year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="branch_id" class="control-label"><?php echo 'Religion'; ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="religion_id" name="religion_id">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                          if (isset($religion_list) && !empty($religion_list)){
                                            foreach ($religion_list as $value) {
                                        ?>
                                                <option value="<?php echo $value->id;?>" <?php if(!empty($holiday_info->religion_id) && $holiday_info->religion_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                        <?php
                                          }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4" app-field-wrapper="date">
                                    <label for="date" class="control-label"><?php echo 'Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="date" required name="date" class="form-control datepicker" value="<?php echo (isset($holiday_info->date) && $holiday_info->date != "") ? $holiday_info->date : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>



								<div class="form-group col-md-12">
                                    <label for="name" class="control-label"><?php echo _l('description'); ?> </label>
                                    <textarea id="description" name="description" class="form-control"><?php echo (isset($holiday_info->description) && $holiday_info->description != "") ? $holiday_info->description : "" ?></textarea>
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
