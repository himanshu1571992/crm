<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('expenses/expense_report'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?></h4>
                            <hr class="hr-panel-heading">

                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="staff_id" class="control-label">Employee Name </label>
                                    <select class="form-control selectpicker" data-live-search="true" id="staff_id" name="staff_id">
                                        <option value="" >-- Select All -</option>
                                        <?php
                                        if (!empty($staff_list)) {
                                            foreach ($staff_list as $row) {
                                                if (in_array($row->staffid, $staffids)){
                                                ?>
                                                <option value="<?php echo $row->staffid; ?>" <?php if (isset($s_staff) && ($s_staff == $row->staffid)) {
                                            echo 'selected';
                                        } ?> ><?php echo cc($row->firstname); ?></option>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="category_id" class="control-label">Expense Category</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="category_id" name="category_id">
                                        <option value="" >-- Select All -</option>
                                        <?php
                                        if (!empty($category_info)) {
                                            foreach ($category_info as $row) {
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php
                                                if (isset($category_id) && $category_id == $row->id) {
                                                    echo 'selected';
                                                }
                                                ?> ><?php echo cc($row->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="expense_type" class="control-label">Expense Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="expense_type" name="expense_type">
                                        <option value="" >-- Select All -</option>
                                        <option value="1" <?php
                                        if (isset($expense_type) && $expense_type == 1) {
                                            echo 'selected';
                                        }
                                        ?> >Personal Expense</option>
                                        <option value="2" <?php
                                        if (isset($expense_type) && $expense_type == 2) {
                                            echo 'selected';
                                        }
                                        ?> >Company Expense</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="type_id" class="control-label">Expense Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="type_id" name="type_id">
                                        <option value="" >-- Select All -</option>
                                        <?php
                                        if (!empty($type_info)) {
                                            foreach ($type_info as $row) {
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php
                                                if (isset($s_type) && $$s_type == $row->id) {
                                                    echo 'selected';
                                                }
                                                ?> ><?php echo cc($row->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-2">
                                    <label for="status" class="control-label">Status</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="status" name="status">
                                        <option value="" >-- Select All -</option>
                                        <option value="1" <?php
                                        if (isset($status) && $status == 1) {
                                            echo 'selected';
                                        }
                                        ?> >Approved</option>
                                        <option value="2" <?php
                                        if (isset($status) && $status == 2) {
                                            echo 'selected';
                                        }
                                        ?> >Rejected</option>
                                        <option value="3" <?php
                                                if (isset($status) && $status == 3) {
                                                    echo 'selected';
                                                }
                                        ?> >Pending</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" required name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" required name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="status" class="control-label">Bill Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="bill_type" name="bill_type">
                                        <option value="" >-- Select All -</option>
                                        <option value="1" <?php echo (isset($bill_type) && $bill_type == 1) ? 'selected' : ''; ?> >With Bill</option>
                                        <option value="2" <?php echo (isset($bill_type) && $bill_type == 2) ? 'selected' : ''; ?> >Without Bill</option>
                                        <option value="3" <?php echo (isset($bill_type) && $bill_type == 3) ? 'selected' : ''; ?> >GST Bill</option>
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
                                                    <th width="3%">S.No</th>
                                                    <th width="7%">Date</th>
                                                    <th width="10%">EXP-ID</th>
                                                    <th>Employee</th>
                                                    <th>Category</th>
                                                    <th>Details</th>
                                                    <th>Expense Type</th>
                                                    <th>Type</th>
                                                    <th>Sub-Type</th>
                                                    <th>Bill Type</th>
                                                    <th>Party Name</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th width="10%">Images</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($expense_info)) {
                                                    $z = 1;
                                                    foreach ($expense_info as $row) {

                                                        if ($row->parent_id > 0) {
                                                            $parent_id = $row->parent_id;
                                                        } else {
                                                            $parent_id = $row->id;
                                                        }

                                                        if ($row->expense_for == 1) {
                                                            $expense_for = 'Personal';
                                                        } elseif ($row->expense_for == 2) {
                                                            $expense_for = 'Company';
                                                        } else {
                                                            $expense_for = '--';
                                                        }

                                                        if ($row->approved_status == 1) {
                                                            $approved_status = 'Approved';
                                                            $cls = 'text-success';
                                                        } elseif ($row->approved_status == 2) {
                                                            $approved_status = 'Rejected';
                                                            $cls = 'text-danger';
                                                        } else {
                                                            $approved_status = 'Pending';
                                                            $cls = 'text-warning';
                                                        }
                                                        $bill_type = '--';
                                                        $bill_party_name = '--';
                                                        if($row->category == 2){
                                                            $column = 'tempo_bill_type';
                                                        }elseif($row->category == 4){
                                                            $column = 'hotel_bill_type';
                                                        }elseif($row->category == 6){
                                                            $column = 'extra_bill_type';
                                                        }
                                                        
                                                        if(!empty($column)){
                                                            if($row->$column == 1){
                                                                $bill_type = "With Bill";

                                                                if(!empty($row->bill_party_name)){
                                                                    $bill_party_name =$row->bill_party_name;
                                                                }
                                                            }elseif($row->$column == 2){
                                                                $bill_type = "Without Bill";
                                                            }elseif($row->$column == 3){
                                                                $bill_type = "GST Bill";

                                                                if(!empty($row->bill_party_name)){
                                                                    $bill_party_name =$row->bill_party_name;
                                                                }
                                                            }
                                                        }

                                                        
                                                        

                                                        $file_info = $this->db->query("SELECT * FROM `tblfiles` where  rel_id = '" . $row->id . "' and rel_type = 'expense'  ")->result();
                                                        ?>																						
                                                        <tr>
                                                            <td><?php echo $z++; ?></td>
                                                            <td><?php echo _d($row->date); ?></td>
                                                            <td><?php echo 'EXP-' . get_short(get_expense_category($row->category)) . '-' . number_series($parent_id); ?></td>
                                                            <td><?php echo get_employee_name($row->addedfrom); ?></td>
                                                            <td><?php echo cc(value_by_id('tblexpensescategories', $row->category, 'name')); ?></td>
                                                            <td>Purpose - <?php echo get_expense_purpose($row->id); ?> <br> <?php echo cc(get_expense_related($row->id)); ?></td>
                                                            <td><?php echo $expense_for; ?></td>
                                                            <td><?php echo value_by_id('tblexpensetype', $row->type_id, 'name'); ?></td>
                                                            <td><?php echo value_by_id('tblexpensetypesub', $row->typesub_id, 'name'); ?></td>
                                                            <td><?php echo $bill_type; ?></td>
                                                            <td><?php echo $bill_party_name; ?></td>
                                                            <td><?php echo $row->amount; ?></td>
                                                            <td><?php echo '<p class="' . $cls . '">' . $approved_status . '</p>'; ?></td>
                                                            <td><?php
                                                                if (!empty($file_info)) {
                                                                    foreach ($file_info as $file) {
                                                                        ?>
                                                                        <a target="_blank" href="<?php echo site_url('uploads/expenses/' . $row->id . '/' . $file->file_name); ?>"><?php echo $file->file_name; ?></a><br>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?></td>

                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo '<tr><td class="text-center" colspan="14"><h5>Record Not Found</h5></td></tr>';
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>


<script>

    $(document).ready(function () {
        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ]
        });
    });
</script>

</body>
</html>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Expanse Type</h4>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).on('click', '.type', function () {

        var expense_id = $(this).val();
        var type_id = $("#type_id").val();
        var staff_id = $("#staff_id").val();
        var f_date = $("#f_date").val();
        var t_date = $("#t_date").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/expenses/change_expense_type_modal'); ?>",
            data: {'expense_id': expense_id, 'type_id': type_id, 'staff_id': staff_id, 'f_date': f_date, 't_date': t_date},
            success: function (response) {
                if (response != '') {


                    $('.modal-body').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })


    });
</script>
