<?php
init_head();
?>
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="month" class="control-label">Month</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="month" name="month">
                                        <option value=""></option>
                                        <?php
                                        if (!empty($month_info)) {
                                            foreach ($month_info as $row) {
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo (!empty($month) && $month == $row->id) ? 'selected' : ""; ?>  ><?php echo $row->month_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="year" class="control-label">Year</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="year_id" name="year_id">
                                        <option value=""></option>
                                        <?php
                                        $j = date('Y');
                                        for ($i = 2017; $i <= $j; $i++) {
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php echo (!empty($year_id) && $year_id == $i) ? 'selected' : ""; ?>  ><?php echo $i; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="col-md-12"> 
                            <hr> 
                            <div class="table-responsive" style="margin-bottom:30px;">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th width="15%">Worker Name</th>
                                            <th>Request Date </th>
                                            <th>Monthly Salary</th>
                                            <th>Attendance Till Date</th>
                                            <th>Salary Earned Till Date</th>
                                            <th>50% of Salary</th>
                                            <th>Total Advanced Taken</th>
                                            <th>Required Advance Amount</th>
                                            <th>Difference</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        $i = 1;
                                        $ttlamount = 0;
                                        $ttllastadvance = 0;
                                        if (!empty($advance_salary_list)) {
                                            foreach ($advance_salary_list as $key => $r) {

                                                $row = $this->db->query("SELECT * FROM `tblrequests` WHERE id = '".$r->id."' ")->row();

                                                $staff_attandance = $this->db->query("SELECT COUNT(id) as ttl_attendance  FROM `tblstaffattendance` WHERE `staff_id` = '".$row->addedfrom."' AND status NOT IN (2,0) AND MONTH(`date`) = '".$month."' AND YEAR(`date`) = '".$year_id."'")->row();
                                                $monthly_salary  = get_staff_info($row->addedfrom)->monthly_salary;

                                                $ttlstaff_attendance = (!empty($staff_attandance)) ? $staff_attandance->ttl_attendance : 0;
                                                $salarylog = $this->db->query("SELECT * FROM `tbltempstaffsalarylog` WHERE `staff_id` =".$row->addedfrom." AND month='".$month."' AND year='".$year_id."'")->row();
                                                $current_salary = (!empty($salarylog)) ? $salarylog->net_salary : 0;
                                                $getstaff_lastadvanced = $this->db->query("SELECT sum(approved_amount) as last_advance_taken FROM `tblrequests` WHERE `category` = 1 AND `addedfrom` = '".$row->addedfrom."' AND `id` != '".$r->id."' AND `cancel` = 0 AND is_taken = 0 AND MONTH(`date`) = '".$month."' AND YEAR(`date`) = '".$year_id."' and approved_status = 1")->row();
                                                $staff_last_advanced = (!empty($getstaff_lastadvanced) && !empty($getstaff_lastadvanced->last_advance_taken) ) ? $getstaff_lastadvanced->last_advance_taken : 0;
                                                $halfsalaryofstaff = ($current_salary/2);

                                                $approved_status = '<span class="text-warning">Pending</span>';
                                                if ($row->approved_status == 1){
                                                    $approved_status = '<span class="text-success">Approved</span>';
                                                }elseif ($row->approved_status == 2){
                                                    $approved_status = '<span class="text-danger">Rejected</span>';
                                                }
                                                $requested_amt = ($row->approved_amount > 0) ? $row->approved_amount : $row->amount;
                                                $differance_amt = ($halfsalaryofstaff - $staff_last_advanced - $requested_amt);
                                                $ttlamount += $requested_amt;
                                                $ttllastadvance += $staff_last_advanced;
                                                $colorcode = ($differance_amt > 0) ? 'text-success':'text-danger';
                                        ?>        
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo get_employee_fullname($row->addedfrom); ?></td>
                                                    <td><?php echo _d($row->date); ?></td>
                                                    <td><?php echo number_format(round($monthly_salary), 2, '.', ','); ?></td>
                                                    <td><?php echo $ttlstaff_attendance.' Days'; ?></td>
                                                    <td><?php echo number_format(round($current_salary), 2, '.', ','); ?></td>
                                                    <td><?php echo number_format(round($halfsalaryofstaff), 2, '.', ','); ?></td>
                                                    <td><?php echo $staff_last_advanced; ?></td>
                                                    <td class="<?php echo $colorcode; ?>"><?php echo $requested_amt; ?></td>
                                                    <td class="<?php echo $colorcode; ?>"><?php echo number_format(round($differance_amt), 2, '.', ','); ?></td>
                                                    <td><?php echo $approved_status; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" style="text-align:center;font-size: 20px;">Total Advance Amount</td>
                                            <td style="font-size: 20px;"><?php echo number_format($ttllastadvance, 2, '.', ','); ?></td>
                                            <td colspan="3" style="font-size: 20px;"><?php echo number_format($ttlamount, 2, '.', ','); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
<?php init_tail(); ?>
</body>
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
            "iDisplayLength": 25,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength',
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
                'colvis',
            ]
        });
    });
</script>
</html>
