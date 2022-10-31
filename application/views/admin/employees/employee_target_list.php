<?php init_head(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
        background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('employees/employee_target'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title; ?></h4>
                                </div>
                                <?php if(check_permission_page(334,'create')){ ?>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <a target="_blank" href="<?php echo admin_url("employees/add_monthly_target")?>" type="submit" class="btn btn-info">Add Monthly Target</a>
                                </div>
                                <?php } ?>
                            </div>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="staff_id" class="control-label">Employee Name</label>
                                    <select class="form-control selectpicker" name="staff_id" id="staff_id" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                            if (!empty($sales_person_info)) {
                                            foreach ($sales_person_info as $row) {
                                        ?>
                                                <option value="<?php echo $row->sales_person_id; ?>" <?php echo (!empty($staff_id) && ($staff_id == $row->sales_person_id)) ? 'selected' : ''; ?> ><?php echo cc(get_employee_name($row->sales_person_id)); ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="division_id" class="control-label">Division</label>
                                    <select class="form-control selectpicker" name="division_id" id="division_id" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        if (isset($divisionmaster_list) && count($divisionmaster_list) > 0) {
                                            foreach ($divisionmaster_list as $value) {
                                                ?>
                                                <option value="<?php echo $value->id ?>" <?php echo (isset($division_id) && $division_id == $value->id) ? 'selected' : "" ?>><?php echo cc($value->title); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                </div>

                                <div class="col-md-12">	
                                    <div class="table-responsive"> 															
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Employee Name</th>
                                                    <!-- <th>Product Category</th> -->
                                                    <th>Division</th>
                                                    <th>Target Amount</th>
                                                    <th>Remark</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if (!empty($employee_target)) {
                                                $z = 1;
                                                foreach ($employee_target as $row) {
                                                    ?>																						
                                                        <tr>
                                                            <td><?php echo $z++; ?></td>
                                                            <td>
                                                                <?php echo get_creator_info($row->added_by, $row->created_at); ?>
                                                                <?php echo cc(get_employee_name($row->staff_id)); ?>
                                                            </td>
                                                            <!-- <td><?php echo cc(get_product_category($row->product_category_id)); ?></td> -->
                                                            <td><?php echo cc(value_by_id("tbldivisionmaster", $row->product_category_id, "title")); ?></td>
                                                            <td><?php echo number_format($row->amount, 2); ?></td>
                                                            <td><?php echo $row->remark; ?></td>
                                                            <td class="text-center">
                                                                <a target="_blank" href="<?php echo admin_url("employees/staff_target_list/".$row->staff_id."");?>">Target Achieved</a>
                                                                <?php if(check_permission_page(334,'edit')){ ?>
                                                                <a target="_blank" class="btn btn-info" href="<?php echo admin_url("employees/employee_target_edit/".$row->id."");?>"><i class="fa fa-edit"></i></a>
                                                                <?php 
                                                                }
                                                                if(check_permission_page(334,'delete')){ ?>
                                                                <a class="btn btn-danger _delete" href="<?php echo admin_url("employees/employee_target_delete/".$row->id."");?>"><i class="fa fa-trash-o"></i></a>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                           
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Work List</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script>

    $(document).ready(function () {
        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip'
        });
    });
</script>

<script type="text/javascript">
    $(".myselect").select2();
</script>

</body>
</html>
