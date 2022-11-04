<?php 
    init_head();
?>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="row">
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) {
                                                echo $f_date;
                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) {
                                                echo $t_date;
                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-3">                            
                                    <button type="submit" style="margin-top: 26px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 26px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                        </form>

                        <br>

                        <div class="col-md-12">
                            <br>
                            <div class="table-responsive" style="margin-bottom:30px;">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Sales Person</th>
                                            <th>Lead Assigned</th>
                                            <th>Lead Converted</th>
                                            <th>Percent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if (!empty($sales_person_list)){
                                                foreach ($sales_person_list as $key => $value) {

                                                    $where = "ls.type = 2 and ls.staff_id IN (".$value->sales_person_id.") and l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."'";
                                                    $lead_assigned = $this->db->query("SELECT COUNT(l.id) as ttlcount from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id WHERE ".$where." ")->row()->ttlcount;
                                                    $lead_converted = $this->db->query("SELECT COUNT(l.id) as ttlcount from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id WHERE ".$where." and l.enquiry_type_main_id = '5' ")->row()->ttlcount;
                                                    $percent = ($lead_converted > 0) ? ($lead_converted/$lead_assigned) * 100 : 0;
                                        ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo get_staff_full_name($value->sales_person_id); ?></td>
                                                        <td><?php echo $lead_assigned; ?></td>
                                                        <td><?php echo $lead_converted; ?></td>
                                                        <td><?php echo number_format($percent, 2).' %'; ?></td>
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
            "iDisplayLength": 15,
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
<script type="text/javascript">
    function change_lead_type(enquiry_type_id, type_id, lead_id) {
    var data = {};
    data.type = type_id;
    data.leadid = lead_id;
    data.enquiry_type_id = enquiry_type_id;
        $.post('<?php echo base_url(); ?>admin/leads/update_lead_type', data).done(function(response) {
            if (response != ""){
                $(".enquirytype"+lead_id).html(response);
            }
//        location.reload(true);
    });
}
function change_lead_main_status(enquiry_type_id, type_id, lead_id) {
    var data = {};
    data.type = type_id;
    data.leadid = lead_id;
    data.enquiry_type_id = enquiry_type_id;
        $.post('<?php echo base_url(); ?>admin/leads/update_lead_main_status', data).done(function(response) {
            
            if (response != ""){
                var obj = jQuery.parseJSON(response);
                $(".enquirymaintype"+lead_id).html(obj["main_status"]);
                $(".enquirytype"+lead_id).html(obj["sub_status"]);
            }
//        location.reload(true);
    });
}

//$("#staff_id").on("change", function(){
//    var val = $(this).val();
//    if (val == "all"){
//        $('#staff_id').attr("multiple", "");
//        $('#staff_id option').attr("selected", "selected");
//    }
//});
</script>




</html>

