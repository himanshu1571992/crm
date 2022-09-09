<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'designation-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gender" class="control-label">Select Client </label>
                                    <select class="form-control selectpicker" id="userid" name="userid"  required="" data-live-search="true">
                                        <option value="" disabled selected>--Select One--</option>
                                        <?php
                                        if(!empty($client_info)){
                                            foreach ($client_info as $row) {
                                                ?>
                                                <option value="<?php echo $row['userid']; ?>" <?php if(!empty($client) && $client['userid'] == $row['userid']){ echo 'selected';}?>><?php echo cc($row['client_branch_name']); ?></option>
                                                <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>

                               <div class="form-group">
                                    <label for="staff_group" class="control-label">Select Group</label>
                                    <select class="form-control selectpicker" id="staff_group" name="staff_group[]"  multiple  data-live-search="true">
                                        <option value=""></option>

                                        <?php
                                        $group_arr = array();
                                        if(isset($client['staff_group']) && $client['staff_group']!='')
                                        {
                                            $group_arr=explode(',',$client['staff_group']);
                                        }
                                        if (isset($group_info) && count($group_info) > 0) {
                                            foreach ($group_info as $group_value) 
                                            {
                                                $staff_id = explode(',', $group_value['staff_id']);
                                                ?>
                                                <optgroup class="<?php echo 'group' . $group_value['id'] ?>">
                                                    <option value="<?php echo $group_value['id'] ?>"  <?php echo (isset($client['staff_group']) && in_array($group_value['id'],$group_arr)) ? 'selected' : "" ?>><?php echo $group_value['name'] ?></option>
                                                        <?php
                                                        if(!empty($staff_id)){
                                                            foreach ($staff_id as $s_id) {
                                                               echo '<option disabled="" style="margin-left: 3%;">'.get_employee_name($s_id).'</option>';
                                                            }
                                                        }
                                                        ?>
                                                        
                                                </optgroup>
                                        <?php
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
