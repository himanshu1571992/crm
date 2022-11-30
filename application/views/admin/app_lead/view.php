<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('app_lead'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?>  </h4>
                            <hr class="hr-panel-heading">

                            <div class="row">

                                <div class="form-group col-md-3">
                                    <label for="status" class="control-label">Lead Status</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status">
                                        <option value="">--Select All--</option>
                                        <option value="0" <?php if (!empty($s_status) && $s_status == 0) {
    echo 'selected';
} ?>>Pending</option>
                                        <option value="1" <?php if (!empty($s_status) && $s_status == 1) {
    echo 'selected';
} ?>>Converted</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" required name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" required name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <!-- <div class="form-group col-md-2 float-right">
                                        <button class="form-control btn-info" type="submit" value="print">Search</button> 
                                </div> -->
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>

                                <div class="col-md-12 table-responsive">																
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Added By</th>
                                                <th>Company Name</th>
                                                <th>Company Email</th>
                                                <th>Company Number</th>
                                                <th>Contact Person</th>
                                                <th>Created Date</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($task_list)) {
                                                $z = 1;
                                                foreach ($task_list as $row) {

                                                    if ($row->status == 0) {
                                                        $status = '<span class="btn btn-warning">Pending</span>';
                                                    } elseif ($row->status == 1) {
                                                        $status = '<span class="btn btn-success">Converted</span>';
                                                    }
                                                    
                                                    ?>																						
                                                    <tr>
                                                        <td><?php echo $z++; ?></td>
                                                        <td><?php echo get_employee_name($row->staff_id); ?></td>
                                                        <td><?php echo cc($row->company_name); ?></td>
                                                        <td><?php echo $row->company_email; ?></td>
                                                        <td><?php echo $row->company_number; ?></td>
                                                        <td><?php echo $row->person_name; ?></td>
                                                        <td><?php echo date('d/m/Y', strtotime($row->created_at)); ?></td>
                                                        <td><?php echo $status; ?></td>
                                                        <td>
                                                            <a class="btn btn-info" target="_blank" href="<?php echo admin_url('app_lead/details/' . $row->id); ?>">View</a>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>



                            </div>

<?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>



                            <div class="btn-bottom-toolbar text-right">

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
