<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'designation-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4><hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label">Title *</label>
                                    <input type="text" id="title" name="title" class="form-control" required="" value="<?php echo (isset($division_info['title']) && $division_info['title'] != "") ? $division_info['title'] : "" ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label">Division *</label>
                                    <select class="form-control selectpicker" name="division_id" id="division_id" data-live-search="true">
                                      <option value=""></option>
                                      <?php
                                          if (isset($division_list) && !empty($division_list)){
                                             foreach ($division_list as $value) {
                                                $selected_cls = (isset($division_info['division_id']) && $division_info['division_id'] == $value->id) ? "selected":"";
                                                echo '<option value="'.$value->id.'" '.$selected_cls.'>'.cc($value->title).'</option>';
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
