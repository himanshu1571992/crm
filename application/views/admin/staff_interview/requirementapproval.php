<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
    .b-success{
        background-color: yellowgreen;
        color: #FFF;
        padding: 5px;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        padding: 15px;
        /*width: 20%;*/
        /*border-radius: 50%;*/
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .card-inform {
        margin-bottom: 10px;
    }
    .bg-c-green {
        background: linear-gradient(45deg,#2ed8b6,#59e0c5);
    }
    .bg-palegoldenrod {
        background-color: palegoldenrod;
    }
    .bg-moccasin {
        background-color: moccasin;
    }
    .bg-gray {
        background-color: #e4e6ea;
    }
    
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'interview_details-form', 'class' => 'proposal-form','enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12 bg-c-green">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Designation</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo value_by_id("tbldesignation", $requirement_info->designation_id, "designation"); ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>    
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Department</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo value_by_id("tbldepartmentsmaster", $requirement_info->department_id, "name"); ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>    
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Branch</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo value_by_id("tblcompanybranch", $requirement_info->branch_id, "comp_branch_name"); ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>    
                                 
                                    
                            </div>
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Location</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($requirement_info->location)) ? $requirement_info->location : "--"; ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>    
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">No Of Candidate Requirement</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($requirement_info->candidate_number)) ? $requirement_info->candidate_number : "--"; ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>    
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Deadline Date</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($requirement_info->deadline_date)) ? _d($requirement_info->deadline_date) : "--"; ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>   
                            </div>
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Experience</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($requirement_info->experience)) ? $requirement_info->experience : "--"; ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>    
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Added By</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo ($requirement_info->added_by > 0) ? get_employee_name($requirement_info->added_by) : "--"; ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>    
                                <div class="col-sm-4">
                                    <div class="card label-info bg-gray">
                                        <div class="card-body ">
                                            <h4 class="card-title">Job Description</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($requirement_info->job_description)) ? cc($requirement_info->job_description) : "--"; ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>
                                
                            </div> 
                            <div class="col-md-12 card-inform">
                                <div class="col-sm-12">
                                    <div class="card label-info bg-palegoldenrod">
                                        <div class="card-body ">
                                            <h4 class="card-title">Reason</h4>
                                            <p class="card-text">
                                            <div class="form-group" style="font-size: 15px;">
                                                <?php echo (!empty($requirement_info->reason)) ? cc($requirement_info->reason) : "--"; ?>
                                            </div>
                                            </p>
                                        </div>    
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 pull-right">
                                    <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="6"><?php
                                            if (!empty($appvoal_info)) {
                                                echo $appvoal_info->approve_remark;
                                            }
                                            ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="5" style="background-color: #e8bb0b;color: #fff;" class="btn btn-warning hold mleft10 proposal-form-submit save-and-send transaction-submit">
                                    On Hold
                                </button>
                                <button type="submit" name="submit" value="4" style="background-color: brown;color: #fff;" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit button3">
                                    Reconciliation
                                </button>
                                <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>
                                <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approve
                                </button>
                            </div> 
                           <?php 
                        }
                    ?>
                </div>
            </div>
            
            <?php echo form_close(); ?>



        </div>

        <div class="btn-bottom-pusher"></div>

    </div>

<?php init_tail(); ?>


<script type="text/javascript">

    $(function () {

        $('#color-group').colorpicker({horizontal: true});

    });

    $(document).on('change', '#designation_id', function() {   

        var designation_id = $(this).val(); 
        var url = "<?php echo admin_url("staff_interview/get_designation_question"); ?>";
        $.post(url, { designation_id: designation_id, interview_round: "<?php echo $round; ?>"}, function (response){
            if (response != ''){
                $(".designation_question").html(response);
            }else{
                $(".designation_question").html("");
            }      
        });
    });
</script>

</body>

</html>

