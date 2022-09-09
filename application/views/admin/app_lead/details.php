<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('Task/task_details'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">


                            <h4 class="no-margin">App Lead - Details  </h4>
                            <hr class="hr-panel-heading">

                            <div class="row">

                                <?php
                                $reminder_for = '--';
                                if (isset($reminder_info) && !empty($reminder_info)){
                                    if ($reminder_info->reminder_for == 1) {
                                        $reminder_for = 'Payment Followup';
                                    } elseif ($reminder_info->reminder_for == 2) {
                                        $reminder_for = 'Lead Followup';
                                    } elseif ($reminder_info->reminder_for == 3) {
                                        $reminder_for = 'Task';
                                    }
                                }
                                ?>						

                                <div role="tabpanel" class="tab-pane" id="lead_activity">
                                    <div class="panel_s no-shadow">
                                        <div class="activity-feed">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="Description-box">
                                                        <p><b>Lead Created Date  : </b> <?php echo date('d/m/Y', strtotime($lead_info->created_at)); ?></p> 
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="Description-box text-right">
                                                        <?php
                                                        if ($lead_info->status == 1) {
                                                            echo '<p class="label label-success"><b>Converted</b></p>';
                                                        }
                                                        ?>  
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <div class="Description-box">
                                                            <p><b>Company Name : </b> <?php echo cc($lead_info->company_name); ?></p> 
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="Description-box">
                                                            <p><b>Company Number : </b> <?php echo $lead_info->company_number; ?></p> 
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="Description-box">
                                                            <p><b>Company Email : </b> <?php echo $lead_info->company_email; ?></p> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <div class="Description-box">
                                                            <p><b>Contact Person Name : </b> <?php echo $lead_info->person_name; ?></p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="Description-box">
                                                            <p><b>Contact Person Number : </b> <?php echo $lead_info->person_number; ?></p> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="Description-box">
                                                            <p><b>Contact Person Email : </b> <?php echo $lead_info->person_email; ?></p> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <div class="Description-box">
                                                            <p><b>Contact Person Designation : </b> <?php echo value_by_id('tbldesignation', $lead_info->designation_id, 'designation'); ?></p> 
                                                        </div>
                                                    </div>


                                                    <div class="col-md-8">
                                                        <div class="Description-box">
                                                            <p><b>Lead Description : </b> <?php echo $lead_info->description; ?></p> 
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                

                                                

                                                <div class="col-md-12">
                                                    <div class="Description-box">
                                                        <?php
                                                        if (!empty($lead_attachment)) {
                                                            echo '<p><b>Image Attachment : </b>';
                                                            foreach ($lead_attachment as $key => $value) {
                                                                ?>
                                                                <p><?php if (!empty($value->file_name)) { ?><a target="_blank" href="<?php echo base_url('uploads/app_leads/' . $value->rel_id . '/' . $value->file_name); ?>" >View Attachment</a><?php } ?></p> 
                                                                <?php
                                                            }
                                                        }
                                                        ?>

                                                    </div>
                                                </div>


                                            </div>





                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#month', function () {
        $("#attendance_form").submit();
    });
</script> 


<script type="text/javascript">
    $(document).on('click', '.pay_all', function () {
        if (!$("input[name='staffid[]']").is(":checked")) {
            alert('Please Check Any Checkbox First!');
            return false;
        } else {
            $("#salary_form").submit();
        }



    });
</script> 

<script type="text/javascript">
    $(".myselect").select2();
</script>

</body>
</html>
