<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'interview_details-form', 'class' => 'proposal-form','enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="designation" class="control-label">Designation <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" id="designation_id" name="designation_id" required="" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                            if($designation_list){
                                                foreach ($designation_list as $value) {
                                                    $selected = (!empty($requirement_info->designation_id) && $value->id == $requirement_info->designation_id) ? "selected='selected'":"";
                                                    echo '<option value="'.$value->id.'" '.$selected.'>'.$value->designation.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="designation" class="control-label">Department <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" id="department_id" name="department_id" required="" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                            if($department_list){
                                                foreach ($department_list as $value) {
                                                    $selected = (!empty($requirement_info->department_id) && $value->id == $requirement_info->department_id) ? "selected='selected'":"";
                                                    echo '<option value="'.$value->id.'" '.$selected.'>'.cc($value->name).'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="branch_id" class="control-label">Branch <span style="color: red;">*</span></label>
                                    <select class="form-control selectpicker" id="branch_id" name="branch_id" required="" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                            if($branch_list){
                                                foreach ($branch_list as $value) {
                                                    $selectedcls = "";
                                                    if (!empty($requirement_info->branch_id) && $value->id == $requirement_info->branch_id){
                                                        $selectedcls = "selected='selected'";
                                                    }else if($value->id == get_login_branch()) {
                                                        $selectedcls = "selected='selected'";
                                                    }
                                                    
                                                    echo '<option value="'.$value->id.'" '.$selectedcls.'>'.cc($value->comp_branch_name).'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" style="margin-bottom:2%;">

                                <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?> <span style="color: red;">*</span></label>

                                <select class="form-control selectpicker" required="" multiple data-live-search="true" id="assign" name="assignid[]">

                                    <?php
                                    if (isset($allStaffdata) && count($allStaffdata) > 0) {

                                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                            ?>

                                            <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">

                                                <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>

                                                <?php
                                                foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                    ?>

                                                    <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                    if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {

                                                        echo'selected';
                                                    }
                                                    ?>>       <?php echo $singstaff['firstname'] ?></option>

                                                <?php }
                                                ?>

                                            </optgroup>

                                            <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="location" class="control-label">Location <span style="color: red;">*</span></label>
                                    <input type="text" name="location" class="form-control" required="" value="<?php echo (!empty($requirement_info->location)) ? $requirement_info->location : ""; ?>">  
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="candidate_number" class="control-label">No Of Candidate Requirement<span style="color: red;">*</span></label>
                                    <input type="number" name="candidate_number" class="form-control" required="" value="<?php echo (!empty($requirement_info->candidate_number)) ? $requirement_info->candidate_number : ""; ?>">  
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <?php
                                    $deadline_date = (!empty($requirement_info) && !empty($requirement_info->deadline_date)) ? date("d/m/Y", strtotime($requirement_info->deadline_date)) : "";
                                    echo render_date_input('deadline_date', 'Deadline Date  <span style="color: red;">*</span>', $deadline_date, array("required" => ""));
                                ?>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="experience" class="control-label">Experience <span style="color: red;">*</span></label>
                                    <input type="text" name="experience" class="form-control" required="" value="<?php echo (!empty($requirement_info->experience)) ? $requirement_info->experience : ""; ?>">  
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reason" class="control-label">Reason <span style="color: red;">*</span></label>
                                    <textarea type="text" name="reason" required="" class="form-control" rows="3"><?php echo (!empty($requirement_info->reason)) ? $requirement_info->reason : ""; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="job_description" class="control-label">Job Description <span style="color: red;">*</span></label>
                                    <textarea type="text" name="job_description" required="" class="form-control" rows="3"><?php echo (!empty($requirement_info->job_description)) ? $requirement_info->job_description : ""; ?></textarea>
                                </div>
                            </div> 
                            
                        </div>
                    </div>

                    <div class="btn-bottom-toolbar text-right">
                        <button class="btn btn-info" type="submit">
                            <?php echo 'Submit'; ?>
                        </button>
                    </div>

                    </div>
                    <div class="designation_question">
                        <?php
                            if(!empty($interview_questions)){
                    ?>
                            <div class="panel_s">
                                <div class="panel-body">
                                    <h4>Interview Questions Answers</h4>
                                    <hr class="hr-panel-heading">
                                    <?php
                                        foreach ($interview_questions as $k => $value) {
                                        echo    '<div class="col-md-12">
                                                    <div class="row">
                                                        <label for="question" style="color:red;" class="control-label">'.++$k.") ".$value->question.'</label>
                                                        <div class="form-group">
                                                            <input type="hidden" name="interview['.$k.'][question]" value="'.$value->question.'">
                                                            <textarea id="answer_'.$k.'" required="" name="interview['.$k.'][answer]" class="form-control">'.$value->answer.'</textarea>
                                                        </div>    
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    ?>
                                </div>
                            </div>
                    <?php    
                            }
                        ?>
                    </div>
                </div>

            </div> 

            <?php echo form_close(); ?>



        </div>

        <div class="btn-bottom-pusher"></div>

    </div>

<?php init_tail(); ?>


<script type="text/javascript">

</script>

</body>

</html>

